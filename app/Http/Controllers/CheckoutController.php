<?php

namespace App\Http\Controllers;

use ApiChef\PayHere\Payment;
use App\Enums\OrderStatusEnum;
use App\Enums\PayHerePaymentStatusEnum;
use App\Models\Order;
use App\Utils\Enums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show()
    {

        return view('frontend.checkout.index');
    }

    public function placeOrder(Order $order, Request $request)
    {
        $this->authorize('placeOrder', $order);

        $payment = Payment::make($order, $request->user(), $order->amount);

        return view('frontend.checkout.place-order', compact('payment', 'order'));
    }

    public function success(Request $request)
    {

        $payment = Payment::findByOrderId($request->get('order_id'));
        $order = $payment->payable;
        $order->status =  OrderStatusEnum::approved->value;
        $order->payment_method = 'online';
        $order->save();

        $paymentStatus = 'success';
        $redirectRoute = route('checkout');

        return view('frontend.checkout.payment.payment-success', compact('paymentStatus', 'redirectRoute'));
    }

    public function cancelled(Request $request)
    {
        $payment = Payment::findByOrderId($request->get('order_id'));
        $order = $payment->payable;
        $order->status = OrderStatusEnum::rejected->value;
        $order->payment_method = 'online';
        $order->save();

        $paymentStatus = 'error';
        $errorMessage = 'The transaction was unsuccessful';
        $redirectRoute = route('checkout');


        return view('frontend.checkout.payment.payment-cancelled', compact('paymentStatus', 'errorMessage', 'redirectRoute'));
    }
}
