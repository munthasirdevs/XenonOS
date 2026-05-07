@extends('layouts.app')

@section('title', 'XenonOS | Project Alpha - Team')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/projects-team.css') }}">
@endpush

@section('content')
    <!-- Section 3: Branding & Strategic Resource Controls -->
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
        <div>
            <h2 class="font-headline font-extrabold text-4xl text-on-surface tracking-tight mb-2">Quantum Leap
                Framework</h2>
            <div class="flex items-center gap-4 text-on-surface-variant">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                    Oct 2024 - Jan 2025
                </span>
                <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">lock</span>
                    Internal Workspace
                </span>
            </div>
        </div>
        <div class="flex gap-3">
            <button
                class="bg-surface-container-highest px-6 py-2.5 rounded-xl text-on-surface font-medium border border-outline-variant/20 hover:bg-surface-container transition-colors">
                Manage Roles
            </button>
            <button
                class="indigo-glow-cta px-6 py-2.5 rounded-xl text-on-primary-container font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">person_add</span>
                Add Member
            </button>
        </div>
    </div>

    <!-- Section 4: Project Force Distribution -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-6">
        <!-- Large Card: Project Lead -->
        <div
            class="lg:col-span-8 obsidian-card rounded-xl p-8 flex flex-col md:flex-row gap-8 items-center border border-outline-variant/5 hover:border-primary/10">
            <div class="relative">
                <div class="w-32 h-32 rounded-2xl overflow-hidden ring-4 ring-primary/20">
                    <img alt="Lead Architect" class="w-full h-full object-cover"
                        src="https://ui-avatars.com/api/?name=Adrian+Ross&background=818cf8&color=fff&size=128&bold=true" />
                </div>
                <div class="absolute -bottom-2 -right-2 bg-primary p-1.5 rounded-lg shadow-xl">
                    <span class="material-symbols-outlined text-on-primary text-xl">verified</span>
                </div>
            </div>
            <div class="flex-1 text-center md:text-left">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-on-surface">Adrian Ross</h3>
                        <p class="text-primary font-medium tracking-wide">LEAD ARCHITECT</p>
                    </div>
                    <div
                        class="bg-surface-container-lowest px-4 py-1.5 rounded-full text-xs font-semibold text-primary border border-primary/20">
                        ACTIVE - 100% ALLOCATED
                    </div>
                </div>
                <p class="text-on-surface-variant text-sm leading-relaxed mb-6 max-w-xl">
                    Driving the core infrastructure and scalability patterns for the Quantum Leap environment.
                    Overseeing all sub-modules and integration protocols.
                </p>
                <div class="flex gap-3 justify-center md:justify-start">
                    <button
                        class="bg-primary/10 text-primary px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary/20 transition-all">
                        Reassign
                    </button>
                    <button class="text-on-surface-variant hover:text-on-surface p-2 transition-colors">
                        <span class="material-symbols-outlined">more_horiz</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Small Card: UI Designer -->
        <div
            class="lg:col-span-4 obsidian-card rounded-xl p-6 border border-outline-variant/5 hover:border-primary/10 flex flex-col">
            <div class="flex items-start justify-between mb-4">
                <div class="w-16 h-16 rounded-xl overflow-hidden border border-outline-variant/30">
                    <img alt="Elena Chen" class="w-full h-full object-cover"
                        src="https://ui-avatars.com/api/?name=Elena+Chen&background=c084fc&color=fff&size=64&bold=true" />
                </div>
                <div
                    class="flex h-8 items-center bg-surface-container-lowest px-3 rounded-full text-[10px] font-bold text-tertiary border border-tertiary/20">
                    AVAILABLE (20%)
                </div>
            </div>
            <h4 class="text-lg font-bold text-on-surface">Elena Chen</h4>
            <p class="text-on-surface-variant text-xs uppercase tracking-widest mb-4">UI Designer</p>
            <div class="mt-auto flex justify-between items-center">
                <div class="flex -space-x-2">
                    <div
                        class="w-6 h-6 rounded-full bg-surface-container-highest border border-outline-variant text-[8px] flex items-center justify-center font-bold">
                        PS
                    </div>
                    <div
                        class="w-6 h-6 rounded-full bg-surface-container-highest border border-outline-variant text-[8px] flex items-center justify-center font-bold">
                        FI
                    </div>
                </div>
                <button class="text-primary text-sm font-bold flex items-center gap-1 hover:underline">
                    Assign Task
                    <span class="material-symbols-outlined text-sm">arrow_outward</span>
                </button>
            </div>
        </div>

        <!-- Standard Card: Dev Ops -->
        <div
            class="lg:col-span-4 obsidian-card rounded-xl p-6 border border-outline-variant/5 hover:border-primary/10 flex flex-col">
            <div class="flex items-start justify-between mb-4">
                <div class="w-16 h-16 rounded-xl overflow-hidden border border-outline-variant/30">
                    <img alt="Marcus Thornton" class="w-full h-full object-cover"
                        src="https://ui-avatars.com/api/?name=Marcus+Thornton&background=34d399&color=fff&size=64&bold=true" />
                </div>
                <div
                    class="flex h-8 items-center bg-surface-container-lowest px-3 rounded-full text-[10px] font-bold text-success border border-success/20">
                    ON LEAVE
                </div>
            </div>
            <h4 class="text-lg font-bold text-on-surface">Marcus Thornton</h4>
            <p class="text-on-surface-variant text-xs uppercase tracking-widest mb-4">Dev Ops Lead</p>
            <div class="mt-auto flex justify-between items-center">
                <div class="text-xs text-on-surface-variant">Returns Oct 22</div>
                <button
                    class="bg-surface-container-highest p-2 rounded-lg text-on-surface-variant hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-xl">mail</span>
                </button>
            </div>
        </div>

        <!-- Standard Card: Backend Engineer -->
        <div
            class="lg:col-span-4 obsidian-card rounded-xl p-6 border border-outline-variant/5 hover:border-primary/10 flex flex-col">
            <div class="flex items-start justify-between mb-4">
                <div class="w-16 h-16 rounded-xl overflow-hidden border border-outline-variant/30">
                    <img alt="Sarah Jenkins" class="w-full h-full object-cover"
                        src="https://ui-avatars.com/api/?name=Sarah+Jenkins&background=818cf8&color=fff&size=64&bold=true" />
                </div>
                <div
                    class="flex h-8 items-center bg-surface-container-lowest px-3 rounded-full text-[10px] font-bold text-primary border border-primary/20">
                    ACTIVE (80%)
                </div>
            </div>
            <h4 class="text-lg font-bold text-on-surface">Sarah Jenkins</h4>
            <p class="text-on-surface-variant text-xs uppercase tracking-widest mb-4">Backend Engineer</p>
            <div class="mt-auto flex justify-between items-center">
                <div class="flex gap-1">
                    <div class="w-2 h-2 rounded-full bg-primary"></div>
                    <div class="w-2 h-2 rounded-full bg-primary"></div>
                    <div class="w-2 h-2 rounded-full bg-primary"></div>
                    <div class="w-2 h-2 rounded-full bg-outline-variant"></div>
                </div>
                <button class="text-primary text-sm font-bold flex items-center gap-1 hover:underline">
                    View Profile
                </button>
            </div>
        </div>

        <!-- Standard Card: QA Specialist -->
        <div
            class="lg:col-span-4 obsidian-card rounded-xl p-6 border border-outline-variant/5 hover:border-primary/10 flex flex-col">
            <div class="flex items-start justify-between mb-4">
                <div class="w-16 h-16 rounded-xl overflow-hidden border border-outline-variant/30">
                    <img alt="Luke Morris" class="w-full h-full object-cover"
                        src="https://ui-avatars.com/api/?name=Luke+Morris&background=f87171&color=fff&size=64&bold=true" />
                </div>
                <div
                    class="flex h-8 items-center bg-surface-container-lowest px-3 rounded-full text-[10px] font-bold text-error border border-error/20">
                    OVERLOADED
                </div>
            </div>
            <h4 class="text-lg font-bold text-on-surface">Luke Morris</h4>
            <p class="text-on-surface-variant text-xs uppercase tracking-widest mb-4">QA Specialist</p>
            <div class="mt-auto flex justify-between items-center">
                <span class="text-xs text-error font-medium">6 Critical Tasks</span>
                <button
                    class="bg-error/10 text-error px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-error/20 transition-all">
                    Relieve
                </button>
            </div>
        </div>

        <!-- Section 5: Team Performance & Morale Tracking -->
        <div
            class="lg:col-span-12 bg-surface-container-low rounded-2xl p-8 border border-outline-variant/10 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-primary/5 blur-[100px] rounded-full -translate-y-1/2 translate-x-1/2">
            </div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-center md:text-left">
                    <h3 class="text-xl font-bold text-on-surface mb-2">Team Efficiency</h3>
                    <p class="text-on-surface-variant text-sm">Overall Capacity for Sprint 14 is at 84%. Team
                        morale is trending upward.</p>
                </div>
                <div class="flex gap-12">
                    <div class="text-center">
                        <div class="text-3xl font-headline font-extrabold text-primary">12</div>
                        <div class="text-xs uppercase tracking-tighter text-on-surface-variant font-bold mt-1">
                            Total Members
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-headline font-extrabold text-tertiary">08</div>
                        <div class="text-xs uppercase tracking-tighter text-on-surface-variant font-bold mt-1">
                            Full-Time
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-headline font-extrabold text-on-surface">04</div>
                        <div class="text-xs uppercase tracking-tighter text-on-surface-variant font-bold mt-1">
                            External
                        </div>
                    </div>
                </div>
                <button
                    class="bg-surface-container-highest px-6 py-3 rounded-xl text-on-surface font-bold border border-outline-variant/20 hover:bg-primary hover:text-on-primary transition-all">
                    Team Audit
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/projects-team.js') }}"></script>
@endpush
