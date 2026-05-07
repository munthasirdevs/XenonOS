@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-details.css') }}">
@endpush

@section('title', 'Project Details - XenonOS')

@section('content')
<x-navbar />

<main class="flex-1 md:ml-[260px] min-h-screen">
    <div class="p-6 md:p-8">
        <!-- Project Header -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12">
            <div class="space-y-4 max-w-2xl">
                <div class="flex items-center gap-3">
                    <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase border border-primary/20">Active</span>
                    <span class="text-on-surface-variant text-sm font-medium flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
                        High Priority
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl font-headline font-light tracking-tight text-on-surface">
                    Lumina <span class="text-primary font-bold tracking-tighter">Rebrand</span>
                </h1>
                <div class="flex flex-col gap-2">
                    <a class="text-primary hover:text-primary-container transition-colors text-lg font-semibold flex items-center gap-2" href="#">
                        Aura Dynamics
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                    </a>
                    <p class="text-on-surface-variant leading-relaxed max-w-xl">
                        Q4 Brand identity overhaul including logo, style guide, and digital assets.
                    </p>
                </div>
            </div>
            <div class="flex gap-3">
                <button class="px-6 py-2.5 bg-surface-container border border-outline-variant/20 rounded-xl text-sm font-semibold hover:bg-surface-bright transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">edit</span>
                    Edit Project
                </button>
                <button class="p-2.5 bg-surface-container border border-outline-variant/20 rounded-xl hover:bg-surface-bright transition-colors">
                    <span class="material-symbols-outlined">more_vert</span>
                </button>
            </div>
        </header>

        <!-- Metrics -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-surface-container-low p-6 rounded-3xl border-l-2 border-primary/50">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase mb-4 block">Current Progress</span>
                <div class="flex items-end justify-between mb-2">
                    <span class="text-3xl font-headline font-semibold text-primary">75%</span>
                    <span class="text-xs text-on-surface-variant font-medium">3 of 4 phases</span>
                </div>
                <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="h-full bg-primary rounded-full" style="width: 75%"></div>
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-3xl border-l-2 border-tertiary/50">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase mb-4 block">Deadline</span>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-tertiary">event</span>
                    <div>
                        <span class="text-xl font-headline font-semibold block text-on-surface">Oct 24, 2024</span>
                        <span class="text-xs text-on-surface-variant">12 days remaining</span>
                    </div>
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-3xl border-l-2 border-outline-variant/50">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase mb-4 block">Assigned Team</span>
                <div class="flex -space-x-3 items-center">
                    <img alt="Team" class="w-10 h-10 rounded-full border-2 border-surface-container-low object-cover" src="https://ui-avatars.com/api/?name=JD&background=818cf8&color=fff" />
                    <img alt="Team" class="w-10 h-10 rounded-full border-2 border-surface-container-low object-cover" src="https://ui-avatars.com/api/?name=AS&background=34d399&color=fff" />
                    <img alt="Team" class="w-10 h-10 rounded-full border-2 border-surface-container-low object-cover" src="https://ui-avatars.com/api/?name=MK&background=c084fc&color=fff" />
                    <div class="w-10 h-10 rounded-full border-2 border-surface-container-low bg-surface-container-highest flex items-center justify-center text-xs font-bold text-primary">+2</div>
                    <span class="ml-6 text-xs text-on-surface-variant font-medium">4 Core Members</span>
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-3xl border-l-2 border-secondary/50">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase mb-4 block">Service Type</span>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">brush</span>
                    <div>
                        <span class="text-lg font-headline font-semibold block text-on-surface leading-tight">Branding & UI Design</span>
                        <span class="text-xs text-on-surface-variant">Identity Package</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Column -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Active Tasks -->
                <section class="bg-surface-container-low rounded-3xl p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-xl font-headline font-semibold text-on-surface">Active Tasks</h3>
                            <p class="text-sm text-on-surface-variant">Milestones for the current sprint</p>
                        </div>
                        <button class="text-primary font-bold text-xs tracking-wide flex items-center gap-2">
                            <span class="w-1 h-1 bg-primary rounded-full"></span>
                            VIEW ALL TASKS
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl hover:bg-surface-bright transition-all">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-primary">check_circle</span>
                                <span class="text-sm font-medium text-on-surface-variant line-through opacity-60">Finalize Color Palette</span>
                            </div>
                            <span class="text-[10px] font-bold bg-primary/10 text-primary px-2 py-0.5 rounded uppercase">Done</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl hover:bg-surface-bright transition-all">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-tertiary">radio_button_checked</span>
                                <span class="text-sm font-medium text-on-surface">Iconography Set</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <img alt="Assignee" class="w-6 h-6 rounded-full border border-outline-variant/30" src="https://ui-avatars.com/api/?name=AS&background=34d399&color=fff" />
                                <span class="text-[10px] font-bold text-tertiary px-2 py-0.5 rounded uppercase">In Progress</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl hover:bg-surface-bright transition-all">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-outline">circle</span>
                                <span class="text-sm font-medium text-on-surface">Style Guide PDF Production</span>
                            </div>
                            <span class="text-[10px] font-bold text-on-surface-variant px-2 py-0.5 rounded uppercase">Pending</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl hover:bg-surface-bright transition-all">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-outline">circle</span>
                                <span class="text-sm font-medium text-on-surface">Responsive Web Mockups</span>
                            </div>
                            <span class="text-[10px] font-bold text-on-surface-variant px-2 py-0.5 rounded uppercase">Pending</span>
                        </div>
                    </div>
                    <button class="mt-6 p-4 border-2 border-dashed border-outline-variant/20 rounded-2xl text-on-surface-variant hover:text-primary hover:border-primary/40 hover:bg-primary/5 transition-all font-medium text-sm flex items-center justify-center gap-2 w-full">
                        <span class="material-symbols-outlined text-lg">add_circle</span>
                        Add New Task
                    </button>
                </section>

                <!-- Asset Vault -->
                <section class="bg-surface-container-low rounded-3xl p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-xl font-headline font-semibold text-on-surface">Asset Vault</h3>
                        <button class="px-4 py-2 bg-primary text-on-primary rounded-xl text-xs font-bold hover:scale-95 transition-transform flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">upload</span>
                            UPLOAD
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-surface-container rounded-2xl border border-outline-variant/10 flex items-center gap-4 group hover:bg-surface-bright transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">folder_zip</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-on-surface truncate">Lumina_Final_Assets.zip</p>
                                <p class="text-[10px] text-on-surface-variant">ZIP • 45.2 MB • Oct 10</p>
                            </div>
                            <button class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100">download</button>
                        </div>
                        <div class="p-4 bg-surface-container rounded-2xl border border-outline-variant/10 flex items-center gap-4 group hover:bg-surface-bright transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-tertiary/10 flex items-center justify-center text-tertiary">
                                <span class="material-symbols-outlined">description</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-on-surface truncate">Brand_Strategy_Draft.pdf</p>
                                <p class="text-[10px] text-on-surface-variant">PDF • 2.1 MB • Oct 08</p>
                            </div>
                            <button class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100">download</button>
                        </div>
                        <div class="p-4 bg-surface-container rounded-2xl border border-outline-variant/10 flex items-center gap-4 group hover:bg-surface-bright transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-secondary/10 flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined">image</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-on-surface truncate">Main_Logo_Black.png</p>
                                <p class="text-[10px] text-on-surface-variant">PNG • 840 KB • Oct 05</p>
                            </div>
                            <button class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100">download</button>
                        </div>
                        <div class="p-4 bg-surface-container rounded-2xl border border-outline-variant/10 flex items-center gap-4 group hover:bg-surface-bright transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-success/10 flex items-center justify-center text-success">
                                <span class="material-symbols-outlined">image</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-on-surface truncate">Brand_Guidelines_v2.pdf</p>
                                <p class="text-[10px] text-on-surface-variant">PDF • 5.4 MB • Oct 01</p>
                            </div>
                            <button class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100">download</button>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Activity -->
                <div class="bg-surface-container-low p-6 rounded-3xl">
                    <h3 class="text-lg font-headline font-semibold text-on-surface mb-6">Activity</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <img alt="User" class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=AS&background=34d399&color=fff" />
                            <div>
                                <p class="text-sm text-on-surface"><span class="font-semibold">Alex Santos</span> uploaded 3 files</p>
                                <p class="text-xs text-on-surface-variant">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <img alt="User" class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=JD&background=818cf8&color=fff" />
                            <div>
                                <p class="text-sm text-on-surface"><span class="font-semibold">John Doe</span> completed "Iconography Set"</p>
                                <p class="text-xs text-on-surface-variant">Yesterday</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <img alt="User" class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=MK&background=c084fc&color=fff" />
                            <div>
                                <p class="text-sm text-on-surface"><span class="font-semibold">Maria Kim</span> added comment</p>
                                <p class="text-xs text-on-surface-variant">2 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/projects-details.js') }}"></script>
@endpush