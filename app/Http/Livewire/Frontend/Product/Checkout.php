<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Enums\OrderStatusEnum;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\User;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;


class Checkout extends Component
{
    use WithFileUploads;
    public Order $order;
    public array $listForFields = [];
    public $buyItems = [];
    public $subTotal = 0;
    public $cartItems = [];
    protected $listeners = [
        'buyNow' => 'updateBuyNow',
        'checkoutItems' => 'processCheckout',
    ];
    public $bankReceiptFile;

    protected function rules()
    {
        return [
            'order.name' => ['required', 'string', 'max:255'],
            'order.email' => ['required', 'string', 'email', 'max:255'],
            'order.address' => ['required', 'string', 'max:255'],
            'order.district_id' => ['required', 'string'],
            'order.city_id' => ['required', 'string'],
            'order.number' => ['required', 'regex:/^\+\d{11}$/'],
            'order.payment_method' => ['required', 'in:bank_receipt,online,cod'],
            'order.bank_receipt_description' => ['nullable', 'string', 'max:255',],
            'bankReceiptFile' => ['required_if:order.payment_method,bank_receipt', 'nullable', 'file', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
        ];
    }

    protected $validationAttributes = [
        'order.district_id' => "district",
        'order.city_id' => "city",
        'order.number' => "phone number",
        'order.name' => "name",
        'order.email' => "email",
        'order.address' => "address",
        'order.payment_method' => 'payment method',
        'order.bank_receipt_description' => 'bank receipt description',
        'bankReceiptFile' => 'bank receipt file',
    ];

    protected $messages = [
        'order.name.required' => 'The name field is required.',
        'order.email.required' => 'The email field is required.',
        'order.email.email' => 'Please enter a valid email address.',
        'order.address.required' => 'The address field is required.',
        'order.district_id.required' => 'The district field is required.',
        'order.city_id.required' => 'The city field is required.',
        'order.number.required' => 'The phone number field is required.',
        'order.number.regex' => 'Please enter a valid phone number in the format: +947xxxxxxxx.',
        'order.payment_method.required' => 'Please select a payment method.',
        'order.bank_receipt_description.required_if' => 'The bank receipt description field is required when payment method is bank receipt.',
        'bankReceiptFile.required_if' => 'The bank receipt file field is required when payment method is bank receipt.',
        'bankReceiptFile.mimes' => 'The bank receipt file must be a valid file format (jpeg, bmp, png, gif, svg, pdf).',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function updatingOrderDistrictId($district)
    {

        $this->listForFields['city'] = City::where('district_id', $district)->orderBy('name')->get();
    }

    public function mount()
    {
        $this->order = new Order();
        $this->order->name = Auth::user()->name ?? '';
        $this->order->email = Auth::user()->email ?? '';
        $this->order->number = Auth::user()->phone ?? '';
        $this->listForFields['district'] = District::orderBy('name')->get();
        $this->listForFields['city'] = City::where('district_id', $this->order->district_id)->orderBy('name')->get();

        if (session()->has('buy')) {
            $this->updateBuyNow();
        } else {
            $this->processCheckout();
        }
    }

    public function processCheckout()
    {
        $this->buyItems = session('cart_items', []);
        $this->subTotal = $this->calculateCartTotal($this->buyItems);
    }

    public function updateBuyNow()
    {
        $this->buyItems = session('buy', []);
        $this->subTotal = $this->calculateCartTotal($this->buyItems);
    }

    private function calculateCartTotal($items)
    {
        $total = 0;

        foreach ($items as $item) {


            $total += $item['discount_price'];
        }

        return $total;
    }

    public function saveOrder()
    {
        $this->validate();
        // Save the order
        $order = $this->order;
        $order->status =  OrderStatusEnum::pending->value;
        $order->user_id = auth()->user()->id;
        $order->amount = $this->subTotal;
        $order->payment_method = $this->order->payment_method;
        if ($this->order->payment_method == 'bank_receipt') {
            $order->bank_receipt_description = $this->order->bank_receipt_description;
            if (!empty($this->bankReceiptFile)) {
                $bankReceiptFileName = $this->bankReceiptFile->getClientOriginalName() . "-" . \Str::random(20) . "-" . Carbon::now()->timestamp . '.' . $this->bankReceiptFile->extension();
                if (!empty($this->bankReceiptFile)) {
                    Storage::delete('uploads/customer/order/bank-receipt/' .  $order->bank_receipt);
                }
                $this->bankReceiptFile->storeAs('uploads/customer/order/bank-receipt', $bankReceiptFileName);
                $order->bank_receipt = $bankReceiptFileName;
            }
        }
        $order->save();

        // Save the order items
        foreach ($this->buyItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->product_variations_id = $item['variation'];
            $orderItem->qty = $item['quantity'];
            $orderItem->price = $item['discount_price'];
            $orderItem->save();
        }

        // if (session()->has('buy')) {
        //     session()->forget('buy');
        // } else {
        //     // session()->forget('cart_items');
        //     session()->forget('cart');
        // }


        $this->order = new Order();
        $this->bankReceiptFile = null;

        $this->sendAdminSmsNotification($order);
        if ($order->payment_method === 'bank_receipt' || $order->payment_method === 'cod') {
            
            Session::flash('success', 'Your order has been placed successfully.!');
            return redirect()->route('checkout');

        } elseif ($order->payment_method === 'online') {
            $order->status = OrderStatusEnum::rejected->value;
            $order->payment_method = 'online';
            $order->save();
            return redirect()->route('placeOrder', ['order' => $order]);
        }
    }

    public function sendAdminSmsNotification(Order $order)
    {
        $adminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        
    }


    public function render()
    {
        return view('livewire.frontend.product.checkout');
    }
}
