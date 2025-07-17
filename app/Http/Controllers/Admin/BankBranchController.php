<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankBranch;
use Illuminate\Http\Request;

class BankBranchController extends Controller
{
    public function index(Bank $bank)
    {
        $branches = $bank->branches()->orderBy('branch_name')->get();
        return view('backend.admin.bank-branch.branch.index', compact('branches', 'bank'));
    }


    public function edit(BankBranch $branch)
    {

        return view('backend.admin.bank-branch.branch.edit', compact('branch'));
    }

    public function destroy(BankBranch $branch)
    {

        if (!$branch) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'branch name not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $branch->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'branch name record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $branch;
        return response()->json($json);
    }
}
