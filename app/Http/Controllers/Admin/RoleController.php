<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies(['role.create', 'role.manage']), Response::HTTP_FORBIDDEN);
        $roles = Role::all();
        return view('backend.admin.role.index', compact('roles'));
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies(['role.update', 'role.manage']), Response::HTTP_FORBIDDEN);
        $role->load('permissions');
        return view('backend.admin.role.edit', compact('role'));
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies(['role.delete', 'role.manage']), Response::HTTP_FORBIDDEN);
        if (!$role) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'role not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $role->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'role record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $role;
        return response()->json($json);
    }
}
