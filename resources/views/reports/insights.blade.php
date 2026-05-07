@extends('layouts.app')

@section('title', 'Reports - Q4 Performance Growth')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/reports-insights.css') }}">
@endpush

@section('content')
<x-navbar />
<div class="space-y-8">
    <!-- Header -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="px-3 py-1 bg-surface-container-highest text-primary-fixed-dim text-[10px] font-bold uppercase tracking-widest rounded-full">Quarterly Analysis</span>
                <span class="text-on-surface-variant text-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">calendar_today</span>
                    Oct-Dec 2024
                </span>
            </div>
            <h2 class="font-syne font-extrabold text-4xl text-on-surface tracking-tighter">Q4 Performance Growth</h2>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-4 py-2.5 bg-surface-container border border-white/20 rounded-xl text-on-surface hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined text-lg">share</span>
                <span class="text-sm font-medium">Share</span>
            </button>
            <div class="flex rounded-xl overflow-hidden border border-white/20">
                <button class="px-4 py-2.5 bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors border-r border-white/20 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">download</span>
                    <span class="text-sm font-medium">Export</span>
                </button>
                <select aria-label="Export format selection" class="bg-surface-container text-on-surface-variant text-xs border-none focus:ring-0 px-2 cursor-pointer hover:bg-surface-container-high transition-colors" name="export_format">
                    <option>PDF</option>
                    <option>CSV</option>
                    <option>Excel</option>
                </select>
            </div>
        </div>
    </section>

    <!-- KPI Cards -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-surface-container p-6 rounded-2xl transition-all duration-400">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary">payments</span>
                </div>
                <span class="text-emerald-400 text-xs font-bold flex items-center">
                    <span class="material-symbols-outlined text-xs">trending_up</span> 12.5%
                </span>
            </div>
            <p class="text-on-surface-variant text-sm font-medium mb-1">Total Revenue</p>
            <h3 class="text-2xl font-bold font-syne">$1,284,500</h3>
        </div>

        <div class="bg-surface-container p-6 rounded-2xl transition-all duration-400">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-lg bg-tertiary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-tertiary">speed</span>
                </div>
                <span class="text-emerald-400 text-xs font-bold flex items-center">
                    <span class="material-symbols-outlined text-xs">trending_up</span> 8.2%
                </span>
            </div>
            <p class="text-on-surface-variant text-sm font-medium mb-1">Growth %</p>
            <h3 class="text-2xl font-bold font-syne">24.8%</h3>
        </div>

        <div class="bg-surface-container p-6 rounded-2xl transition-all duration-400">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-lg bg-secondary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary">timer</span>
                </div>
                <span class="text-amber-400 text-xs font-bold flex items-center">
                    <span class="material-symbols-outlined text-xs">trending_down</span> 4.1%
                </span>
            </div>
            <p class="text-on-surface-variant text-sm font-medium mb-1">Avg Task Time</p>
            <h3 class="text-2xl font-bold font-syne">18.4m</h3>
        </div>

        <div class="bg-surface-container p-6 rounded-2xl transition-all duration-400">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-lg bg-primary-container/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary-container">groups</span>
                </div>
                <span class="text-emerald-400 text-xs font-bold flex items-center">
                    <span class="material-symbols-outlined text-xs">add</span> 2
                </span>
            </div>
            <p class="text-on-surface-variant text-sm font-medium mb-1">Active Projects</p>
            <h3 class="text-2xl font-bold font-syne">42</h3>
        </div>
    </section>

    <!-- Financial Trends & Side Panels -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Large Chart Card -->
        <div class="lg:col-span-2 bg-surface-container rounded-2xl p-8 overflow-hidden relative">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h4 class="text-lg font-bold text-on-surface font-syne mb-1">Financial Trends</h4>
                    <p class="text-on-surface-variant text-sm">Monthly performance trajectory</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 bg-surface-container-highest rounded-lg text-xs font-bold text-primary">Daily</button>
                    <button class="px-3 py-1.5 hover:bg-surface-container-highest rounded-lg text-xs font-bold text-on-surface-variant transition-colors">Weekly</button>
                    <button class="px-3 py-1.5 hover:bg-surface-container-highest rounded-lg text-xs font-bold text-on-surface-variant transition-colors">Monthly</button>
                </div>
            </div>
            <div class="h-64 relative">
                <div class="absolute inset-0 flex flex-col justify-between opacity-10">
                    <div class="border-b border-on-surface w-full h-px"></div>
                    <div class="border-b border-on-surface w-full h-px"></div>
                    <div class="border-b border-on-surface w-full h-px"></div>
                    <div class="border-b border-on-surface w-full h-px"></div>
                </div>
                <svg class="w-full h-full relative z-10" preserveaspectratio="none" viewBox="0 0 100 100">
                    <defs>
                        <linearGradient id="lineGrad" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#818cf8" stop-opacity="0.5"></stop>
                            <stop offset="100%" stop-color="#818cf8" stop-opacity="0"></stop>
                        </linearGradient>
                    </defs>
                    <path d="M0,80 Q10,75 20,60 T40,65 T60,40 T80,30 T100,20 L100,100 L0,100 Z" fill="url(#lineGrad)"></path>
                    <path d="M0,80 Q10,75 20,60 T40,65 T60,40 T80,30 T100,20" fill="none" stroke="#6366f1" stroke-width="2"></path>
                    <circle cx="20" cy="60" fill="#818cf8" r="1.5"></circle>
                    <circle cx="40" cy="65" fill="#818cf8" r="1.5"></circle>
                    <circle cx="60" cy="40" fill="#818cf8" r="1.5"></circle>
                    <circle cx="80" cy="30" fill="#818cf8" r="1.5"></circle>
                </svg>
                <div class="flex justify-between mt-4 text-[10px] text-on-surface-variant font-bold tracking-widest uppercase">
                    <span>October</span>
                    <span>November</span>
                    <span>December</span>
                </div>
            </div>
        </div>

        <!-- Side Comparison Section -->
        <div class="flex flex-col gap-6">
            <div class="flex-1 bg-surface-container rounded-2xl p-6">
                <h4 class="text-sm font-bold text-on-surface font-syne mb-4">Revenue vs Expenses</h4>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-on-surface-variant">Revenue</span>
                            <span class="text-on-surface">$842k</span>
                        </div>
                        <div class="w-full h-2 bg-surface-container-lowest rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full w-[75%]"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-on-surface-variant">Expenses</span>
                            <span class="text-on-surface">$442k</span>
                        </div>
                        <div class="w-full h-2 bg-surface-container-lowest rounded-full overflow-hidden">
                            <div class="h-full bg-tertiary rounded-full w-[45%]"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 bg-surface-container rounded-2xl p-6 flex flex-col">
                <h4 class="text-sm font-bold text-on-surface font-syne mb-4">Team Productivity</h4>
                <div class="flex-1 flex items-center justify-center relative">
                    <div class="w-32 h-32 rounded-full border-[12px] border-surface-container-lowest flex items-center justify-center relative">
                        <svg class="absolute inset-0 w-32 h-32 -rotate-90">
                            <circle cx="64" cy="64" fill="none" r="58" stroke="#6366f1" stroke-dasharray="364" stroke-dashoffset="100" stroke-width="12"></circle>
                        </svg>
                        <div class="text-center">
                            <p class="text-2xl font-bold font-syne">92%</p>
                            <p class="text-[8px] text-on-surface-variant uppercase tracking-tighter">Efficiency</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Breakdown Table -->
    <section class="bg-surface-container rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h4 class="text-lg font-bold text-on-surface font-syne">Detailed Breakdown</h4>
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-3 py-1.5 bg-surface-container-lowest border border-white/20 rounded-lg text-xs text-on-surface hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-sm">filter_list</span>
                    Filter
                </button>
                <button class="flex items-center gap-2 px-3 py-1.5 bg-surface-container-lowest border border-white/20 rounded-lg text-xs text-on-surface hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-sm">sort</span>
                    Sort
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-lowest/50">
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Client / Project</th>
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Category</th>
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Amount</th>
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Date</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr class="hover:bg-surface-container-high/50 transition-colors group">
                        <td class="px-6 py-4 text-sm text-on-surface-variant">#9402</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center text-primary text-xs font-bold">NV</div>
                                <div>
                                    <p class="text-sm font-semibold text-on-surface">Nova Dynamics</p>
                                    <p class="text-[10px] text-on-surface-variant">Cloud Migration</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-surface-container-highest text-on-surface-variant text-[10px] font-bold rounded">Infrastructure</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-on-surface">$24,400.00</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                <span class="text-xs text-on-surface">Completed</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-on-surface-variant">Oct 12, 2024</td>
                        <td class="px-6 py-4 text-right">
                            <button class="p-1.5 hover:bg-surface-container-highest rounded-lg text-on-surface-variant group-hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">more_vert</span>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-container-high/50 transition-colors group">
                        <td class="px-6 py-4 text-sm text-on-surface-variant">#9408</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-tertiary/20 flex items-center justify-center text-tertiary text-xs font-bold">SL</div>
                                <div>
                                    <p class="text-sm font-semibold text-on-surface">Solaris Labs</p>
                                    <p class="text-[10px] text-on-surface-variant">AI Optimization</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-surface-container-highest text-on-surface-variant text-[10px] font-bold rounded">Software</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-on-surface">$12,800.00</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                                <span class="text-xs text-on-surface">Pending</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-on-surface-variant">Oct 15, 2024</td>
                        <td class="px-6 py-4 text-right">
                            <button class="p-1.5 hover:bg-surface-container-highest rounded-lg text-on-surface-variant group-hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">more_vert</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-surface-container-lowest/30 border-t border-white/10 flex items-center justify-between">
            <p class="text-xs text-on-surface-variant">Showing 2 of 128 entries</p>
            <div class="flex gap-2">
                <button class="w-8 h-8 rounded bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                </button>
                <button class="w-8 h-8 rounded bg-primary text-on-primary text-xs font-bold">1</button>
                <button class="w-8 h-8 rounded bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors">2</button>
                <button class="w-8 h-8 rounded bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors">3</button>
                <button class="w-8 h-8 rounded bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </button>
            </div>
        </div>
    </section>
</div>
@endpush
