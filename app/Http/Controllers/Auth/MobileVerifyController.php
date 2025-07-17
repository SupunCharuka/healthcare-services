<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class MobileVerifyController extends Controller
{
    public function verifyPhoneView(Request $request)
    {
        $phoneNumber = $request->query('phone');
        if (empty($phoneNumber)) {

            return redirect()->route('login')->with('error', 'Please sign up.');
        }

        return view('auth.verify-mobile-otp', compact('phoneNumber'));
    }

    public function sendCode(Request $request)
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

        $verificationCode = $user->generateAndStoreVerificationCode($phoneNumber);
        $message = "Your verification code is: $verificationCode";
        $recipients = $phoneNumber;
        $alias = 'MyDoc.lk';
        $result = SmsService::sendSms($message, $recipients, $alias);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', Rule::unique('users', 'phone')->ignore(Auth::user()->id)->whereNull('deleted_at')],
            'code' => ['required'],
        ]);

        $hashed_phone = hash("sha512", $request->get('phone'));
        $hashed_code = hash("sha512", $request->get('code'));
        if (session()->has($hashed_phone) && session()->get($hashed_phone) === $hashed_code) {
            session()->forget($hashed_phone);
            Auth::user()->update([
                'phone_verified_at' => Carbon::now(),
            ]);

            return redirect()->route(Auth::user()->getRoleNames()->first() . '.dashboard')->with('success', 'Registration successful!');
        } else {

            return redirect()->back()->withErrors(['error' => 'Verification code is incorrect.']);
        }
    }

    public function addPhoneNumberView()
    {
        return view('auth.enter-mobile-number');
    }

    public function addPhoneNumber(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|unique:users',
        ]);
        $phoneNumber = $validatedData['phone'];
        auth()->user()->update([
            'phone' => $phoneNumber,
        ]);

        return redirect()->route('customer.dashboard');
    }
}
