<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Utils\Enums;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function paymentDetail(Invoice $invoice)
    {
        return view('backend.admin.payment-invoice.payment-detail', compact('invoice'));
    }

    public function approvePayment(Request $request)
    {
        abort_if(Gate::denies('payment.approve'), Response::HTTP_FORBIDDEN);
        try {

            $fields = $request->validate([
                'Id' => 'required'
            ]);

            $invoice = Invoice::find($fields['Id']);
            $invoice->paid = OrderStatusEnum::approved->value;
            $invoice->rejected_at = null;
            $invoice->save();

            $inquiry = $invoice->inquiry;
            $inquiry->member_status = 'confirmed';
            $inquiry->save();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully approved!',
                    'data' => ['invoice' => $invoice]
                ));
            }
            return back()->with(['invoice' => $invoice]);
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


    public function rejectPayment(Request $request)
    {
        abort_if(Gate::denies('payment.reject'), Response::HTTP_FORBIDDEN);
        try {
            $fields = $request->validate([
                'Id' => 'required',
            ]);

            $invoice = Invoice::find($fields['Id']);
            $invoice->paid = OrderStatusEnum::pending->value;
            $invoice->rejected_at = Carbon::now();
            $invoice->save();

            $inquiry = $invoice->inquiry;
            $inquiry->member_status = 'unpaid';
            $inquiry->save();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully rejected!',
                    'data' => ['invoice' => $invoice]
                ));
            }
            return back()->with(['invoice' => $invoice]);
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
}
