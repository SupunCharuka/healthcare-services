<?php

namespace App\Policies;

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InquiryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole(['customer']) || $user->hasAnyPermission(['doctor', 'service-provider.access']);
    }

    public function view(User $user, Inquiry $inquiry)
    {
        //
    }

    public function viewInvoice(User $user, Inquiry $inquiry)
    {
        return $user->hasRole(['customer']) && $inquiry->cost !== null;
    }

    public function viewInquiryDetails(User $user, Inquiry $inquiry)
    {
        return ($user->hasRole(['customer']) && $user->id === $inquiry->user_id) || ($user->hasRole(['service-provider']) && $user->id === $inquiry->service->user_id);
    }

    public function writeReview(User $user, Inquiry $inquiry)
    {
        return $user->hasRole(['customer']) && $user->id === $inquiry->user_id;
    }

    public function viewMedicalReport(User $user, Inquiry $inquiry)
    {
        return $user->hasRole(['service-provider']) && $user->id === $inquiry->service->user_id;
    }

    public function create(User $user)
    {
        return $user->hasRole(['customer']);
    }

    public function update(User $user, Inquiry $inquiry)
    {
        //
    }


    public function delete(User $user, Inquiry $inquiry)
    {
        //
    }


    public function restore(User $user, Inquiry $inquiry)
    {
        //
    }

    public function forceDelete(User $user, Inquiry $inquiry)
    {
        //
    }
}
