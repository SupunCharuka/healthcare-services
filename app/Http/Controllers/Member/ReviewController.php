<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $services = Service::where('user_id', Auth::user()->id)->get();
        $serviceIds = $services->pluck('id');
        $inquiries = Inquiry::whereIn('service_id', $serviceIds)->where('status', 1)->get();
        $inquiryId = $inquiries->pluck('id');
        $reviews = Review::whereIn('inquiry_id', $inquiryId)->get();
         return view('backend.service-provider.my-reviews.view-reviews',compact('reviews'));
    }
}
