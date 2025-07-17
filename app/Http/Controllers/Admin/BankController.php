<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class BankController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bank.view'), Response::HTTP_FORBIDDEN);
        $banks = Bank::orderBy('bank_name')->get();
        return view('backend.admin.bank-branch.index', compact('banks'));
    }

    public function edit(Bank $bank)
    {
        abort_if(Gate::denies('bank.update'), Response::HTTP_FORBIDDEN);
        return view('backend.admin.bank-branch.edit', compact('bank'));
    }

    public function destroy(Bank $bank)
    {
        abort_if(Gate::denies('bank.delete'), Response::HTTP_FORBIDDEN);
        if (!$bank) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Bank name not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $bank->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Bank name record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $bank;
        return response()->json($json);
    }
}
