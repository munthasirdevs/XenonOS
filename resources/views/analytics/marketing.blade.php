@extends('layouts.app')

@section('title', 'Analytics - Marketing | Admin Panel')

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
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">
                Performance <span class="text-primary font-semibold">Pulse</span>
            </h1>
            <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed">
                Real-time data synchronization with your active marketing funnels.
            </p>
        </div>
        <div class="flex flex-wrap gap-2 sm:gap-3 w-full sm:w-auto">
            <div class="bg-surface-container-low px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl flex items-center gap-2 border border-white/10 min-h-[44px]">
                <span class="material-symbols-outlined text-primary text-sm flex-shrink-0" aria-hidden="true">calendar_today</span>
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Last 30 Days</span>
            </div>
            <button type="button" class="bg-primary hover:bg-primary/90 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-primary px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl text-xs sm:text-sm font-bold transition-all w-full sm:w-auto min-h-[44px]">
                Export PDF
            </button>
        </div>
    </header>

    <!-- Marketing KPIs -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8" aria-label="Marketing key performance indicators">
        <!-- Total Traffic -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm group">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary-container" aria-hidden="true"></div>
            <div class="flex justify-between items-start mb-3 sm:mb-4">
                <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-[0.1em]">Total Traffic</span>
                <span class="text-xs font-bold text-emerald-400 flex items-center gap-1 shrink-0">+12.4% <span class="material-symbols-outlined text-xs" aria-hidden="true">trending_up</span></span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-headline font-bold text-on-surface tracking-tight">842,910</h3>
            <p class="text-xs text-on-surface-variant mt-1">Unique visitors this month</p>
            <div class="mt-4 sm:mt-6 h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                <div class="h-full w-3/4 bg-primary rounded-full shadow-sm transition-all duration-700" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-hidden="true"></div>
            </div>
        </div>
        <!-- New Sign-ups -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm group">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-tertiary" aria-hidden="true"></div>
            <div class="flex justify-between items-start mb-3 sm:mb-4">
                <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-[0.1em]">New Sign-ups</span>
                <span class="text-xs font-bold text-emerald-400 flex items-center gap-1 shrink-0">+8.1% <span class="material-symbols-outlined text-xs" aria-hidden="true">trending_up</span></span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-headline font-bold text-on-surface tracking-tight">12,402</h3>
            <p class="text-xs text-on-surface-variant mt-1">Conversion from landing page</p>
            <div class="mt-4 sm:mt-6 h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                <div class="h-full w-1/2 bg-tertiary rounded-full shadow-sm transition-all duration-700" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" aria-hidden="true"></div>
            </div>
        </div>
        <!-- Avg. CTR -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm group">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary-container" aria-hidden="true"></div>
            <div class="flex justify-between items-start mb-3 sm:mb-4">
                <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-[0.1em]">Avg. CTR</span>
                <span class="text-xs font-bold text-rose-400 flex items-center gap-1 shrink-0">-1.2% <span class="material-symbols-outlined text-xs" aria-hidden="true">trending_down</span></span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-headline font-bold text-on-surface tracking-tight">4.82%</h3>
            <p class="text-xs text-on-surface-variant mt-1">Global ad engagement</p>
            <div class="mt-4 sm:mt-6 h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                <div class="h-full w-2/5 bg-primary rounded-full shadow-sm transition-all duration-700" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" aria-hidden="true"></div>
            </div>
        </div>
        <!-- Conversion Rate -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm group">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-tertiary" aria-hidden="true"></div>
            <div class="flex justify-between items-start mb-3 sm:mb-4">
                <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-[0.1em]">Conversion Rate</span>
                <span class="text-xs font-bold text-emerald-400 flex items-center gap-1 shrink-0">+4.9% <span class="material-symbols-outlined text-xs" aria-hidden="true">trending_up</span></span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-headline font-bold text-on-surface tracking-tight">18.5%</h3>
            <p class="text-xs text-on-surface-variant mt-1">Lead to customer flow</p>
            <div class="mt-4 sm:mt-6 h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                <div class="h-full w-2/3 bg-tertiary rounded-full shadow-sm transition-all duration-700" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" aria-hidden="true"></div>
            </div>
        </div>
    </section>

    <!-- Website Traffic & Campaigns -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8 mb-6 sm:mb-8">
        <!-- Website Traffic Chart -->
        <div class="lg:col-span-2 bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8 relative overflow-hidden" aria-label="Website traffic chart">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 sm:mb-8">
                <div>
                    <h4 class="text-lg sm:text-xl font-headline font-semibold text-on-surface">Website Traffic</h4>
                    <p class="text-xs sm:text-sm text-on-surface-variant">Global sessions vs. Page views</p>
                </div>
                <div class="flex gap-2" role="tablist" aria-label="Chart time period">
                    <button type="button" role="tab" aria-selected="true" class="px-3 py-2 text-[10px] font-bold uppercase rounded-md bg-surface-container-high text-primary border border-primary/20 min-h-[44px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary transition-all">Daily</button>
                    <button type="button" role="tab" aria-selected="false" class="px-3 py-2 text-[10px] font-bold uppercase rounded-md text-on-surface-variant hover:text-on-surface min-h-[44px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary transition-all">Weekly</button>
                </div>
            </div>
            <div class="w-full" role="img" aria-label="Bar chart showing website traffic from Monday to Sunday">
                <svg viewBox="0 0 700 320" class="w-full h-auto" preserveAspectRatio="xMidYMid meet">
                    <line x1="50" y1="20" x2="50" y2="280" stroke="#334155" stroke-width="0.5" opacity="0.3" />
                    <line x1="50" y1="280" x2="680" y2="280" stroke="#334155" stroke-width="0.5" opacity="0.3" />
                    <line x1="50" y1="215" x2="680" y2="215" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="150" x2="680" y2="150" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="50" y1="85" x2="680" y2="85" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <rect x="70" y="176" width="45" height="104" rx="6" fill="#475569" opacity="0.4" />
                    <rect x="160" y="150" width="45" height="130" rx="6" fill="#475569" opacity="0.4" />
                    <rect x="250" y="100" width="45" height="180" rx="6" fill="#475569" opacity="0.4" />
                    <rect x="340" y="124" width="45" height="156" rx="6" fill="#475569" opacity="0.4" />
                    <rect x="430" y="70" width="45" height="210" rx="6" fill="#475569" opacity="0.4" />
                    <rect x="520" y="36" width="45" height="244" rx="6" fill="#818cf8" opacity="0.5" />
                    <rect x="610" y="140" width="45" height="140" rx="6" fill="#475569" opacity="0.4" />
                    <rect x="70" y="214" width="45" height="66" rx="6" fill="#818cf8" opacity="0.4" />
                    <rect x="160" y="196" width="45" height="84" rx="6" fill="#818cf8" opacity="0.4" />
                    <rect x="250" y="152" width="45" height="128" rx="6" fill="#818cf8" opacity="0.4" />
                    <rect x="340" y="176" width="45" height="104" rx="6" fill="#818cf8" opacity="0.4" />
                    <rect x="430" y="124" width="45" height="156" rx="6" fill="#818cf8" opacity="0.5" />
                    <rect x="520" y="80" width="45" height="200" rx="6" fill="#818cf8" opacity="0.6" />
                    <rect x="610" y="192" width="45" height="88" rx="6" fill="#818cf8" opacity="0.4" />
                    <text x="92" y="300" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">MON</text>
                    <text x="182" y="300" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">TUE</text>
                    <text x="272" y="300" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">WED</text>
                    <text x="362" y="300" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">THU</text>
                    <text x="452" y="300" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">FRI</text>
                    <text x="542" y="300" text-anchor="middle" fill="#818cf8" font-size="11" font-weight="700">SAT</text>
                    <text x="632" y="300" text-anchor="middle" fill="#94a3b8" font-size="11" font-weight="600">SUN</text>
                </svg>
            </div>
        </div>

        <!-- Campaign Performance -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8" aria-label="Campaign performance">
            <div class="mb-6 sm:mb-8">
                <h4 class="text-lg sm:text-xl font-headline font-semibold text-on-surface">Campaigns</h4>
                <p class="text-xs sm:text-sm text-on-surface-variant">Reach per platform</p>
            </div>
            <div class="space-y-4 sm:space-y-6">
                <div>
                    <div class="flex justify-between text-xs mb-2">
                        <span class="text-on-surface font-bold uppercase tracking-wider">Instagram Ads</span>
                        <span class="text-primary font-bold">88%</span>
                    </div>
                    <div class="h-2 bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full w-[88%] bg-primary rounded-full transition-all duration-700" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100" aria-hidden="true"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs mb-2">
                        <span class="text-on-surface font-bold uppercase tracking-wider">Google Search</span>
                        <span class="text-primary font-bold">64%</span>
                    </div>
                    <div class="h-2 bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full w-[64%] bg-primary rounded-full opacity-70 transition-all duration-700" role="progressbar" aria-valuenow="64" aria-valuemin="0" aria-valuemax="100" aria-hidden="true"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs mb-2">
                        <span class="text-on-surface font-bold uppercase tracking-wider">LinkedIn Promo</span>
                        <span class="text-tertiary font-bold">42%</span>
                    </div>
                    <div class="h-2 bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full w-[42%] bg-tertiary rounded-full transition-all duration-700" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" aria-hidden="true"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs mb-2">
                        <span class="text-on-surface font-bold uppercase tracking-wider">X Campaigns</span>
                        <span class="text-primary font-bold">31%</span>
                    </div>
                    <div class="h-2 bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full w-[31%] bg-primary rounded-full opacity-40 transition-all duration-700" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
            <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-white/10">
                <button type="button" class="flex items-center gap-2 text-primary font-bold text-xs uppercase tracking-widest group min-h-[44px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded transition-all">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full group-hover:w-3 group-hover:h-3 transition-all duration-300" aria-hidden="true"></span>
                    View Analytics
                </button>
            </div>
        </div>
    </section>

    <!-- Top Converting Pages & Team Updates -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
        <!-- Top Converting Pages Table -->
        <div class="lg:col-span-2 bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm overflow-hidden">
            <div class="p-4 sm:p-6 md:p-8 border-b border-white/10 flex flex-wrap justify-between items-center gap-3">
                <h4 class="text-lg sm:text-xl font-headline font-semibold text-on-surface">Top Converting Pages</h4>
                <button type="button" class="text-primary font-bold text-xs uppercase tracking-widest hover:underline focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded min-h-[44px] inline-flex items-center">
                    View All
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[550px]" role="table" aria-label="Top converting pages">
                    <thead>
                        <tr class="border-b border-white/10">
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-3 sm:py-4 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap">Page Path</th>
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-3 sm:py-4 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap text-right">Visits</th>
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-3 sm:py-4 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap text-right hidden sm:table-cell">Bounce Rate</th>
                            <th scope="col" class="px-4 sm:px-6 md:px-8 py-3 sm:py-4 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap">Conversion</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <tr class="hover:bg-surface-container-high/60 transition-colors">
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary shrink-0">
                                        <span class="material-symbols-outlined text-sm" aria-hidden="true">home</span>
                                    </div>
                                    <span class="text-xs sm:text-sm text-on-surface font-medium">/home</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-on-surface-variant text-right text-xs sm:text-sm">42,012</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-on-surface-variant text-right text-xs sm:text-sm hidden sm:table-cell">24.5%</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="bg-primary/10 text-primary px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold whitespace-nowrap">4.2%</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-high/60 transition-colors">
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-surface-container-highest flex items-center justify-center text-tertiary shrink-0">
                                        <span class="material-symbols-outlined text-sm" aria-hidden="true">shopping_cart</span>
                                    </div>
                                    <span class="text-xs sm:text-sm text-on-surface font-medium truncate max-w-[150px] sm:max-w-none">/product-pro-plan</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-on-surface-variant text-right text-xs sm:text-sm">28,550</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-on-surface-variant text-right text-xs sm:text-sm hidden sm:table-cell">18.2%</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="bg-tertiary/10 text-tertiary px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold whitespace-nowrap">12.8%</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-high/60 transition-colors">
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary shrink-0">
                                        <span class="material-symbols-outlined text-sm" aria-hidden="true">sell</span>
                                    </div>
                                    <span class="text-xs sm:text-sm text-on-surface font-medium truncate max-w-[150px] sm:max-w-none">/pricing-enterprise</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-on-surface-variant text-right text-xs sm:text-sm">15,221</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-on-surface-variant text-right text-xs sm:text-sm hidden sm:table-cell">32.1%</td>
                            <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                <span class="bg-primary/10 text-primary px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold whitespace-nowrap">8.4%</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Team Updates -->
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8" aria-label="Team activity updates">
            <h4 class="text-lg sm:text-xl font-headline font-semibold text-on-surface mb-4 sm:mb-6">Team Updates</h4>
            <div class="space-y-5 sm:space-y-6">
                <div class="flex gap-3 sm:gap-4 group">
                    <div class="relative shrink-0">
                        <img alt="Sarah Jenkins" class="w-10 h-10 rounded-full grayscale group-hover:grayscale-0 transition-all object-cover" src="https://ui-avatars.com/api/?name=Sarah+Jenkins&background=818cf8&color=fff&size=128" loading="lazy" />
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-surface rounded-full" aria-hidden="true"></div>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs sm:text-sm text-on-surface"><span class="font-bold">Sarah Jenkins</span> updated <span class="text-primary font-medium">Q4 Roadmap</span></p>
                        <span class="text-[10px] text-on-surface-variant uppercase mt-1 font-bold">14 minutes ago</span>
                    </div>
                </div>
                <div class="flex gap-3 sm:gap-4 group">
                    <div class="relative shrink-0">
                        <img alt="Marcus Thornton" class="w-10 h-10 rounded-full grayscale group-hover:grayscale-0 transition-all object-cover" src="https://ui-avatars.com/api/?name=Marcus+Thornton&background=c084fc&color=fff&size=128" loading="lazy" />
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-amber-500 border-2 border-surface rounded-full" aria-hidden="true"></div>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs sm:text-sm text-on-surface"><span class="font-bold">Marcus Thornton</span> pushed new creatives to <span class="text-tertiary font-medium">Google Ads</span></p>
                        <span class="text-[10px] text-on-surface-variant uppercase mt-1 font-bold">2 hours ago</span>
                    </div>
                </div>
                <div class="flex gap-3 sm:gap-4 group">
                    <div class="relative shrink-0">
                        <img alt="Lydia Chen" class="w-10 h-10 rounded-full grayscale group-hover:grayscale-0 transition-all object-cover" src="https://ui-avatars.com/api/?name=Lydia+Chen&background=34d399&color=fff&size=128" loading="lazy" />
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-indigo-500 border-2 border-surface rounded-full" aria-hidden="true"></div>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs sm:text-sm text-on-surface"><span class="font-bold">Lydia Chen</span> exported monthly <span class="text-primary font-medium">KPI Report</span></p>
                        <span class="text-[10px] text-on-surface-variant uppercase mt-1 font-bold">5 hours ago</span>
                    </div>
                </div>
            </div>
            <button type="button" class="mt-6 sm:mt-8 p-3 rounded-xl border border-white/10 hover:bg-surface-container-high text-on-surface-variant text-xs font-bold uppercase tracking-widest transition-all min-h-[44px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                View All Activity
            </button>
        </div>
    </section>
</div>
@endpush
