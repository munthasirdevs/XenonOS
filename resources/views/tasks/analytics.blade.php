@extends('layouts.app')

@section('title', 'Task Analytics - XenonOS')

@push('styles')
<style>
    .progress-bar {
        transition: width 0.3s ease;
    }
</style>
@endpush

@section('content')
<div class="max-w-[1600px] mx-auto p-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
        <div>
            <h1 class="font-headline text-4xl lg:text-5xl font-extrabold tracking-tight mb-2">Task Analytics</h1>
            <p class="text-on-surface-variant text-lg">Performance insights and real-time productivity metrics.</p>
        </div>
        <div class="flex gap-4">
            <div class="bg-surface-container-high p-1 rounded-xl flex">
                <button class="px-4 py-2 bg-surface-container-highest text-primary rounded-lg text-sm font-semibold">Weekly</button>
                <button class="px-4 py-2 text-on-surface-variant hover:text-on-surface text-sm font-semibold">Monthly</button>
                <button class="px-4 py-2 text-on-surface-variant hover:text-on-surface text-sm font-semibold">Yearly</button>
            </div>
            <button class="bg-gradient-to-br from-primary to-primary/70 text-on-primary px-6 py-2 rounded-xl font-bold flex items-center gap-2 hover:shadow-[0_0_20px_rgba(192,193,255,0.4)] transition-all">
                <span class="material-symbols-outlined">download</span>
                Export Report
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-surface-container p-6 rounded-2xl hover:bg-surface-container-high transition-all duration-400 group relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-6xl">inventory_2</span>
            </div>
            <p class="text-on-surface-variant text-sm font-semibold mb-1">Total Tasks</p>
            <h3 class="text-4xl font-headline font-extrabold mb-4">1,284</h3>
            <div class="flex items-center gap-2 text-emerald-400 text-sm">
                <span class="material-symbols-outlined text-xs">trending_up</span>
                <span>12.5% vs last week</span>
            </div>
        </div>

        <div class="bg-surface-container p-6 rounded-2xl hover:bg-surface-container-high transition-all duration-400 group relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-6xl text-primary">check_circle</span>
            </div>
            <p class="text-on-surface-variant text-sm font-semibold mb-1">Completed Tasks</p>
            <h3 class="text-4xl font-headline font-extrabold mb-4 text-primary">842</h3>
            <div class="flex items-center gap-2 text-emerald-400 text-sm">
                <span class="material-symbols-outlined text-xs">trending_up</span>
                <span>8.2% completion rate</span>
            </div>
        </div>

        <div class="bg-surface-container p-6 rounded-2xl hover:bg-surface-container-high transition-all duration-400 group relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-6xl text-red-400">warning</span>
            </div>
            <p class="text-on-surface-variant text-sm font-semibold mb-1">Overdue Tasks</p>
            <h3 class="text-4xl font-headline font-extrabold mb-4 text-red-400">42</h3>
            <div class="flex items-center gap-2 text-red-400 text-sm">
                <span class="material-symbols-outlined text-xs">trending_down</span>
                <span>+4 since yesterday</span>
            </div>
        </div>

        <div class="bg-surface-container p-6 rounded-2xl hover:bg-surface-container-high transition-all duration-400 group relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-6xl text-purple-400">pending_actions</span>
            </div>
            <p class="text-on-surface-variant text-sm font-semibold mb-1">Active Tasks</p>
            <h3 class="text-4xl font-headline font-extrabold mb-4 text-purple-400">400</h3>
            <div class="flex items-center gap-2 text-on-surface-variant text-sm">
                <span class="material-symbols-outlined text-xs">info</span>
                <span>32 waiting on approval</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8 bg-surface-container rounded-2xl p-8 relative overflow-hidden">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h3 class="font-headline text-2xl font-bold">Productivity Trends</h3>
                    <p class="text-on-surface-variant text-sm">Units produced vs. Target goals</p>
                </div>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-primary"></div>
                        <span class="text-xs text-on-surface-variant">Actual</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-surface-container-highest"></div>
                        <span class="text-xs text-on-surface-variant">Target</span>
                    </div>
                </div>
            </div>

            <div class="h-64 flex items-end justify-between gap-2">
                <div class="w-full bg-surface-container-low h-full rounded-t-xl relative overflow-hidden flex flex-col justify-end">
                    <div class="w-full bg-surface-container-highest h-[40%] rounded-t-lg"></div>
                    <div class="w-full bg-primary/40 h-[25%] absolute bottom-0"></div>
                </div>
                <div class="w-full bg-surface-container-low h-full rounded-t-xl relative overflow-hidden flex flex-col justify-end">
                    <div class="w-full bg-surface-container-highest h-[55%] rounded-t-lg"></div>
                    <div class="w-full bg-primary/40 h-[45%] absolute bottom-0"></div>
                </div>
                <div class="w-full bg-surface-container-low h-full rounded-t-xl relative overflow-hidden flex flex-col justify-end">
                    <div class="w-full bg-surface-container-highest h-[50%] rounded-t-lg"></div>
                    <div class="w-full bg-primary h-[65%] absolute bottom-0 shadow-[0_-10px_20px_rgba(192,193,255,0.2)]"></div>
                </div>
                <div class="w-full bg-surface-container-low h-full rounded-t-xl relative overflow-hidden flex flex-col justify-end">
                    <div class="w-full bg-surface-container-highest h-[70%] rounded-t-lg"></div>
                    <div class="w-full bg-primary/40 h-[55%] absolute bottom-0"></div>
                </div>
                <div class="w-full bg-surface-container-low h-full rounded-t-xl relative overflow-hidden flex flex-col justify-end">
                    <div class="w-full bg-surface-container-highest h-[65%] rounded-t-lg"></div>
                    <div class="w-full bg-primary/40 h-[40%] absolute bottom-0"></div>
                </div>
                <div class="w-full bg-surface-container-low h-full rounded-t-xl relative overflow-hidden flex flex-col justify-end">
                    <div class="w-full bg-surface-container-highest h-[80%] rounded-t-lg"></div>
                    <div class="w-full bg-primary h-[90%] absolute bottom-0 shadow-[0_-10px_20px_rgba(192,193,255,0.2)]"></div>
                </div>
                <div class="w-full bg-surface-container-low h-full rounded-t-xl relative overflow-hidden flex flex-col justify-end">
                    <div class="w-full bg-surface-container-highest h-[60%] rounded-t-lg"></div>
                    <div class="w-full bg-primary/40 h-[50%] absolute bottom-0"></div>
                </div>
            </div>

            <div class="flex justify-between mt-4 text-xs text-on-surface-variant font-medium">
                <span>MON</span><span>TUE</span><span>WED</span><span>THU</span><span>FRI</span><span>SAT</span><span>SUN</span>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4 bg-surface-container rounded-2xl p-8 flex flex-col items-center justify-center text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>
            <h3 class="font-headline text-xl font-bold mb-8">Completion Rate</h3>
            <div class="relative w-48 h-48 flex items-center justify-center mb-8">
                <svg class="w-full h-full transform -rotate-90">
                    <circle class="text-surface-container-highest" cx="96" cy="96" fill="transparent" r="80" stroke="currentColor" stroke-width="12"></circle>
                    <circle class="text-primary" cx="96" cy="96" fill="transparent" r="80" stroke="currentColor" stroke-dasharray="502.4" stroke-dashoffset="125.6" stroke-width="12"></circle>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-4xl font-headline font-extrabold">75%</span>
                    <span class="text-xs text-on-surface-variant uppercase tracking-widest">Efficiency</span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 w-full">
                <div class="bg-surface-container-low p-3 rounded-xl border border-outline-variant/5">
                    <p class="text-xs text-on-surface-variant mb-1">Optimal</p>
                    <p class="font-bold text-primary">85%</p>
                </div>
                <div class="bg-surface-container-low p-3 rounded-xl border border-outline-variant/5">
                    <p class="text-xs text-on-surface-variant mb-1">Average</p>
                    <p class="font-bold">72%</p>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-5 bg-surface-container rounded-2xl p-8">
            <h3 class="font-headline text-2xl font-bold mb-6">Top Contributors</h3>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full border border-primary/20 overflow-hidden">
                            <img alt="Alex Rivers" src="https://ui-avatars.com/api/?name=Alex+Rivers&background=818cf8&color=fff&size=40" />
                        </div>
                        <div>
                            <p class="font-bold">Alex Rivers</p>
                            <p class="text-xs text-on-surface-variant">Product Designer</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary">42 Tasks</p>
                        <div class="w-24 h-1.5 bg-surface-container-highest rounded-full mt-1 overflow-hidden">
                            <div class="bg-primary h-full w-[90%]"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full border border-primary/20 overflow-hidden">
                            <img alt="Sarah Chen" src="https://ui-avatars.com/api/?name=Sarah+Chen&background=c084fc&color=fff&size=40" />
                        </div>
                        <div>
                            <p class="font-bold">Sarah Chen</p>
                            <p class="text-xs text-on-surface-variant">Senior Engineer</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary">38 Tasks</p>
                        <div class="w-24 h-1.5 bg-surface-container-highest rounded-full mt-1 overflow-hidden">
                            <div class="bg-primary h-full w-[80%]"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full border border-primary/20 overflow-hidden">
                            <img alt="Jordan Smith" src="https://ui-avatars.com/api/?name=Jordan+Smith&background=34d399&color=fff&size=40" />
                        </div>
                        <div>
                            <p class="font-bold">Jordan Smith</p>
                            <p class="text-xs text-on-surface-variant">Project Manager</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary">31 Tasks</p>
                        <div class="w-24 h-1.5 bg-surface-container-highest rounded-full mt-1 overflow-hidden">
                            <div class="bg-primary h-full w-[65%]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-7 bg-surface-container rounded-2xl p-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="font-headline text-2xl font-bold">Category Distribution</h3>
                <span class="text-xs font-bold text-on-surface-variant bg-surface-container-highest px-3 py-1 rounded-full uppercase tracking-widest">Global View</span>
            </div>
            <div class="flex flex-wrap gap-4">
                <div class="flex-grow min-w-[200px] bg-surface-container-low p-5 rounded-2xl border border-outline-variant/10 hover:border-primary/40 transition-colors">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-sm">code</span>
                        </div>
                        <span class="text-xs font-bold opacity-60">342 Tasks</span>
                    </div>
                    <h4 class="font-bold mb-1">Development</h4>
                    <div class="w-full h-1 bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="bg-primary h-full w-[45%]"></div>
                    </div>
                </div>

                <div class="flex-grow min-w-[200px] bg-surface-container-low p-5 rounded-2xl border border-outline-variant/10 hover:border-primary/40 transition-colors">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-purple-400 text-sm">palette</span>
                        </div>
                        <span class="text-xs font-bold opacity-60">218 Tasks</span>
                    </div>
                    <h4 class="font-bold mb-1">Design</h4>
                    <div class="w-full h-1 bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="bg-purple-400 h-full w-[28%]"></div>
                    </div>
                </div>

                <div class="flex-grow min-w-[200px] bg-surface-container-low p-5 rounded-2xl border border-outline-variant/10 hover:border-primary/40 transition-colors">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-8 h-8 rounded-lg bg-red-500/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-red-400 text-sm">bug_report</span>
                        </div>
                        <span class="text-xs font-bold opacity-60">94 Tasks</span>
                    </div>
                    <h4 class="font-bold mb-1">QA and Debugging</h4>
                    <div class="w-full h-1 bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="bg-red-400 h-full w-[15%]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script></script>
@endpush
