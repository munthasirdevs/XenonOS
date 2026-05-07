@extends('layouts.app')

@section('content')
<x-navbar />

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/billing-transactions.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/billing-transactions.js') }}" defer></script>
@endpush

<main class="flex-1 min-h-screen flex flex-col" role="main">
    <div class="flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 md:px-8 lg:px-10 py-6 sm:py-8 md:py-10 lg:py-12">

        <!-- Branding & Global Data Exports -->
        <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
            <div class="space-y-1.5 sm:space-y-2">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">
                    Transaction Ledger
                </h1>
                <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed">
                    Detailed overview of financial flows across all active projects and international clients.
                </p>
            </div>
            <div class="flex flex-wrap gap-2 sm:gap-3 w-full sm:w-auto">
                <button type="button" class="bg-surface-container-highest hover:bg-surface-container-high active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-surface font-medium px-4 py-2.5 sm:py-3 rounded-xl inline-flex items-center justify-center gap-2 transition-all duration-150 border border-outline-variant/10 w-full sm:w-auto min-h-[44px] text-sm" aria-label="Export transactions as PDF">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">download</span>
                    <span>Export PDF</span>
                </button>
                <button type="button" class="bg-surface-container-highest hover:bg-surface-container-high active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-surface font-medium px-4 py-2.5 sm:py-3 rounded-xl inline-flex items-center justify-center gap-2 transition-all duration-150 border border-outline-variant/10 w-full sm:w-auto min-h-[44px] text-sm" aria-label="Export transactions as CSV">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">ios_share</span>
                    <span>CSV Export</span>
                </button>
                <button type="button" class="bg-primary hover:bg-primary/90 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-primary font-semibold px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl inline-flex items-center justify-center gap-2 transition-all duration-150 shadow-lg shadow-primary/20 w-full sm:w-auto min-h-[44px] text-sm" aria-label="Create new transaction">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">add</span>
                    <span>New Transaction</span>
                </button>
            </div>
        </header>

        <!-- Performance Pulse (Quarterly Stats Overlay) -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8" aria-label="Transaction statistics">
            <!-- Total Volume -->
            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-sm border-l-4 border-primary/40 hover:scale-[1.02] transition-transform duration-400">
                <p class="text-on-surface-variant text-[10px] uppercase tracking-widest mb-1">Total Volume</p>
                <h3 class="text-2xl sm:text-3xl font-headline font-bold text-on-surface">$124,502.00</h3>
                <p class="text-xs text-primary mt-2 flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs" aria-hidden="true">trending_up</span>
                    +12.4% vs last month
                </p>
            </div>
            <!-- Pending Clearance -->
            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-sm border-l-4 border-tertiary/40 hover:scale-[1.02] transition-transform duration-400">
                <p class="text-on-surface-variant text-[10px] uppercase tracking-widest mb-1">Pending Clearance</p>
                <h3 class="text-2xl sm:text-3xl font-headline font-bold text-on-surface">$8,120.40</h3>
                <p class="text-xs text-on-surface-variant mt-2">4 active transactions</p>
            </div>
            <!-- Primary Gateway -->
            <div class="sm:col-span-2 bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-sm border border-outline-variant/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:scale-[1.02] transition-transform duration-400">
                <div>
                    <p class="text-on-surface-variant text-[10px] uppercase tracking-widest mb-1">Primary Gateway</p>
                    <h3 class="text-lg sm:text-xl font-headline font-bold text-on-surface">Stripe Connect &bull; USD</h3>
                </div>
                <div class="h-12 w-24 bg-surface-container rounded-lg flex items-center justify-center opacity-40 shrink-0" aria-hidden="true">
                    <span class="material-symbols-outlined text-3xl text-on-surface">account_balance</span>
                </div>
            </div>
        </section>

        <!-- Intelligence Filtration & Logic Engine -->
        <section class="flex flex-wrap items-center gap-3 sm:gap-4 mb-4 sm:mb-6" aria-label="Transaction filters">
            <!-- Date Range -->
            <label for="txn-date" class="sr-only">Filter by date range</label>
            <div class="flex items-center gap-2 px-3 py-2.5 sm:py-3 bg-surface-container rounded-xl border border-outline-variant/10 min-h-[44px]">
                <span class="material-symbols-outlined text-sm text-on-surface-variant flex-shrink-0" aria-hidden="true">calendar_today</span>
                <select id="txn-date" class="bg-transparent border-none text-xs sm:text-sm text-on-surface focus:ring-0 cursor-pointer pr-4" aria-label="Filter by date range">
                    <option>Last 30 Days</option>
                    <option>Current Quarter</option>
                    <option>Year to Date</option>
                    <option>All Time</option>
                </select>
            </div>
            <!-- Payment Method -->
            <label for="txn-method" class="sr-only">Filter by payment method</label>
            <div class="flex items-center gap-2 px-3 py-2.5 sm:py-3 bg-surface-container rounded-xl border border-outline-variant/10 min-h-[44px]">
                <span class="material-symbols-outlined text-sm text-on-surface-variant flex-shrink-0" aria-hidden="true">filter_list</span>
                <select id="txn-method" class="bg-transparent border-none text-xs sm:text-sm text-on-surface focus:ring-0 cursor-pointer pr-4" aria-label="Filter by payment method">
                    <option>All Methods</option>
                    <option>Wire Transfer</option>
                    <option>Credit Card</option>
                    <option>Crypto (USDC)</option>
                </select>
            </div>
            <!-- Status -->
            <label for="txn-status" class="sr-only">Filter by transaction status</label>
            <div class="flex items-center gap-2 px-3 py-2.5 sm:py-3 bg-surface-container rounded-xl border border-outline-variant/10 min-h-[44px]">
                <span class="material-symbols-outlined text-sm text-on-surface-variant flex-shrink-0" aria-hidden="true">verified</span>
                <select id="txn-status" class="bg-transparent border-none text-xs sm:text-sm text-on-surface focus:ring-0 cursor-pointer pr-4" aria-label="Filter by transaction status">
                    <option>Any Status</option>
                    <option>Completed</option>
                    <option>Pending</option>
                    <option>Failed</option>
                </select>
            </div>
            <button type="button" class="ml-auto text-xs sm:text-sm text-primary font-medium hover:underline focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded min-h-[44px] inline-flex items-center" aria-label="Clear all filters">
                Clear all filters
            </button>
        </section>

        <!-- Financial Flow History (Granular Ledger) -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm overflow-hidden mb-6 sm:mb-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[720px]" role="table" aria-label="Transaction ledger">
                    <thead>
                        <tr class="border-b border-outline-variant/10">
                            <th scope="col" class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Transaction ID</th>
                            <th scope="col" class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Date</th>
                            <th scope="col" class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Client</th>
                            <th scope="col" class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap hidden sm:table-cell">Method</th>
                            <th scope="col" class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Status</th>
                            <th scope="col" class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/5">
                        <!-- Row 1: TXN-88219 (Completed) -->
                        <tr class="hover:bg-surface-container-high/60 transition-colors cursor-pointer" tabindex="0" role="row" aria-label="Transaction TXN-88219, Nexus Labs Inc., Completed, $12,450.00">
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="text-xs sm:text-sm font-mono text-on-surface-variant hover:text-on-surface transition-colors">#TXN-88219</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-xs sm:text-sm text-on-surface whitespace-nowrap">Oct 24, 2023</td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Nexus+Labs&background=10b981&color=fff&size=32&rounded=true" alt="Nexus Labs" class="h-8 w-8 rounded-full shrink-0">
                                    <span class="text-xs sm:text-sm font-medium">Nexus Labs Inc.</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 hidden sm:table-cell">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm text-on-surface-variant flex-shrink-0" aria-hidden="true">credit_card</span>
                                    <span class="text-xs sm:text-sm">Credit Card</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="px-2.5 py-1 rounded-full bg-primary/10 text-primary text-[10px] sm:text-[11px] font-bold uppercase tracking-wider whitespace-nowrap">Completed</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-right text-xs sm:text-sm font-bold">$12,450.00</td>
                        </tr>

                        <!-- Row 2: TXN-88220 (Pending) -->
                        <tr class="hover:bg-surface-container-high/60 transition-colors cursor-pointer" tabindex="0" role="row" aria-label="Transaction TXN-88220, Solaris Architecture, Pending, $4,800.00">
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="text-xs sm:text-sm font-mono text-on-surface-variant hover:text-on-surface transition-colors">#TXN-88220</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-xs sm:text-sm text-on-surface whitespace-nowrap">Oct 23, 2023</td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Solaris+Architecture&background=f97316&color=fff&size=32&rounded=true" alt="Solaris Architecture" class="h-8 w-8 rounded-full shrink-0">
                                    <span class="text-xs sm:text-sm font-medium">Solaris Architecture</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 hidden sm:table-cell">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm text-on-surface-variant flex-shrink-0" aria-hidden="true">account_balance</span>
                                    <span class="text-xs sm:text-sm">Wire Transfer</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="px-2.5 py-1 rounded-full bg-surface-container-highest text-on-surface-variant text-[10px] sm:text-[11px] font-bold uppercase tracking-wider whitespace-nowrap">Pending</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-right text-xs sm:text-sm font-bold">$4,800.00</td>
                        </tr>

                        <!-- Row 3: TXN-88221 (Completed) -->
                        <tr class="hover:bg-surface-container-high/60 transition-colors cursor-pointer" tabindex="0" role="row" aria-label="Transaction TXN-88221, Vanguard Estate, Completed, $32,000.00">
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="text-xs sm:text-sm font-mono text-on-surface-variant hover:text-on-surface transition-colors">#TXN-88221</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-xs sm:text-sm text-on-surface whitespace-nowrap">Oct 21, 2023</td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Vanguard+Estate&background=6366f1&color=fff&size=32&rounded=true" alt="Vanguard Estate" class="h-8 w-8 rounded-full shrink-0">
                                    <span class="text-xs sm:text-sm font-medium">Vanguard Estate</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 hidden sm:table-cell">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm text-on-surface-variant flex-shrink-0" aria-hidden="true">currency_bitcoin</span>
                                    <span class="text-xs sm:text-sm">USDC (Polygon)</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="px-2.5 py-1 rounded-full bg-primary/10 text-primary text-[10px] sm:text-[11px] font-bold uppercase tracking-wider whitespace-nowrap">Completed</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-right text-xs sm:text-sm font-bold">$32,000.00</td>
                        </tr>

                        <!-- Row 4: TXN-88222 (Failed) -->
                        <tr class="hover:bg-surface-container-high/60 transition-colors cursor-pointer" tabindex="0" role="row" aria-label="Transaction TXN-88222, Aura Kraft, Failed, $920.00">
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="text-xs sm:text-sm font-mono text-on-surface-variant hover:text-on-surface transition-colors">#TXN-88222</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-xs sm:text-sm text-on-surface whitespace-nowrap">Oct 20, 2023</td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Aura+Kraft&background=ef4444&color=fff&size=32&rounded=true" alt="Aura Kraft" class="h-8 w-8 rounded-full shrink-0">
                                    <span class="text-xs sm:text-sm font-medium">Aura Kraft</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 hidden sm:table-cell">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm text-on-surface-variant flex-shrink-0" aria-hidden="true">credit_card</span>
                                    <span class="text-xs sm:text-sm">Credit Card</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="px-2.5 py-1 rounded-full bg-error-container/20 text-error text-[10px] sm:text-[11px] font-bold uppercase tracking-wider whitespace-nowrap">Failed</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-right text-xs sm:text-sm font-bold text-error">$920.00</td>
                        </tr>

                        <!-- Row 5: TXN-88223 (Completed) -->
                        <tr class="hover:bg-surface-container-high/60 transition-colors cursor-pointer" tabindex="0" role="row" aria-label="Transaction TXN-88223, Quantum UI, Completed, $7,250.00">
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="text-xs sm:text-sm font-mono text-on-surface-variant hover:text-on-surface transition-colors">#TXN-88223</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-xs sm:text-sm text-on-surface whitespace-nowrap">Oct 19, 2023</td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Quantum+UI&background=475569&color=fff&size=32&rounded=true" alt="Quantum UI" class="h-8 w-8 rounded-full shrink-0">
                                    <span class="text-xs sm:text-sm font-medium">Quantum UI</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 hidden sm:table-cell">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm text-on-surface-variant flex-shrink-0" aria-hidden="true">account_balance</span>
                                    <span class="text-xs sm:text-sm">Wire Transfer</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5">
                                <span class="px-2.5 py-1 rounded-full bg-primary/10 text-primary text-[10px] sm:text-[11px] font-bold uppercase tracking-wider whitespace-nowrap">Completed</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 sm:py-5 text-right text-xs sm:text-sm font-bold">$7,250.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination & Data Navigation Matrix -->
            <div class="px-4 sm:px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 bg-surface-container/50 border-t border-outline-variant/5">
                <p class="text-xs text-on-surface-variant">Showing <span class="text-on-surface font-bold">5</span> of <span class="text-on-surface font-bold">1,240</span> entries</p>
                <div class="flex items-center gap-1.5" role="navigation" aria-label="Pagination">
                    <button type="button" class="p-2 rounded-lg hover:bg-surface-container-highest transition-colors disabled:opacity-20 min-h-[44px] min-w-[44px] inline-flex items-center justify-center" disabled aria-label="Previous page">
                        <span class="material-symbols-outlined text-sm" aria-hidden="true">chevron_left</span>
                    </button>
                    <button type="button" class="w-9 h-9 flex items-center justify-center rounded-lg bg-primary text-on-primary text-xs font-bold min-h-[44px] min-w-[44px]" aria-current="page" aria-label="Page 1">1</button>
                    <button type="button" class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-surface-container-highest text-xs font-medium transition-colors min-h-[44px] min-w-[44px]" aria-label="Page 2">2</button>
                    <button type="button" class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-surface-container-highest text-xs font-medium transition-colors min-h-[44px] min-w-[44px]" aria-label="Page 3">3</button>
                    <span class="mx-1 text-on-surface-variant text-xs" aria-hidden="true">...</span>
                    <button type="button" class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-surface-container-highest text-xs font-medium transition-colors min-h-[44px] min-w-[44px]" aria-label="Page 248">248</button>
                    <button type="button" class="p-2 rounded-lg hover:bg-surface-container-highest transition-colors min-h-[44px] min-w-[44px] inline-flex items-center justify-center" aria-label="Next page">
                        <span class="material-symbols-outlined text-sm" aria-hidden="true">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Cryptographic Integrity Audit & Support -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8" aria-label="Integrity audit and support">
            <!-- Integrity Audit Info -->
            <div class="md:col-span-2 bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8 relative overflow-hidden group">
                <div class="absolute top-4 right-4 opacity-10 group-hover:opacity-20 transition-opacity" aria-hidden="true">
                    <span class="material-symbols-outlined text-6xl sm:text-8xl text-on-surface">verified_user</span>
                </div>
                <h4 class="font-headline font-bold text-lg sm:text-xl text-on-surface mb-3 sm:mb-4">Integrity Audit</h4>
                <p class="text-on-surface-variant text-xs sm:text-sm mb-4 sm:mb-6 max-w-lg leading-relaxed">All transactions are cryptographically signed and immutable once completed. Our automated reconciliation system runs every 6 hours to ensure your ledger matches your connected bank entities.</p>
                <div class="flex flex-wrap items-center gap-4 sm:gap-6">
                    <div class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-primary animate-pulse" aria-hidden="true"></span>
                        <span class="text-xs font-mono uppercase text-on-surface">System Live</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-primary" aria-hidden="true">task_alt</span>
                        <span class="text-xs font-mono uppercase text-on-surface">Verified Today</span>
                    </div>
                </div>
            </div>
            <!-- Support Card -->
            <div class="bg-surface-container-high rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 border border-outline-variant/10 shadow-sm flex flex-col justify-between">
                <div>
                    <span class="material-symbols-outlined text-primary text-2xl sm:text-3xl mb-3 sm:mb-4 block" aria-hidden="true">help_outline</span>
                    <h4 class="font-bold text-base sm:text-lg mb-1 sm:mb-2">Need Assistance?</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">Our dedicated finance desk is available 24/7 for high-value transaction support.</p>
                </div>
                <button type="button" class="w-full mt-4 sm:mt-6 py-2.5 sm:py-3 rounded-xl bg-surface hover:bg-primary hover:text-on-primary active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary text-on-surface text-xs sm:text-sm font-bold transition-all duration-150 min-h-[44px]">
                    Contact Support
                </button>
            </div>
        </section>
    </div>
</main>
@endsection
