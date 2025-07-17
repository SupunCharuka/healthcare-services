<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Utils\Enums;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class BusinessController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business.view'), Response::HTTP_FORBIDDEN);
        $businesses = Business::all();
        return view('backend.admin.manage-business-profile.index', compact('businesses'));
    }

    public function viewDetails(Business $business)
    {
        abort_if(Gate::denies('business.details'), Response::HTTP_FORBIDDEN);
        return view('backend.admin.manage-business-profile.view-details', compact('business'));
    }

    public function approveBusinessProfile(Request $request)
    {
        abort_if(Gate::denies('business.approve'), Response::HTTP_FORBIDDEN);
        try {
            $fields = $request->validate([
                'Id' => 'required',
            ]);

            $businessProfile = Business::find($fields['Id']);
            $businessProfile->status =Enums::businessProfile['APPROVED'];
            $businessProfile->user->givePermissionTo('service-provider');
            $businessProfile->save();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully approved!',
                    'data' => ['businessProfile' => $businessProfile]
                ));
            }
            return back()->with(['businessProfile' => $businessProfile]);
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

    public function rejectBusinessProfile(Request $request)
    {
        abort_if(Gate::denies('business.reject'), Response::HTTP_FORBIDDEN);
        try {
            $fields = $request->validate([
                'Id' => 'required',
            ]);

            $businessProfile = Business::find($fields['Id']);
            $businessProfile->status = Enums::businessProfile['REJECTED'];
            $businessProfile->user->revokePermissionTo('service-provider');
            $businessProfile->save();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'Successfully rejected!',
                    'data' => ['businessProfile' => $businessProfile]
                ));
            }
            return back()->with(['businessProfile' => $businessProfile]);
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
