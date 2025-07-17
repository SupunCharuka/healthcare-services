<?php

namespace App\Policies;

use App\Models\Inquiry;
use App\Models\InquiryConversation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InquiryConversationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole(['customer', 'service-provider']);
    }

    public function create(User $user, Inquiry $inquiry)
    {
        return $user->hasRole(['customer', 'service-provider']) && ($inquiry->user_id === $user->id || $inquiry->service->user_id === $user->id);
    }

    public function update(User $user, InquiryConversation $conversation)
    {
        //
    }


    public function delete(User $user, InquiryConversation $conversation)
    {
        //
    }


    public function restore(User $user, InquiryConversation $conversation)
    {
        //
    }

    public function forceDelete(User $user, InquiryConversation $conversation)
    {
        //
    }
}
