<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Mail\AdminBankTransferSendMail;
use App\Mail\CustomerBankTransferSendMail;
use App\Models\Inquiry;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class InvoiceController extends Controller
{
    public function guestInvoice(Inquiry $inquiry)
    {
        $invoice = $inquiry->invoice;
        return view('backend.guest.invoice', compact('invoice'));
    }

    public function guestOnlinePay(Request $request)
    {
        try {
            $fields = $request->validate([
                'invoiceId' => 'required',
            ]);

            $invoices = Invoice::find($fields['invoiceId']);
            $invoices->payment_type = 'online';
            $invoices->save();

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

    public function guestBankTransfer(Request $request)
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
            $invoice->save();

            //admin
            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($adminUsers as $adminUser) {
                Mail::to($adminUser->email)->send(new AdminBankTransferSendMail($invoice));
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
}
