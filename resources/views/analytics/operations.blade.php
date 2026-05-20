@extends('layouts.app')

@section('title', 'Analytics - Operations | Admin Panel')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/analytics-operations.css') }}">
@endpush

@section('content')
<div class="max-w-[1600px] mx-auto">
    <!-- Header -->
    <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
        <div class="space-y-1.5 sm:space-y-2">
            <span class="text-[10px] font-bold tracking-widest text-primary uppercase block">System Overview</span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">
                Operations <span class="text-primary font-semibold">Pulse</span>
            </h1>
        </div>
        <div class="flex flex-wrap gap-2 sm:gap-3 w-full sm:w-auto">
            <button type="button" class="bg-surface-container-high hover:bg-surface-container-highest active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-surface px-5 sm:px-6 py-2.5 sm:py-3 rounded-full text-xs sm:text-sm font-semibold transition-all w-full sm:w-auto min-h-[44px]">
                Export Logs
            </button>
            <button type="button" class="bg-primary hover:bg-primary/90 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-primary px-5 sm:px-6 py-2.5 sm:py-3 rounded-full text-xs sm:text-sm font-bold shadow-lg shadow-primary/20 transition-all w-full sm:w-auto min-h-[44px]">
                New Workflow
            </button>
        </div>
    </header>

    <!-- Operations KPIs -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8" aria-label="Operations key performance indicators">
        <!-- Total Revenue -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 relative overflow-hidden shadow-sm group">
            <div class="absolute top-0 left-0 w-1 h-full bg-primary-container" aria-hidden="true"></div>
            <div class="flex justify-between items-start mb-4 sm:mb-6">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase">Total Revenue</span>
                <span class="material-symbols-outlined text-primary" aria-hidden="true">payments</span>
            </div>
            <div class="space-y-1">
                <p class="text-2xl sm:text-3xl md:text-4xl font-headline font-light text-on-surface">$1,248,500</p>
                <div class="flex items-center gap-2 text-tertiary text-xs font-bold">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">trending_up</span>
                    <span>+12.4% vs last month</span>
                </div>
            </div>
        </div>
        <!-- Active Automated Metrics -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 relative overflow-hidden shadow-sm group">
            <div class="absolute top-0 left-0 w-1 h-full bg-primary-container" aria-hidden="true"></div>
            <div class="flex justify-between items-start mb-4 sm:mb-6">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase">Active Automated Metrics</span>
                <span class="material-symbols-outlined text-primary" aria-hidden="true">bolt</span>
            </div>
            <div class="space-y-1">
                <p class="text-2xl sm:text-3xl md:text-4xl font-headline font-light text-on-surface">42 <span class="text-base sm:text-xl text-on-surface-variant">Active</span></p>
                <div class="flex items-center gap-2 text-primary text-xs font-bold">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">check_circle</span>
                    <span>92% execution rate</span>
                </div>
            </div>
        </div>
        <!-- System Health -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 relative overflow-hidden shadow-sm group sm:col-span-2 lg:col-span-1">
            <div class="absolute top-0 left-0 w-1 h-full bg-primary-container" aria-hidden="true"></div>
            <div class="flex justify-between items-start mb-4 sm:mb-6">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase">System Health %</span>
                <span class="material-symbols-outlined text-primary" aria-hidden="true">lan</span>
            </div>
            <div class="space-y-1">
                <p class="text-2xl sm:text-3xl md:text-4xl font-headline font-light text-on-surface">99.98%</p>
                <div class="flex items-center gap-2 text-tertiary text-xs font-bold">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">electric_bolt</span>
                    <span>Ultra-low latency</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Automation Success & System Load -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 md:gap-8 mb-6 sm:mb-8">
        <!-- Automation Success -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8" aria-label="Automation success rate chart">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 sm:mb-8">
                <div>
                    <h3 class="font-headline text-lg sm:text-xl font-semibold text-on-surface">Automation Success</h3>
                    <p class="text-xs text-on-surface-variant">Success rates by weekday</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div class="w-3 h-3 rounded-full bg-primary" aria-hidden="true"></div>
                    <span class="text-[10px] font-bold uppercase text-on-surface-variant">Success %</span>
                </div>
            </div>
            <div class="w-full" role="img" aria-label="Bar chart showing automation success rates Monday through Sunday">
                <svg viewBox="0 0 700 240" class="w-full h-auto" preserveAspectRatio="xMidYMid meet">
                    <line x1="50" y1="20" x2="50" y2="200" stroke="#334155" stroke-width="0.5" opacity="0.3" />
                    <line x1="50" y1="200" x2="680" y2="200" stroke="#334155" stroke-width="0.5" opacity="0.3" />
                    <line x1="50" y1="155" x2="680" y2="155" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="110" x2="680" y2="110" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="65" x2="680" y2="65" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="20" x2="680" y2="20" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <text x="40" y="204" text-anchor="end" fill="#94a3b8" font-size="9">80%</text>
                    <text x="40" y="159" text-anchor="end" fill="#94a3b8" font-size="9">85%</text>
                    <text x="40" y="114" text-anchor="end" fill="#94a3b8" font-size="9">90%</text>
                    <text x="40" y="69" text-anchor="end" fill="#94a3b8" font-size="9">95%</text>
                    <text x="40" y="24" text-anchor="end" fill="#94a3b8" font-size="9">100%</text>
                    <rect x="80" y="38" width="60" height="162" rx="8" fill="#818cf8" opacity="0.7" />
                    <rect x="170" y="20" width="60" height="180" rx="8" fill="#818cf8" opacity="0.8" />
                    <rect x="260" y="47" width="60" height="153" rx="8" fill="#818cf8" opacity="0.7" />
                    <rect x="350" y="29" width="60" height="171" rx="8" fill="#818cf8" opacity="0.9" />
                    <rect x="440" y="56" width="60" height="144" rx="8" fill="#818cf8" opacity="0.7" />
                    <rect x="530" y="74" width="60" height="126" rx="8" fill="#818cf8" opacity="0.6" />
                    <rect x="620" y="92" width="60" height="108" rx="8" fill="#818cf8" opacity="0.5" />
                    <text x="110" y="220" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">MON</text>
                    <text x="200" y="220" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">TUE</text>
                    <text x="290" y="220" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">WED</text>
                    <text x="380" y="220" text-anchor="middle" fill="#818cf8" font-size="11" font-weight="700">THU</text>
                    <text x="470" y="220" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">FRI</text>
                    <text x="560" y="220" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">SAT</text>
                    <text x="650" y="220" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">SUN</text>
                </svg>
            </div>
        </div>

        <!-- System Load -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8 relative overflow-hidden" aria-label="System load chart">
            <div class="flex justify-between items-center mb-4 sm:mb-6 relative z-10">
                <div>
                    <h3 class="font-headline text-lg sm:text-xl font-semibold text-on-surface">System Load</h3>
                    <p class="text-xs text-on-surface-variant">Real-time resource utilization</p>
                </div>
                <div class="bg-surface-container-highest text-primary text-[10px] font-bold py-1 px-3 rounded-full border border-primary/20">
                    LIVE
                </div>
            </div>
            <div class="w-full mt-4 sm:mt-6" role="img" aria-label="Line chart showing system load over time">
                <svg viewBox="0 0 400 120" class="w-full h-auto" preserveAspectRatio="xMidYMid meet">
                    <defs>
                        <linearGradient id="sysLoadGrad" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#a8b4ff" stop-opacity="0.3" />
                            <stop offset="100%" stop-color="#a8b4ff" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <line x1="0" y1="30" x2="400" y2="30" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="0" y1="60" x2="400" y2="60" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="0" y1="90" x2="400" y2="90" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <path d="M0,80 Q50,20 100,50 T200,30 T300,70 T400,10 V120 H0 Z" fill="url(#sysLoadGrad)" />
                    <path d="M0,80 Q50,20 100,50 T200,30 T300,70 T400,10" fill="none" stroke="#a8b4ff" stroke-linecap="round" stroke-width="2" />
                    <text x="0" y="115" fill="#94a3b8" font-size="8" font-weight="600">12:00</text>
                    <text x="100" y="115" text-anchor="middle" fill="#94a3b8" font-size="8" font-weight="600">13:00</text>
                    <text x="200" y="115" text-anchor="middle" fill="#94a3b8" font-size="8" font-weight="600">14:00</text>
                    <text x="300" y="115" text-anchor="middle" fill="#94a3b8" font-size="8" font-weight="600">15:00</text>
                    <text x="400" y="115" text-anchor="end" fill="#94a3b8" font-size="8" font-weight="600">16:00</text>
                </svg>
            </div>
        </div>
    </section>

    <!-- Recent Failures & Activity Flow -->
    <section class="grid grid-cols-1 xl:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
        <!-- Recent System Failures -->
        <div class="xl:col-span-2 bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8" aria-label="Recent system failures">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 sm:mb-8">
                <h3 class="font-headline text-lg sm:text-xl font-semibold text-on-surface flex items-center gap-2 sm:gap-3">
                    Recent Failures
                    <span class="bg-error-container text-on-error-container text-[10px] px-2 py-0.5 rounded-full font-bold shrink-0">3 UNRESOLVED</span>
                </h3>
                <a class="text-primary text-xs font-bold flex items-center gap-1.5 group min-h-[44px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded transition-all" href="#" aria-label="View incident logs">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full group-hover:w-3 transition-all" aria-hidden="true"></span>
                    View Incident Logs
                </a>
            </div>
            <div class="space-y-3 sm:space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-3 sm:p-4 bg-surface-container rounded-xl hover:bg-surface-container-high transition-all min-h-[44px]">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-10 h-10 rounded-lg bg-error-container/20 flex items-center justify-center text-error shrink-0">
                            <span class="material-symbols-outlined text-xl" aria-hidden="true">error</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs sm:text-sm font-semibold text-on-surface">API Timeout: Payment Gateway</p>
                            <p class="text-[10px] text-on-surface-variant">System: checkout-api-v2 &bull; 2 mins ago</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold px-3 py-1.5 rounded-full border border-error/30 text-error bg-error/5 uppercase whitespace-nowrap self-start sm:self-auto">Critical</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-3 sm:p-4 bg-surface-container rounded-xl hover:bg-surface-container-high transition-all min-h-[44px]">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-10 h-10 rounded-lg bg-tertiary-container/20 flex items-center justify-center text-tertiary shrink-0">
                            <span class="material-symbols-outlined text-xl" aria-hidden="true">warning</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs sm:text-sm font-semibold text-on-surface">DB Connection Refused: Warehouse-2</p>
                            <p class="text-[10px] text-on-surface-variant">System: db-cluster-west &bull; 15 mins ago</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold px-3 py-1.5 rounded-full border border-tertiary/30 text-tertiary bg-tertiary/5 uppercase whitespace-nowrap self-start sm:self-auto">Warning</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-3 sm:p-4 bg-surface-container rounded-xl hover:bg-surface-container-high transition-all min-h-[44px]">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-10 h-10 rounded-lg bg-primary-container/20 flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined text-xl" aria-hidden="true">info</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs sm:text-sm font-semibold text-on-surface">Workflow Error: User-Sync</p>
                            <p class="text-[10px] text-on-surface-variant">System: auth-node-primary &bull; 1 hour ago</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold px-3 py-1.5 rounded-full border border-primary/30 text-primary bg-primary/5 uppercase whitespace-nowrap self-start sm:self-auto">Info</span>
                </div>
            </div>
        </div>

        <!-- Activity Flow Timeline -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8" aria-label="Activity flow timeline">
            <h3 class="font-headline text-lg sm:text-xl font-semibold text-on-surface mb-6 sm:mb-8">Activity Flow</h3>
            <div class="relative space-y-5 sm:space-y-6 before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-[2px] before:bg-white/10">
                <div class="relative pl-7 sm:pl-8">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-primary flex items-center justify-center shadow-sm shrink-0">
                        <span class="material-symbols-outlined text-sm text-on-primary" aria-hidden="true">rocket_launch</span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-semibold text-on-surface">Auto-scaling event triggered</p>
                        <p class="text-[10px] text-on-surface-variant">Capacity increased to 12 nodes &bull; 4:20 PM</p>
                    </div>
                </div>
                <div class="relative pl-7 sm:pl-8">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-surface-container-highest flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-sm text-primary" aria-hidden="true">sync</span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-semibold text-on-surface">User sync completed</p>
                        <p class="text-[10px] text-on-surface-variant">1,402 records updated &bull; 3:45 PM</p>
                    </div>
                </div>
                <div class="relative pl-7 sm:pl-8">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-surface-container-highest flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-sm text-primary" aria-hidden="true">cloud_done</span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-semibold text-on-surface">Backup successful</p>
                        <p class="text-[10px] text-on-surface-variant">Global region snapshot R-492 &bull; 2:30 PM</p>
                    </div>
                </div>
                <div class="relative pl-7 sm:pl-8 opacity-60">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-surface-container-highest flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-sm text-primary" aria-hidden="true">person_add</span>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm font-semibold text-on-surface">New team member joined</p>
                        <p class="text-[10px] text-on-surface-variant">Sarah Miller (DevOps) &bull; 1:15 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endpush
