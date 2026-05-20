@extends('layouts.app')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/billing-index.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/billing-index.js') }}" defer></script>
@endpush

<main class="flex-1 min-h-screen flex flex-col" role="main">
    <!-- Main Scrollable Canvas -->
    <div class="flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 md:px-8 lg:px-10 py-6 sm:py-8 md:py-10 lg:py-12">

        <!-- Branding & Global Fiscal Actions -->
        <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
            <div class="space-y-1.5 sm:space-y-2">
                <h1
                    class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">
                    Billing &amp; Finance
                </h1>
                <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed">
                    Real-time performance metrics and revenue stream tracking.
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

        <!-- Key Performance Indicators (KPI) Monitor -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8"
            aria-label="Key performance indicators">
            <!-- Total Revenue -->
            <div
                class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary-container rounded-full"
                    aria-hidden="true">
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Total Revenue</p>
                <h3 class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface mt-2">$842,900.00</h3>
                <div class="flex items-center gap-2 mt-4 text-emerald-400 text-xs sm:text-sm">
                    <span class="material-symbols-outlined text-xs" aria-hidden="true">trending_up</span>
                    <span class="whitespace-nowrap">+12.5% vs last month</span>
                </div>
            </div>
            <!-- Monthly Recurring -->
            <div
                class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary-container rounded-full"
                    aria-hidden="true">
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Monthly Recurring
                </p>
                <h3 class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface mt-2">$42,150.00</h3>
                <div class="flex items-center gap-2 mt-4 text-primary text-xs sm:text-sm">
                    <span class="material-symbols-outlined text-xs" aria-hidden="true">sync</span>
                    <span class="whitespace-nowrap">Stable growth trajectory</span>
                </div>
            </div>
            <!-- Outstanding Payments -->
            <div
                class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-error rounded-full" aria-hidden="true"></div>
                <p class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Outstanding
                    Payments</p>
                <h3 class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface mt-2">$12,400.00</h3>
                <div class="flex items-center gap-2 mt-4 text-error text-xs sm:text-sm">
                    <span class="material-symbols-outlined text-xs" aria-hidden="true">warning</span>
                    <span class="whitespace-nowrap">8 invoices overdue</span>
                </div>
            </div>
            <!-- Active Subscriptions -->
            <div
                class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary-container rounded-full"
                    aria-hidden="true">
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Active
                    Subscriptions</p>
                <h3 class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface mt-2">1,204</h3>
                <div class="flex items-center gap-2 mt-4 text-on-surface-variant text-xs sm:text-sm">
                    <span class="material-symbols-outlined text-xs" aria-hidden="true">person</span>
                    <span class="whitespace-nowrap">+48 new this week</span>
                </div>
            </div>
        </section>

        <!-- Revenue Analytics & Performance Trends -->
        <section
            class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8 mb-6 sm:mb-8"
            aria-label="Revenue trends chart">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 sm:gap-0 mb-6 sm:mb-8">
                <div>
                    <h4 class="text-base sm:text-lg font-bold text-on-surface">Revenue Trends</h4>
                    <p class="text-xs sm:text-sm text-on-surface-variant">Annual performance metrics 2024</p>
                </div>
                <div class="flex bg-surface-container p-1 rounded-lg" role="tablist" aria-label="Chart time period">
                    <button type="button" role="tab" aria-selected="true"
                        class="px-3 sm:px-4 py-2 text-xs font-semibold rounded-md bg-surface-container-high text-primary whitespace-nowrap min-h-[44px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary transition-all">Monthly</button>
                    <button type="button" role="tab" aria-selected="false"
                        class="px-3 sm:px-4 py-2 text-xs font-semibold rounded-md text-on-surface-variant hover:text-on-surface whitespace-nowrap min-h-[44px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary transition-all">Quarterly</button>
                </div>
            </div>
            <!-- Bar Chart Visualization -->
            <div class="w-full" role="img" aria-label="Bar chart showing monthly revenue from January to August">
                <svg viewBox="0 0 800 300" class="w-full h-auto" preserveAspectRatio="xMidYMid meet">
                    <!-- Grid Lines -->
                    <line x1="50" y1="40" x2="50" y2="260" stroke="var(--color-outline-variant, #334155)"
                        stroke-width="0.5" opacity="0.3" />
                    <line x1="50" y1="260" x2="770" y2="260" stroke="var(--color-outline-variant, #334155)"
                        stroke-width="0.5" opacity="0.3" />
                    <line x1="50" y1="205" x2="770" y2="205" stroke="var(--color-outline-variant, #334155)"
                        stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="150" x2="770" y2="150" stroke="var(--color-outline-variant, #334155)"
                        stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="95" x2="770" y2="95" stroke="var(--color-outline-variant, #334155)"
                        stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="40" x2="770" y2="40" stroke="var(--color-outline-variant, #334155)"
                        stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />

                    <!-- Y-axis Labels -->
                    <text x="40" y="264" text-anchor="end" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="10">$0</text>
                    <text x="40" y="209" text-anchor="end" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="10">$25k</text>
                    <text x="40" y="154" text-anchor="end" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="10">$50k</text>
                    <text x="40" y="99" text-anchor="end" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="10">$75k</text>
                    <text x="40" y="44" text-anchor="end" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="10">$100k</text>

                    <!-- Bars -->
                    <rect x="80" y="172" width="60" height="88" rx="6"
                        fill="var(--color-surface-container-highest, #475569)" opacity="0.3"
                        class="transition-all duration-300 hover:opacity-60" />
                    <rect x="170" y="139" width="60" height="121" rx="6"
                        fill="var(--color-surface-container-highest, #475569)" opacity="0.3"
                        class="transition-all duration-300 hover:opacity-60" />
                    <rect x="260" y="161" width="60" height="99" rx="6"
                        fill="var(--color-surface-container-highest, #475569)" opacity="0.3"
                        class="transition-all duration-300 hover:opacity-60" />
                    <rect x="350" y="77" width="60" height="183" rx="6" fill="var(--color-primary, #c0c1ff)"
                        opacity="0.4" class="transition-all duration-300 hover:opacity-70" />
                    <rect x="440" y="128" width="60" height="132" rx="6"
                        fill="var(--color-surface-container-highest, #475569)" opacity="0.3"
                        class="transition-all duration-300 hover:opacity-60" />
                    <rect x="530" y="51" width="60" height="209" rx="6"
                        fill="var(--color-surface-container-highest, #475569)" opacity="0.3"
                        class="transition-all duration-300 hover:opacity-60" />
                    <rect x="620" y="95" width="60" height="165" rx="6"
                        fill="var(--color-surface-container-highest, #475569)" opacity="0.3"
                        class="transition-all duration-300 hover:opacity-60" />
                    <rect x="710" y="29" width="60" height="231" rx="6"
                        fill="var(--color-surface-container-highest, #475569)" opacity="0.3"
                        class="transition-all duration-300 hover:opacity-60" />

                    <!-- X-axis Labels -->
                    <text x="110" y="280" text-anchor="middle" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="11" font-weight="600">JAN</text>
                    <text x="200" y="280" text-anchor="middle" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="11" font-weight="600">FEB</text>
                    <text x="290" y="280" text-anchor="middle" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="11" font-weight="600">MAR</text>
                    <text x="380" y="280" text-anchor="middle" fill="var(--color-on-surface, #f8fafc)"
                        font-size="11" font-weight="700">APR</text>
                    <text x="470" y="280" text-anchor="middle" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="11" font-weight="600">MAY</text>
                    <text x="560" y="280" text-anchor="middle" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="11" font-weight="600">JUN</text>
                    <text x="650" y="280" text-anchor="middle" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="11" font-weight="600">JUL</text>
                    <text x="740" y="280" text-anchor="middle" fill="var(--color-on-surface-variant, #94a3b8)"
                        font-size="11" font-weight="600">AUG</text>
                </svg>
            </div>
        </section>

        <!-- Actionable Insight & Support Modules -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">

            <!-- Transaction Control Hub -->
            <div class="lg:col-span-2 space-y-6 sm:space-y-8">
                <!-- Quick Action Buttons -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <button type="button"
                        class="bg-primary hover:bg-primary/90 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-primary p-6 sm:p-8 rounded-2xl sm:rounded-3xl flex flex-col justify-between items-start gap-4 transition-all duration-300 shadow-sm w-full min-h-[160px]"
                        aria-label="Create new invoice">
                        <span class="material-symbols-outlined text-3xl sm:text-4xl"
                            aria-hidden="true">add_circle</span>
                        <div class="text-left">
                            <h4 class="text-lg sm:text-xl font-bold text-on-primary">Create Invoice</h4>
                            <p class="text-on-primary/70 text-xs sm:text-sm">Generate and send billing documents</p>
                        </div>
                    </button>
                    <button type="button"
                        class="bg-surface-container-highest hover:bg-surface-container-high active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface rounded-2xl sm:rounded-3xl p-6 sm:p-8 flex flex-col justify-between items-start gap-4 transition-all duration-300 border border-outline-variant/10 shadow-sm w-full min-h-[160px]"
                        aria-label="View transactions">
                        <span class="material-symbols-outlined text-3xl sm:text-4xl text-primary"
                            aria-hidden="true">receipt_long</span>
                        <div class="text-left">
                            <h4 class="text-lg sm:text-xl font-bold text-on-surface">View Transactions</h4>
                            <p class="text-on-surface-variant text-xs sm:text-sm">Audit logs and payment history</p>
                        </div>
                    </button>
                </div>

                <!-- Recent Activity Feed -->
                <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8"
                    aria-label="Recent billing activity">
                    <div class="flex justify-between items-center mb-4 sm:mb-6">
                        <h4 class="text-base sm:text-lg font-bold text-on-surface">Recent Activity</h4>
                        <a class="text-primary text-xs sm:text-sm font-semibold hover:underline focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded min-h-[44px] inline-flex items-center whitespace-nowrap"
                            href="#" aria-label="View all activity">View All</a>
                    </div>
                    <div class="space-y-3 sm:space-y-4">
                        <!-- Activity Item 1 -->
                        <div
                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-3 sm:p-4 rounded-xl bg-surface-container/50 border border-outline-variant/5 hover:border-outline-variant/20 transition-all">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary text-xl"
                                        aria-hidden="true">check_circle</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs sm:text-sm font-semibold text-on-surface truncate">Payment
                                        received from Quantum Dynamics</p>
                                    <p class="text-xs text-on-surface-variant whitespace-nowrap">Invoice #XN-9023 •
                                        2 hours ago</p>
                                </div>
                            </div>
                            <span
                                class="text-xs sm:text-sm font-bold text-emerald-400 whitespace-nowrap text-center sm:text-left">+$12,500.00</span>
                        </div>
                        <!-- Activity Item 2 -->
                        <div
                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-3 sm:p-4 rounded-xl bg-surface-container/50 border border-outline-variant/5 hover:border-outline-variant/20 transition-all">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-secondary-container/30 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-secondary text-xl"
                                        aria-hidden="true">mail</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs sm:text-sm font-semibold text-on-surface truncate">Invoice
                                        sent to Nebula Studios</p>
                                    <p class="text-xs text-on-surface-variant whitespace-nowrap">Invoice #XN-9024 •
                                        5 hours ago</p>
                                </div>
                            </div>
                            <span
                                class="text-xs sm:text-sm font-bold text-on-surface-variant whitespace-nowrap text-center sm:text-left">$4,200.00</span>
                        </div>
                        <!-- Activity Item 3 -->
                        <div
                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-3 sm:p-4 rounded-xl bg-surface-container/50 border border-outline-variant/5 hover:border-outline-variant/20 transition-all">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-error-container/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-error text-xl"
                                        aria-hidden="true">error</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs sm:text-sm font-semibold text-on-surface truncate">Payment
                                        failed: Atlas Logistics</p>
                                    <p class="text-xs text-on-surface-variant whitespace-nowrap">Retry attempt
                                        scheduled • 1 day ago</p>
                                </div>
                            </div>
                            <span
                                class="text-xs sm:text-sm font-bold text-error whitespace-nowrap text-center sm:text-left">-$2,850.00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Ecosystem Analytic Distribution -->
            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8 flex flex-col"
                aria-label="Payment distribution">
                <h4 class="text-base sm:text-lg font-bold text-on-surface mb-4 sm:mb-6">Payment Distribution</h4>
                <!-- Donut Chart -->
                <div class="flex-grow flex items-center justify-center py-4">
                    <div class="relative w-full max-w-[200px] aspect-square">
                        <svg viewBox="0 0 120 120" class="w-full h-full" preserveAspectRatio="xMidYMid meet"
                            role="img" aria-label="Donut chart showing payment method distribution">
                            <!-- Background circle -->
                            <circle cx="60" cy="60" r="45" fill="none"
                                stroke="var(--color-surface-container-highest, #475569)" stroke-width="16" />
                            <!-- Credit Card 72% -->
                            <circle cx="60" cy="60" r="45" fill="none" stroke="var(--color-primary, #c0c1ff)"
                                stroke-width="16" stroke-dasharray="203.6 282.7" stroke-dashoffset="0"
                                transform="rotate(-90 60 60)" class="transition-all duration-700" />
                            <!-- Bank Transfer 18% -->
                            <circle cx="60" cy="60" r="45" fill="none" stroke="var(--color-secondary, #a8b4ff)"
                                stroke-width="16" stroke-dasharray="50.9 282.7" stroke-dashoffset="-203.6"
                                transform="rotate(-90 60 60)" class="transition-all duration-700" />
                            <!-- Crypto 6% -->
                            <circle cx="60" cy="60" r="45" fill="none" stroke="var(--color-tertiary, #ffb787)"
                                stroke-width="16" stroke-dasharray="17.0 282.7" stroke-dashoffset="-254.4"
                                transform="rotate(-90 60 60)" class="transition-all duration-700" />
                            <!-- Center text -->
                            <text x="60" y="55" text-anchor="middle" fill="var(--color-on-surface, #f8fafc)"
                                font-size="18" font-weight="700">72%</text>
                            <text x="60" y="72" text-anchor="middle" fill="var(--color-on-surface-variant, #94a3b8)"
                                font-size="8" font-weight="600" letter-spacing="1">DIGITAL</text>
                        </svg>
                    </div>
                </div>
                <!-- Legend -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mt-4 sm:mt-6">
                    <div class="flex items-center gap-2 min-h-[44px]">
                        <div class="w-3 h-3 rounded-full bg-primary shrink-0" aria-hidden="true"></div>
                        <span class="text-xs text-on-surface-variant truncate">Credit Card (72%)</span>
                    </div>
                    <div class="flex items-center gap-2 min-h-[44px]">
                        <div class="w-3 h-3 rounded-full bg-secondary opacity-50 shrink-0" aria-hidden="true"></div>
                        <span class="text-xs text-on-surface-variant truncate">Bank Transfer (18%)</span>
                    </div>
                    <div class="flex items-center gap-2 min-h-[44px]">
                        <div class="w-3 h-3 rounded-full bg-tertiary shrink-0" aria-hidden="true"></div>
                        <span class="text-xs text-on-surface-variant truncate">Crypto (6%)</span>
                    </div>
                    <div class="flex items-center gap-2 min-h-[44px]">
                        <div class="w-3 h-3 rounded-full bg-outline-variant shrink-0" aria-hidden="true"></div>
                        <span class="text-xs text-on-surface-variant truncate">Other (4%)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
