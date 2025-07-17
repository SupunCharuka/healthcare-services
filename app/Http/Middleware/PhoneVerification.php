<?php

namespace App\Http\Middleware;

use App\Services\SmsService;
use Closure;
use Illuminate\Http\Request;

class PhoneVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user) {
            if ($user->hasRole('customer') || $user->hasRole('service-provider')) {
                if (!$user->phone_verified_at) {
                    if (!$user->phone) {
                        return redirect()->route('add.phoneNumber.View')->with('status', 'Please add your phone number to proceed.');
                    }
                    $phoneNumber = $user->phone;
                    $verificationCode = $user->generateAndStoreVerificationCode($phoneNumber);
                    $message = "Your verification code is: $verificationCode";
                    $recipients = $phoneNumber;
                    $alias = 'MyDoc.lk';

                    $result = SmsService::sendSms($message, $recipients, $alias);
                    
                    return redirect()->route('verify.phone', ['phone' => $phoneNumber])->with('status', 'Verification code sent successfully. Check your mobile for the code.');
                }
            }
        }

        return $next($request);
    }
}
