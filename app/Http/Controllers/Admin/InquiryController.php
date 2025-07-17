<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\InquiryAssignedEmail;
use App\Jobs\SendCustomerInvoiceEmail;
use App\Mail\CustomerInvoiceMail;
use App\Mail\InquiryAssignedMail;
use App\Models\InputDetaile;
use App\Models\Inquiry;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Services\SmsService;
use App\Utils\Enums;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class InquiryController extends Controller
{
    public function getInquiry()
    {
        abort_if(Gate::denies('all-member.view'), Response::HTTP_FORBIDDEN);

        $inquiries = Inquiry::orderBy('id', 'desc')->whereHas('user', function ($query) {
            $query->whereNull('deactivated_at');
        })->get();
        return view('backend.admin.get-inquiry.index', compact('inquiries'));
    }

    public function pendingInquiries()
    {
        abort_if(Gate::denies('all-member.view'), Response::HTTP_FORBIDDEN);

        $inquiries = Inquiry::orderBy('id', 'desc')
            ->where('member_status', 'pending')
            ->whereHas('user', function ($query) {
                $query->whereNull('deactivated_at');
            })
            ->get();
        return view('backend.admin.get-inquiry.pending-inquiry', compact('inquiries'));
    }

    public function unpaidInquiries()
    {
        abort_if(Gate::denies('all-member.view'), Response::HTTP_FORBIDDEN);

        $inquiries = Inquiry::orderBy('id', 'desc')
            ->where('member_status', 'unpaid')
            ->whereHas('user', function ($query) {
                $query->whereNull('deactivated_at');
            })
            ->get();
        return view('backend.admin.get-inquiry.unpaid-inquiry', compact('inquiries'));
    }
    public function confirmInquiries()
    {
        abort_if(Gate::denies('all-member.view'), Response::HTTP_FORBIDDEN);

        $inquiries = Inquiry::orderBy('id', 'desc')
            ->where('member_status', 'confirmed')
            ->whereHas('user', function ($query) {
                $query->whereNull('deactivated_at');
            })
            ->get();
        return view('backend.admin.get-inquiry.confirmed-inquiry', compact('inquiries'));
    }

    public function completedInquiries()
    {
        abort_if(Gate::denies('all-member.view'), Response::HTTP_FORBIDDEN);

        $inquiries = Inquiry::orderBy('id', 'desc')
            ->where('member_status', 'completed')
            ->whereHas('user', function ($query) {
                $query->whereNull('deactivated_at');
            })
            ->get();
        return view('backend.admin.get-inquiry.completed-inquiry', compact('inquiries'));
    }

    public function rejectedInquiries()
    {
        abort_if(Gate::denies('all-member.view'), Response::HTTP_FORBIDDEN);

        $inquiries = Inquiry::orderBy('id', 'desc')->where('member_status', 'rejected')->get();
        return view('backend.admin.get-inquiry.rejected-inquiry', compact('inquiries'));
    }

    public function getInquiryDetails($inquiryId, Request $request)
    {
        abort_if(Gate::denies('inquiry.view-details'), Response::HTTP_FORBIDDEN);

        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $date = $request->input('date');

        $inquiryDetails = Inquiry::find($inquiryId);
        $serviceMembersId = $inquiryDetails->service_category_id;

        if ($inquiryDetails->view_status === 'unread') {
            $inquiryDetails->view_status = 'read'; 
            $inquiryDetails->save();
        }

        if ($inquiryDetails->district_id) {
            $query = Service::where('service_category_id', $serviceMembersId)->where('district_id', $inquiryDetails->district_id)->where('status', 'approved');
        } else {
            $query = Service::where('service_category_id', $serviceMembersId)->where('status', 'approved');
        }


        // Check if date, start_time, and end_time are provided in the request
        if ($request->filled('date') && $request->filled('start_time') && $request->filled('end_time')) {
            $formattedDate = date('Y-m-d', strtotime($date));

            // Use whereHas to filter based on WeeklyAvailability
            $query->whereHas('weeklyAvailabilities', function ($subQuery) use ($startTime, $endTime, $formattedDate) {
                $subQuery->where('week_day', '=', strtolower(date('l', strtotime($formattedDate))))
                    ->whereTime('start_time', '<=', $startTime)
                    ->whereTime('end_time', '>=', $endTime);
            });
        } elseif ($request->filled('date')) {
            $formattedDate = date('Y-m-d', strtotime($date));

            // Use whereHas to filter based on WeeklyAvailability
            $query->whereHas('weeklyAvailabilities', function ($subQuery) use ($formattedDate) {
                $subQuery->where('week_day', '=', strtolower(date('l', strtotime($formattedDate))));
            });
        } elseif ($request->filled('start_time') && $request->filled('end_time')) {
            $query->whereHas('weeklyAvailabilities', function ($subQuery) use ($startTime, $endTime) {
                $subQuery->whereTime('start_time', '<=', $startTime)
                    ->whereTime('end_time', '>=', $endTime);
            });
        }

        $serviceMembers = $query->get();

        return view('backend.admin.get-inquiry.inquiry-details', compact('inquiryDetails', 'serviceMembers'));
    }




    public function assignService(Request $request)
    {
        try {
            $fields = $request->validate([
                'serviceid' => 'required',
                'iquiryId' => 'required',
                'cost' => 'nullable|numeric|min:0',
            ]);


            $inquiry = Inquiry::findOrFail(intval($fields['iquiryId']));

            $inquiry->status = Enums::inquiryStatus['ASSIGN'];
            $inquiry->member_status = 'unpaid';
            $inquiry->service_id  = $fields['serviceid'];
            if (isset($fields['cost'])) {
                $inquiry->cost = $fields['cost'];
                $existingInvoice = Invoice::where('inquiry_id', $inquiry->id)->first();

                if ($existingInvoice) {
                    $existingInvoice->amount = floatval($fields['cost']);
                    $existingInvoice->save();
                } else {
                    Invoice::create([
                        'inquiry_id' => $inquiry->id,
                        'amount' => floatval($fields['cost']),
                        'paid' => false,
                    ]);
                }
            }
            $inquiry->save();

            $invoiceLink =  URL::signedRoute('guest.invoice', ['inquiry' => $inquiry->id]);
            Mail::to($inquiry->email)->send(new CustomerInvoiceMail($inquiry, $fields['cost'], $invoiceLink));
            Mail::to($inquiry->service->user->email)->send(new InquiryAssignedMail($inquiry));

           

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully!',
                    'data' => ['inquiry' => $inquiry]
                ));
            }
            return back()->with(['inquiry' => $inquiry]);
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

    public function unassignService(Request $request)
    {
        try {
            $fields = $request->validate([
                'iquiryId' => 'required',
            ]);

            $inquiry = Inquiry::findOrFail(intval($fields['iquiryId']));

            $inquiry->status = Enums::inquiryStatus['UNASSIGN'];
            $inquiry->member_status = 'pending';
            $inquiry->service_id  = null;
            $inquiry->save();


            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully!',
                    'data' => ['inquiry' => $inquiry]
                ));
            }
            return back()->with(['inquiry' => $inquiry]);
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

    public function saveCost(Request $request)
    {
        try {

            $fields = $request->validate([
                'cost' => 'required|string|max:255',
                'iquiryId' => 'required',
            ]);

            $inquiry = Inquiry::findOrFail(intval($fields['iquiryId']));

            $inquiry->cost = floatval($fields['cost']);
            $inquiry->save();


            $invoice = Invoice::where('inquiry_id', $inquiry->id)->first();

            if ($invoice) {

                $invoice->amount = floatval($fields['cost']);
                $invoice->save();
            } else {

                $invoice = Invoice::create([
                    'inquiry_id' => $inquiry->id,
                    'amount' => floatval($fields['cost']),
                    'paid' => false,
                ]);
            }

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully!',
                    'cost' => 'LKR ' . number_format(floatval($fields['cost']), 2),
                    'data' => [
                        'inquiry' => $inquiry,
                        'invoice' => $invoice,
                    ],
                ));
            }
            return back()->with(['inquiry' => $inquiry]);
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

    public function updateLocation(Inquiry $inquiry, Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Update the location data in the $inquiry object
        $inquiry->latitude = $latitude;
        $inquiry->longitude = $longitude;
        $inquiry->save();

        // Return a response indicating the success of the location update
        return response()->json(['message' => 'Location updated successfully'], 200);
    }

    public function invoice(Inquiry $inquiry)
    {
        $invoice = $inquiry->invoice;
        return view('backend.admin.get-inquiry.invoice.index', compact('invoice'));
    }


    public function memberAvailability(Service $service)
    {
        return view('backend.admin.member-availability.index', compact('service'));
    }

    public function checkUnreadInquiries(Request $request)
    {
        $unreadInquiries = Inquiry::where('view_status', 'unread')->get();
        $unreadCount = $unreadInquiries->count();

        return response()->json([
            'unreadCount' => $unreadCount,
            'unreadInquiries' => $unreadInquiries,
        ]);
    }

    public function completedInquiry(Inquiry $inquiry)
    {

        $inquiry->update(['member_status' => 'completed']);
        return response()->json(['success' => true, 'message' => 'Completed successfully']);
    }

    public function rejectInquiry(Inquiry $inquiry)
    {
        $inquiry->update(['member_status' => 'rejected']);
        return response()->json(['success' => true, 'message' => 'Rejected successfully']);
    }

    public function serviceCategories()
    {
        $serviceCategories = ServiceCategory::orderBy('local_order', 'asc')->get();
        return view('backend.admin.get-inquiry.add-new-inquiry.service-category', compact('serviceCategories'));
    }

    public function newInquiry(ServiceCategory $serviceCategory)
    {
        return view('backend.admin.get-inquiry.add-new-inquiry.add-new-inquiry', compact('serviceCategory'));
    }
}
