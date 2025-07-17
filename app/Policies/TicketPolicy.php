<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Ticket $ticket)
    {
        return $user->hasRole('admin') || $user->id === $ticket->user_id;
    }

    public function create(User $user)
    {
        return $user->hasRole('customer') || $user->hasRole('service-provider');
    }

    public function update(User $user, Ticket $ticket)
    {
        return $user->hasRole('admin') || $user->id === $ticket->user_id;
    }

    public function delete(User $user, Ticket $ticket)
    {
        return $user->hasRole('admin') || $user->id === $ticket->user_id;
    }


    public function restore(User $user, Ticket $ticket)
    {
        //
    }


    public function forceDelete(User $user, Ticket $ticket)
    {
        //
    }

    public function open(User $user, Ticket $ticket)
    {

        return $user->hasRole('admin') ||
            $ticket->status === 'close' && $user->id === $ticket->user_id;
    }

    public function close(User $user, Ticket $ticket)
    {
        return $user->hasRole('admin') ||
            $ticket->status !== 'close' && $user->id === $ticket->user_id;
    }
}
