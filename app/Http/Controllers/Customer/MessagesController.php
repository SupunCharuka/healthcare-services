<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Utils\Enums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::where('user_id', Auth::user()->id)
        ->whereHas('invoice', function ($query) {
            $query->where('paid', 1)
                ->whereNull('rejected_at');
        })
        ->with('service') 
        ->get();
        return view('backend.customer.messages.index',compact('inquiries'));
    }
}
