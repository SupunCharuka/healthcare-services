<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberOrderController extends Controller
{
    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('backend.service-provider.orders.index', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        $this->authorize('orderDetails', $order);
        return view('backend.service-provider.orders.order-details',compact('order'));
    }

    public function markReceived(Order $order)
    {
        $this->authorize('orderDetails', $order);
        $order->update(['received_at' => now()]);
        return response()->json(['success' => true, 'message' => 'Order marked as received successfully']);
    }

}
