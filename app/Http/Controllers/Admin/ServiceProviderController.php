<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberRegister;
use App\Utils\Enums;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class ServiceProviderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('service-provider.view'), Response::HTTP_FORBIDDEN);
        $serviceProviders = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'service-provider')->whereNull('deactivated_at');
        })->get();

        return view('backend.admin.manage-service-provider.index', compact('serviceProviders'));
    }

    public function pendingServiceProviders()
    {
         abort_if(Gate::denies('service-provider.view'), Response::HTTP_FORBIDDEN);
        $serviceProviders = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'service-provider')->whereNull('deactivated_at');
        })->where('status', 0)->get();        
        return view('backend.admin.manage-service-provider.pending-service-provider', compact('serviceProviders'));
    }

    public function approvedServiceProviders()
    {
         abort_if(Gate::denies('service-provider.view'), Response::HTTP_FORBIDDEN);
        $serviceProviders = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'service-provider')->whereNull('deactivated_at');
        })->where('status', 1)->get();        
        return view('backend.admin.manage-service-provider.approved-service-provider', compact('serviceProviders'));
    }

    public function rejectedServiceProviders()
    {
         abort_if(Gate::denies('service-provider.view'), Response::HTTP_FORBIDDEN);
        $serviceProviders = MemberRegister::whereHas('user', function ($query) {
            $query->where('member_type', 'service-provider')->whereNull('deactivated_at');
        })->where('status', 2)->get();        
        return view('backend.admin.manage-service-provider.rejected-service-provider', compact('serviceProviders'));
    }

   

    public function approveServiceProvider(Request $request)
    {
        abort_if(Gate::denies('service-provider.approve'), Response::HTTP_FORBIDDEN);
        try {
            $fields = $request->validate([
                'tableId' => 'required',
                'userId' => 'required',
            ]);

            $memberRegister = MemberRegister::find($fields['tableId']);
            $memberRegister->status =Enums::memberRegister['APPROVED'];
            // $memberRegister->approved_date = Carbon::now();
            $memberRegister->user->givePermissionTo('service-provider.access');
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

    public function rejectServiceProvider(Request $request)
    {
        abort_if(Gate::denies('service-provider.reject'), Response::HTTP_FORBIDDEN);
        try {
            $fields = $request->validate([
                'tableId' => 'required',
            ]);

            $memberRegister = MemberRegister::find($fields['tableId']);
            $memberRegister->status = Enums::memberRegister['REJECTED'];
            $memberRegister->user->revokePermissionTo('service-provider.access');
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
}
