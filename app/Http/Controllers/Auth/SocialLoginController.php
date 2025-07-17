<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Socialite\Facades\Socialite;
use Str;

class SocialLoginController extends Controller
{
    // Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', trans('Something went wrong. Try Again.!'));
        }
        $user = User::where('google_id', $googleUser->id)->first();


        // if doesn't exist google id associated account
        if (!$user) {
            $user = User::where('email', $googleUser->email)->first();
            if (!$user) {
                $user = tap(User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => password_hash(Hash::make(Str::random(16)), PASSWORD_DEFAULT), // make a shuffle coz this never meant to use
                    'google_id' => $googleUser->id,
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'google_avatar' => $googleUser->avatar
                ]), function (User $user) {
                    $user->assignRole('customer');
                });
                event(new Registered($user));
                Auth::login($user);
                return app(RegisterResponse::class);
            }

            $user->update([
                'google_id' => $googleUser->id,
                'google_avatar' => $googleUser->avatar
            ]);
        }
        $user->update([
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);
        Auth::login($user, true);
        return app(LoginResponse::class);
    }

    // Facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', trans('Something went wrong. Try Again.!'));
        }
        $user = User::where('facebook_id', $facebookUser->id)->first();

        // if doesn't exist google id associated account
        if (!$user) {
            $user = User::where('email', $facebookUser->email)->first();
            if (!$user) {
                $user = tap(User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'password' => password_hash(Hash::make(Str::random(16)), PASSWORD_DEFAULT), // make a shuffle coz this never meant to use
                    'facebook_id' => $facebookUser->id,
                    'facebook_token' => $facebookUser->token,
                    'facebook_refresh_token' => $facebookUser->refreshToken,
                    'facebook_avatar' => $facebookUser->avatar
                ]), function (User $user) {
                    $user->assignRole('customer');
                });
                event(new Registered($user));
                Auth::login($user);
                return app(RegisterResponse::class);
            }

            $user->update([
                'facebook_id' => $facebookUser->id,
                'facebook_avatar' => $facebookUser->avatar
            ]);
        }
        $user->update([
            'facebook_token' => $facebookUser->token,
            'facebook_refresh_token' => $facebookUser->refreshToken,
        ]);
        Auth::login($user, true);
        return app(LoginResponse::class);
    }
}
