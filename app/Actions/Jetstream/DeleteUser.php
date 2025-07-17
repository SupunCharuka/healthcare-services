<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->update(['fcm_token' => null]);
        $user->inquiries()->where('member_status', 'pending')->update(['member_status' => 'rejected']);
        $user->services()->update(['status' => 'rejected']);
        $user->tickets()->update(['status' => 'close']);
        $user->delete();
    }
}
