@extends('layouts.app')

@section('title', 'Payments - XenonOS')

@section('content')
<header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8">
    <div>
        <span class="text-[10px] font-bold tracking-[0.2em] text-primary uppercase block">Billing</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-headline font-light tracking-tighter text-on-surface">Payments</h1>
    </div>
</header>

<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
    <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-success"></div>
        <div class="flex flex-col gap-1">
            <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Total Revenue</span>
            <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">${{ number_format($totalRevenue ?? 0) }}</div>
        </div>
    </div>
    <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
        <div class="flex flex-col gap-1">
            <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Pending</span>
            <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">${{ number_format($pendingAmount ?? 0) }}</div>
        </div>
    </div>
    <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
        <div class="flex flex-col gap-1">
            <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">This Month</span>
            <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">${{ number_format($thisMonth ?? 0) }}</div>
        </div>
    </div>
</section>

<div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-outline/10">
                    <th class="px-6 py-4 text-[10px] uppercase tracking-widest text-on-surface-muted">Invoice</th>
                    <th class="px-6 py-4 text-[10px] uppercase tracking-widest text-on-surface-muted">Client</th>
                    <th class="px-6 py-4 text-[10px] uppercase tracking-widest text-on-surface-muted">Amount</th>
                    <th class="px-6 py-4 text-[10px] uppercase tracking-widest text-on-surface-muted">Status</th>
                    <th class="px-6 py-4 text-[10px] uppercase tracking-widest text-on-surface-muted">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline/5">
                @forelse($payments as $payment)
                <tr class="hover:bg-surface-container-high/60">
                    <td class="px-6 py-4 text-sm font-medium text-on-surface">#{{ $payment->invoice_id }}</td>
                    <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $payment->invoice?->client?->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-on-surface">${{ number_format($payment->amount) }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-success/10 text-success text-[10px] font-bold px-2 py-1 rounded-full uppercase">{{ $payment->status }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $payment->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-on-surface-variant">No payments found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection