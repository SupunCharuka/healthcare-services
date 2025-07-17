<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\MemberRegister;
use App\Models\Service;
use App\Models\User;
use App\Models\WorkDetail;
use App\Utils\Enums;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MemberListController extends Controller
{
    public function getDoctorsList(Request $request)
    {
        abort_if(Gate::denies('manage-doctor.manage'), Response::HTTP_FORBIDDEN);
        $members = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'doctor')->whereNull('deactivated_at');
        })->get();
        return view('backend.admin.manage-doctor.index', compact('members'));
    }

    public function pendingDoctors()
    {
        abort_if(Gate::denies('manage-doctor.manage'), Response::HTTP_FORBIDDEN);
        $members = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'doctor')->whereNull('deactivated_at');
        })->where('status', 0)->get();
        return view('backend.admin.manage-doctor.pending-doctors', compact('members'));
    }


    public function approvedDoctors()
    {
        abort_if(Gate::denies('manage-doctor.manage'), Response::HTTP_FORBIDDEN);
        $members = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'doctor')->whereNull('deactivated_at');
        })->where('status', 1)->get();
        return view('backend.admin.manage-doctor.approve-doctors', compact('members'));
    }

    public function rejectedDoctors()
    {
        abort_if(Gate::denies('manage-doctor.manage'), Response::HTTP_FORBIDDEN);
        $members = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'doctor')->whereNull('deactivated_at');
        })->where('status', 2)->get();
        return view('backend.admin.manage-doctor.reject-doctors', compact('members'));
    }

    public function doctorEducation($member)
    {
        $educations = Education::where('user_id', $member)->get();
        return view('backend.admin.manage-doctor.member-education', compact('educations'));
    }

    public function doctorWork($member)
    {
        $workDetails = WorkDetail::where('user_id', $member)->get();
        return view('backend.admin.manage-doctor.member-work', compact('workDetails'));
    }


    public function approveDoctor(Request $request)
    {
        abort_if(Gate::denies(['manage-doctor.manage', 'manage-doctor.approve']), Response::HTTP_FORBIDDEN);
        try {
            $fields = $request->validate([
                'tableId' => 'required',
                'userId' => 'required',
            ]);

            $memberRegister = MemberRegister::find($fields['tableId']);
            $memberRegister->status = Enums::memberRegister['APPROVED'];
            // $memberRegister->approved_date = Carbon::now();
            $memberRegister->user->givePermissionTo('doctor.access');
            $memberRegister->save();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully approved!',
                    'data' => ['memberRegister' => $memberRegister]
                ));
            }
            return back()->with(['memberRegister' => $memberRegister]);
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

    public function rejectDoctor(Request $request)
    {
        abort_if(Gate::denies(['manage-doctor.manage', 'manage-doctor.reject']), Response::HTTP_FORBIDDEN);

        try {
            $fields = $request->validate([
                'tableId' => 'required',
            ]);

            $memberRegister = MemberRegister::find($fields['tableId']);
            $memberRegister->status = Enums::memberRegister['REJECTED'];
            $memberRegister->user->revokePermissionTo('doctor.access');
            $memberRegister->save();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully rejected!',
                    'data' => ['memberRegister' => $memberRegister]
                ));
            }
            return back()->with(['memberRegister' => $memberRegister]);
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

    public function getMembers()
    {
        abort_if(Gate::denies('all-member.view'), Response::HTTP_FORBIDDEN);
        $membersLists = MemberRegister::where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
        return view('backend.admin.get-members.index', compact('membersLists'));
    }

    public function memberDetails($member)
    {
        $memberDetails = User::where('id', $member)->first();
        return view('backend.admin.get-members.member-details', compact('memberDetails'));
    }

    public function memberServices($member)
    {
        $memberServices = Service::where('user_id', $member)->get();
        return view('backend.admin.get-members.member-service', compact('memberServices'));
    }
}
