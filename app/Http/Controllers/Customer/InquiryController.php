<?php

namespace App\Http\Controllers\Customer;

use ApiChef\PayHere\Payment;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Jobs\SendBankTransferAdminToEmail;
use App\Jobs\SendBankTransferCustomerToEmail;
use App\Jobs\SendBankTransferToEmail;
use App\Mail\AdminBankTransferSendMail;
use App\Mail\CustomerBankTransferSendMail;
use App\Models\InputDetaile;
use App\Models\Inquiry;
use App\Models\Invoice;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Storage;


class InquiryController extends Controller
{
    public function myInquiry()
    {
        $myInquiries = Inquiry::where('user_id', Auth::user()->id)->get();
        return view('backend.customer.inquiry.index', compact('myInquiries'));
    }

    public function myInquiryDetails(Inquiry $inquiry)
    {
        $this->authorize('viewInquiryDetails', $inquiry);

        $roomID = 'video_room_' . $inquiry->id;
        return view('backend.customer.inquiry.inquiry-details', compact('inquiry', 'roomID'));
    }

    public function reject(Inquiry $inquiry)
    {
        if (!$inquiry) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Inquiry not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }

        $inquiry->member_status = 'rejected';
        $inquiry->save();

        $json['status'] = 'rejected';
        $json['message'] = 'Inquiry record rejected successfully';
        $json['icon'] = 'success';
        $json['data'] = $inquiry;

        return response()->json($json);
    }

    public function writeReview($inquiryId)
    {
        $inquiryreviews = Inquiry::where('id', $inquiryId)->first();
        $this->authorize('writeReview', $inquiryreviews);
        return view('backend.customer.inquiry.review', compact('inquiryreviews'));
    }

    public function invoice(Inquiry $inquiry, Request $request)
    {
        $this->authorize('viewInvoice', $inquiry);
        $invoice = $inquiry->invoice;
        $payment = Payment::make($invoice, $request->user(), $invoice->amount);
        return view('backend.customer.inquiry.invoice.index', compact('invoice', 'payment'));
    }

    public function onlinePay(Request $request)
    {
        try {
            $fields = $request->validate([
                'invoiceId' => 'required',
            ]);

            $invoices = Invoice::find($fields['invoiceId']);


            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully!',
                    'data' => ['invoices' => $invoices]
                ));
            }
            return back()->with(['invoices' => $invoices]);
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

    public function bankTransfer(Request $request)
    {
        try {
            $fields = $request->validate([
                'invoiceId' => 'required',
                'receipt' => 'required|file',
                'comment' => 'nullable',
            ]);

            $invoice = Invoice::find($fields['invoiceId']);

            // Delete the previously uploaded file
            if ($invoice->document) {
                Storage::delete('uploads/customer/bank-transfer/file/' . $invoice->document);
            }

            // Handle the receipt file upload
            $file = $request->file('receipt');
            $extension = $file->getClientOriginalExtension();
            $fileName = \Str::random(20) . "-" . \Carbon\Carbon::now()->timestamp . '.' . $extension;
            $path = $file->storeAs('uploads/customer/bank-transfer/file', $fileName);

            $invoice->document = $fileName;
            $invoice->payment_type = 'bank_transfer';
            $invoice->comment = $fields['comment'];
            $invoice->paid = OrderStatusEnum::pending->value;
            $invoice->save();

            //admin
            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($adminUsers as $adminUser) {
                Mail::to($adminUser->email)->send(new AdminBankTransferSendMail($invoice));

                //sms
                
            }

           

            //customer
            Mail::to($invoice->inquiry->email)->send(new CustomerBankTransferSendMail($invoice));

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully!',
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


    public function viewInvoice()
    {
        $myInquiries = Inquiry::where('user_id', Auth::user()->id)->get();
        $inquiryIds = $myInquiries->pluck('id')->toArray();
        $myInvoices = Invoice::whereIn('inquiry_id', $inquiryIds)->get();
        return view('backend.customer.my-invoice.index', compact('myInvoices'));
    }
}
