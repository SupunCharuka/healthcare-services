<?php

namespace App\Http\Resources;

use App\Utils\Enums;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        if ($this->google_avatar) {
            $socialAvatar = $this->google_avatar;
        } else {
            $socialAvatar = ($this->facebook_avatar ?: "https://robohash.org/{$this->name}.png");
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'slmc_number' => $this->slmc_number,
            'is_hotel' => $this->is_hotel,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'email_verified_at' => $this->email_verified_at,
            'phone_verified_at' => $this->phone_verified_at,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'two_factor_secret' => $this->two_factor_secret,
            'two_factor_recovery_codes' => $this->two_factor_recovery_codes,
            'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
            'remember_token' => $this->remember_token,
            'current_team_id' => $this->current_team_id,
            'has_profile_photo' => $this->profile_photo_path !== null,
            'is_dr_profile_approved' => $this->memberRegister->status === Enums::memberRegister['APPROVED'],
            'is_dr_education_filled' => $this->education->count() > 0,
            'is_dr_work_details_filled' => $this->workDetails->count() > 0,
            'google_id' => $this->google_id,
            'google_avatar' => $this->google_avatar,
            'facebook_id' => $this->facebook_id,
            'facebook_avatar' => $this->facebook_avatar,
            'profile_photo_url' => $this->when($this->profile_photo_path !== null, $this->profile_photo_url, $socialAvatar),
            'role' => $this->getRoleNames()->first(),
            'permissions' => $this->getAllPermissions(),
            'direct_permissions' => $this->getDirectPermissions(),
            'role_permissions' => $this->getPermissionsViaRoles(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'deactivated_at' => $this->deactivated_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
