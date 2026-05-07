@extends('layouts.app')

@push('styles')
<style>
    .font-syne { font-family: 'Syne', sans-serif; }
    .font-outfit { font-family: 'Outfit', sans-serif; }
</style>
@endpush

@section('title', 'XenonOS | Assigned Projects')

@section('content')
<main class="min-h-screen transition-all duration-300 flex flex-col">
    <section class="p-6 md:p-10 max-w-7xl mx-auto">
        <div class="mb-12">
            <h2 class="font-syne font-extrabold text-3xl md:text-5xl tracking-tight text-on-surface mb-2">Assigned Projects</h2>
            <p class="text-on-surface-variant font-outfit text-lg max-w-2xl">Manage your active priorities and tracking your momentum across the intelligence network.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
            <div class="md:col-span-4 md:row-span-2 bg-surface-container rounded-2xl p-8 group hover:scale-[1.01] transition-all duration-400 ease-in-out relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8">
                    <span class="px-4 py-1 bg-error/10 text-error text-xs font-bold rounded-full border border-error/20 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-error animate-pulse"></span> Priority: High</span>
                </div>
                <div class="flex flex-col h-full justify-between">
                    <div>
                        <span class="text-primary font-syne font-bold text-xs tracking-widest uppercase mb-4 block">Product Launch</span>
                        <h3 class="text-3xl font-syne font-extrabold text-[#c0c1ff] mb-4">Quantum Interface Redesign</h3>
                        <p class="text-on-surface-variant text-base leading-relaxed max-w-xl mb-8">Implementing the new orbital navigation engine for the core Xenon dashboard. Requires deep focus on micro-interactions and low-latency rendering.</p>
                        <div class="flex items-center gap-6 mb-8">
                            <div class="flex -space-x-3">
                                <img alt="Team 1" class="w-10 h-10 rounded-full border-2 border-surface-container" src="https://ui-avatars.com/api/?name=Sarah+Miller&background=818cf8&color=fff&size=80" />
                                <img alt="Team 2" class="w-10 h-10 rounded-full border-2 border-surface-container" src="https://ui-avatars.com/api/?name=Alex+Chen&background=c084fc&color=fff&size=80" />
                                <div class="w-10 h-10 rounded-full border-2 border-surface-container bg-surface-container-highest flex items-center justify-center text-xs font-bold">+4</div>
                            </div>
                            <div class="h-10 w-px bg-outline-variant/20"></div>
                            <div class="flex flex-col"><span class="text-[10px] uppercase tracking-tighter text-on-surface-variant font-bold">Due Date</span><span class="text-on-surface font-outfit font-semibold">Oct 24, 2023</span></div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-end"><span class="text-on-surface font-bold text-lg">74% Complete</span><span class="text-on-surface-variant text-sm">Target: 100%</span></div>
                        <div class="w-full bg-surface-container-lowest h-3 rounded-full overflow-hidden"><div class="h-full bg-primary w-[74%]"></div></div>
                        <div class="flex gap-4 pt-4">
                            <button class="flex-1 bg-primary text-on-primary font-bold py-3 rounded-xl hover:shadow-[0_4px_20px_rgba(99,102,241,0.4)] transition-all">Open Project</button>
                            <button class="px-6 border border-outline-variant/30 hover:bg-surface-container-highest rounded-xl transition-colors font-semibold">Update Status</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:col-span-2 bg-surface-container rounded-2xl p-6 group hover:scale-[1.02] transition-all duration-400">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-2 bg-primary/10 rounded-lg"><span class="material-symbols-outlined text-primary">analytics</span></div>
                    <span class="px-3 py-1 bg-tertiary/10 text-tertiary text-[10px] font-bold rounded-full border border-tertiary/20">Med Priority</span>
                </div>
                <h4 class="text-xl font-syne font-extrabold text-on-surface mb-2">Neural Engine Optimization</h4>
                <p class="text-sm text-on-surface-variant font-outfit mb-6 line-clamp-2">Refining the latency of the local inference engine for project predictions.</p>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-xs"><span class="text-on-surface-variant">Progress</span><span class="text-on-surface font-bold">42%</span></div>
                    <div class="w-full bg-surface-container-lowest h-1.5 rounded-full overflow-hidden"><div class="h-full bg-primary w-[42%]"></div></div>
                </div>
                <button class="p-2 rounded-lg border border-outline-variant/20 text-sm font-semibold hover:bg-surface-container-highest transition-colors w-full">Open Project</button>
            </div>
            <div class="md:col-span-2 bg-surface-container rounded-2xl p-6 group hover:scale-[1.02] transition-all duration-400">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-2 bg-secondary/10 rounded-lg"><span class="material-symbols-outlined text-secondary">cloud_sync</span></div>
                    <span class="px-3 py-1 bg-on-surface-variant/10 text-on-surface-variant text-[10px] font-bold rounded-full border border-outline-variant/20">Low Priority</span>
                </div>
                <h4 class="text-xl font-syne font-extrabold text-on-surface mb-2">Cloud Migration Ph2</h4>
                <p class="text-sm text-on-surface-variant font-outfit mb-6 line-clamp-2">Syncing legacy databases with the new encrypted vault clusters.</p>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-xs"><span class="text-on-surface-variant">Progress</span><span class="text-on-surface font-bold">89%</span></div>
                    <div class="w-full bg-surface-container-lowest h-1.5 rounded-full overflow-hidden"><div class="h-full bg-secondary w-[89%]"></div></div>
                </div>
                <button class="p-2 rounded-lg border border-outline-variant/20 text-sm font-semibold hover:bg-surface-container-highest transition-colors w-full">Open Project</button>
            </div>
            <div class="md:col-span-3 bg-surface-container-low rounded-2xl p-8 flex flex-col justify-between border border-primary/5 group">
                <div>
                    <div class="flex items-center gap-3 mb-4"><span class="material-symbols-outlined text-primary">auto_awesome</span><h4 class="font-syne font-extrabold text-xl text-primary">Intelligence Insight</h4></div>
                    <p class="text-on-surface-variant text-base leading-relaxed">Based on your current velocity, you are on track to complete the <span class="text-primary font-bold">Quantum Interface</span> 2 days ahead of schedule. Would you like to reallocate 5 hours to the Neural Engine?</p>
                </div>
                <div class="flex gap-4 mt-8">
                    <button class="text-sm font-bold text-primary px-4 py-2 rounded-lg bg-primary/10 hover:bg-primary/20 transition-all">Optimize Schedule</button>
                    <button class="text-sm font-semibold text-on-surface-variant px-4 py-2 hover:text-on-surface transition-colors">Dismiss</button>
                </div>
            </div>
            <div class="md:col-span-3 bg-surface-container rounded-2xl p-8 relative overflow-hidden group">
                <div class="absolute -right-12 -top-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-all"></div>
                <div class="relative z-10">
                    <h4 class="font-syne font-extrabold text-xl text-on-surface mb-6">Next Milestones</h4>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 group/item">
                            <div class="w-10 h-10 rounded-full bg-surface-container-lowest flex items-center justify-center border border-outline-variant/10 group-hover/item:border-primary/40 transition-colors"><span class="material-symbols-outlined text-sm text-on-surface-variant group-hover/item:text-primary">done_all</span></div>
                            <div class="flex-grow"><p class="text-sm font-semibold text-on-surface">API Documentation Sync</p><p class="text-[10px] text-on-surface-variant uppercase tracking-tighter">Completed yesterday</p></div>
                        </div>
                        <div class="flex items-center gap-4 group/item">
                            <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center border border-primary/30"><span class="material-symbols-outlined text-sm text-primary">pending</span></div>
                            <div class="flex-grow"><p class="text-sm font-semibold text-on-surface">Beta User Feedback Loop</p><p class="text-[10px] text-primary uppercase tracking-tighter">In Progress - Due 4h</p></div>
                        </div>
                        <div class="flex items-center gap-4 group/item">
                            <div class="w-10 h-10 rounded-full bg-surface-container-lowest flex items-center justify-center border border-outline-variant/10"><span class="material-symbols-outlined text-sm text-on-surface-variant">event</span></div>
                            <div class="flex-grow"><p class="text-sm font-semibold text-on-surface-variant">Stakeholder Review</p><p class="text-[10px] text-on-surface-variant uppercase tracking-tighter">Friday, Oct 27</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
