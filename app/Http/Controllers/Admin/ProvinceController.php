<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProvinceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies(['province-district-city.manage', 'province-district-city.create']), Response::HTTP_FORBIDDEN);
        $provinces = Province::orderBy('name', 'asc')->get();
        return view('backend.admin.province.index',compact('provinces'));
    }

    public function edit(Province $province)
    {
        abort_if(Gate::denies(['province-district-city.manage', 'province-district-city.update']), Response::HTTP_FORBIDDEN);
        
        return view('backend.admin.province.edit', compact('province'));
    }

    public function destroy(Province $province)
    {
        abort_if(Gate::denies(['province-district-city.manage', 'province-district-city.delete']), Response::HTTP_FORBIDDEN);
        if (!$province) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'province name not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $province->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'province name record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $province;
        return response()->json($json);

    }
}
