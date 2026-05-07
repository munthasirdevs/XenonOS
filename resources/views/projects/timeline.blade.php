@extends('layouts.app')

@section('content')
<x-navbar />

<main class="min-h-screen relative flex flex-col">
    <div class="mt-20 p-8 flex-1">
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-3 py-1 rounded-full bg-primary-container/20 text-primary text-xs font-bold tracking-widest uppercase">Active Production</span>
                    <span class="text-on-surface-variant text-sm font-medium">Updated 2h ago</span>
                </div>
                <h2 class="text-5xl font-['Syne'] font-extrabold text-on-surface tracking-tight leading-none mb-4">Quantum Leap Framework</h2>
                <div class="flex items-center gap-6">
                    <div class="flex -space-x-3">
                        <img alt="Team member" class="w-10 h-10 rounded-full border-2 border-background object-cover" src="https://ui-avatars.com/api/?name=Alex&background=6366f1&color=fff&size=40" />
                        <img alt="Team member" class="w-10 h-10 rounded-full border-2 border-background object-cover" src="https://ui-avatars.com/api/?name=Sarah&background=8b5cf6&color=fff&size=40" />
                        <img alt="Team member" class="w-10 h-10 rounded-full border-2 border-background object-cover" src="https://ui-avatars.com/api/?name=Mike&background=a855f7&color=fff&size=40" />
                        <div class="w-10 h-10 rounded-full border-2 border-background bg-surface-container-highest flex items-center justify-center text-xs font-bold text-on-surface-variant">+8</div>
                    </div>
                    <div class="h-10 w-[1px] bg-outline-variant/20"></div>
                    <div class="flex flex-col">
                        <span class="text-xs text-on-surface-variant font-bold uppercase tracking-tighter">Overall Progress</span>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-bold font-['Syne']">64%</span>
                            <div class="w-32 h-1.5 bg-surface-container-lowest rounded-full overflow-hidden">
                                <div class="h-full indigo-glow w-[64%] shadow-[0_0_12px_rgba(192,193,255,0.4)]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                <button class="px-6 py-3 bg-surface-container hover:bg-surface-container-high text-on-surface rounded-xl font-semibold transition-all duration-400 flex items-center gap-2 ghost-border">
                    <span class="material-symbols-outlined text-lg" data-icon="ios_share">ios_share</span>
                    Export PDF
                </button>
                <button class="px-6 py-3 indigo-glow text-on-primary-container rounded-xl font-bold shadow-lg flex items-center gap-2 hover:scale-[1.02] transition-transform">
                    <span class="material-symbols-outlined" data-icon="edit">edit</span>
                    Edit Roadmap
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-surface-container p-6 rounded-2xl hover:scale-[1.02] transition-all duration-400 ghost-border group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-tertiary-container/20 rounded-xl">
                            <span class="material-symbols-outlined text-tertiary" data-icon="flag">flag</span>
                        </div>
                        <span class="text-xs font-bold text-tertiary bg-tertiary-container/10 px-2 py-1 rounded">High Priority</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Beta V1.0 Release</h3>
                    <p class="text-on-surface-variant text-sm mb-4 leading-relaxed">System integration for core quantum modules and real-time visualization layer.</p>
                    <div class="flex items-center gap-2 text-primary font-bold">
                        <span class="material-symbols-outlined text-sm" data-icon="calendar_today">calendar_today</span>
                        <span class="text-sm">Oct 24, 2024</span>
                    </div>
                </div>
                <div class="bg-surface-container-lowest p-6 rounded-2xl ghost-border border-dashed">
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <div class="w-12 h-12 rounded-full border-2 border-dashed border-outline-variant flex items-center justify-center mb-4 text-on-surface-variant group-hover:text-primary transition-colors">
                            <span class="material-symbols-outlined" data-icon="add">add</span>
                        </div>
                        <h4 class="font-bold mb-1">Add Milestone</h4>
                        <p class="text-xs text-on-surface-variant">Define next project anchor point</p>
                    </div>
                </div>
                <div class="bg-surface-container p-6 rounded-2xl ghost-border overflow-hidden relative">
                    <div class="absolute -right-4 -top-4 opacity-10">
                        <span class="material-symbols-outlined text-9xl" data-icon="analytics">analytics</span>
                    </div>
                    <h3 class="text-lg font-bold mb-4">Velocity Tracker</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-end">
                            <span class="text-xs text-on-surface-variant uppercase font-bold">Discovery</span>
                            <span class="text-xs font-mono">100%</span>
                        </div>
                        <div class="w-full h-1 bg-surface-container-lowest rounded-full overflow-hidden">
                            <div class="h-full bg-primary w-full"></div>
                        </div>
                        <div class="flex justify-between items-end">
                            <span class="text-xs text-on-surface-variant uppercase font-bold">Development</span>
                            <span class="text-xs font-mono">42%</span>
                        </div>
                        <div class="w-full h-1 bg-surface-container-lowest rounded-full overflow-hidden">
                            <div class="h-full bg-primary w-[42%]"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 bg-surface-container rounded-2xl p-8 ghost-border relative overflow-hidden">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-2xl font-syne font-extrabold tracking-tight">Timeline Architecture</h3>
                    <div class="flex bg-surface-container-lowest p-1 rounded-lg">
                        <button class="px-4 py-1.5 rounded-md text-xs font-bold transition-all bg-surface-container-high text-on-surface">Weekly</button>
                        <button class="px-4 py-1.5 rounded-md text-xs font-bold transition-all text-on-surface-variant hover:text-on-surface">Monthly</button>
                        <button class="px-4 py-1.5 rounded-md text-xs font-bold transition-all text-on-surface-variant hover:text-on-surface">Quarterly</button>
                    </div>
                </div>
                <div class="relative space-y-12">
                    <div class="absolute left-[27px] top-4 bottom-4 w-[2px] bg-gradient-to-b from-primary/60 via-primary/20 to-transparent"></div>

                    <div class="relative flex gap-8 group">
                        <div class="z-10 w-14 h-14 rounded-2xl bg-primary flex items-center justify-center shadow-[0_0_20px_rgba(192,193,255,0.4)]">
                            <span class="material-symbols-outlined text-on-primary" data-icon="search">search</span>
                        </div>
                        <div class="flex-1 pb-4">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-xl font-bold font-syne">Phase 01: Discovery & Architecture</h4>
                                <span class="flex items-center gap-1 text-primary text-xs font-bold bg-primary/10 px-3 py-1 rounded-full uppercase">
                                    <span class="material-symbols-outlined text-xs" data-icon="check_circle">check_circle</span>
                                    Completed
                                </span>
                            </div>
                            <p class="text-on-surface-variant text-sm mb-4">Initial mapping of quantum logic gates and user journey topology.</p>
                            <div class="flex gap-4">
                                <div class="bg-surface-container-high/50 px-4 py-3 rounded-xl flex-1 ghost-border">
                                    <span class="block text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">Start Date</span>
                                    <span class="text-sm font-bold">Aug 12, 2024</span>
                                </div>
                                <div class="bg-surface-container-high/50 px-4 py-3 rounded-xl flex-1 ghost-border">
                                    <span class="block text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">End Date</span>
                                    <span class="text-sm font-bold">Sep 05, 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex gap-8 group">
                        <div class="z-10 w-14 h-14 rounded-2xl bg-primary flex items-center justify-center shadow-[0_0_20px_rgba(192,193,255,0.2)]">
                            <span class="material-symbols-outlined text-on-primary" data-icon="palette">palette</span>
                        </div>
                        <div class="flex-1 pb-4">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-xl font-bold font-syne">Phase 02: Interface & Motion Logic</h4>
                                <span class="flex items-center gap-1 text-primary text-xs font-bold bg-primary/10 px-3 py-1 rounded-full uppercase">
                                    <span class="material-symbols-outlined text-xs" data-icon="check_circle">check_circle</span>
                                    Completed
                                </span>
                            </div>
                            <p class="text-on-surface-variant text-sm mb-4">Crafting the Nocturnal Precision visual system and spatial component library.</p>
                            <div class="flex gap-4">
                                <div class="bg-surface-container-high/50 px-4 py-3 rounded-xl flex-1 ghost-border">
                                    <span class="block text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">Start Date</span>
                                    <span class="text-sm font-bold">Sep 06, 2024</span>
                                </div>
                                <div class="bg-surface-container-high/50 px-4 py-3 rounded-xl flex-1 ghost-border">
                                    <span class="block text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">End Date</span>
                                    <span class="text-sm font-bold">Oct 10, 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex gap-8 group">
                        <div class="z-10 w-14 h-14 rounded-2xl bg-[#6366f1] flex items-center justify-center shadow-[0_0_30px_rgba(99,102,241,0.5)] outline outline-4 outline-background">
                            <span class="material-symbols-outlined text-white" data-icon="code">code</span>
                        </div>
                        <div class="flex-1 pb-4">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-xl font-bold font-syne text-[#c0c1ff]">Phase 03: Core Engine Development</h4>
                                <span class="flex items-center gap-1 text-on-primary-container text-xs font-bold indigo-glow px-3 py-1 rounded-full uppercase shadow-lg">
                                    <span class="material-symbols-outlined text-xs" data-icon="bolt">bolt</span>
                                    In Progress
                                </span>
                            </div>
                            <p class="text-on-surface-variant text-sm mb-4">Building the distributed ledger and neural sync protocols. Focus on low-latency state management.</p>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="bg-surface-container-highest px-4 py-3 rounded-xl flex-1 border border-primary/20">
                                    <span class="block text-[10px] text-primary uppercase font-bold tracking-widest mb-1">Target Completion</span>
                                    <span class="text-sm font-bold">Nov 15, 2024</span>
                                </div>
                                <div class="bg-surface-container-highest px-4 py-3 rounded-xl flex-1 ghost-border">
                                    <span class="block text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">Current Sprint</span>
                                    <span class="text-sm font-bold">Epic-04: Sync Protocols</span>
                                </div>
                            </div>
                            <div class="w-full h-1 bg-surface-container-lowest rounded-full overflow-hidden">
                                <div class="h-full indigo-glow w-[42%]"></div>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex gap-8 group opacity-40 grayscale">
                        <div class="z-10 w-14 h-14 rounded-2xl bg-surface-container-highest flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-surface-variant" data-icon="bug_report">bug_report</span>
                        </div>
                        <div class="flex-1 pb-4">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-xl font-bold font-syne">Phase 04: Security & Edge Testing</h4>
                                <span class="flex items-center gap-1 text-on-surface-variant text-xs font-bold bg-surface-container-low px-3 py-1 rounded-full uppercase">Pending</span>
                            </div>
                            <p class="text-on-surface-variant text-sm mb-4">Penetration testing and massive stress loads on the edge compute network.</p>
                            <div class="flex gap-4">
                                <div class="bg-surface-container-high/50 px-4 py-3 rounded-xl flex-1 ghost-border">
                                    <span class="block text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">Estimated Start</span>
                                    <span class="text-sm font-bold">Nov 20, 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-timeline.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('js/projects-timeline.js') }}"></script>
@endpush
