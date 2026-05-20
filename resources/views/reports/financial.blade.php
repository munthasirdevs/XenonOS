@extends('layouts.app')

@section('title', 'Financial Reports')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/reports-financial.css') }}">
@endpush

@section('content')
<div class="space-y-12">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex justify-between items-end mb-8">
            <div>
                <p class="font-label text-[10px] text-tertiary uppercase tracking-[0.2em] font-bold mb-1">Financial Performance</p>
                <h3 class="text-4xl font-headline font-light tracking-tight text-on-surface">Agency Overview</h3>
            </div>
            <button class="flex items-center space-x-2 bg-primary text-on-primary px-5 py-2.5 rounded-xl font-headline font-bold text-sm transition-all hover:shadow-[0_0_20px_rgba(192,193,255,0.3)] active:scale-95">
                <span class="material-symbols-outlined text-sm">download</span>
                <span>Export Data</span>
            </button>
        </div>

        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Revenue -->
            <div class="bg-surface-container-low p-6 rounded-xl relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-primary-container"></div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                    <span class="font-label text-[10px] bg-primary/10 text-primary px-2 py-1 rounded-full">+12.5%</span>
                </div>
                <p class="font-label text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">Total Revenue</p>
                <h4 class="text-3xl font-headline font-bold text-on-surface mt-1">$482,950</h4>
                <div class="mt-4 h-1 w-full bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-primary to-primary-container w-[75%] shadow-[0_0_8px_rgba(192,193,255,0.4)]"></div>
                </div>
            </div>

            <!-- Expenses -->
            <div class="bg-surface-container-low p-6 rounded-xl relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-error"></div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-error">payments</span>
                    <span class="font-label text-[10px] bg-error/10 text-error px-2 py-1 rounded-full">+4.2%</span>
                </div>
                <p class="font-label text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">Total Expenses</p>
                <h4 class="text-3xl font-headline font-bold text-on-surface mt-1">$128,400</h4>
                <div class="mt-4 h-1 w-full bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="h-full bg-error w-[40%]"></div>
                </div>
            </div>

            <!-- Profit -->
            <div class="bg-surface-container-low p-6 rounded-xl relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-tertiary"></div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-tertiary">trending_up</span>
                    <span class="font-label text-[10px] bg-tertiary/10 text-tertiary px-2 py-1 rounded-full">+18.3%</span>
                </div>
                <p class="font-label text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">Net Profit</p>
                <h4 class="text-3xl font-headline font-bold text-on-surface mt-1">$354,550</h4>
                <div class="mt-4 h-1 w-full bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="h-full bg-tertiary w-[88%]"></div>
                </div>
            </div>

            <!-- Cash Flow -->
            <div class="bg-surface-container-low p-6 rounded-xl relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-secondary"></div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-secondary">account_tree</span>
                    <span class="font-label text-[10px] bg-secondary/10 text-secondary px-2 py-1 rounded-full">Stable</span>
                </div>
                <p class="font-label text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">Cash Flow</p>
                <h4 class="text-3xl font-headline font-bold text-on-surface mt-1">$92,120</h4>
                <div class="mt-4 h-1 w-full bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="h-full bg-secondary w-[62%]"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue & Financial Reports -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Monthly Revenue -->
        <div class="lg:col-span-2 bg-surface-container p-8 rounded-2xl border border-white/5">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h5 class="font-headline font-semibold text-lg">Monthly Revenue</h5>
                    <p class="text-xs text-on-surface-variant mt-1">Revenue vs Expenses - FY 2023</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-gradient-to-r from-primary to-primary-container shadow-[0_0_8px_rgba(192,193,255,0.4)]"></div>
                        <span class="text-xs text-on-surface-variant">Revenue</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-gradient-to-r from-error to-error-container"></div>
                        <span class="text-xs text-on-surface-variant">Expenses</span>
                    </div>
                </div>
            </div>
            <div class="relative h-72">
                <svg viewBox="0 0 600 250" class="w-full h-full" preserveAspectRatio="xMidYMid meet">
                    <line x1="40" y1="20" x2="40" y2="220" stroke="#334155" stroke-width="0.5" opacity="0.3" />
                    <line x1="40" y1="220" x2="580" y2="220" stroke="#334155" stroke-width="0.5" opacity="0.3" />
                    <line x1="40" y1="165" x2="580" y2="165" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="40" y1="110" x2="580" y2="110" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <line x1="40" y1="55" x2="580" y2="55" stroke="#334155" stroke-width="0.5" opacity="0.15" stroke-dasharray="4,4" />
                    <text x="35" y="224" text-anchor="end" fill="#94a3b8" font-size="9">$0</text>
                    <text x="35" y="169" text-anchor="end" fill="#94a3b8" font-size="9">$100k</text>
                    <text x="35" y="114" text-anchor="end" fill="#94a3b8" font-size="9">$200k</text>
                    <text x="35" y="59" text-anchor="end" fill="#94a3b8" font-size="9">$300k</text>
                    <rect x="70" y="120" width="40" height="100" rx="4" fill="#818cf8" opacity="0.8" />
                    <rect x="140" y="90" width="40" height="130" rx="4" fill="#818cf8" opacity="0.8" />
                    <rect x="210" y="100" width="40" height="120" rx="4" fill="#818cf8" opacity="0.8" />
                    <rect x="280" y="60" width="40" height="160" rx="4" fill="#818cf8" opacity="0.8" />
                    <rect x="350" y="80" width="40" height="140" rx="4" fill="#818cf8" opacity="0.8" />
                    <rect x="420" y="110" width="40" height="110" rx="4" fill="#818cf8" opacity="0.8" />
                    <rect x="490" y="70" width="40" height="150" rx="4" fill="#818cf8" opacity="0.8" />
                    <rect x="70" y="180" width="40" height="40" rx="4" fill="#f87171" opacity="0.6" />
                    <rect x="140" y="160" width="40" height="60" rx="4" fill="#f87171" opacity="0.6" />
                    <rect x="210" y="170" width="40" height="50" rx="4" fill="#f87171" opacity="0.6" />
                    <rect x="280" y="150" width="40" height="70" rx="4" fill="#f87171" opacity="0.6" />
                    <rect x="350" y="165" width="40" height="55" rx="4" fill="#f87171" opacity="0.6" />
                    <rect x="420" y="175" width="40" height="45" rx="4" fill="#f87171" opacity="0.6" />
                    <rect x="490" y="155" width="40" height="65" rx="4" fill="#f87171" opacity="0.6" />
                    <text x="90" y="240" text-anchor="middle" fill="#94a3b8" font-size="10">JAN</text>
                    <text x="160" y="240" text-anchor="middle" fill="#94a3b8" font-size="10">FEB</text>
                    <text x="230" y="240" text-anchor="middle" fill="#94a3b8" font-size="10">MAR</text>
                    <text x="300" y="240" text-anchor="middle" fill="#94a3b8" font-size="10">APR</text>
                    <text x="370" y="240" text-anchor="middle" fill="#94a3b8" font-size="10">MAY</text>
                    <text x="440" y="240" text-anchor="middle" fill="#94a3b8" font-size="10">JUN</text>
                    <text x="510" y="240" text-anchor="middle" fill="#94a3b8" font-size="10">JUL</text>
                </svg>
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="bg-surface-container-low p-8 rounded-2xl border border-white/5">
            <div class="flex justify-between items-center mb-8">
                <h5 class="font-headline font-semibold text-lg">Financial Reports</h5>
                <button class="flex items-center text-primary font-label text-xs font-bold tracking-wider hover:underline">
                    <div class="w-1 h-1 bg-primary rounded-full mr-2"></div>
                    VIEW ALL
                </button>
            </div>
            <div class="space-y-6">
                <div class="flex items-center group cursor-pointer hover:bg-surface-bright/20 p-2 -m-2 rounded-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-tertiary mr-4">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Q3 Tax Summary</p>
                        <p class="text-xs text-on-surface-variant">Generated Dec 14, 2023</p>
                    </div>
                    <span class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity">download</span>
                </div>
                <div class="flex items-center group cursor-pointer hover:bg-surface-bright/20 p-2 -m-2 rounded-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary mr-4">
                        <span class="material-symbols-outlined">analytics</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Annual Forecast 2024</p>
                        <p class="text-xs text-on-surface-variant">Generated Dec 10, 2023</p>
                    </div>
                    <span class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity">download</span>
                </div>
                <div class="flex items-center group cursor-pointer hover:bg-surface-bright/20 p-2 -m-2 rounded-xl transition-all">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-error mr-4">
                        <span class="material-symbols-outlined">receipt_long</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Expense Audit Report</p>
                        <p class="text-xs text-on-surface-variant">Generated Nov 28, 2023</p>
                    </div>
                    <span class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity">download</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-surface-container p-8 rounded-2xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h5 class="font-headline font-semibold text-lg">Recent Transactions</h5>
                <p class="text-xs text-on-surface-variant">Detailed view of your agency's cash flow activity.</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="bg-surface-container-low border border-white/15 rounded-lg flex items-center px-3 py-2 w-64">
                    <span class="material-symbols-outlined text-on-surface-variant text-sm mr-2">search</span>
                    <input aria-label="Search transactions" class="bg-transparent border-none text-xs focus:ring-0 text-on-surface w-full" placeholder="Search transactions..." type="text" name="search_transactions" />
                </div>
                <button class="p-2 bg-surface-container-low border border-white/15 rounded-lg">
                    <span class="material-symbols-outlined text-sm">filter_list</span>
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/10 text-on-surface-variant">
                        <th class="pb-4 font-label text-[10px] uppercase tracking-widest font-bold">Company / Vendor</th>
                        <th class="pb-4 font-label text-[10px] uppercase tracking-widest font-bold">Date</th>
                        <th class="pb-4 font-label text-[10px] uppercase tracking-widest font-bold text-right">Amount</th>
                        <th class="pb-4 font-label text-[10px] uppercase tracking-widest font-bold text-center">Status</th>
                        <th class="pb-4 font-label text-[10px] uppercase tracking-widest font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr class="group hover:bg-surface-bright/10 transition-colors">
                        <td class="py-5">
                            <div class="flex items-center">
                                <div class="w-9 h-9 rounded-lg bg-surface-container-highest flex items-center justify-center mr-3">
                                    <span class="material-symbols-outlined text-sm text-primary">cloud</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold">DigitalOcean Inc.</p>
                                    <p class="text-[10px] text-on-surface-variant">Cloud Infrastructure</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 text-sm">Dec 14, 2023</td>
                        <td class="py-5 text-sm font-bold text-right text-error">-$1,240.00</td>
                        <td class="py-5 text-center">
                            <span class="px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full">COMPLETED</span>
                        </td>
                        <td class="py-5 text-right">
                            <button class="p-1 hover:text-primary"><span class="material-symbols-outlined text-lg">more_vert</span></button>
                        </td>
                    </tr>
                    <tr class="group hover:bg-surface-bright/10 transition-colors">
                        <td class="py-5">
                            <div class="flex items-center">
                                <div class="w-9 h-9 rounded-lg bg-surface-container-highest flex items-center justify-center mr-3">
                                    <span class="material-symbols-outlined text-sm text-tertiary">rocket_launch</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold">Starlight Creative</p>
                                    <p class="text-[10px] text-on-surface-variant">Project Milestone</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 text-sm">Dec 12, 2023</td>
                        <td class="py-5 text-sm font-bold text-right text-primary">+$15,800.00</td>
                        <td class="py-5 text-center">
                            <span class="px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full">COMPLETED</span>
                        </td>
                        <td class="py-5 text-right">
                            <button class="p-1 hover:text-primary"><span class="material-symbols-outlined text-lg">more_vert</span></button>
                        </td>
                    </tr>
                    <tr class="group hover:bg-surface-bright/10 transition-colors">
                        <td class="py-5">
                            <div class="flex items-center">
                                <div class="w-9 h-9 rounded-lg bg-surface-container-highest flex items-center justify-center mr-3">
                                    <span class="material-symbols-outlined text-sm text-secondary">Adobe</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold">Adobe Systems</p>
                                    <p class="text-[10px] text-on-surface-variant">Creative Cloud Subscription</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 text-sm">Dec 10, 2023</td>
                        <td class="py-5 text-sm font-bold text-right text-error">-$299.00</td>
                        <td class="py-5 text-center">
                            <span class="px-2 py-1 bg-tertiary/10 text-tertiary text-[10px] font-bold rounded-full">PENDING</span>
                        </td>
                        <td class="py-5 text-right">
                            <button class="p-1 hover:text-primary"><span class="material-symbols-outlined text-lg">more_vert</span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-8 flex justify-between items-center">
            <p class="text-xs text-on-surface-variant">Showing 3 of 24 transactions</p>
            <div class="flex space-x-2">
                <button class="px-3 py-1.5 bg-surface-container-low border border-white/10 rounded-lg text-xs font-bold disabled:opacity-50" disabled="">Previous</button>
                <button class="px-3 py-1.5 bg-surface-container-high border border-white/10 rounded-lg text-xs font-bold hover:bg-surface-bright">Next</button>
            </div>
        </div>
    </div>
</div>
@endpush
