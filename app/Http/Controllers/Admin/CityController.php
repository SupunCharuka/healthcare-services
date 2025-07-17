<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(District $district)
    {
        $cities = $district->cities()->orderBy('name','asc')->get();
        return view('backend.admin.city.index',compact('cities','district'));
    }

    public function edit($district, City $city)
    {
        return view('backend.admin.city.edit', compact('district','city'));
    }


    public function destroy(City $city)
    {
        
        if (!$city) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'city name not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $city->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'city name record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $city;
        return response()->json($json);

    }
}
