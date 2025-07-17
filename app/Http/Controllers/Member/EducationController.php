<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::where('user_id',Auth::user()->id)->get();
        return view('backend.service-provider.education.index',compact('educations'));
    }

    public function edit(Education $education)
    {
        return view('backend.service-provider.education.edit', compact('education'));
    }

    public function destroy(Education $education)
    {
      
        if (!$education) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Details not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $education->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Details record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $education;
        return response()->json($json);
    }
}
