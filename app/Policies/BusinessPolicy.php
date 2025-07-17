<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Business $business)
    {
        return $user->id === $business->user_id;
    }

    public function create(User $user)
    {
        return $user->business->id === null;
    }

    public function update(User $user, Business $business)
    {
        return $user->id === $business->user_id;
    }


    public function delete(User $user, Business $business)
    {
        return false;
    }


    public function restore(User $user, Business $business)
    {
        return false;
    }


    public function forceDelete(User $user, Business $business)
    {
        return false;
    }
}
