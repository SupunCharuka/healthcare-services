<?php

namespace App\Http\Controllers\Customer;

use ApiChef\PayHere\Payment;
use App\Http\Controllers\Controller;
use App\Utils\Enums;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CustomerInvoiceController extends Controller
{
    public function success(Request $request)
    {

        $payment = Payment::findByOrderId($request->get('order_id'));

        $invoice = $payment->payable;
        $invoice->paid = Enums::invoicePaid['APPROVED'];
        $invoice->rejected_at = null;
        $invoice->payment_type = 'online';
        $invoice->save();

        $myInquiry = $invoice->inquiry;
        $myInquiry->member_status = 'confirmed';
        $myInquiry->save();

        $signedURL = URL::signedRoute('customer.invoice', ['inquiry' => $myInquiry->id]);

        return redirect($signedURL);
    }

    public function cancelled(Request $request)
    {
        $payment = Payment::findByOrderId($request->get('order_id'));

        $invoice = $payment->payable;
        $invoice->paid = Enums::invoicePaid['PENDING'];
        $invoice->rejected_at = Carbon::now();
        $invoice->payment_type = 'online';
        $invoice->save();

        $myInquiry = $invoice->inquiry;
        $myInquiry->member_status = 'unpaid';
        $myInquiry->save();

        $signedURL = URL::signedRoute('customer.invoice', ['inquiry' => $myInquiry->id]);

        return redirect($signedURL);
    }
}
