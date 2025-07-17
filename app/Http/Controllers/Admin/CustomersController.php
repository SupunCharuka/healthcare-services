<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('all-member.view'), Response::HTTP_FORBIDDEN);
        $role = Role::where('name', 'customer')->first();
        $customers =  $role->users;


        return view('backend.admin.customer-list.index', compact('customers'));
    }

    public function updateUserMemberType(Request $request)
    {
        $userId = $request->input('customer_id');
        $memberType = $request->input('member_type');

        $user = User::find($userId);
        $user->removeRole('customer');


        if ($memberType === 'doctor' || $memberType === 'service-provider') {
            $user->assignRole('service-provider');
        } elseif ($memberType === 'hotel') {
            $user->assignRole('customer');
        }

        if ($memberType === 'doctor') {
            $user->givePermissionTo('doctor');
        } elseif ($memberType === 'service-provider') {
            $user->givePermissionTo('service-provider');
        }

        $memberRegister = new MemberRegister();
        $memberRegister->user_id = $userId;
        $memberRegister->save();
        if ($memberType === 'hotel') {
            $user->update(['member_type' => $memberType, 'is_hotel' => true]);
        } else {
            $user->update(['member_type' => $memberType, 'is_hotel' => false]);
        }

        return response()->json(['message' => 'User member type updated successfully']);
    }
}
