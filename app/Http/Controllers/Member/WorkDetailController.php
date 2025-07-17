<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\WorkDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkDetailController extends Controller
{
    public function index()
    {
        $workDetails = WorkDetail::where('user_id',Auth::user()->id)->get();
        return view('backend.service-provider.work-details.index', compact('workDetails'));
    }


    public function edit(WorkDetail $workdetail)
    {
        return view('backend.service-provider.work-details.edit', compact('workdetail'));
    }

    public function destroy(WorkDetail $workdetail)
    {
        // if (Auth::user()->cannot('delete', $permission)) {
        //     $json['status'] = 'error';
        //     $json['code'] = '403';
        //     $json['message'] = 'Access denied';
        //     $json['icon'] = 'error';
        //     return response()->json($json, 403);
        // }

        if (!$workdetail) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Details not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $workdetail->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Details record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $workdetail;
        return response()->json($json);
    }
}
