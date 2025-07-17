<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function myOrders()
    {
        $myOrders = Order::where('user_id', Auth::user()->id)->get();
        return view('backend.customer.my-orders.index', compact('myOrders'));
    }

    public function orderDetails(Order $order)
    {
        $this->authorize('orderDetails', $order);
        $ordersItems= $order->orderItems;
        return view('backend.customer.my-orders.details', compact('order','ordersItems'));
    }

    public function markReceived(Order $order)
    {
        $this->authorize('orderDetails', $order);
        $order->update(['received_at' => now()]);
        return response()->json(['success' => true, 'message' => 'Order marked as received successfully']);
    }
}
