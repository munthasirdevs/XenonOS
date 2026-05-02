<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Subscription::with(['client:id,name', 'creator:id,name']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $subscriptions = $query->orderBy('created_at', 'desc')->paginate(20);
        return $this->success($subscriptions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'plan_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,yearly',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'auto_renew' => 'nullable|boolean',
        ]);

        $subscription = Subscription::create([
            ...$request->all(),
            'status' => 'active',
            'end_date' => $request->end_date ?? ($request->billing_cycle === 'monthly' 
                ? now()->addMonth() 
                : now()->addYear()),
            'created_by' => $request->user()->id,
        ]);

        return $this->success($subscription->load(['client', 'creator']), 'Subscription created', 201);
    }

    public function show(Subscription $subscription)
    {
        $subscription->load(['client:id,name', 'creator:id,name']);
        return $this->success($subscription);
    }

    public function update(Request $request, Subscription $subscription)
    {
        if ($subscription->status !== 'active') {
            return $this->error('Cannot update inactive subscription', 422);
        }

        $request->validate([
            'plan_name' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'auto_renew' => 'nullable|boolean',
        ]);

        $subscription->update($request->only(['plan_name', 'price', 'auto_renew']));
        return $this->success($subscription, 'Subscription updated');
    }

    public function cancel(Request $request, Subscription $subscription)
    {
        $subscription->update([
            'status' => 'cancelled',
            'auto_renew' => false,
        ]);

        return $this->success(null, 'Subscription cancelled');
    }

    public function renew(Request $request, Subscription $subscription)
    {
        if ($subscription->status !== 'active') {
            return $this->error('Cannot renew inactive subscription', 422);
        }

        $newEndDate = $subscription->billing_cycle === 'monthly'
            ? $subscription->end_date->addMonth()
            : $subscription->end_date->addYear();

        $subscription->update(['end_date' => $newEndDate]);

        return $this->success($subscription, 'Subscription renewed');
    }

    public function checkExpired()
    {
        $expired = Subscription::where('status', 'active')
            ->where('end_date', '<', now())
            ->update(['status' => 'expired']);

        return $this->success(['updated' => $expired]);
    }
}