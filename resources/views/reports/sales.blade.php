@extends('layouts.app')

@section('title', 'Sales Reports')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/reports-sales.css') }}">
@endpush

@section('content')
<x-navbar />
<div class="space-y-8">
    <!-- Header -->
    <section class="flex flex-col md:flex-row justify-between items-end gap-6">
        <div class="space-y-1">
            <span class="text-[10px] font-bold text-tertiary uppercase tracking-[0.3em] font-label">Territory Overview</span>
            <h3 class="text-6xl font-light font-headline leading-none -ml-1 tracking-tight text-white">Performance.</h3>
        </div>
        <div class="flex gap-4">
            <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 bg-surface-container border border-white/5 px-4 py-2 rounded-full shadow-sm">
                <span class="w-2 h-2 rounded-full bg-tertiary animate-pulse"></span>
                LIVE PIPELINE
            </div>
        </div>
    </section>

    <!-- KPI Cards -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-surface p-8 rounded-2xl flex flex-col gap-4 relative overflow-hidden group border border-white/5 shadow-lg">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-tertiary"></div>
            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-widest font-label">Total Sales Revenue</span>
            <div class="flex items-baseline gap-2">
                <h4 class="text-4xl font-manrope font-semibold text-white">$1,284,500</h4>
                <span class="text-xs text-tertiary font-bold">+12.4%</span>
            </div>
            <div class="w-full h-1.5 bg-background rounded-full overflow-hidden mt-2">
                <div class="h-full bg-gradient-to-r from-tertiary to-tertiary-light w-[75%] shadow-[0_0_12px_rgba(253,186,116,0.3)]"></div>
            </div>
        </div>

        <div class="bg-surface p-8 rounded-2xl flex flex-col gap-4 relative overflow-hidden group border border-white/5 shadow-lg">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-secondary"></div>
            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-widest font-label">Conversion Rate</span>
            <div class="flex items-baseline gap-2">
                <h4 class="text-4xl font-manrope font-semibold text-white">24.8%</h4>
                <span class="text-xs text-primary font-bold">+2.1%</span>
            </div>
            <div class="w-full h-1.5 bg-background rounded-full overflow-hidden mt-2">
                <div class="h-full bg-gradient-to-r from-primary to-primary/60 w-[48%] shadow-[0_0_12px_rgba(192,193,255,0.3)]"></div>
            </div>
        </div>

        <div class="bg-surface p-8 rounded-2xl flex flex-col gap-4 relative overflow-hidden group border border-white/5 shadow-lg">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-tertiary"></div>
            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-widest font-label">Deals Closed</span>
            <div class="flex items-baseline gap-2">
                <h4 class="text-4xl font-manrope font-semibold text-white">142</h4>
                <span class="text-xs text-slate-500 font-medium">Target: 160</span>
            </div>
            <div class="w-full h-1.5 bg-background rounded-full overflow-hidden mt-2">
                <div class="h-full bg-gradient-to-r from-tertiary to-tertiary-light w-[88%] shadow-[0_0_12px_rgba(253,186,116,0.3)]"></div>
            </div>
        </div>
    </section>

    <!-- Revenue Analytics & Deal Pipeline -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Revenue Analytics -->
        <div class="lg:col-span-8 bg-surface p-8 rounded-2xl flex flex-col gap-10 border border-white/5 shadow-xl relative overflow-hidden">
            <div class="flex justify-between items-center relative z-10">
                <div>
                    <h5 class="text-xl font-headline font-semibold text-white">Revenue Analytics</h5>
                    <p class="text-xs text-slate-500 mt-1">Growth trajectory over the last 7 days</p>
                </div>
                <div class="flex gap-6">
                    <span class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-tertiary shadow-[0_0_8px_rgba(253,186,116,0.6)]"></span>
                        Revenue
                    </span>
                    <span class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-white opacity-20"></span> Target
                    </span>
                </div>
            </div>
            <div class="relative h-64 w-full flex flex-col justify-end gap-6">
                <div class="flex items-end justify-between gap-6 px-4 relative z-10">
                    <div class="flex-1 flex flex-col items-center gap-3 group">
                        <div class="w-full flex flex-col items-center gap-3 h-48 justify-end">
                            <div class="w-full bg-white/5 rounded-t-xl h-24 group-hover:bg-white/10 transition-all duration-300"></div>
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold tracking-tighter">MON</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-3 group">
                        <div class="w-full flex flex-col items-center gap-3 h-48 justify-end">
                            <div class="w-full bg-tertiary/70 rounded-t-xl h-48 shadow-[0_0_30px_rgba(253,186,116,0.1)] group-hover:bg-tertiary transition-all duration-300"></div>
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold tracking-tighter">TUE</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-3 group">
                        <div class="w-full flex flex-col items-center gap-3 h-48 justify-end">
                            <div class="w-full bg-white/5 rounded-t-xl h-36 group-hover:bg-white/10 transition-all duration-300"></div>
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold tracking-tighter">WED</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-3 group">
                        <div class="w-full flex flex-col items-center gap-3 h-48 justify-end">
                            <div class="w-full bg-tertiary rounded-t-xl h-56 shadow-[0_0_30px_rgba(253,186,116,0.2)] group-hover:scale-[1.02] transition-all duration-300"></div>
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold tracking-tighter">THU</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-3 group">
                        <div class="w-full flex flex-col items-center gap-3 h-48 justify-end">
                            <div class="w-full bg-tertiary/50 rounded-t-xl h-44 group-hover:bg-tertiary transition-all duration-300"></div>
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold tracking-tighter">FRI</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-3 group">
                        <div class="w-full flex flex-col items-center gap-3 h-48 justify-end">
                            <div class="w-full bg-white/5 rounded-t-xl h-20 group-hover:bg-white/10 transition-all duration-300"></div>
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold tracking-tighter">SAT</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-3 group">
                        <div class="w-full flex flex-col items-center gap-3 h-48 justify-end">
                            <div class="w-full bg-white/5 rounded-t-xl h-28 group-hover:bg-white/10 transition-all duration-300"></div>
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold tracking-tighter">SUN</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deal Pipeline -->
        <div class="lg:col-span-4 bg-surface p-8 rounded-2xl flex flex-col gap-8 border border-white/5 shadow-xl">
            <div class="flex justify-between items-center">
                <h5 class="text-xl font-headline font-semibold text-white">Deal Pipeline</h5>
                <button class="p-1 hover:bg-white/5 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-slate-500">more_vert</span>
                </button>
            </div>
            <div class="space-y-6">
                <div class="flex flex-col gap-2.5">
                    <div class="flex justify-between text-[11px] font-bold uppercase tracking-widest text-slate-400">
                        <span>Contacted</span>
                        <span class="text-tertiary">8 Deals</span>
                    </div>
                    <div class="h-2.5 bg-background rounded-full overflow-hidden">
                        <div class="h-full bg-tertiary w-full"></div>
                    </div>
                </div>
                <div class="flex flex-col gap-2.5">
                    <div class="flex justify-between text-[11px] font-bold uppercase tracking-widest text-slate-400">
                        <span>Negotiation</span>
                        <span class="text-tertiary">28 Deals</span>
                    </div>
                    <div class="h-2.5 bg-background rounded-full overflow-hidden">
                        <div class="h-full bg-tertiary w-3/4 opacity-80"></div>
                    </div>
                </div>
                <div class="flex flex-col gap-2.5">
                    <div class="flex justify-between text-[11px] font-bold uppercase tracking-widest text-slate-400">
                        <span>Offer Sent</span>
                        <span class="text-tertiary">15 Deals</span>
                    </div>
                    <div class="h-2.5 bg-background rounded-full overflow-hidden">
                        <div class="h-full bg-tertiary w-1/2 opacity-60"></div>
                    </div>
                </div>
                <div class="flex flex-col gap-2.5">
                    <div class="flex justify-between text-[11px] font-bold uppercase tracking-widest text-slate-400">
                        <span>Closed Won</span>
                        <span class="text-tertiary">8 Deals</span>
                    </div>
                    <div class="h-2.5 bg-background rounded-full overflow-hidden">
                        <div class="h-full bg-tertiary w-1/4 opacity-40"></div>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-8 border-t border-white/5 flex items-center justify-between">
                <span class="text-sm font-medium text-slate-400">Estimated Value</span>
                <span class="text-2xl font-manrope font-bold text-tertiary">$4.2M</span>
            </div>
        </div>
    </section>

    <!-- Recent Transactions -->
    <section class="bg-surface rounded-2xl overflow-hidden border border-white/5 shadow-xl">
        <div class="px-8 py-6 flex justify-between items-center border-b border-white/5">
            <h5 class="text-xl font-headline font-semibold text-white">Recent Transactions</h5>
            <button class="flex items-center gap-2 text-tertiary font-bold text-xs uppercase tracking-[0.15em] hover:brightness-110 transition-all px-4 py-2 bg-tertiary/5 rounded-full border border-tertiary/20">
                <span class="w-1.5 h-1.5 rounded-full bg-[#FDBA74]"></span> View All Deals
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-bold text-slate-500 uppercase tracking-widest border-b border-white/5 bg-white/[0.01]">
                        <th class="px-8 py-4">Company</th>
                        <th class="px-8 py-4">Value</th>
                        <th class="px-8 py-4">Owner</th>
                        <th class="px-8 py-4">Status</th>
                        <th class="px-8 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-tertiary/10 flex items-center justify-center text-tertiary border border-tertiary/20">
                                    <span class="material-symbols-outlined text-xl">rocket_launch</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-white">Nexus Labs</span>
                                    <span class="text-[10px] text-slate-500 font-medium">Enterprise License</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 font-manrope font-bold text-sm text-slate-200">$45,000</td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <img alt="Alex Rivers avatar" class="w-7 h-7 rounded-full object-cover border border-white/10" src="https://ui-avatars.com/api/?name=Alex+Rivers&background=818cf8&color=fff&size=56" />
                                <span class="text-xs text-slate-400 font-medium">Alex Rivers</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-[10px] font-bold uppercase tracking-wider border border-emerald-500/20">Completed</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <button class="p-2 hover:bg-white/5 rounded-lg text-slate-600 hover:text-tertiary transition-all">
                                <span class="material-symbols-outlined">more_horiz</span>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-secondary/10 flex items-center justify-center text-secondary border border-secondary/20">
                                    <span class="material-symbols-outlined text-xl">cloud</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-white">Solaris Systems</span>
                                    <span class="text-[10px] text-slate-500 font-medium">Cloud Infrastructure</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 font-manrope font-bold text-sm text-slate-200">$128,200</td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <img alt="Sarah Chen avatar" class="w-7 h-7 rounded-full object-cover border border-white/10" src="https://ui-avatars.com/api/?name=Sarah+Chen&background=c084fc&color=fff&size=56" />
                                <span class="text-xs text-slate-400 font-medium">Sarah Chen</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-full bg-tertiary/10 text-tertiary text-[10px] font-bold uppercase tracking-wider border border-tertiary/20">In Progress</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <button class="p-2 hover:bg-white/5 rounded-lg text-slate-600 hover:text-[#FDBA74] transition-all">
                                <span class="material-symbols-outlined">more_horiz</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
@endpush
