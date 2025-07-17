<?php

namespace App\Http\Controllers;

use App\Helper\ZegoTokenGenerator;
use App\Mail\MeetingInviteSendMail;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class VideoCallController extends Controller
{
    public function index($inquiryId, $roomID)
    {
        $inquiryDetail = Inquiry::with('user')->find($inquiryId);
        
        if (Auth::check() && Auth::user()->member_type === 'doctor') {
            $meetingLink =  URL::signedRoute('video-call', ['inquiryId' => $inquiryDetail->id, 'roomID' => $roomID]);
            Mail::to($inquiryDetail->email)->send(new MeetingInviteSendMail($meetingLink, $inquiryDetail));
        }
        return view('video-call', compact('inquiryDetail', 'roomID'));
    }
}
