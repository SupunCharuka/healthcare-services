<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\SmsService;
use App\Utils\Enums;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function Orders()
    {
        abort_if(Gate::denies('orders.view'), Response::HTTP_FORBIDDEN);
        $orders = Order::all();
        return view('backend.admin.orders.index', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        abort_if(Gate::denies('orders.details'), Response::HTTP_FORBIDDEN);

        return view('backend.admin.orders.order-details', compact('order'));
    }



    public function approveOrder(Request $request)
    {
        abort_if(Gate::denies('orders.approve'), Response::HTTP_FORBIDDEN);

        try {
            $fields = $request->validate([
                'tableId' => 'required',
                'userId' => 'required',
            ]);

            $order = Order::find($fields['tableId']);
            $order->status = OrderStatusEnum::approved->value;
            $order->save();

           

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully approved!',
                    'data' => ['order' => $order]
                ));
            }
            return back()->with(['order' => $order]);
        } catch (ValidationException | QueryException | \Exception $e) {
            $errors = $e->getMessage();
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'message' => $errors,
                    'data' => null
                ));
            }
            return back()->withErrors($errors)->withInput();
        }
    }

    public function rejectOrder(Request $request)
    {
        abort_if(Gate::denies('orders.reject'), Response::HTTP_FORBIDDEN);
        try {
            $fields = $request->validate([
                'tableId' => 'required',
            ]);

            $order = Order::find($fields['tableId']);
            $order->status = OrderStatusEnum::rejected->value;

            $order->save();

            $

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully rejected!',
                    'data' => ['order' => $order]
                ));
            }
            return back()->with(['order' => $order]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errors = reset($errors)[0];
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'message' => $errors,
                    'data' => null
                ));
            }
            return back()->withErrors($errors)->withInput();
        }
    }
    public function markReceived(Order $order)
    {
        $order->update(['received_at' => now()]);
        return response()->json(['success' => true, 'message' => 'Order marked as received successfully']);
    }

    public function updatePrice(Request $request, $orderItemId)
    {
        $orderItem = OrderItem::findOrFail($orderItemId);
        $orderItem->price = $request->input('price');
        $orderItem->save();

        $order = $orderItem->order;
        $order->amount = $order->orderItems->sum(function ($item) {
            return $item->price * $item->qty;
        });
        $order->save();
        
        return redirect()->back()->with('success', 'Product price updated successfully.');
    }
}
