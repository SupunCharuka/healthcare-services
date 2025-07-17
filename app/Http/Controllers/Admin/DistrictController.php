<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::orderBy('name', 'asc')->get();
        return view('backend.admin.district.index', compact('districts'));
    }

    public function edit(District $district)
    {
        return view('backend.admin.district.edit', compact('district'));
    }


    public function destroy(District $district)
    {
        
        if (!$district) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'district name not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $district->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'district name record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $district;
        return response()->json($json);

    }
}
