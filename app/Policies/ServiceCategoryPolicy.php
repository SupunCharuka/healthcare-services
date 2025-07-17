<?php

namespace App\Policies;

use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['customer']);
    }

    public function viewInputs(User $user)
    {
        return $user->hasRole(['customer']);
    }

    public function view(User $user, ServiceCategory $serviceCategory)
    {
        return $user->hasRole(['customer']);
    }

    public function create(User $user)
    {
        // check permissions in admin user
        return !$user->hasRole(['customer']);
    }


    public function update(User $user, ServiceCategory $serviceCategory)
    {
        //
    }

    public function delete(User $user, ServiceCategory $serviceCategory)
    {
        //
    }

    public function restore(User $user, ServiceCategory $serviceCategory)
    {
        //
    }

    public function forceDelete(User $user, ServiceCategory $serviceCategory)
    {
        //
    }
}
