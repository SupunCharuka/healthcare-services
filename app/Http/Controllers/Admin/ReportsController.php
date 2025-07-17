<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Inquiry;
use App\Models\Invoice;
use App\Models\MemberRegister;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Utils\Enums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ReportsController extends Controller
{
    public function serviceProviders()
    {
        abort_if(Gate::denies('reports'), Response::HTTP_FORBIDDEN);

        $serviceProviders = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'service-provider')->whereNull('deactivated_at');
        })
            ->where('status', Enums::memberRegister['APPROVED'])
            ->get();
        return view('backend.admin.reports.service-providers-report', compact('serviceProviders'));
    }

    public function doctors()
    {
        abort_if(Gate::denies('reports'), Response::HTTP_FORBIDDEN);
        $doctors =  MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'doctor')->whereNull('deactivated_at');
        })
            ->where('status', Enums::memberRegister['APPROVED'])
            ->get();
        return view('backend.admin.reports.doctors-reports', compact('doctors'));
    }


    public function services()
    {
        abort_if(Gate::denies('reports'), Response::HTTP_FORBIDDEN);
        $services = Service::where('status', 'approved')->get();
        $districts = District::all();
        return view('backend.admin.reports.services-reports', compact('services','districts'));
    }

    public function customers()
    {
         abort_if(Gate::denies('reports'), Response::HTTP_FORBIDDEN);
        $customers = User::role('customer')->get();
        return view('backend.admin.reports.customer-reports', compact('customers'));
    }

    public function inquiries()
    {
        abort_if(Gate::denies('reports'), Response::HTTP_FORBIDDEN);
        $inquiries = Inquiry::where('member_status','completed')->orderBy('id', 'desc')->get();
        $serviceCategoryNames = ServiceCategory::orderBy('local_order', 'asc')->get();
        return view('backend.admin.reports.Inquiries-reports', compact('inquiries','serviceCategoryNames'));
    }

    public function paymentInvoices()
    {
        abort_if(Gate::denies('reports'), Response::HTTP_FORBIDDEN);
        $paymentInvoices = Invoice::whereNotNull('payment_type')->where('paid', Enums::invoicePaid['APPROVED'])->whereNull('rejected_at')->get();
        $serviceCategoryNames = ServiceCategory::orderBy('local_order', 'asc')->get();
        return view('backend.admin.reports.payment-invoice-reports', compact('paymentInvoices','serviceCategoryNames'));
    }
}
