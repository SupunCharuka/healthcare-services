<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class MobileResetPasswordController extends Controller
{
    public function mobileView()
    {
        return view('auth.verify-mobile');
    }

    public function sendOtp(Request $request)
    {

        $rules = [
            'phone' => 'required',
        ];

        $request->validate($rules);

        $user = User::where('phone', $request->input('phone'))->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $phoneNumber = $user->phone;

        if (!$phoneNumber) {
            return redirect()->back()->with('error', 'Mobile number not available.');
        }

        
        $token = Password::createToken($user);
        
        Session::put('reset_password_token', $token);
        Session::put('user_id', $user->id);
        
      
       
        if ($result) {

            return redirect()->route('forgot-password.mobile.otp', ['phone' => $phoneNumber])->with('status', 'OTP code sent successfully. Check your mobile for the OTP.');
        } else {
            return redirect()->back()->with('error', 'Failed to send OTP code via SMS. Please try again.');
        }
    }

    public function otp(Request $request)
    {
        $phoneNumber = $request->query('phone');
        if (empty($phoneNumber)) {

            return redirect()->route('forgot-password.mobile')->with('error', 'Please try again.');
        }
        return view('auth.forgot-password-mobile-otp', compact('phoneNumber'));
    }

    public function verifyResetPasswordOtp(Request $request)
    {
        $rules = [
            'code' => 'required',
            'phone' => 'required',
        ];

        $request->validate($rules);

        $hashed_phone = hash("sha512", $request->get('phone'));
        $hashed_code = hash("sha512", $request->get('code'));
        if (session()->has($hashed_phone) && session()->get($hashed_phone) === $hashed_code) {
            session()->forget($hashed_phone);

            $resetPassword =  Session::get('reset_password_token');
            $userId =  Session::get('user_id');

            if ($resetPassword) {
                session()->forget('reset_password_token');
                session()->forget('user_id');
                return redirect()->route('password.reset', ['token' => $resetPassword, 'id' => $userId])->with('status', 'OTP code was successfully verified. You can now reset your password.');
            }
        } else {

            return redirect()->back()->withErrors(['error' => 'OTP code is incorrect.']);
        }
    }
}
