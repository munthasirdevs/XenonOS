@extends('layouts.app')

@section('title', 'Analytics - Executive | Admin Panel')

@push('styles')
<style>
    .font-headline { font-family: 'Syne', sans-serif; }
    .font-label { font-family: 'Outfit', sans-serif; }
</style>
@endpush

@section('content')
<div class="max-w-[1600px] mx-auto">
    <!-- Header -->
    <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
        <div class="space-y-1.5 sm:space-y-2">
            <span class="text-[10px] font-bold tracking-[0.2em] text-primary uppercase block">Performance Report</span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">
                Market Velocity
            </h1>
        </div>
        <div class="flex flex-wrap gap-2 sm:gap-4 w-full sm:w-auto">
            <button type="button" class="bg-surface-container-high hover:bg-surface-container-highest active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-surface px-5 sm:px-6 py-2.5 sm:py-3 rounded-full text-xs font-bold uppercase tracking-widest transition-all w-full sm:w-auto min-h-[44px]">
                Export PDF
            </button>
            <button type="button" class="bg-primary hover:bg-primary/90 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-primary px-5 sm:px-6 py-2.5 sm:py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-primary/20 transition-all w-full sm:w-auto min-h-[44px]">
                New Initiative
            </button>
        </div>
    </header>

    <!-- KPI Registry -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8" aria-label="Key performance indicators">
        <!-- Total Revenue -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 border-l-2 border-primary-container relative overflow-hidden shadow-sm group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 blur-3xl group-hover:bg-primary/10 transition-all duration-500" aria-hidden="true"></div>
            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-3 sm:mb-4">Total Revenue</p>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">$4.82M</span>
                <span class="text-xs text-primary font-bold">+12.4%</span>
            </div>
        </div>
        <!-- Growth Rate -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 border-l-2 border-primary-container relative overflow-hidden shadow-sm group">
            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-3 sm:mb-4">Growth Rate</p>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">24.8%</span>
                <span class="text-xs text-tertiary font-bold">+2.1%</span>
            </div>
        </div>
        <!-- Active Users -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 border-l-2 border-primary-container relative overflow-hidden shadow-sm group">
            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-3 sm:mb-4">Active Users</p>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">84.2k</span>
                <span class="text-xs text-primary font-bold">+5.7%</span>
            </div>
        </div>
        <!-- Net Profit -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 border-l-2 border-primary-container relative overflow-hidden shadow-sm group">
            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-3 sm:mb-4">Net Profit</p>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">$1.24M</span>
                <span class="text-xs text-primary font-bold">+8.3%</span>
            </div>
        </div>
    </section>

    <!-- Financial Trend & Strategic Insights -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8 mb-6 sm:mb-8">
        <!-- Financial Trend Chart -->
        <div class="lg:col-span-2 bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8" aria-label="Financial trend chart">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 sm:mb-8">
                <h3 class="font-headline text-lg sm:text-xl font-semibold text-on-surface">Financial Trend</h3>
                <div class="flex gap-2 items-center">
                    <span class="w-3 h-3 rounded-full bg-primary inline-block" aria-hidden="true"></span>
                    <span class="w-3 h-3 rounded-full bg-surface-container-highest inline-block" aria-hidden="true"></span>
                    <span class="text-xs text-on-surface-variant">Revenue vs Expenses</span>
                </div>
            </div>
            <div class="w-full" role="img" aria-label="Bar chart showing financial trend from January to July">
                <svg viewBox="0 0 700 280" class="w-full h-auto" preserveAspectRatio="xMidYMid meet">
                    <line x1="50" y1="30" x2="50" y2="240" stroke="#334155" stroke-width="0.5" opacity="0.3" />
                    <line x1="50" y1="240" x2="680" y2="240" stroke="#334155" stroke-width="0.5" opacity="0.3" />
                    <line x1="50" y1="188" x2="680" y2="188" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="135" x2="680" y2="135" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="83" x2="680" y2="83" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="30" x2="680" y2="30" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <text x="40" y="244" text-anchor="end" fill="#94a3b8" font-size="9">$0</text>
                    <text x="40" y="192" text-anchor="end" fill="#94a3b8" font-size="9">$1M</text>
                    <text x="40" y="139" text-anchor="end" fill="#94a3b8" font-size="9">$2M</text>
                    <text x="40" y="87" text-anchor="end" fill="#94a3b8" font-size="9">$3M</text>
                    <text x="40" y="34" text-anchor="end" fill="#94a3b8" font-size="9">$4M</text>
                    <rect x="70" y="156" width="40" height="84" rx="4" fill="#475569" opacity="0.5" />
                    <rect x="160" y="124" width="40" height="116" rx="4" fill="#475569" opacity="0.5" />
                    <rect x="250" y="77" width="40" height="163" rx="4" fill="#818cf8" opacity="0.6" />
                    <rect x="340" y="103" width="40" height="137" rx="4" fill="#475569" opacity="0.5" />
                    <rect x="430" y="56" width="40" height="184" rx="4" fill="#475569" opacity="0.5" />
                    <rect x="520" y="30" width="40" height="210" rx="4" fill="#818cf8" opacity="0.7" />
                    <rect x="610" y="88" width="40" height="152" rx="4" fill="#475569" opacity="0.5" />
                    <text x="90" y="260" text-anchor="middle" fill="#94a3b8" font-size="10" font-weight="600">JAN</text>
                    <text x="180" y="260" text-anchor="middle" fill="#94a3b8" font-size="10" font-weight="600">FEB</text>
                    <text x="270" y="260" text-anchor="middle" fill="#dfe2f1" font-size="10" font-weight="700">MAR</text>
                    <text x="360" y="260" text-anchor="middle" fill="#94a3b8" font-size="10" font-weight="600">APR</text>
                    <text x="450" y="260" text-anchor="middle" fill="#94a3b8" font-size="10" font-weight="600">MAY</text>
                    <text x="540" y="260" text-anchor="middle" fill="#dfe2f1" font-size="10" font-weight="700">JUN</text>
                    <text x="630" y="260" text-anchor="middle" fill="#94a3b8" font-size="10" font-weight="600">JUL</text>
                </svg>
            </div>
        </div>

        <!-- Strategic Insights -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8" aria-label="Strategic insights">
            <h3 class="font-headline text-lg sm:text-xl font-semibold text-on-surface mb-4 sm:mb-6">Strategic Insights</h3>
            <div class="space-y-4 sm:space-y-6">
                <div class="flex gap-3 sm:gap-4 items-start">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary text-sm" aria-hidden="true">trending_up</span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-medium text-on-surface">Revenue Peak Detected</p>
                        <p class="text-[10px] sm:text-xs text-on-surface-variant mt-1">Global sales exceeded Q3 targets by 14.2% in the last 48 hours.</p>
                    </div>
                </div>
                <div class="flex gap-3 sm:gap-4 items-start">
                    <div class="w-8 h-8 rounded-full bg-tertiary/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-tertiary text-sm" aria-hidden="true">warning</span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-medium text-on-surface">Operational Lag</p>
                        <p class="text-[10px] sm:text-xs text-on-surface-variant mt-1">Infrastructure costs in Asia-Pacific region rose by 4% due to energy surge.</p>
                    </div>
                </div>
                <div class="flex gap-3 sm:gap-4 items-start">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary text-sm" aria-hidden="true">bolt</span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-medium text-on-surface">New Opportunity</p>
                        <p class="text-[10px] sm:text-xs text-on-surface-variant mt-1">User retention in Enterprise tier shows 98% correlation with new AI tools.</p>
                    </div>
                </div>
            </div>
            <button type="button" class="mt-6 sm:mt-8 p-3 border border-white/20 rounded-xl text-[10px] font-bold uppercase tracking-widest text-primary hover:bg-surface-container active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary transition-all min-h-[44px]">
                View All Alerts
            </button>
        </div>
    </section>

    <!-- Allocation Analysis & Recent Activity -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 md:gap-8" aria-label="Allocation analysis and recent activity">
        <!-- Allocation Analysis -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 sm:mb-8">
                <h3 class="font-headline text-lg sm:text-xl font-semibold text-on-surface">Allocation Analysis</h3>
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-primary" aria-hidden="true"></div>
                        <span class="text-[10px] font-bold uppercase text-on-surface-variant">Revenue</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-tertiary" aria-hidden="true"></div>
                        <span class="text-[10px] font-bold uppercase text-on-surface-variant">Expenses</span>
                    </div>
                </div>
            </div>
            <div class="space-y-4 sm:space-y-6">
                <div>
                    <div class="flex justify-between text-xs text-on-surface-variant mb-2">
                        <span>Cloud Infrastructure</span>
                        <span class="text-on-surface font-semibold">$240k / $180k</span>
                    </div>
                    <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden flex">
                        <div class="h-full bg-primary w-[70%] rounded-l-full transition-all duration-700" aria-hidden="true"></div>
                        <div class="h-full bg-tertiary w-[15%] transition-all duration-700" aria-hidden="true"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs text-on-surface-variant mb-2">
                        <span>Talent Acquisition</span>
                        <span class="text-on-surface font-semibold">$510k / $420k</span>
                    </div>
                    <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden flex">
                        <div class="h-full bg-primary w-[60%] rounded-l-full transition-all duration-700" aria-hidden="true"></div>
                        <div class="h-full bg-tertiary w-[25%] transition-all duration-700" aria-hidden="true"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs text-on-surface-variant mb-2">
                        <span>R&amp;D Initiatives</span>
                        <span class="text-on-surface font-semibold">$890k / $210k</span>
                    </div>
                    <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden flex">
                        <div class="h-full bg-primary w-[80%] rounded-l-full transition-all duration-700" aria-hidden="true"></div>
                        <div class="h-full bg-tertiary w-[10%] transition-all duration-700" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8">
            <div class="flex justify-between items-center mb-4 sm:mb-6">
                <h3 class="font-headline text-lg sm:text-xl font-semibold text-on-surface">Recent Activity</h3>
                <a class="text-[10px] font-bold text-primary uppercase tracking-widest hover:underline focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded inline-flex items-center gap-1.5 min-h-[44px]" href="#" aria-label="View all activity">
                    <span class="w-1 h-1 rounded-full bg-primary inline-block" aria-hidden="true"></span>
                    View All
                </a>
            </div>
            <div class="space-y-2 sm:space-y-3 max-h-[220px] overflow-y-auto pr-2">
                <div class="flex items-center justify-between p-3 sm:p-4 rounded-xl hover:bg-surface-container-high transition-all cursor-pointer min-h-[44px]">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-surface-container-highest flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-surface-variant text-sm" aria-hidden="true">account_balance</span>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-on-surface">Stripe Payout: Q2 Retail</p>
                            <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Today, 10:42 AM</p>
                        </div>
                    </div>
                    <span class="text-xs sm:text-sm font-bold text-primary shrink-0">+$124,500.00</span>
                </div>
                <div class="flex items-center justify-between p-3 sm:p-4 rounded-xl hover:bg-surface-container-high transition-all cursor-pointer min-h-[44px]">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-surface-container-highest flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-surface-variant text-sm" aria-hidden="true">shopping_cart</span>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-on-surface">Nvidia GPU Cluster Lease</p>
                            <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Yesterday</p>
                        </div>
                    </div>
                    <span class="text-xs sm:text-sm font-bold text-tertiary shrink-0">-$42,200.00</span>
                </div>
                <div class="flex items-center justify-between p-3 sm:p-4 rounded-xl hover:bg-surface-container-high transition-all cursor-pointer min-h-[44px]">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-surface-container-highest flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-surface-variant text-sm" aria-hidden="true">person</span>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-on-surface">New Enterprise Client: Atlas Corp</p>
                            <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">June 12, 2024</p>
                        </div>
                    </div>
                    <span class="text-xs sm:text-sm font-bold text-primary shrink-0">+$88,000.00</span>
                </div>
            </div>
        </div>
    </section>
</div>
@endpush
