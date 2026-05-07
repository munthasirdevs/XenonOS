@extends('layouts.app')

@section('title', 'Support Reports - XenonOS')

@push('styles')
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }
</style>
@endpush

@section('content')
<div class="p-8">
    <section class="mb-12 flex justify-between items-end">
        <div>
            <p class="text-xs font-bold text-primary uppercase tracking-[0.2em] mb-2">Operational Overview</p>
            <h2 class="text-5xl font-headline font-light tracking-tight text-on-surface">Support Dashboard</h2>
        </div>
        <div class="flex gap-3">
            <button class="px-6 py-2.5 bg-surface-container hover:bg-surface-bright text-on-surface rounded-xl text-sm font-medium transition-all">Export Report</button>
            <button class="px-6 py-2.5 bg-primary text-on-primary-container rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all">New Ticket</button>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="relative overflow-hidden bg-surface-container-low rounded-3xl p-8 group">
            <div class="absolute top-0 left-0 w-1 h-full bg-primary/40"></div>
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-primary/5 blur-3xl rounded-full"></div>
            <div class="flex justify-between items-start mb-4">
                <span class="p-3 bg-surface-container rounded-2xl text-primary">
                    <span class="material-symbols-outlined">confirmation_number</span>
                </span>
                <span class="text-[10px] font-bold py-1 px-2 bg-primary/10 text-primary rounded-lg">+12%</span>
            </div>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Total Tickets</p>
            <h3 class="text-4xl font-headline font-bold mt-1">1,284</h3>
            <p class="text-xs text-slate-400 mt-4 flex items-center gap-1">
                <span class="material-symbols-outlined text-xs text-primary">trending_up</span>
                vs last 30 days
            </p>
        </div>

        <div class="relative overflow-hidden bg-surface-container-low rounded-3xl p-8 group">
            <div class="absolute top-0 left-0 w-1 h-full bg-tertiary/40"></div>
            <div class="flex justify-between items-start mb-4">
                <span class="p-3 bg-surface-container rounded-2xl text-tertiary">
                    <span class="material-symbols-outlined">schedule</span>
                </span>
                <span class="text-[10px] font-bold py-1 px-2 bg-tertiary/10 text-tertiary rounded-lg">-2m</span>
            </div>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Avg Response Time</p>
            <h3 class="text-4xl font-headline font-bold mt-1">14m</h3>
            <p class="text-xs text-slate-400 mt-4 flex items-center gap-1">
                <span class="material-symbols-outlined text-xs text-tertiary">speed</span>
                Optimized since yesterday
            </p>
        </div>

        <div class="relative overflow-hidden bg-surface-container-low rounded-3xl p-8 group">
            <div class="absolute top-0 left-0 w-1 h-full bg-primary-container/40"></div>
            <div class="flex justify-between items-start mb-4">
                <span class="p-3 bg-surface-container rounded-2xl text-primary-container">
                    <span class="material-symbols-outlined">task_alt</span>
                </span>
                <div class="flex -space-x-2">
                    <img alt="Team member avatar" class="w-6 h-6 rounded-full border-2 border-surface-container-low" src="https://ui-avatars.com/api/?name=Alex+Rivera&background=818cf8&color=fff&size=64" />
                    <img alt="Team member avatar" class="w-6 h-6 rounded-full border-2 border-surface-container-low" src="https://ui-avatars.com/api/?name=Lydia+Chen&background=c084fc&color=fff&size=64" />
                </div>
            </div>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Resolution Rate</p>
            <h3 class="text-4xl font-headline font-bold mt-1">94.2%</h3>
            <div class="w-full bg-surface-container-highest h-1.5 rounded-full mt-5 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-primary to-primary-container w-[94%]"></div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <div class="space-y-6">
            <div class="flex items-center justify-between px-2">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-tertiary animate-pulse"></div>
                    <h4 class="font-headline font-bold text-lg">New</h4>
                    <span class="px-2 py-0.5 bg-surface-container-highest rounded-lg text-[10px] font-bold text-slate-400">3</span>
                </div>
                <button class="text-slate-500 hover:text-on-surface">
                    <span class="material-symbols-outlined text-xl">more_horiz</span>
                </button>
            </div>
            <div class="space-y-4">
                <div class="bg-surface-container hover:bg-surface-bright p-5 rounded-2xl transition-all cursor-pointer group border border-outline-variant/10">
                    <div class="flex justify-between items-start mb-3">
                        <span class="px-2 py-1 bg-tertiary/10 text-tertiary text-[9px] font-bold rounded uppercase tracking-wider">High Priority</span>
                        <span class="text-[10px] text-slate-500 font-medium">5m ago</span>
                    </div>
                    <h5 class="font-semibold text-on-surface mb-2 group-hover:text-primary transition-colors">Login issue</h5>
                    <div class="flex items-center gap-3 mt-4">
                        <img alt="Sarah Miller avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Sarah+Miller&background=c084fc&color=fff&size=64" />
                        <span class="text-xs font-medium text-slate-400">Sarah Miller</span>
                    </div>
                </div>

                <div class="bg-surface-container hover:bg-surface-bright p-5 rounded-2xl transition-all cursor-pointer group border border-outline-variant/10">
                    <div class="flex justify-between items-start mb-3">
                        <span class="px-2 py-1 bg-primary/10 text-primary text-[9px] font-bold rounded uppercase tracking-wider">Billing</span>
                        <span class="text-[10px] text-slate-500 font-medium">12m ago</span>
                    </div>
                    <h5 class="font-semibold text-on-surface mb-2 group-hover:text-primary transition-colors">Payment failed</h5>
                    <div class="flex items-center gap-3 mt-4">
                        <img alt="John Doe avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=818cf8&color=fff&size=64" />
                        <span class="text-xs font-medium text-slate-400">John Doe</span>
                    </div>
                </div>

                <div class="bg-surface-container hover:bg-surface-bright p-5 rounded-2xl transition-all cursor-pointer group border border-outline-variant/10">
                    <div class="flex justify-between items-start mb-3">
                        <span class="px-2 py-1 bg-surface-container-highest text-slate-400 text-[9px] font-bold rounded uppercase tracking-wider">Technical</span>
                        <span class="text-[10px] text-slate-500 font-medium">20m ago</span>
                    </div>
                    <h5 class="font-semibold text-on-surface mb-2 group-hover:text-primary transition-colors">Bug in dashboard</h5>
                    <div class="flex items-center gap-3 mt-4">
                        <img alt="Elena Ross avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Elena+Ross&background=34d399&color=fff&size=64" />
                        <span class="text-xs font-medium text-slate-400">Elena Ross</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="flex items-center justify-between px-2">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-primary"></div>
                    <h4 class="font-headline font-bold text-lg">In Progress</h4>
                    <span class="px-2 py-0.5 bg-surface-container-highest rounded-lg text-[10px] font-bold text-slate-400">2</span>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-surface-container hover:bg-surface-bright p-5 rounded-2xl transition-all cursor-pointer group border border-outline-variant/10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-2">
                        <span class="material-symbols-outlined text-primary text-sm">auto_mode</span>
                    </div>
                    <div class="flex justify-between items-start mb-3">
                        <span class="px-2 py-1 bg-error/10 text-error text-[9px] font-bold rounded uppercase tracking-wider">Critical</span>
                        <span class="text-[10px] text-slate-500 font-medium">Started 1h ago</span>
                    </div>
                    <h5 class="font-semibold text-on-surface mb-2 group-hover:text-primary transition-colors">API Timeout</h5>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center gap-3">
                            <img alt="Marcus Thornton avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Marcus+Thornton&background=f87171&color=fff&size=64" />
                            <span class="text-xs font-medium text-slate-400">Marcus Thornton</span>
                        </div>
                        <div class="flex -space-x-1">
                            <img alt="Team member avatar" class="w-4 h-4 rounded-full border border-surface-container" src="https://ui-avatars.com/api/?name=Team&background=818cf8&color=fff&size=32" />
                        </div>
                    </div>
                </div>

                <div class="bg-surface-container hover:bg-surface-bright p-5 rounded-2xl transition-all cursor-pointer group border border-outline-variant/10">
                    <div class="flex justify-between items-start mb-3">
                        <span class="px-2 py-1 bg-primary/10 text-primary text-[9px] font-bold rounded uppercase tracking-wider">UI/UX</span>
                        <span class="text-[10px] text-slate-500 font-medium">Started 2h ago</span>
                    </div>
                    <h5 class="font-semibold text-on-surface mb-2 group-hover:text-primary transition-colors">UI Clipping issue</h5>
                    <div class="flex items-center gap-3 mt-4">
                        <img alt="Lydia Chen avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Lydia+Chen&background=c084fc&color=fff&size=64" />
                        <span class="text-xs font-medium text-slate-400">Lydia Chen</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="flex items-center justify-between px-2">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                    <h4 class="font-headline font-bold text-lg">Resolved</h4>
                    <span class="px-2 py-0.5 bg-surface-container-highest rounded-lg text-[10px] font-bold text-slate-400">2</span>
                </div>
            </div>
            <div class="space-y-4 opacity-70">
                <div class="bg-surface-container hover:bg-surface-bright p-5 rounded-2xl transition-all cursor-pointer group border border-outline-variant/10">
                    <div class="flex justify-between items-start mb-3">
                        <span class="px-2 py-1 bg-emerald-400/10 text-emerald-400 text-[9px] font-bold rounded uppercase tracking-wider">Success</span>
                        <span class="text-[10px] text-slate-500 font-medium">1h ago</span>
                    </div>
                    <h5 class="font-semibold text-slate-400 mb-2 line-through">Reset Password</h5>
                    <div class="flex items-center gap-3 mt-4">
                        <img alt="Alex Rivera avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Alex+Rivera&background=818cf8&color=fff&size=64" />
                        <span class="text-xs font-medium text-slate-500">Alex Rivera</span>
                    </div>
                </div>

                <div class="bg-surface-container hover:bg-surface-bright p-5 rounded-2xl transition-all cursor-pointer group border border-outline-variant/10">
                    <div class="flex justify-between items-start mb-3">
                        <span class="px-2 py-1 bg-emerald-400/10 text-emerald-400 text-[9px] font-bold rounded uppercase tracking-wider">Onboarding</span>
                        <span class="text-[10px] text-slate-500 font-medium">3h ago</span>
                    </div>
                    <h5 class="font-semibold text-slate-400 mb-2 line-through">New account setup</h5>
                    <div class="flex items-center gap-3 mt-4">
                        <img alt="Chloe Smith avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Chloe+Smith&background=34d399&color=fff&size=64" />
                        <span class="text-xs font-medium text-slate-500">Chloe Smith</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-16 grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div>
            <div class="flex items-center justify-between mb-8">
                <h3 class="font-headline font-bold text-xl">Recent Activity</h3>
                <div class="flex items-center gap-2">
                    <div class="w-1 h-1 rounded-full bg-primary"></div>
                    <a class="text-xs font-bold text-primary uppercase tracking-widest hover:underline" href="#">View All</a>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex items-center gap-4 p-4 hover:bg-surface-bright rounded-2xl transition-all cursor-pointer group">
                    <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">forum</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">New message from Marcus Thornton</p>
                        <p class="text-[10px] text-slate-500">Regarding "API Timeout" ticket #842</p>
                    </div>
                    <span class="text-[10px] text-slate-500 font-bold">2m</span>
                </div>

                <div class="flex items-center gap-4 p-4 hover:bg-surface-bright rounded-2xl transition-all cursor-pointer group">
                    <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-tertiary">
                        <span class="material-symbols-outlined">assignment_turned_in</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Alex Rivera resolved "Reset Password"</p>
                        <p class="text-[10px] text-slate-500">Ticket completed in 4 minutes</p>
                    </div>
                    <span class="text-[10px] text-slate-500 font-bold">1h</span>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-low p-8 rounded-3xl">
            <h3 class="font-headline font-bold text-xl mb-8">Team Performance</h3>
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-bold text-on-surface">Alex Rivera</span>
                        <span class="text-xs font-bold text-primary">48 Resolved</span>
                    </div>
                    <div class="w-full bg-surface-container-highest h-1 rounded-full">
                        <div class="h-full bg-primary w-[85%]"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-bold text-on-surface">Lydia Chen</span>
                        <span class="text-xs font-bold text-tertiary">32 Resolved</span>
                    </div>
                    <div class="w-full bg-surface-container-highest h-1 rounded-full">
                        <div class="h-full bg-tertiary w-[60%]"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-bold text-on-surface">Marcus Thornton</span>
                        <span class="text-xs font-bold text-primary-container">29 Resolved</span>
                    </div>
                    <div class="w-full bg-surface-container-highest h-1 rounded-full">
                        <div class="h-full bg-primary-container w-[52%]"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
