@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-tasks-workspace.css') }}">
@endpush

@section('title', 'Project Tasks - XenonOS')

@section('content')
<x-navbar />

<main class="flex-1 md:ml-[260px] min-h-screen">
    <section class="p-4 md:p-8">
        <div class="bg-surface-container rounded-2xl p-6 shadow-[0_32px_32px_-4px_rgba(10,14,24,0.5)] border border-outline-variant/5">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-1">
                    <div class="flex items-center gap-3 flex-wrap">
                        <span class="px-2 py-0.5 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest rounded">Internal</span>
                        <h2 class="font-syne font-extrabold text-2xl md:text-3xl text-on-surface tracking-tight">Quantum Leap Framework</h2>
                    </div>
                    <p class="text-on-surface-variant font-outfit max-w-2xl">Building the next generation modular reactive architecture for enterprise intelligence systems. Q4 focus on core stability.</p>
                </div>
                <div class="flex items-center gap-4 md:gap-8 bg-surface-container-lowest/50 p-4 rounded-xl flex-wrap">
                    <div class="text-center"><p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-tighter">Progress</p><p class="font-syne font-extrabold text-2xl text-primary">64%</p></div>
                    <div class="h-10 w-px bg-outline-variant/20 hidden md:block"></div>
                    <div class="text-center"><p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-tighter">Timeline</p><p class="font-syne font-extrabold text-2xl text-on-surface">12 <span class="text-sm font-outfit font-normal text-on-surface-variant">days left</span></p></div>
                    <div class="h-10 w-px bg-outline-variant/20 hidden md:block"></div>
                    <div class="flex -space-x-2">
                        <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=Sarah+Miller&background=818cf8&color=fff" />
                        <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=Alex+Chen&background=c084fc&color=fff" />
                        <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=David+Wong&background=34d399&color=fff" />
                        <div class="w-8 h-8 rounded-full border-2 border-surface-container bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">+4</div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4 md:gap-8 mt-6 md:mt-8 border-b border-outline-variant/10 overflow-x-auto">
                <button class="pb-4 text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-2 whitespace-nowrap"><span class="material-symbols-outlined text-lg">overview</span><span class="text-sm font-medium">Overview</span></button>
                <button class="pb-4 text-primary border-b-2 border-primary transition-all flex items-center gap-2 font-bold whitespace-nowrap"><span class="material-symbols-outlined text-lg">task_alt</span><span class="text-sm">Tasks</span></button>
                <button class="pb-4 text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-2 whitespace-nowrap"><span class="material-symbols-outlined text-lg">description</span><span class="text-sm font-medium">Files</span></button>
                <button class="pb-4 text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-2 whitespace-nowrap"><span class="material-symbols-outlined text-lg">group</span><span class="text-sm font-medium">Team</span></button>
                <button class="pb-4 text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-2 whitespace-nowrap"><span class="material-symbols-outlined text-lg">insights</span><span class="text-sm font-medium">Analytics</span></button>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 items-start">
            <div class="space-y-4">
                <div class="flex items-center justify-between px-2">
                    <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-outline-variant"></div><h3 class="font-syne font-extrabold text-sm uppercase tracking-widest text-on-surface">To Do</h3><span class="text-xs bg-surface-container-highest text-on-surface-variant px-2 py-0.5 rounded-full">4</span></div>
                    <button class="text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">add</span></button>
                </div>
                <div class="space-y-4">
                    <div class="bg-surface-container p-5 rounded-2xl hover:scale-[1.02] transition-all duration-400 group cursor-pointer border border-transparent hover:border-primary/20">
                        <div class="flex justify-between items-start mb-3"><span class="px-2 py-0.5 bg-surface-container-highest text-[10px] font-bold text-on-surface-variant rounded">Design</span><span class="material-symbols-outlined text-on-surface-variant text-sm opacity-0 group-hover:opacity-100 transition-opacity">more_horiz</span></div>
                        <h4 class="font-outfit font-semibold text-on-surface mb-2 group-hover:text-primary transition-colors">Define API Interface standards for v2</h4>
                        <p class="text-xs text-on-surface-variant mb-4 line-clamp-2">Standardize endpoints, error codes and response envelopes for the new core framework.</p>
                        <div class="flex items-center justify-between mt-auto">
                            <div class="flex -space-x-1.5"><img alt="Assignee" class="w-6 h-6 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Emily+Rose&background=34d399&color=fff&size=48" /></div>
                            <div class="flex items-center gap-3 text-on-surface-variant">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">chat_bubble</span><span class="text-[10px]">12</span></div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">attachment</span><span class="text-[10px]">3</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container p-5 rounded-2xl hover:scale-[1.02] transition-all duration-400 group cursor-pointer border border-transparent hover:border-primary/20">
                        <div class="flex justify-between items-start mb-3"><span class="px-2 py-0.5 bg-surface-container-highest text-[10px] font-bold text-on-surface-variant rounded">Research</span></div>
                        <h4 class="font-outfit font-semibold text-on-surface mb-2">User testing on component navigation</h4>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center gap-2 text-error text-[10px] font-bold uppercase tracking-widest"><span class="material-symbols-outlined text-xs">priority_high</span> High Priority</div>
                            <img alt="Assignee" class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=f87171&color=fff&size=48" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between px-2">
                    <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div><h3 class="font-syne font-extrabold text-sm uppercase tracking-widest text-on-surface">In Progress</h3><span class="text-xs bg-primary/20 text-primary px-2 py-0.5 rounded-full">2</span></div>
                </div>
                <div class="space-y-4">
                    <div class="bg-surface-container p-5 rounded-2xl hover:scale-[1.02] transition-all duration-400 group cursor-pointer border border-transparent hover:border-primary/20">
                        <div class="flex justify-between items-start mb-3"><span class="px-2 py-0.5 bg-primary/20 text-[10px] font-bold text-primary rounded">Engineering</span><span class="material-symbols-outlined text-primary text-sm">pending</span></div>
                        <h4 class="font-outfit font-semibold text-on-surface mb-4">Implement Redis caching for telemetry feed</h4>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-[10px] font-bold uppercase text-on-surface-variant tracking-tighter"><span>Task Progress</span><span class="text-primary">75%</span></div>
                            <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden"><div class="h-full bg-primary w-[75%]"></div></div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-1.5">
                                <img alt="Assignee" class="w-6 h-6 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Alex+Chen&background=818cf8&color=fff&size=48" />
                                <img alt="Assignee" class="w-6 h-6 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Sarah+Miller&background=c084fc&color=fff&size=48" />
                            </div>
                            <div class="flex items-center gap-2 text-on-surface-variant text-[10px]"><span class="material-symbols-outlined text-sm">event</span><span>Today</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between px-2">
                    <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-emerald-400"></div><h3 class="font-syne font-extrabold text-sm uppercase tracking-widest text-on-surface">Done</h3><span class="text-xs bg-emerald-400/20 text-emerald-400 px-2 py-0.5 rounded-full">14</span></div>
                </div>
                <div class="space-y-4 opacity-70 hover:opacity-100 transition-opacity">
                    <div class="bg-surface-container p-5 rounded-2xl hover:scale-[1.02] transition-all duration-400 group cursor-pointer border border-transparent">
                        <div class="flex justify-between items-start mb-3"><span class="px-2 py-0.5 bg-emerald-400/10 text-[10px] font-bold text-emerald-400 rounded">Release</span><span class="material-symbols-outlined text-emerald-400 text-lg">check_circle</span></div>
                        <h4 class="font-outfit font-semibold text-on-surface mb-2 line-through decoration-outline">v1.2.0 Production Deployment</h4>
                        <div class="flex items-center justify-between mt-4"><span class="text-[10px] text-on-surface-variant">Completed Oct 14</span><div class="flex -space-x-1.5"><img alt="Assignee" class="w-6 h-6 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=David+Wong&background=34d399&color=fff&size=48" /></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-4 md:gap-6">
            <div class="col-span-12 lg:col-span-8 bg-surface-container rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity"><span class="material-symbols-outlined text-8xl">analytics</span></div>
                <div class="relative z-10">
                    <h3 class="font-syne font-extrabold text-xl mb-6">Velocity History</h3>
                    <div class="h-48 w-full flex items-end justify-between gap-2">
                        <div class="w-full bg-primary/20 rounded-t-lg h-[40%] hover:bg-primary/40 transition-all"></div>
                        <div class="w-full bg-primary/20 rounded-t-lg h-[65%] hover:bg-primary/40 transition-all"></div>
                        <div class="w-full bg-primary/20 rounded-t-lg h-[55%] hover:bg-primary/40 transition-all"></div>
                        <div class="w-full bg-primary/40 rounded-t-lg h-[90%] hover:bg-primary/60 transition-all relative"><div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-primary text-on-primary px-2 py-1 rounded text-[10px] font-bold">Peak</div></div>
                        <div class="w-full bg-primary/20 rounded-t-lg h-[75%] hover:bg-primary/40 transition-all"></div>
                        <div class="w-full bg-primary/20 rounded-t-lg h-[60%] hover:bg-primary/40 transition-all"></div>
                        <div class="w-full bg-primary/20 rounded-t-lg h-[80%] hover:bg-primary/40 transition-all"></div>
                    </div>
                    <div class="flex justify-between mt-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest flex-wrap gap-2"><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span></div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4 bg-gradient-to-br from-secondary-container to-surface-container rounded-2xl p-6 flex flex-col justify-between">
                <div><span class="material-symbols-outlined text-primary text-3xl mb-4">auto_awesome</span><h3 class="font-syne font-extrabold text-xl">Xenon Insights</h3><p class="text-sm text-on-surface-variant mt-2 leading-relaxed">Based on current velocity, your team is likely to finish the <span class="text-on-surface font-bold">API Standards</span> task 2 days ahead of schedule.</p></div>
                <button class="mt-6 w-full py-3 bg-surface-container-highest rounded-xl text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-all">View Detailed Report</button>
            </div>
        </div>
</section>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/projects-tasks-workspace.js') }}"></script>
@endpush
