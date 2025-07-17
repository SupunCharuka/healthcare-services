<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\HealthProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthProfileController extends Controller
{
    public function index()
    {
        $healthProfiles = HealthProfile::where('user_id',Auth::user()->id)->get();
        return view('backend.customer.health-profile.index',compact('healthProfiles'));
    }

    public function edit(HealthProfile $health)
    {
        $this->authorize('update', $health);
        return view('backend.customer.health-profile.edit', compact('health'));
    }

    public function destroy(HealthProfile $health)
    {
        $this->authorize('delete', $health);
      
        if (!$health) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Details not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $health->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Details record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $health;
        return response()->json($json);
    }

}
