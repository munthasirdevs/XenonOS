@extends('layouts.app')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/billing-invoices.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/billing-invoices.js') }}" defer></script>
@endpush

<main class="flex-1 min-h-screen flex flex-col" role="main">
    <div class="flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 md:px-8 lg:px-10 py-6 sm:py-8 md:py-10 lg:py-12">

        <!-- Branding & Global Fiscal Actions -->
        <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
            <div class="space-y-1.5 sm:space-y-2">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">
                    Invoices
                </h1>
                <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed">
                    Manage your financial ecosystem with surgical precision.
                </p>
            </div>
            <div class="shrink-0">
                <button type="button"
                    class="bg-primary hover:bg-primary/90 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-primary font-semibold px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl sm:rounded-2xl inline-flex items-center justify-center gap-2 transition-all duration-150 shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 w-full sm:w-auto min-h-[44px] text-sm sm:text-base"
                    aria-label="Create new invoice">
                    <span class="material-symbols-outlined text-lg sm:text-xl" aria-hidden="true">add_circle</span>
                    <span>Create Invoice</span>
                </button>
            </div>
        </header>

        <!-- Performance Pulse (KPI Statistics) -->
        <section class="grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8" aria-label="Invoice statistics">
            <!-- Total Revenue -->
            <div class="md:col-span-2 bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 relative overflow-hidden shadow-sm">
                <div class="absolute top-4 right-4 sm:top-8 sm:right-8 opacity-10" aria-hidden="true">
                    <span class="material-symbols-outlined text-6xl sm:text-8xl text-on-surface">account_balance</span>
                </div>
                <p class="text-on-surface-variant font-semibold text-xs sm:text-sm mb-1">Total Revenue</p>
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-headline font-extrabold text-primary mb-3 sm:mb-4">$142,850.40</h3>
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-400 bg-emerald-400/10 px-2 py-1 rounded-full w-fit">
                    <span class="material-symbols-outlined text-xs" aria-hidden="true">trending_up</span>
                    +12.4% from last month
                </div>
            </div>
            <!-- Pending -->
            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 shadow-sm hover:bg-surface-container-high transition-all">
                <p class="text-on-surface-variant font-semibold text-xs sm:text-sm mb-1">Pending</p>
                <h3 class="text-2xl sm:text-3xl font-headline font-extrabold text-on-surface mb-3 sm:mb-4">$12,400</h3>
                <p class="text-xs text-on-surface-variant">8 invoices awaiting payment</p>
            </div>
            <!-- Overdue -->
            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 shadow-sm hover:bg-surface-container-high transition-all">
                <p class="text-on-surface-variant font-semibold text-xs sm:text-sm mb-1">Overdue</p>
                <h3 class="text-2xl sm:text-3xl font-headline font-extrabold text-error mb-3 sm:mb-4">$3,210</h3>
                <p class="text-xs text-on-surface-variant">2 invoices high priority</p>
            </div>
        </section>

        <!-- Discovery & Filtration Logic -->
        <section class="bg-surface-container-low rounded-t-2xl sm:rounded-t-3xl p-3 sm:p-4 md:p-6 shadow-sm" aria-label="Invoice filters">
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <!-- Status Filter -->
                <label for="invoice-status" class="sr-only">Filter by invoice status</label>
                <select id="invoice-status"
                    class="bg-surface-container text-on-surface text-sm rounded-xl py-2.5 sm:py-3 px-4 border-0 focus:ring-2 focus:ring-primary appearance-none cursor-pointer min-h-[44px] pr-10"
                    aria-label="Filter by invoice status">
                    <option value="all">Status: All Invoices</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                    <option value="overdue">Overdue</option>
                </select>
                <!-- Date Range Filter -->
                <label for="invoice-date" class="sr-only">Filter by date range</label>
                <select id="invoice-date"
                    class="bg-surface-container text-on-surface text-sm rounded-xl py-2.5 sm:py-3 px-4 border-0 focus:ring-2 focus:ring-primary appearance-none cursor-pointer min-h-[44px] pr-10"
                    aria-label="Filter by date range">
                    <option value="30">Date: Last 30 days</option>
                    <option value="quarter">Last Quarter</option>
                    <option value="ytd">Year to Date</option>
                </select>
                <!-- Client Filter -->
                <label for="invoice-client" class="sr-only">Filter by client</label>
                <select id="invoice-client"
                    class="bg-surface-container text-on-surface text-sm rounded-xl py-2.5 sm:py-3 px-4 border-0 focus:ring-2 focus:ring-primary appearance-none cursor-pointer min-h-[44px] pr-10"
                    aria-label="Filter by client">
                    <option value="all">Client: All Clients</option>
                    <option value="aether">Aether Labs</option>
                    <option value="cyber">Cyber Systems</option>
                    <option value="nexus">Nexus Corp</option>
                </select>
                <!-- Action Buttons -->
                <div class="flex items-center gap-2 ml-auto">
                    <button type="button"
                        class="p-2.5 sm:p-3 bg-surface-container hover:bg-surface-container-high active:scale-[0.96] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-xl transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center"
                        aria-label="Open advanced filters">
                        <span class="material-symbols-outlined text-sm sm:text-base" aria-hidden="true">filter_list</span>
                    </button>
                    <button type="button"
                        class="p-2.5 sm:p-3 bg-surface-container hover:bg-surface-container-high active:scale-[0.96] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-xl transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center"
                        aria-label="Download invoices">
                        <span class="material-symbols-outlined text-sm sm:text-base" aria-hidden="true">download</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Financial Transaction Ledger (Data Grid) -->
        <div class="bg-surface-container-low rounded-b-2xl sm:rounded-b-3xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[720px]" role="table" aria-label="Invoices list">
                    <thead>
                        <tr class="border-b border-outline-variant/10">
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Invoice ID</th>
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Client</th>
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-right">Amount</th>
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Status</th>
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap hidden md:table-cell">Due Date</th>
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted w-[52px]"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/5">
                        <!-- Row 1: INV-9402 (Paid) -->
                        <tr class="group hover:bg-surface-container/60 cursor-pointer transition-colors" tabindex="0" role="row" aria-label="Invoice INV-9402, Aether Labs, Paid, $12,450.00">
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="font-headline text-on-surface font-bold text-sm">INV-9402</span>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Aether+Labs&background=6366f1&color=fff&size=32&rounded=true" alt="Aether Labs" class="w-8 h-8 rounded-lg shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-on-surface truncate">Aether Labs</p>
                                        <p class="text-xs text-on-surface-variant truncate">Cloud Infrastructure</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right font-headline text-on-surface text-sm sm:text-base">$12,450.00</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-wider bg-primary/10 text-primary border border-primary/20 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary" aria-hidden="true"></span>
                                    Paid
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-sm text-on-surface-variant whitespace-nowrap hidden md:table-cell">Oct 12, 2023</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right">
                                <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button type="button" class="p-2 hover:bg-surface-container-high rounded-lg text-on-surface-variant hover:text-primary transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center" aria-label="View invoice INV-9402">
                                        <span class="material-symbols-outlined text-lg sm:text-xl" aria-hidden="true">visibility</span>
                                    </button>
                                    <button type="button" class="p-2 hover:bg-surface-container-high rounded-lg text-on-surface-variant hover:text-primary transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center" aria-label="Download invoice INV-9402">
                                        <span class="material-symbols-outlined text-lg sm:text-xl" aria-hidden="true">download</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2: INV-9398 (Pending) -->
                        <tr class="group hover:bg-surface-container/60 cursor-pointer transition-colors" tabindex="0" role="row" aria-label="Invoice INV-9398, Cyber Systems, Pending, $8,200.00">
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="font-headline text-on-surface font-bold text-sm">INV-9398</span>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Cyber+Systems&background=f97316&color=fff&size=32&rounded=true" alt="Cyber Systems" class="w-8 h-8 rounded-lg shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-on-surface truncate">Cyber Systems</p>
                                        <p class="text-xs text-on-surface-variant truncate">AI Research</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right font-headline text-on-surface text-sm sm:text-base">$8,200.00</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-wider bg-tertiary/10 text-tertiary border border-tertiary/20 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse" aria-hidden="true"></span>
                                    Pending
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-sm text-on-surface-variant whitespace-nowrap hidden md:table-cell">Oct 28, 2023</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button type="button" class="flex items-center gap-1.5 px-3 py-2 bg-surface-container-highest hover:bg-primary/20 text-on-surface-variant hover:text-primary rounded-lg text-xs font-bold transition-all border border-outline-variant/20 min-h-[44px]" aria-label="Send reminder for invoice INV-9398">
                                        <span class="material-symbols-outlined text-base" aria-hidden="true">send</span>
                                        <span class="hidden sm:inline">Remind</span>
                                    </button>
                                    <button type="button" class="p-2 hover:bg-surface-container-high rounded-lg text-on-surface-variant transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center" aria-label="More options for INV-9398">
                                        <span class="material-symbols-outlined text-lg sm:text-xl" aria-hidden="true">more_vert</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3: INV-9385 (Overdue) -->
                        <tr class="group hover:bg-surface-container/60 cursor-pointer transition-colors" tabindex="0" role="row" aria-label="Invoice INV-9385, Nexus Corp, Overdue, $3,210.00">
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="font-headline text-on-surface font-bold text-sm">INV-9385</span>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Nexus+Corp&background=10b981&color=fff&size=32&rounded=true" alt="Nexus Corp" class="w-8 h-8 rounded-lg shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-on-surface truncate">Nexus Corp</p>
                                        <p class="text-xs text-on-surface-variant truncate">Data Logistics</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right font-headline text-on-surface text-sm sm:text-base">$3,210.00</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-wider bg-error/10 text-error border border-error/20 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-error" aria-hidden="true"></span>
                                    Overdue
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-sm text-error font-bold italic underline decoration-error/30 whitespace-nowrap hidden md:table-cell">Oct 05, 2023</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right">
                                <div class="flex items-center justify-end gap-1 opacity-100 transition-opacity">
                                    <button type="button" class="flex items-center gap-1.5 px-3 py-2 bg-error/20 text-error hover:bg-error/30 rounded-lg text-xs font-bold transition-all border border-error/30 min-h-[44px]" aria-label="Send final notice for invoice INV-9385">
                                        <span class="material-symbols-outlined text-base" aria-hidden="true">warning</span>
                                        <span class="hidden lg:inline">Final Notice</span>
                                    </button>
                                    <button type="button" class="p-2 hover:bg-surface-container-high rounded-lg text-on-surface-variant transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center" aria-label="More options for INV-9385">
                                        <span class="material-symbols-outlined text-lg sm:text-xl" aria-hidden="true">more_vert</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4: INV-9382 (Paid) -->
                        <tr class="group hover:bg-surface-container/60 cursor-pointer transition-colors" tabindex="0" role="row" aria-label="Invoice INV-9382, Stark Tech, Paid, $25,000.00">
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="font-headline text-on-surface font-bold text-sm">INV-9382</span>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Stark+Tech&background=64748b&color=fff&size=32&rounded=true" alt="Stark Tech" class="w-8 h-8 rounded-lg shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-on-surface truncate">Stark Tech</p>
                                        <p class="text-xs text-on-surface-variant truncate">Defense Systems</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right font-headline text-on-surface text-sm sm:text-base">$25,000.00</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-wider bg-primary/10 text-primary border border-primary/20 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary" aria-hidden="true"></span>
                                    Paid
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-sm text-on-surface-variant whitespace-nowrap hidden md:table-cell">Oct 02, 2023</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right">
                                <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button type="button" class="p-2 hover:bg-surface-container-high rounded-lg text-on-surface-variant hover:text-primary transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center" aria-label="View invoice INV-9382">
                                        <span class="material-symbols-outlined text-lg sm:text-xl" aria-hidden="true">visibility</span>
                                    </button>
                                    <button type="button" class="p-2 hover:bg-surface-container-high rounded-lg text-on-surface-variant hover:text-primary transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center" aria-label="Download invoice INV-9382">
                                        <span class="material-symbols-outlined text-lg sm:text-xl" aria-hidden="true">download</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination & Navigation Matrix -->
            <div class="px-4 sm:px-6 md:px-8 py-4 sm:py-6 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-outline-variant/10">
                <p class="text-xs text-on-surface-variant">Showing <span class="text-on-surface font-bold">1-4</span> of <span class="text-on-surface font-bold">128</span> invoices</p>
                <div class="flex items-center gap-1.5" role="navigation" aria-label="Pagination">
                    <button type="button" class="w-9 h-9 flex items-center justify-center rounded-xl border border-outline-variant/20 text-on-surface-variant disabled:opacity-30 min-h-[44px] min-w-[44px] transition-all" disabled aria-label="Previous page">
                        <span class="material-symbols-outlined text-sm" aria-hidden="true">chevron_left</span>
                    </button>
                    <button type="button" class="w-9 h-9 flex items-center justify-center rounded-xl bg-primary text-on-primary font-bold text-xs min-h-[44px] min-w-[44px]" aria-label="Page 1" aria-current="page">1</button>
                    <button type="button" class="w-9 h-9 flex items-center justify-center rounded-xl hover:bg-surface-container-highest text-on-surface-variant font-bold text-xs transition-colors min-h-[44px] min-w-[44px]" aria-label="Page 2">2</button>
                    <button type="button" class="w-9 h-9 flex items-center justify-center rounded-xl hover:bg-surface-container-highest text-on-surface-variant font-bold text-xs transition-colors min-h-[44px] min-w-[44px]" aria-label="Page 3">3</button>
                    <button type="button" class="w-9 h-9 flex items-center justify-center rounded-xl border border-outline-variant/20 text-on-surface-variant hover:text-primary transition-colors min-h-[44px] min-w-[44px]" aria-label="Next page">
                        <span class="material-symbols-outlined text-sm" aria-hidden="true">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
