<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('payment.view');
    }

    public function view(User $user, Payment $payment): bool
    {
        return $user->hasPermission('payment.view') && $this->hasAccess($user, $payment);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('payment.create');
    }

    public function refund(User $user, Payment $payment): bool
    {
        return $user->hasPermission('payment.refund') && $this->isOwner($user, $payment);
    }

    private function hasAccess(User $user, Payment $payment): bool
    {
        return $payment->invoice && $payment->invoice->client &&
               ($payment->invoice->client->created_by === $user->id ||
                $payment->invoice->client->teamMembers()->where('user_id', $user->id)->exists());
    }

    private function isOwner(User $user, Payment $payment): bool
    {
        return $payment->invoice && $payment->invoice->client &&
               $payment->invoice->client->created_by === $user->id;
    }
}