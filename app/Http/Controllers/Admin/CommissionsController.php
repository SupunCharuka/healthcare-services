<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionPayout;
use App\Models\Inquiry;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommissionsController extends Controller
{
    public function commission(Request $request)
    {
        $date = $request->input('date', Carbon::now()->toDateString());
        $serviceIds = Inquiry::where('member_status', 'completed')
            ->whereNotNull('cost')
            ->whereDate('updated_at', $date)
            ->distinct('service_id')
            ->pluck('service_id');

        $services = Service::whereIn('id', $serviceIds)->get();

        return view('backend.admin.commission.index', compact('services', 'date'));
    }

    public function viewInquiries(Service $service, $date)
    {
        $inquiries = $service->inquiries()->where('member_status', 'completed')->whereDate('updated_at', $date)->get();
        return view('backend.admin.commission.view-inquiries', compact('inquiries', 'service', 'date'));
    }

    public function markAllCommissionsPaid(Request $request)
    {
        try {

            $serviceData = $request->input('services');

            foreach ($serviceData as $data) {
                $serviceId = $data['service_id'];
                $date = $data['date'];
                $earnings = str_replace(['LKR', ','], '', $data['earnings']);
                $earnings = (float) $earnings;

                $existingPayout = CommissionPayout::where('service_id', $serviceId)
                    ->where('date', $date)
                    ->first();

                if ($existingPayout) {
                    $existingPayout->amount = $earnings;
                    $existingPayout->save();
                } else {
                    $commissionPayout = new CommissionPayout();
                    $commissionPayout->service_id = $serviceId;
                    $commissionPayout->amount = $earnings;
                    $commissionPayout->date = $date;
                    $commissionPayout->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'All commissions have been marked as paid.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to mark commissions as paid.']);
        }
    }

    public function paidCommission(Request $request)
    {
        $date = $request->input('date', Carbon::now()->toDateString());
        $serviceIdsWithCommissions = Inquiry::where('member_status', 'completed')
            ->whereNotNull('cost')
            ->whereDate('updated_at', $date)
            ->distinct('service_id')
            ->pluck('service_id');


        $allCommissionPayouts = CommissionPayout::whereIn('service_id', $serviceIdsWithCommissions)
            ->get();

        return view('backend.admin.commission.paid-commission', compact('allCommissionPayouts', 'date'));
    }

    public function notPaidCommission(Request $request)
    {
        $date = $request->input('date', Carbon::now()->toDateString());
        $serviceIdsWithCommissions = Inquiry::where('member_status', 'completed')
            ->whereNotNull('cost')
            ->whereDate('updated_at', $date)
            ->distinct('service_id')
            ->pluck('service_id');

        $serviceIdsWithPayouts = CommissionPayout::pluck('service_id');

        // Find the difference to get service IDs without commission payouts
        $serviceIdsWithoutPayouts = array_diff($serviceIdsWithCommissions->toArray(), $serviceIdsWithPayouts->toArray());

        // Retrieve services without commission payouts
        $services = Service::whereIn('id', $serviceIdsWithoutPayouts)->get();

        return view('backend.admin.commission.not-paid-commission', compact('services', 'date'));
    }
}
