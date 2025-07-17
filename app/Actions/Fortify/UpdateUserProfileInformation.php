<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param array<string, string> $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)->whereNull('deleted_at')],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:5024'],
            'phone' => ['required', 'string', Rule::unique('users', 'phone')->ignore($user?->id)->whereNull('deleted_at')],
            'slmc_number' => ['nullable', Rule::requiredIf($user->member_type === 'doctor'), 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'dob' => ['required', 'date_format:Y-m-d'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } elseif ($input['phone'] !== $user->phone) {
            $user->forceFill([
                'name' => $input['name'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'gender' => $input['gender'],
                'dob' => $input['dob'],
                'slmc_number' => $input['slmc_number'] ?? null,
                'phone_verified_at' => null,
            ])->save();
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'gender' => $input['gender'],
                'dob' => $input['dob'],
                'slmc_number' => $input['slmc_number'] ?? null,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param array<string, string> $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'gender' => $input['gender'],
            'dob' => $input['dob'],
            'slmc_number' => $input['slmc_number'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
