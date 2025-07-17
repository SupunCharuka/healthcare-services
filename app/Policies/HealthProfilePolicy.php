<?php

namespace App\Policies;

use App\Models\HealthProfile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HealthProfilePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, HealthProfile $healthProfile)
    {
        //
    }

    public function create(User $user)
    {
        return $user->hasRole(['customer']);
    }


    public function update(User $user, HealthProfile $healthProfile)
    {
        return $user->hasRole(['customer']) && $user->id === $healthProfile->user_id;
    }

    public function delete(User $user, HealthProfile $healthProfile)
    {
        return $user->hasRole(['customer']) && $user->id === $healthProfile->user_id;
    }

    public function restore(User $user, HealthProfile $healthProfile)
    {
        //
    }


    public function forceDelete(User $user, HealthProfile $healthProfile)
    {
        //
    }
}
