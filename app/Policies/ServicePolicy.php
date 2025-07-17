<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Service $service)
    {
        //
    }

    public function create(User $user)
    {
        return ($user->hasRole('service-provider') && $user->can('doctor.access')) || ($user->hasRole('service-provider') && $user->can('service-provider.access')) || $user->hasRole('admin');
    }

    public function update(User $user, Service $service)
    {
        return ($user->hasRole('service-provider') && $user->can('doctor.access') || $user->hasRole('admin')) || ($user->hasRole('service-provider') && $user->can('service-provider.access')) && $user->id === $service->user_id;
    }

    public function delete(User $user, Service $service)
    {
        if ($service->inquiries()->count() > 0) {
            return false;
        }
        return (
                ($user->hasRole('service-provider') && $user->can('doctor.access')) ||
                $user->hasRole('admin')) ||
            (($user->hasRole('service-provider') && $user->can('service-provider.access')) && $user->id === $service->user_id);
    }

    public function restore(User $user, Service $service)
    {
        //
    }

    public function forceDelete(User $user, Service $service)
    {
        //
    }
}
