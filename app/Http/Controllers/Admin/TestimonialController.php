<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function manage()
    {
        $testimonials = Testimonial::all();
        return view('backend.admin.testimonial.manage',compact('testimonials'));
    }

    public function create()
    {
        return view('backend.admin.testimonial.create');
    }


    public function edit(Testimonial $testimonial)
    {
       
        return view('backend.admin.testimonial.edit', compact('testimonial'));
    }

    public function destroy(Testimonial $testimonial)
    {
       
        if (!$testimonial) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'Testimonial not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $testimonial->delete();
        Storage::delete('uploads/testimonial/' . $testimonial->image);
        $json['status'] = 'deleted';
        $json['message'] = 'Testimonial record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $testimonial;
        return response()->json($json);
    }
}
