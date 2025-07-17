<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerReviewController extends Controller
{
    public function myReviews()
    {
        $myInquiries = Inquiry::where('user_id', Auth::user()->id)->get();
        $myReviews = collect();

        foreach ($myInquiries as $inquiry) {
            $reviews = $inquiry->reviews;
            $myReviews = $myReviews->merge($reviews);
        }

        return view('backend.customer.my-reviews.index', compact('myReviews'));
    }
}
