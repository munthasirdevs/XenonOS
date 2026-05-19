<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('invoice.view');
    }

    public function view(User $user, Invoice $invoice): bool
    {
        return $user->hasPermission('invoice.view') && $this->hasAccess($user, $invoice);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('invoice.create');
    }

    public function update(User $user, Invoice $invoice): bool
    {
        return $user->hasPermission('invoice.update') && $this->isOwner($user, $invoice);
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        return $user->hasPermission('invoice.delete') && $this->isOwner($user, $invoice);
    }

    public function send(User $user, Invoice $invoice): bool
    {
        return $user->hasPermission('invoice.send') && $this->isOwner($user, $invoice);
    }

    public function markPaid(User $user, Invoice $invoice): bool
    {
        return $user->hasPermission('invoice.update') && $this->isOwner($user, $invoice);
    }

    private function hasAccess(User $user, Invoice $invoice): bool
    {
        return $invoice->client && 
               ($invoice->client->created_by === $user->id || 
                $invoice->client->teamMembers()->where('user_id', $user->id)->exists());
    }

    private function isOwner(User $user, Invoice $invoice): bool
    {
        return $invoice->client && $invoice->client->created_by === $user->id;
    }
}