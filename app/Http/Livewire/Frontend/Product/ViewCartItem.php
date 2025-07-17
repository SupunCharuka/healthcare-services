<?php

namespace App\Http\Livewire\Frontend\Product;

use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class ViewCartItem extends Component
{
    public $cartItems = [];
    public $cartTotal = 0;
    protected $listeners = [
        'cartUpdated' => 'updateCartCount',
    ];


    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $this->cartItems = session('cart', []);
        $this->cartTotal = $this->calculateCartTotal($this->cartItems);
    }

    private function calculateCartTotal($cartItems)
    {
        $total = 0;

        foreach ($cartItems as $item) {


            $total += $item['discount_price'];
        }

        return $total;
    }

    public function removeItem($index)
    {
        $cartItems = session('cart', []);

        if (isset($cartItems[$index])) {
            unset($cartItems[$index]);
            session(['cart' => $cartItems]);
            $this->cartItems = $cartItems; // Update the cart items in the component
            $this->emit('cartUpdated');
        }
    }
    public function checkout()
    {
        if (!(auth()->check())) {
            return Redirect::to('/login')->with('message', 'Login First!');
        } else {
            session(['cart_items' => $this->cartItems]);
            $this->emit('checkoutItems');
            return redirect()->route('checkout');
        }
    }


    public function updateCartItem($index)
    {
        $this->cartItems[$index]['discount_price'] = $this->cartItems[$index]['price'] * $this->cartItems[$index]['quantity'];
        $this->cartTotal = $this->calculateCartTotal($this->cartItems);
    }

    public function render()
    {
        return view('livewire.frontend.product.view-cart-item');
    }
}
