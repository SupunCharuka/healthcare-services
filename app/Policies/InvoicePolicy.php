<?php

namespace App\Policies;

use App\Models\Inquiry;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole(['customer']);
    }

    public function view(User $user, Invoice $invoice, Inquiry $inquiry)
    {
        return $user->hasRole(['customer']);
    }


    public function submitBankTransferReceipt(User $user, Invoice $invoice)
    {
        return $user->hasRole(['customer']) && !$invoice->paid;
    }

    public function create(User $user)
    {
        return $user->hasRole(['customer']);
    }

    public function viewInvoicePayment(User $user, Invoice $invoice)
    {
        return $user->hasRole(['customer']) && $invoice->inquiry_id ===  $invoice->inquiry->id && $user->id === $invoice->inquiry->user_id;
    }

    public function update(User $user, Invoice $invoice)
    {
        //
    }


    public function delete(User $user, Invoice $invoice)
    {
        //
    }


    public function restore(User $user, Invoice $invoice)
    {
        //
    }

    public function forceDelete(User $user, Invoice $invoice)
    {
        //
    }
}
