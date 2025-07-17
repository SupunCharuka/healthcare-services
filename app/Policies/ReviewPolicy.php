<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Review $review)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }


    public function update(User $user, Review $review)
    {
        return true;
    }

    public function delete(User $user, Review $review)
    {
        return $user->id === $review->inquiry->user_id;
    }


    public function restore(User $user, Review $review)
    {
        return false;
    }

    public function forceDelete(User $user, Review $review)
    {
        return false;
    }
}
