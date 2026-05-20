@extends('layouts.app')

@section('title', 'Report Builder - XenonOS')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/reports-builder.css') }}">
@endpush

@section('content')
<main class="min-h-screen grid grid-cols-12 gap-0 overflow-hidden">
    <aside class="col-span-12 md:col-span-3 bg-surface-container-low p-6 flex flex-col gap-6 overflow-y-auto custom-scrollbar border-r border-outline-variant/10">
        <div>
            <h2 class="font-headline text-lg font-extrabold text-primary mb-6 tracking-tight">Report Builder</h2>

            <div class="space-y-3 mb-8">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Data Source</label>
                <div class="grid grid-cols-1 gap-2">
                    <button class="flex items-center gap-3 p-3 bg-surface-container-high border border-primary/20 rounded-xl text-left text-on-surface group hover:border-primary transition-all">
                        <span class="material-symbols-outlined text-primary">group</span>
                        <span class="text-sm font-medium">Clients</span>
                        <span class="ml-auto material-symbols-outlined text-xs text-primary/40">radio_button_checked</span>
                    </button>
                    <button class="flex items-center gap-3 p-3 bg-surface-container rounded-xl text-left text-on-surface-variant hover:bg-surface-container-high transition-all">
                        <span class="material-symbols-outlined">assignment</span>
                        <span class="text-sm font-medium">Projects</span>
                    </button>
                    <button class="flex items-center gap-3 p-3 bg-surface-container rounded-xl text-left text-on-surface-variant hover:bg-surface-container-high transition-all">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span class="text-sm font-medium">Tasks</span>
                    </button>
                    <button class="flex items-center gap-3 p-3 bg-surface-container rounded-xl text-left text-on-surface-variant hover:bg-surface-container-high transition-all">
                        <span class="material-symbols-outlined">payments</span>
                        <span class="text-sm font-medium">Billing</span>
                    </button>
                </div>
            </div>

            <div class="space-y-4 mb-8">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Global Filters</label>
                <div class="space-y-4">
                    <div class="space-y-2">
                        <p class="text-xs text-on-surface-variant font-medium">Date Range</p>
                        <div class="flex items-center gap-2 p-2.5 bg-surface-container-lowest rounded-xl border border-outline-variant/20">
                            <span class="material-symbols-outlined text-sm text-on-surface-variant">calendar_today</span>
                            <span class="text-xs text-on-surface">Oct 1, 2023 - Oct 31, 2023</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs text-on-surface-variant font-medium">Status</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full border border-primary/20">Active</span>
                            <span class="px-3 py-1 bg-surface-container-highest text-on-surface-variant text-[10px] font-bold rounded-full border border-outline-variant/10">Completed</span>
                            <span class="px-3 py-1 bg-surface-container-highest text-on-surface-variant text-[10px] font-bold rounded-full border border-outline-variant/10">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <section class="col-span-12 md:col-span-9 bg-surface p-8 overflow-y-auto custom-scrollbar flex flex-col gap-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-headline font-extrabold text-on-surface tracking-tighter">October Performance Analysis</h1>
                <p class="text-sm text-on-surface-variant mt-1">Real-time preview based on live data source</p>
            </div>
            <div class="flex gap-2">
                <button class="p-2 flex items-center justify-center bg-surface-container rounded-xl border border-outline-variant/10 hover:bg-surface-container-high transition-all text-on-surface-variant">
                    <span class="material-symbols-outlined">save</span>
                </button>
                <button class="p-2 flex items-center justify-center bg-surface-container rounded-xl border border-outline-variant/10 hover:bg-surface-container-high transition-all text-on-surface-variant">
                    <span class="material-symbols-outlined">file_download</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-surface-container p-6 rounded-2xl hover:bg-surface-container-high transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-400">+12.4%</span>
                </div>
                <p class="text-[10px] uppercase tracking-widest text-on-surface-variant font-bold mb-1">Total Revenue</p>
                <h3 class="text-2xl font-headline font-bold text-on-surface">$142,500</h3>
            </div>

            <div class="bg-surface-container p-6 rounded-2xl hover:bg-surface-container-high transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-10 h-10 rounded-xl bg-secondary-container/30 flex items-center justify-center text-secondary">
                        <span class="material-symbols-outlined">layers</span>
                    </div>
                    <span class="text-[10px] font-bold text-on-surface-variant">Stable</span>
                </div>
                <p class="text-[10px] uppercase tracking-widest text-on-surface-variant font-bold mb-1">Active Projects</p>
                <h3 class="text-2xl font-headline font-bold text-on-surface">48</h3>
            </div>

            <div class="bg-surface-container p-6 rounded-2xl hover:bg-surface-container-high transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-10 h-10 rounded-xl bg-tertiary-container/20 flex items-center justify-center text-tertiary">
                        <span class="material-symbols-outlined">bolt</span>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-400">98%</span>
                </div>
                <p class="text-[10px] uppercase tracking-widest text-on-surface-variant font-bold mb-1">Completion Rate</p>
                <h3 class="text-2xl font-headline font-bold text-on-surface">94.2%</h3>
            </div>
        </div>

        <div class="bg-surface-container p-8 rounded-2xl flex flex-col gap-6 relative overflow-hidden min-h-[320px]">
            <div class="flex items-center justify-between z-10">
                <h4 class="font-headline font-bold text-on-surface">Revenue vs Projections</h4>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-primary"></span>
                        <span class="text-[10px] text-on-surface-variant font-bold uppercase tracking-tight">Actual</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-outline-variant"></span>
                        <span class="text-[10px] text-on-surface-variant font-bold uppercase tracking-tight">Forecast</span>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex items-end gap-3 pb-4">
                <div class="w-full bg-surface-container-lowest h-48 rounded-t-lg relative group">
                    <div class="absolute bottom-0 left-0 w-full bg-primary/20 rounded-t-lg h-[60%] transition-all group-hover:bg-primary/30"></div>
                    <div class="absolute bottom-0 left-0 w-full bg-primary rounded-t-lg h-[45%]"></div>
                    <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-surface-container-highest px-3 py-1.5 rounded-lg text-[10px] opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-20 shadow-xl border border-outline-variant/20">
                        <span class="text-primary font-bold">Week 1:</span> $32,400
                    </div>
                </div>
                <div class="w-full bg-surface-container-lowest h-32 rounded-t-lg relative group">
                    <div class="absolute bottom-0 left-0 w-full bg-primary/20 rounded-t-lg h-[80%]"></div>
                    <div class="absolute bottom-0 left-0 w-full bg-primary rounded-t-lg h-[65%]"></div>
                </div>
                <div class="w-full bg-surface-container-lowest h-56 rounded-t-lg relative group">
                    <div class="absolute bottom-0 left-0 w-full bg-primary/20 rounded-t-lg h-[40%]"></div>
                    <div class="absolute bottom-0 left-0 w-full bg-primary rounded-t-lg h-[25%]"></div>
                </div>
                <div class="w-full bg-surface-container-lowest h-40 rounded-t-lg relative group">
                    <div class="absolute bottom-0 left-0 w-full bg-primary/20 rounded-t-lg h-[95%]"></div>
                    <div class="absolute bottom-0 left-0 w-full bg-primary rounded-t-lg h-[75%]"></div>
                </div>
                <div class="w-full bg-surface-container-lowest h-44 rounded-t-lg relative group">
                    <div class="absolute bottom-0 left-0 w-full bg-primary/20 rounded-t-lg h-[70%]"></div>
                    <div class="absolute bottom-0 left-0 w-full bg-primary rounded-t-lg h-[55%]"></div>
                </div>
                <div class="w-full bg-surface-container-lowest h-52 rounded-t-lg relative group">
                    <div class="absolute bottom-0 left-0 w-full bg-primary/20 rounded-t-lg h-[30%]"></div>
                    <div class="absolute bottom-0 left-0 w-full bg-primary rounded-t-lg h-[20%]"></div>
                </div>
            </div>

            <div class="flex justify-between px-2 text-[10px] font-bold text-on-surface-variant/40">
                <span>OCT 01</span>
                <span>OCT 07</span>
                <span>OCT 14</span>
                <span>OCT 21</span>
                <span>OCT 28</span>
                <span>OCT 31</span>
            </div>
        </div>

        <div class="bg-surface-container rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant/10 flex items-center justify-between">
                <h4 class="font-headline font-bold text-sm text-on-surface">Detailed Logs</h4>
                <span class="text-[10px] font-medium text-on-surface-variant">Showing 1-5 of 1,240 entries</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-surface-container-high text-on-surface-variant uppercase tracking-widest font-bold">
                            <th class="px-6 py-3">Client</th>
                            <th class="px-6 py-3">Project</th>
                            <th class="px-6 py-3">Revenue</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        <tr class="hover:bg-surface-container-highest/50 transition-colors">
                            <td class="px-6 py-4 font-medium">Aether Corp</td>
                            <td class="px-6 py-4 text-on-surface-variant">Quantum CRM</td>
                            <td class="px-6 py-4 text-on-surface font-bold">$24,500.00</td>
                            <td class="px-6 py-4"><span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-400 rounded-md">Paid</span></td>
                            <td class="px-6 py-4 text-right"><span class="material-symbols-outlined text-sm cursor-pointer hover:text-primary">more_vert</span></td>
                        </tr>
                        <tr class="hover:bg-surface-container-highest/50 transition-colors">
                            <td class="px-6 py-4 font-medium">Lumina Labs</td>
                            <td class="px-6 py-4 text-on-surface-variant">Biotech Dashboard</td>
                            <td class="px-6 py-4 text-on-surface font-bold">$12,000.00</td>
                            <td class="px-6 py-4"><span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-400 rounded-md">Paid</span></td>
                            <td class="px-6 py-4 text-right"><span class="material-symbols-outlined text-sm cursor-pointer hover:text-primary">more_vert</span></td>
                        </tr>
                        <tr class="hover:bg-surface-container-highest/50 transition-colors">
                            <td class="px-6 py-4 font-medium">Void Space</td>
                            <td class="px-6 py-4 text-on-surface-variant">Satellite Uplink</td>
                            <td class="px-6 py-4 text-on-surface font-bold">$45,200.00</td>
                            <td class="px-6 py-4"><span class="px-2 py-0.5 bg-primary-container/20 text-primary rounded-md">Processing</span></td>
                            <td class="px-6 py-4 text-right"><span class="material-symbols-outlined text-sm cursor-pointer hover:text-primary">more_vert</span></td>
                        </tr>
                        <tr class="hover:bg-surface-container-highest/50 transition-colors">
                            <td class="px-6 py-4 font-medium">Neon District</td>
                            <td class="px-6 py-4 text-on-surface-variant">Marketing Kit</td>
                            <td class="px-6 py-4 text-on-surface font-bold">$3,400.00</td>
                            <td class="px-6 py-4"><span class="px-2 py-0.5 bg-error-container/20 text-error rounded-md">Overdue</span></td>
                            <td class="px-6 py-4 text-right"><span class="material-symbols-outlined text-sm cursor-pointer hover:text-primary">more_vert</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
@endsection
