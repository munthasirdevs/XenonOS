@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-overview.css') }}">
@endpush

@section('title', 'Project Intelligence - XenonOS')

@section('content')
<x-navbar />

<main class="flex-1 md:ml-[260px] min-h-screen">
    <section class="px-4 md:px-8 pt-8 pb-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-widest border border-primary/20">Active Project</span>
                    <div class="flex items-center gap-1.5 text-on-surface-variant text-sm"><span class="material-symbols-outlined text-xs">calendar_today</span><span>Due Oct 24, 2024</span></div>
                </div>
                <h2 class="text-3xl md:text-5xl font-syne font-extrabold tracking-tight text-on-surface">Neural Core V2</h2>
                <div class="flex items-center gap-6 flex-wrap">
                    <div class="flex -space-x-3">
                        <img alt="Team" class="w-8 h-8 rounded-full border-2 border-background" src="https://ui-avatars.com/api/?name=Alex+Chen&background=818cf8&color=fff" />
                        <img alt="Team" class="w-8 h-8 rounded-full border-2 border-background" src="https://ui-avatars.com/api/?name=Sarah+Miller&background=c084fc&color=fff" />
                        <img alt="Team" class="w-8 h-8 rounded-full border-2 border-background" src="https://ui-avatars.com/api/?name=David+Wong&background=34d399&color=fff" />
                        <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-background flex items-center justify-center text-[10px] font-bold text-on-surface-variant">+12</div>
                    </div>
                    <div class="h-4 w-px bg-outline-variant/30 hidden md:block"></div>
                    <div class="flex-grow max-w-xs space-y-2">
                        <div class="flex justify-between text-xs font-bold text-on-surface-variant"><span>Overall Progress</span><span>68%</span></div>
                        <div class="h-1.5 w-full bg-surface-container rounded-full overflow-hidden"><div class="h-full bg-primary w-[68%]"></div></div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-outline-variant/20 hover:bg-surface-container-high transition-all"><span class="material-symbols-outlined text-lg">edit</span><span class="text-sm font-semibold">Edit</span></button>
                <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-outline-variant/20 hover:bg-surface-container-high transition-all"><span class="material-symbols-outlined text-lg">person_add</span><span class="text-sm font-semibold">Assign</span></button>
                <button class="flex items-center gap-2 px-6 py-2.5 rounded-xl bg-primary text-on-primary font-bold shadow-xl hover:scale-105 transition-all"><span class="material-symbols-outlined text-lg">upload_file</span><span>Upload File</span></button>
            </div>
        </div>
        <div class="mt-6 md:mt-10 flex gap-4 md:gap-8 border-b border-outline-variant/10 overflow-x-auto">
            <a class="pb-4 text-primary font-bold border-b-2 border-primary transition-all flex items-center gap-2 whitespace-nowrap" href="#"><span class="material-symbols-outlined text-sm">space_dashboard</span> Overview</a>
            <a class="pb-4 text-on-surface-variant hover:text-on-surface transition-all flex items-center gap-2 whitespace-nowrap" href="#"><span class="material-symbols-outlined text-sm">timeline</span> Timeline</a>
            <a class="pb-4 text-on-surface-variant hover:text-on-surface transition-all flex items-center gap-2 whitespace-nowrap" href="#"><span class="material-symbols-outlined text-sm">task_alt</span> Tasks</a>
            <a class="pb-4 text-on-surface-variant hover:text-on-surface transition-all flex items-center gap-2 whitespace-nowrap" href="#"><span class="material-symbols-outlined text-sm">description</span> Files</a>
            <a class="pb-4 text-on-surface-variant hover:text-on-surface transition-all flex items-center gap-2 whitespace-nowrap" href="#"><span class="material-symbols-outlined text-sm">groups</span> Team</a>
        </div>
    </section>
    <section class="p-4 md:p-8 grid grid-cols-1 md:grid-cols-12 gap-6 pb-24">
        <div class="col-span-12 md:col-span-3 bg-surface-container rounded-xl p-6 hover:bg-surface-container-high hover:scale-[1.02] transition-all duration-400 group">
            <div class="flex justify-between items-start mb-4"><div class="p-2 rounded-lg bg-primary/10 text-primary"><span class="material-symbols-outlined">playlist_add_check</span></div><span class="text-xs font-bold text-green-400 flex items-center gap-0.5"><span class="material-symbols-outlined text-xs">trending_up</span> +12%</span></div>
            <p class="text-on-surface-variant text-sm font-medium">Total Tasks</p>
            <h3 class="text-3xl font-syne font-extrabold mt-1">142</h3>
        </div>
        <div class="col-span-12 md:col-span-3 bg-surface-container rounded-xl p-6 hover:bg-surface-container-high hover:scale-[1.02] transition-all duration-400">
            <div class="flex justify-between items-start mb-4"><div class="p-2 rounded-lg bg-tertiary/10 text-tertiary"><span class="material-symbols-outlined">verified</span></div></div>
            <p class="text-on-surface-variant text-sm font-medium">Completed</p>
            <h3 class="text-3xl font-syne font-extrabold mt-1">96</h3>
        </div>
        <div class="col-span-12 md:col-span-3 bg-surface-container rounded-xl p-6 hover:bg-surface-container-high hover:scale-[1.02] transition-all duration-400">
            <div class="flex justify-between items-start mb-4"><div class="p-2 rounded-lg bg-secondary/10 text-secondary"><span class="material-symbols-outlined">group</span></div></div>
            <p class="text-on-surface-variant text-sm font-medium">Active Members</p>
            <h3 class="text-3xl font-syne font-extrabold mt-1">24</h3>
        </div>
        <div class="col-span-12 md:col-span-3 bg-surface-container rounded-xl p-6 hover:bg-surface-container-high hover:scale-[1.02] transition-all duration-400 overflow-hidden relative">
            <div class="flex justify-between items-start mb-4"><div class="p-2 rounded-lg bg-primary-container/20 text-primary-container"><span class="material-symbols-outlined">speed</span></div></div>
            <p class="text-on-surface-variant text-sm font-medium">Velocity</p>
            <h3 class="text-3xl font-syne font-extrabold mt-1">4.2<span class="text-sm font-outfit font-normal text-on-surface-variant ml-1">pts/day</span></h3>
            <div class="absolute -bottom-2 -right-2 opacity-20 group-hover:opacity-40 transition-opacity"><span class="material-symbols-outlined text-7xl text-primary">analytics</span></div>
        </div>
        <div class="col-span-12 md:col-span-8 bg-surface-container rounded-xl p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-syne font-extrabold flex items-center gap-2"><span class="material-symbols-outlined text-primary">info</span> Project Summary</h3>
                <button class="text-sm font-bold text-primary hover:underline">View Roadmap</button>
            </div>
            <p class="text-on-surface-variant leading-relaxed text-lg mb-8">Neural Core V2 is the flagship initiative to integrate advanced LLM protocols into the primary XenonOS architecture. This phase focuses on reducing latency by 40% and implementing a context-aware semantic layer for real-time project insights.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <h4 class="text-xs uppercase tracking-widest font-bold text-outline">Current Focus</h4>
                    <div class="flex items-center gap-4 bg-surface-container-low p-4 rounded-xl border border-outline-variant/10">
                        <div class="w-10 h-10 rounded-lg bg-primary-container/20 flex items-center justify-center text-primary-container"><span class="material-symbols-outlined">architecture</span></div>
                        <div><p class="text-sm font-bold">API Mesh Optimization</p><p class="text-[10px] text-on-surface-variant">Due in 3 days - Sprint 14</p></div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h4 class="text-xs uppercase tracking-widest font-bold text-outline">Risk Level</h4>
                    <div class="flex items-center gap-4 bg-surface-container-low p-4 rounded-xl border border-outline-variant/10">
                        <div class="w-10 h-10 rounded-lg bg-tertiary/10 flex items-center justify-center text-tertiary"><span class="material-symbols-outlined">warning</span></div>
                        <div><p class="text-sm font-bold">Low Stability Risks</p><p class="text-[10px] text-on-surface-variant">Monitoring load balancers</p></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-4 bg-surface-container rounded-xl p-8 row-span-2">
            <h3 class="text-xl font-syne font-extrabold mb-8 flex items-center gap-2"><span class="material-symbols-outlined text-primary">dynamic_feed</span> Activity Feed</h3>
            <div class="space-y-8 relative before:absolute before:left-[11px] before:top-2 before:bottom-0 before:w-px before:bg-outline-variant/20">
                <div class="relative pl-8">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-primary flex items-center justify-center ring-4 ring-surface-container"><span class="material-symbols-outlined text-on-primary text-xs">check</span></div>
                    <p class="text-sm font-bold">Alex Chen <span class="text-on-surface-variant font-normal">completed task</span> Deploy Alpha Core</p>
                    <p class="text-[10px] text-on-surface-variant mt-1">2 hours ago</p>
                </div>
                <div class="relative pl-8">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-surface-container-highest flex items-center justify-center ring-4 ring-surface-container border border-outline-variant"><span class="material-symbols-outlined text-on-surface-variant text-xs">comment</span></div>
                    <p class="text-sm font-bold">Sarah Miller <span class="text-on-surface-variant font-normal">commented on</span> Database Schema</p>
                    <p class="text-[10px] text-on-surface-variant mt-1">5 hours ago</p>
                    <div class="mt-3 p-3 bg-surface-container-low rounded-lg text-[11px] text-on-surface-variant italic border-l-2 border-primary">"Great catch on the indexing strategy. Let's push to dev tomorrow."</div>
                </div>
                <div class="relative pl-8">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-tertiary flex items-center justify-center ring-4 ring-surface-container"><span class="material-symbols-outlined text-on-tertiary-container text-xs">upload</span></div>
                    <p class="text-sm font-bold">David Wong <span class="text-on-surface-variant font-normal">uploaded</span> Brand_Assets_v2.zip</p>
                    <p class="text-[10px] text-on-surface-variant mt-1">Yesterday</p>
                </div>
                <div class="relative pl-8">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-secondary flex items-center justify-center ring-4 ring-surface-container"><span class="material-symbols-outlined text-on-secondary-container text-xs">person_add</span></div>
                    <p class="text-sm font-bold">Project <span class="text-on-surface-variant font-normal">assigned</span> 4 tasks <span class="text-on-surface-variant font-normal">to</span> Emily Rose</p>
                    <p class="text-[10px] text-on-surface-variant mt-1">Yesterday</p>
                </div>
            </div>
            <button class="mt-10 p-3 rounded-xl border border-outline-variant/10 text-xs font-bold hover:bg-surface-container-high transition-all w-full">View All Activity</button>
        </div>
        <div class="col-span-12 md:col-span-8 bg-surface-container rounded-xl p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <h3 class="text-xl font-syne font-extrabold flex items-center gap-2"><span class="material-symbols-outlined text-primary">data_exploration</span> Task Distribution</h3>
                <div class="flex gap-2 flex-wrap">
                    <span class="flex items-center gap-1.5 text-xs text-on-surface-variant"><span class="w-2 h-2 rounded-full bg-primary"></span> Todo</span>
                    <span class="flex items-center gap-1.5 text-xs text-on-surface-variant"><span class="w-2 h-2 rounded-full bg-secondary"></span> In Progress</span>
                    <span class="flex items-center gap-1.5 text-xs text-on-surface-variant"><span class="w-2 h-2 rounded-full bg-green-400"></span> Done</span>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <div class="space-y-2">
                    <div class="flex justify-between items-end"><span class="text-[10px] font-bold text-outline uppercase tracking-wider">Planning</span><span class="text-sm font-syne font-bold text-green-400">100%</span></div>
                    <div class="h-2 bg-surface-container-lowest rounded-full overflow-hidden"><div class="h-full bg-green-400 w-full"></div></div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-end"><span class="text-[10px] font-bold text-outline uppercase tracking-wider">Development</span><span class="text-sm font-syne font-bold">75%</span></div>
                    <div class="h-2 bg-surface-container-lowest rounded-full overflow-hidden"><div class="h-full bg-primary w-[75%]"></div></div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-end"><span class="text-[10px] font-bold text-outline uppercase tracking-wider">Testing</span><span class="text-sm font-syne font-bold">30%</span></div>
                    <div class="h-2 bg-surface-container-lowest rounded-full overflow-hidden"><div class="h-full bg-secondary w-[30%]"></div></div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-end"><span class="text-[10px] font-bold text-outline uppercase tracking-wider">Deployment</span><span class="text-sm font-syne font-bold text-outline">0%</span></div>
                    <div class="h-2 bg-surface-container-lowest rounded-full overflow-hidden"><div class="h-full bg-primary w-0"></div></div>
                </div>
            </div>
            <div class="mt-8 p-4 bg-surface-container-low border border-outline-variant/5 rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center"><span class="material-symbols-outlined text-sm text-primary">auto_awesome</span></div>
                    <p class="text-xs text-on-surface-variant font-medium">AI Insight: Team productivity is up <span class="text-primary font-bold">14%</span> compared to last sprint.</p>
                </div>
                <span class="material-symbols-outlined text-outline cursor-pointer hover:text-primary transition-colors">close</span>
            </div>
        </div>
</section>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/projects-overview.js') }}"></script>
@endpush
