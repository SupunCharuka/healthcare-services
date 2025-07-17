<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole(['customer', 'service-provider']);
    }

    public function view(User $user, Order $invoice)
    {
        return $user->hasRole(['customer', 'service-provider']);
    }


    public function create(User $user)
    {
        return $user->hasRole(['customer', 'service-provider']);
    }

    public function orderDetails(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    public function update(User $user, Order $invoice)
    {
        //
    }


    public function delete(User $user, Order $invoice)
    {
        //
    }


    public function restore(User $user, Order $invoice)
    {
        //
    }

    public function forceDelete(User $user, Order $invoice)
    {
        //
    }

    public function placeOrder(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }
}
