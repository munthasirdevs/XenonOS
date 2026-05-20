@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-assigned.css') }}">
@endpush

@section('title', 'Assigned Projects - XenonOS')

@section('content')

<main class="flex-1 md:ml-[260px] min-h-screen">
    <div class="px-4 md:px-10 p-8 md:p-12 space-y-10">
        <section class="flex flex-col md:flex-row justify-between items-end md:items-center gap-6">
            <div class="space-y-2">
                <h1 class="font-headline text-3xl md:text-5xl font-light tracking-tight text-on-surface">Assigned Projects</h1>
                <p class="text-on-surface-variant max-w-md text-sm leading-relaxed">Oversee active Workflows, monitor delivery health, and coordinate team velocity across your premium portfolio.</p>
            </div>
            <button class="bg-primary text-on-primary px-6 py-3 rounded-xl font-headline font-semibold text-sm flex items-center gap-2 hover:opacity-90 active:scale-[0.98] transition-all shadow-[0_10px_20px_rgba(192,193,255,0.2)]">
                <span class="material-symbols-outlined text-lg">add</span>
                Assign New Project
            </button>
        </section>
        <section class="bg-surface-container-low p-2 rounded-2xl flex flex-wrap items-center gap-2">
            <div class="flex items-center gap-2 px-3 py-2 bg-surface-container-high rounded-xl text-xs font-semibold text-on-surface-variant cursor-pointer hover:bg-surface-bright transition-colors">
                <span class="material-symbols-outlined text-sm">person</span> Team Member: All <span class="material-symbols-outlined text-sm">expand_more</span>
            </div>
            <div class="flex items-center gap-2 px-3 py-2 bg-surface-container-high rounded-xl text-xs font-semibold text-on-surface-variant cursor-pointer hover:bg-surface-bright transition-colors">
                <span class="material-symbols-outlined text-sm">stacked_line_chart</span> Status: Active <span class="material-symbols-outlined text-sm">expand_more</span>
            </div>
            <div class="flex items-center gap-2 px-3 py-2 bg-surface-container-high rounded-xl text-xs font-semibold text-on-surface-variant cursor-pointer hover:bg-surface-bright transition-colors">
                <span class="material-symbols-outlined text-sm">priority_high</span> Priority: High <span class="material-symbols-outlined text-sm">expand_more</span>
            </div>
            <div class="ml-auto flex items-center gap-4 pr-2">
                <div class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Showing 24 Projects</div>
                <button class="p-2 rounded-lg text-slate-400 hover:bg-surface-bright transition-colors"><span class="material-symbols-outlined">grid_view</span></button>
                <button class="p-2 rounded-lg bg-primary/10 text-primary"><span class="material-symbols-outlined">view_list</span></button>
            </div>
        </section>
        <div class="space-y-4">
            <div class="bg-surface-container rounded-xl overflow-hidden shadow-2xl transition-all duration-300 ring-1 ring-primary/20">
                <div class="p-6 flex items-start gap-6 border-b border-outline-variant/10">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center shrink-0"><span class="material-symbols-outlined text-primary text-3xl">auto_awesome</span></div>
                    <div class="flex-1 grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-12 md:col-span-4">
                            <h3 class="font-headline font-bold text-lg text-on-surface leading-tight">Neon Genesis Rebranding</h3>
                            <p class="text-xs text-on-surface-variant">Client: Cyber Systems</p>
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <div class="flex -space-x-2">
                                <img alt="Team member" class="w-8 h-8 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Sarah+Miller&background=818cf8&color=fff" />
                                <img alt="Team member" class="w-8 h-8 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Alex+Chen&background=c084fc&color=fff" />
                                <img alt="Team member" class="w-8 h-8 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=David+Wong&background=34d399&color=fff" />
                                <div class="w-8 h-8 rounded-full bg-surface-container-highest ring-2 ring-surface-container flex items-center justify-center text-[10px] font-bold">+2</div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-3 px-4">
                            <div class="flex justify-between text-[10px] font-bold text-on-surface-variant mb-1.5 uppercase tracking-tighter"><span>Velocity</span><span>68%</span></div>
                            <div class="h-1.5 bg-surface-container-highest rounded-full overflow-hidden"><div class="h-full bg-gradient-to-r from-primary to-primary-container w-[68%] shadow-[0_0_8px_rgba(192,193,255,0.4)]"></div></div>
                        </div>
                        <div class="col-span-12 md:col-span-2 flex flex-col items-end">
                            <span class="px-2 py-0.5 rounded bg-tertiary/20 text-tertiary text-[10px] font-bold uppercase tracking-wider mb-1">High Priority</span>
                            <span class="text-[11px] text-slate-400 font-medium">Due Oct 24, 2024</span>
                        </div>
                        <div class="col-span-1 flex justify-end"><button class="p-2 text-slate-500 hover:text-on-surface transition-colors"><span class="material-symbols-outlined">more_vert</span></button></div>
                    </div>
                </div>
                <div class="bg-surface-container-low/40 p-8 grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Task Summary</h4>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-surface-container p-4 rounded-xl border-l-2 border-primary"><p class="text-2xl font-headline font-bold text-on-surface">42</p><p class="text-[10px] text-on-surface-variant font-bold uppercase">Total Tasks</p></div>
                                <div class="bg-surface-container p-4 rounded-xl border-l-2 border-tertiary"><p class="text-2xl font-headline font-bold text-on-surface">12</p><p class="text-[10px] text-on-surface-variant font-bold uppercase">In Progress</p></div>
                                <div class="bg-surface-container p-4 rounded-xl border-l-2 border-slate-600"><p class="text-2xl font-headline font-bold text-on-surface">08</p><p class="text-[10px] text-on-surface-variant font-bold uppercase">Pending</p></div>
                                <div class="bg-surface-container p-4 rounded-xl border-l-2 border-emerald-500"><p class="text-2xl font-headline font-bold text-on-surface">22</p><p class="text-[10px] text-on-surface-variant font-bold uppercase">Completed</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <h4 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Recent Updates</h4>
                        <div class="space-y-4 relative before:absolute before:left-[7px] before:top-2 before:bottom-2 before:w-[1px] before:bg-outline-variant/20">
                            <div class="flex gap-4 relative pl-6">
                                <div class="absolute left-0 top-1 w-3.5 h-3.5 rounded-full bg-primary-container ring-4 ring-surface-container-low"></div>
                                <div><p class="text-[13px] text-on-surface leading-tight font-medium">Sarah Miller updated <span class="text-primary">Hero_Concept_V2.fig</span></p><p class="text-[11px] text-slate-500 mt-0.5">2 hours ago</p></div>
                            </div>
                            <div class="flex gap-4 relative pl-6">
                                <div class="absolute left-0 top-1 w-3.5 h-3.5 rounded-full bg-surface-container-highest ring-4 ring-surface-container-low"></div>
                                <div><p class="text-[13px] text-on-surface leading-tight font-medium">Status changed to <span class="px-1.5 py-0.5 bg-secondary-container rounded text-[10px]">In Review</span></p><p class="text-[11px] text-slate-500 mt-0.5">5 hours ago</p></div>
                            </div>
                            <div class="flex gap-4 relative pl-6">
                                <div class="absolute left-0 top-1 w-3.5 h-3.5 rounded-full bg-surface-container-highest ring-4 ring-surface-container-low"></div>
                                <div><p class="text-[13px] text-on-surface leading-tight font-medium">New comment from Client on <span class="text-primary">Style Guide</span></p><p class="text-[11px] text-slate-500 mt-0.5">Yesterday</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <h4 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Project Actions</h4>
                        <div class="flex flex-col gap-2">
                            <button class="w-full flex items-center justify-between px-4 py-3 bg-surface-container rounded-xl text-sm font-medium hover:bg-surface-bright transition-colors group"><div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary">task_alt</span> View Full Tasks</div><span class="material-symbols-outlined text-slate-500 group-hover:translate-x-1 transition-transform">chevron_right</span></button>
                            <button class="w-full flex items-center justify-between px-4 py-3 bg-surface-container rounded-xl text-sm font-medium hover:bg-surface-bright transition-colors group"><div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary">folder</span> Project Assets</div><span class="material-symbols-outlined text-slate-500 group-hover:translate-x-1 transition-transform">chevron_right</span></button>
                            <button class="w-full flex items-center justify-between px-4 py-3 bg-surface-container rounded-xl text-sm font-medium hover:bg-surface-bright transition-colors group"><div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary">forum</span> Open Team Chat</div><span class="material-symbols-outlined text-slate-500 group-hover:translate-x-1 transition-transform">chevron_right</span></button>
                            <button class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-outline-variant/10 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-outline-variant/20 transition-colors"><span class="material-symbols-outlined text-base">person_add</span> Reassign Team</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-surface-container hover:bg-surface-container-high rounded-xl overflow-hidden transition-all duration-300 group cursor-pointer border-l-2 border-transparent hover:border-primary">
                <div class="p-6 flex items-start gap-6">
                    <div class="w-14 h-14 bg-surface-container-highest rounded-2xl flex items-center justify-center shrink-0 transition-colors group-hover:bg-primary/10"><span class="material-symbols-outlined text-slate-400 text-3xl transition-colors group-hover:text-primary">diamond</span></div>
                    <div class="flex-1 grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-12 md:col-span-4"><h3 class="font-headline font-bold text-lg text-on-surface leading-tight">Sapphire E-commerce</h3><p class="text-xs text-on-surface-variant">Client: Blue Ocean Retail</p></div>
                        <div class="col-span-12 md:col-span-2"><div class="flex -space-x-2"><img alt="Team" class="w-8 h-8 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Emily+Rose&background=34d399&color=fff" /><img alt="Team" class="w-8 h-8 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Mike+Chen&background=f87171&color=fff" /></div></div>
                        <div class="col-span-12 md:col-span-3 px-4"><div class="flex justify-between text-[10px] font-bold text-on-surface-variant mb-1.5 uppercase tracking-tighter"><span>Velocity</span><span>32%</span></div><div class="h-1.5 bg-surface-container-highest rounded-full overflow-hidden"><div class="h-full bg-gradient-to-r from-primary to-primary-container w-[32%]"></div></div></div>
                        <div class="col-span-12 md:col-span-2 flex flex-col items-end"><span class="px-2 py-0.5 rounded bg-surface-container-highest text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Med Priority</span><span class="text-[11px] text-slate-400 font-medium">Due Nov 12, 2024</span></div>
                        <div class="col-span-1 flex justify-end"><button class="p-2 text-slate-500 group-hover:text-on-surface transition-colors"><span class="material-symbols-outlined">keyboard_arrow_down</span></button></div>
                    </div>
                </div>
            </div>
            <div class="bg-surface-container hover:bg-surface-container-high rounded-xl overflow-hidden transition-all duration-300 group cursor-pointer border-l-2 border-transparent hover:border-primary">
                <div class="p-6 flex items-start gap-6">
                    <div class="w-14 h-14 bg-surface-container-highest rounded-2xl flex items-center justify-center shrink-0 transition-colors group-hover:bg-primary/10"><span class="material-symbols-outlined text-slate-400 text-3xl transition-colors group-hover:text-primary">cloud_queue</span></div>
                    <div class="flex-1 grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-12 md:col-span-4"><h3 class="font-headline font-bold text-lg text-on-surface leading-tight">Quantum Infrastructure</h3><p class="text-xs text-on-surface-variant">Client: Omni Corp</p></div>
                        <div class="col-span-12 md:col-span-2"><div class="flex -space-x-2"><img alt="Team" class="w-8 h-8 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=John+Doe&background=818cf8&color=fff" /><img alt="Team" class="w-8 h-8 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Jane+Smith&background=c084fc&color=fff" /><img alt="Team" class="w-8 h-8 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Bob+Wilson&background=34d399&color=fff" /></div></div>
                        <div class="col-span-12 md:col-span-3 px-4"><div class="flex justify-between text-[10px] font-bold text-on-surface-variant mb-1.5 uppercase tracking-tighter"><span>Velocity</span><span>92%</span></div><div class="h-1.5 bg-surface-container-highest rounded-full overflow-hidden"><div class="h-full bg-gradient-to-r from-primary to-primary-container w-[92%] shadow-[0_0_8px_rgba(192,193,255,0.4)]"></div></div></div>
                        <div class="col-span-12 md:col-span-2 flex flex-col items-end"><span class="px-2 py-0.5 rounded bg-tertiary/20 text-tertiary text-[10px] font-bold uppercase tracking-wider mb-1">High Priority</span><span class="text-[11px] text-slate-400 font-medium">Due Tomorrow</span></div>
                        <div class="col-span-1 flex justify-end"><button class="p-2 text-slate-500 group-hover:text-on-surface transition-colors"><span class="material-symbols-outlined">keyboard_arrow_down</span></button></div>
                    </div>
                </div>
            </div>
        </div>
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6 pt-8">
            <div class="bg-surface-container-low p-6 rounded-2xl relative overflow-hidden group"><div class="absolute top-0 left-0 w-1 h-full bg-primary/40 group-hover:bg-primary transition-colors"></div><p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Total Budget Allocated</p><h4 class="text-3xl font-headline font-light text-on-surface">.4M</h4><p class="text-xs text-emerald-500 mt-2 flex items-center gap-1"><span class="material-symbols-outlined text-xs">trending_up</span> +12% from last quarter</p></div>
            <div class="bg-surface-container-low p-6 rounded-2xl relative overflow-hidden group"><div class="absolute top-0 left-0 w-1 h-full bg-tertiary/40 group-hover:bg-tertiary transition-colors"></div><p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Pending Milestones</p><h4 class="text-3xl font-headline font-light text-on-surface">18</h4><p class="text-xs text-slate-500 mt-2 flex items-center gap-1">7 critical path items</p></div>
            <div class="bg-surface-container-low p-6 rounded-2xl relative overflow-hidden group"><div class="absolute top-0 left-0 w-1 h-full bg-secondary/40 group-hover:bg-secondary transition-colors"></div><p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Team Capacity</p><h4 class="text-3xl font-headline font-light text-on-surface">84%</h4><p class="text-xs text-on-surface-variant mt-2 flex items-center gap-1">Optimal operating range</p></div>
            <div class="bg-surface-container-low p-6 rounded-2xl relative overflow-hidden group"><div class="absolute top-0 left-0 w-1 h-full bg-slate-600/40 group-hover:bg-slate-400 transition-colors"></div><p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Avg. Completion Time</p><h4 class="text-3xl font-headline font-light text-on-surface">14d</h4><p class="text-xs text-on-surface-variant mt-2 flex items-center gap-1">-2d compared to industry</p></div>
        </section>
</div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/projects-assigned.js') }}"></script>
@endpush
