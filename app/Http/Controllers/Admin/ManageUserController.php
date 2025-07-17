<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ManageUserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies(['users.add-new']), Response::HTTP_FORBIDDEN);

        $users = User::with('roles')->get();
        return view('backend.admin.manage-user.index', compact('users'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies(['users.update']), Response::HTTP_FORBIDDEN);

        $user->load('roles');
        return view('backend.admin.manage-user.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies(['users.delete']), Response::HTTP_FORBIDDEN);
        if (!$user) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'user not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $user->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'user record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $user;
        return response()->json($json);
    }

    public function deactivate()
    {
        abort_if(Gate::denies('deactivate.view'), Response::HTTP_FORBIDDEN);
        $deactivatedUsers = User::whereNotNull('deactivated_at')->get();
        return view('backend.admin.manage-user.deactivate-users', compact('deactivatedUsers'));
    }

    public function recovery(User $user)
    {
        try {
            $json = [];

            if ($user) {
                $user->deactivated_at = null;
                $user->save();

                $json = [
                    'status' => 'success',
                    'message' => 'User record recovered successfully',
                    'data' => $user,
                ];
            } else {
                $json = [
                    'status' => 'error',
                    'message' => 'User not found',
                    'code' => 404,
                ];
            }

            return response()->json($json);
        } catch (\Exception $e) {
            $json = [
                'status' => 'error',
                'message' => 'An error occurred while processing the recovery action.',
                'exception' => $e->getMessage(),
            ];

            return response()->json($json, 500); 
        }
    }
}
