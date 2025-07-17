<?php

namespace App\Policies;

use App\Models\Education;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $user->hasRole('service-provider') && $user->hasPermissionTo('doctor');
    }

    public function view(User $user, Education $education)
    {
        return $user->hasRole('service-provider') && $user->hasPermissionTo('doctor');
    }


    public function create(User $user)
    {
        return $user->hasRole('service-provider') && $user->hasPermissionTo('doctor');
    }

    public function update(User $user, Education $education)
    {
        return $user->hasRole('service-provider') && $user->hasPermissionTo('doctor');
    }


    public function delete(User $user, Education $education)
    {
        return $user->hasRole('service-provider') && $user->hasPermissionTo('doctor');
    }


    public function restore(User $user, Education $education)
    {
        return $user->hasRole('service-provider') && $user->hasPermissionTo('doctor');
    }

    public function forceDelete(User $user, Education $education)
    {
        return $user->hasRole('service-provider') && $user->hasPermissionTo('doctor');
    }
}
