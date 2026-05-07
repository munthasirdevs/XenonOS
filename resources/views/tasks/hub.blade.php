@extends('layouts.app')

@section('title', 'Active Tasks - XenonOS')

@push('styles')
<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="p-6 lg:p-10">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div class="space-y-2">
            <h1 class="font-headline text-4xl lg:text-5xl tracking-tighter text-on-surface">Active Tasks</h1>
            <p class="text-on-surface-variant text-lg max-w-xl">Precision management for your obsidian-grade infrastructure. Monitor, assign, and execute with absolute clarity.</p>
        </div>
        <button class="bg-gradient-to-br from-primary to-primary/70 text-on-primary font-bold px-8 py-4 rounded-xl shadow-[0_0_20px_rgba(192,193,255,0.2)] flex items-center gap-2 hover:scale-105 transition-transform duration-400 group">
            <span class="material-symbols-outlined text-xl">add</span>
            Create Task
        </button>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
        <aside class="md:col-span-3 space-y-6">
            <div class="bg-surface-container rounded-xl p-6 shadow-sm">
                <h3 class="font-headline text-sm uppercase tracking-widest text-primary mb-6">Execution Filters</h3>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-medium text-on-surface-variant uppercase tracking-wider mb-3">Status Matrix</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" class="rounded border-outline-variant bg-surface-container-low text-primary focus:ring-primary/20 transition-all" />
                                <span class="text-sm text-on-surface-variant group-hover:text-on-surface transition-colors">To Do</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" checked class="rounded border-outline-variant bg-surface-container-low text-primary focus:ring-primary/20 transition-all" />
                                <span class="text-sm text-on-surface-variant group-hover:text-on-surface transition-colors">In Progress</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" class="rounded border-outline-variant bg-surface-container-low text-primary focus:ring-primary/20 transition-all" />
                                <span class="text-sm text-on-surface-variant group-hover:text-on-surface transition-colors">Done</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-on-surface-variant uppercase tracking-wider mb-3">Priority Gradient</label>
                        <div class="flex flex-wrap gap-2">
                            <button class="px-3 py-1.5 rounded-lg bg-surface-container-low border border-outline-variant/20 text-xs hover:border-primary/50 transition-colors">Low</button>
                            <button class="px-3 py-1.5 rounded-lg bg-primary/10 border border-primary/30 text-primary text-xs font-semibold">Medium</button>
                            <button class="px-3 py-1.5 rounded-lg bg-surface-container-low border border-outline-variant/20 text-xs hover:border-primary/50 transition-colors">High</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-surface-container to-surface-container-high rounded-xl p-6 border-l-4 border-primary/40">
                <span class="material-symbols-outlined text-primary mb-4">analytics</span>
                <h4 class="font-headline text-lg text-on-surface mb-2">Weekly Efficiency</h4>
                <p class="text-on-surface-variant text-sm mb-4">You have completed 84% of your high-priority cycles this week.</p>
                <div class="h-1.5 w-full bg-surface-container-low rounded-full overflow-hidden">
                    <div class="h-full bg-primary w-[84%] rounded-full"></div>
                </div>
            </div>
        </aside>

        <section class="md:col-span-9 space-y-4">
            <div class="grid grid-cols-12 px-6 py-3 text-xs font-medium text-on-surface-variant uppercase tracking-widest bg-surface-container-low rounded-t-xl hidden lg:grid">
                <div class="col-span-4">Task Designation</div>
                <div class="col-span-2">Protocol Status</div>
                <div class="col-span-1">Priority</div>
                <div class="col-span-2">Assignee</div>
                <div class="col-span-2">Deadline</div>
                <div class="col-span-1 text-right">Actions</div>
            </div>

            <div class="group bg-surface-container rounded-xl p-6 transition-all duration-400 hover:scale-[1.01] hover:bg-surface-container-high shadow-lg lg:grid lg:grid-cols-12 lg:items-center lg:gap-4 border border-transparent hover:border-primary/10">
                <div class="col-span-4 mb-4 lg:mb-0">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">terminal</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface group-hover:text-primary transition-colors">Initialize Xenon Core v4.2</h3>
                            <p class="text-sm text-on-surface-variant line-clamp-1">Deployment of low-latency kernel updates across primary nodes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0">
                    <span class="flex items-center gap-2 text-sm font-medium text-primary">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        In Progress
                    </span>
                </div>
                <div class="col-span-1 mb-4 lg:mb-0">
                    <span class="px-2.5 py-1 rounded-md bg-red-500/20 text-red-400 text-xs font-bold uppercase border border-red-500/30">High</span>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0 flex items-center gap-2">
                    <img alt="Assignee avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Alex+Rivera&background=818cf8&color=fff&size=32" />
                    <span class="text-sm text-on-surface-variant">Alex Rivera</span>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0">
                    <div class="flex items-center gap-2 text-sm text-on-surface-variant">
                        <span class="material-symbols-outlined text-base">calendar_today</span>
                        <span>Oct 15, 2024</span>
                    </div>
                </div>
                <div class="col-span-1 flex justify-end gap-2">
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">visibility</button>
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">edit</button>
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-emerald-400 transition-colors">check_circle</button>
                </div>
            </div>

            <div class="group bg-surface-container rounded-xl p-6 transition-all duration-400 hover:scale-[1.01] hover:bg-surface-container-high shadow-lg lg:grid lg:grid-cols-12 lg:items-center lg:gap-4 border border-transparent hover:border-primary/10">
                <div class="col-span-4 mb-4 lg:mb-0">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-on-surface-variant">
                            <span class="material-symbols-outlined">database</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface group-hover:text-primary transition-colors">Neural Sync Optimization</h3>
                            <p class="text-sm text-on-surface-variant line-clamp-1">Database indexing for real-time telemetry processing.</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0">
                    <span class="flex items-center gap-2 text-sm font-medium text-on-surface-variant">
                        <span class="w-2 h-2 rounded-full bg-on-surface-variant"></span>
                        To Do
                    </span>
                </div>
                <div class="col-span-1 mb-4 lg:mb-0">
                    <span class="px-2.5 py-1 rounded-md bg-purple-500/20 text-purple-400 text-xs font-bold uppercase border border-purple-500/30">Medium</span>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0 flex items-center gap-2">
                    <img alt="Assignee avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Marcus+Chen&background=c084fc&color=fff&size=32" />
                    <span class="text-sm text-on-surface-variant">Marcus Chen</span>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0">
                    <div class="flex items-center gap-2 text-sm text-on-surface-variant">
                        <span class="material-symbols-outlined text-base">calendar_today</span>
                        <span>Oct 20, 2024</span>
                    </div>
                </div>
                <div class="col-span-1 flex justify-end gap-2">
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">visibility</button>
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">edit</button>
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-emerald-400 transition-colors">check_circle</button>
                </div>
            </div>

            <div class="group bg-surface-container rounded-xl p-6 transition-all duration-400 hover:scale-[1.01] hover:bg-surface-container-high shadow-lg lg:grid lg:grid-cols-12 lg:items-center lg:gap-4 border border-transparent hover:border-primary/10">
                <div class="col-span-4 mb-4 lg:mb-0">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400">
                            <span class="material-symbols-outlined">security</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface-variant line-through">Biometric Security Audit</h3>
                            <p class="text-sm text-on-surface-variant/60 line-clamp-1">Compliance review of facial recognition protocols.</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0">
                    <span class="flex items-center gap-2 text-sm font-medium text-emerald-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Done
                    </span>
                </div>
                <div class="col-span-1 mb-4 lg:mb-0">
                    <span class="px-2.5 py-1 rounded-md bg-surface-container-highest text-on-surface-variant text-xs font-bold uppercase border border-outline-variant/20">Low</span>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0 flex items-center gap-2">
                    <img alt="Assignee avatar" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Sara+Ross&background=34d399&color=fff&size=32" />
                    <span class="text-sm text-on-surface-variant">Sara Ross</span>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0">
                    <div class="flex items-center gap-2 text-sm text-on-surface-variant">
                        <span class="material-symbols-outlined text-base">calendar_today</span>
                        <span>Oct 10, 2024</span>
                    </div>
                </div>
                <div class="col-span-1 flex justify-end gap-2">
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">visibility</button>
                    <button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">edit</button>
                    <button class="material-symbols-outlined text-emerald-400">check_circle</button>
                </div>
            </div>

            <div class="group bg-gradient-to-br from-surface-container to-[#1a1e2e] rounded-xl p-8 transition-all duration-400 hover:shadow-2xl lg:grid lg:grid-cols-12 lg:items-center lg:gap-4 border border-primary/5 relative overflow-hidden">
                <div class="absolute -right-12 -top-12 w-32 h-32 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="col-span-5 mb-4 lg:mb-0 relative z-10">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 rounded-xl bg-primary flex items-center justify-center text-on-primary shadow-[0_0_20px_rgba(192,193,255,0.4)]">
                            <span class="material-symbols-outlined text-3xl">rocket_launch</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-primary tracking-[0.2em] uppercase mb-1 block">Critical Milestone</span>
                            <h3 class="font-headline text-2xl text-on-surface">Galaxy Gate Beta Integration</h3>
                            <p class="text-sm text-on-surface-variant mt-1">Full-stack bridge between internal Xenon protocols and public API nodes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0">
                    <span class="flex flex-col">
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-wider mb-1">Status</span>
                        <span class="text-primary font-bold">Awaiting Input</span>
                    </span>
                </div>
                <div class="col-span-2 mb-4 lg:mb-0">
                    <span class="flex flex-col">
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-wider mb-1">Due Date</span>
                        <span class="text-on-surface font-medium">Oct 24, 2024</span>
                    </span>
                </div>
                <div class="col-span-3 flex justify-end gap-3">
                    <button class="bg-surface-container-highest text-on-surface-variant px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-surface-bright transition-all">Details</button>
                    <button class="bg-primary text-on-primary px-5 py-2.5 rounded-lg text-sm font-bold shadow-lg hover:brightness-110 transition-all">Initialize</button>
                </div>
            </div>

            <div class="pt-8 flex justify-center">
                <button class="text-on-surface-variant text-sm font-medium flex items-center gap-2 hover:text-primary transition-colors group">
                    Load more encrypted tasks
                    <span class="material-symbols-outlined text-lg group-hover:translate-y-1 transition-transform">expand_more</span>
                </button>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script></script>
@endpush
