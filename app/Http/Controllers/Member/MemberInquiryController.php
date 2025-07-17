<?php

namespace App\Http\Controllers\Member;

use App\Helper\ZegoTokenGenerator;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerInquiryResource;
use App\Jobs\InquiryCompletedJob;
use App\Mail\InquiryCompletedMail;
use App\Models\Inquiry;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class MemberInquiryController extends Controller
{
    public function index()
    {
        $services = Service::where('user_id', Auth::user()->id)->get();
        $serviceIds = $services->pluck('id');
        $inquiries = Inquiry::whereIn('service_id', $serviceIds)
            ->whereHas('user', function ($query) {
                $query->whereNull('deactivated_at');
            })
            ->get();
        return view('backend.service-provider.my-inquiry.index', compact('inquiries'));
    }

    public function inquiryDetails($inquiryId)
    {
        $inquiryDetail = Inquiry::with('user')->find($inquiryId);
        $this->authorize('viewInquiryDetails', $inquiryDetail);
        $roomID = 'video_room_' . $inquiryDetail->id;
        return view('backend.service-provider.my-inquiry.inquiry-details', compact('inquiryDetail', 'roomID'));
    }


    public function complete(Request $request)
    {

        try {
            $fields = $request->validate([
                'iquiryId' => 'required',

            ]);
            $memberInquiryService = Inquiry::findOrFail(intval($fields['iquiryId']));
            $memberInquiryService->member_status = 'completed';
            $memberInquiryService->save();

            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($adminUsers as $adminUser) {
                Mail::to($adminUser->email)->send(new InquiryCompletedMail($memberInquiryService));
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully!',
                    'data' => new CustomerInquiryResource($memberInquiryService)
                ));
            }
            return back()->with(['memberInquiryService' => $memberInquiryService]);
        } catch (ValidationException|QueryException|\Exception $e) {
            $errors = $e->getMessage();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(array(
                    'success' => false,
                    'message' => $errors,
                    'data' => null
                ));
            }
            return back()->withErrors($errors)->withInput();
        }
    }


    public function reject(Request $request)
    {

        try {
            $fields = $request->validate([
                'iquiryId' => 'required',
            ]);
            $memberInquiryService = Inquiry::findOrFail(intval($fields['iquiryId']));
            $memberInquiryService->member_status = 'rejected';
            $memberInquiryService->save();


            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully!',
                    'data' => new CustomerInquiryResource($memberInquiryService)
                ));
            }
            return back()->with(['memberInquiryService' => $memberInquiryService]);
        } catch (ValidationException|QueryException|\Exception $e) {
            $errors = $e->getMessage();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(array(
                    'success' => false,
                    'message' => $errors,
                    'data' => null
                ));
            }
            return back()->withErrors($errors)->withInput();
        }
    }


    public function invoice(Inquiry $inquiry)
    {
        abort_if(Gate::denies('doctor.access'), Response::HTTP_FORBIDDEN);
        $invoice = $inquiry->invoice;
        return view('backend.service-provider.my-inquiry.invoice.index', compact('invoice'));
    }
}
