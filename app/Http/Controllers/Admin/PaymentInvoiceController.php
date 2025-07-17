<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Utils\Enums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PaymentInvoiceController extends Controller
{
    public function all()
    {
        abort_if(Gate::denies('reports.payment'), Response::HTTP_FORBIDDEN);
        $invoices = Invoice::whereNotNull('payment_type')->get();
        return view('backend.admin.payment-invoice.index', compact('invoices'));
    }
    public function paid()
    {
        $invoices = Invoice::whereNotNull('payment_type')->where('paid', Enums::invoicePaid['APPROVED'])->whereNull('rejected_at')->get();
        return view('backend.admin.payment-invoice.paid', compact('invoices'));
    }
    public function pending()
    {
        $invoices = Invoice::whereNotNull('payment_type')->where('paid', Enums::invoicePaid['PENDING'])->whereNull('rejected_at')->get();
        return view('backend.admin.payment-invoice.pending', compact('invoices'));
    }
    public function unpaid()
    {
        $invoices = Invoice::whereNotNull('payment_type')->where('paid', Enums::invoicePaid['PENDING'])->whereNotNull('rejected_at')->get();
        return view('backend.admin.payment-invoice.unpaid', compact('invoices'));
    }
}
