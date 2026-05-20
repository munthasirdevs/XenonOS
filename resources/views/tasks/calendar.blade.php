@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tasks-calendar.css') }}">
@endpush

@section('title', 'Task Calendar - XenonOS')

@section('content')

<div class="p-8">
    <div class="max-w-[1600px] mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
            <div>
                <h2 class="font-headline text-4xl text-primary tracking-tight mb-2">October 2024</h2>
                <p class="text-on-surface-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">schedule</span>
                    You have 14 tasks scheduled for this month.
                </p>
            </div>
            <div class="flex items-center gap-4 bg-surface-container p-1 rounded-2xl shadow-inner">
                <button class="p-2 hover:bg-surface-container-highest rounded-xl text-on-surface transition-all">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="px-6 py-2 bg-surface-container-highest text-on-surface rounded-xl font-semibold text-sm">Today</button>
                <button class="p-2 hover:bg-surface-container-highest rounded-xl text-on-surface transition-all">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex bg-surface-container-low p-1 rounded-xl">
                    <button class="px-4 py-1.5 text-xs font-bold rounded-lg bg-primary text-on-primary">Month</button>
                    <button class="px-4 py-1.5 text-xs font-medium text-on-surface-variant hover:text-on-surface transition-colors">Week</button>
                    <button class="px-4 py-1.5 text-xs font-medium text-on-surface-variant hover:text-on-surface transition-colors">Day</button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-7 gap-px bg-outline-variant/10 rounded-2xl overflow-hidden shadow-2xl border border-outline-variant/5">
            <div class="bg-surface-container py-4 text-center border-b border-outline-variant/10">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Sun</span>
            </div>
            <div class="bg-surface-container py-4 text-center border-b border-outline-variant/10">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Mon</span>
            </div>
            <div class="bg-surface-container py-4 text-center border-b border-outline-variant/10">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Tue</span>
            </div>
            <div class="bg-surface-container py-4 text-center border-b border-outline-variant/10">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Wed</span>
            </div>
            <div class="bg-surface-container py-4 text-center border-b border-outline-variant/10">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Thu</span>
            </div>
            <div class="bg-surface-container py-4 text-center border-b border-outline-variant/10">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Fri</span>
            </div>
            <div class="bg-surface-container py-4 text-center border-b border-outline-variant/10">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Sat</span>
            </div>

            <div class="bg-surface-container-low h-40 opacity-40"></div>
            <div class="bg-surface-container-low h-40 opacity-40"></div>

            <div class="bg-surface-container h-40 p-3 group relative hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">01</span>
                <button class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 p-1 hover:bg-primary/20 rounded-md transition-all">
                    <span class="material-symbols-outlined text-primary text-sm">add</span>
                </button>
            </div>

            <div class="bg-surface-container h-40 p-3 group relative hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">02</span>
                <div class="mt-2 p-2 bg-red-500/20 border-l-2 border-red-500 rounded-r-lg calendar-event hover:scale-[1.02] transition-transform">
                    <p class="text-[10px] font-bold text-red-400 uppercase mb-0.5">Urgent</p>
                    <p class="text-xs font-medium text-on-surface truncate">Server Migration</p>
                </div>
            </div>

            <div class="bg-surface-container h-40 p-3 group relative hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">03</span>
            </div>

            <div class="bg-surface-container h-40 p-3 group relative hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">04</span>
                <div class="mt-2 p-2 bg-primary/20 border-l-2 border-primary rounded-r-lg hover:scale-[1.02] transition-transform calendar-event">
                    <p class="text-[10px] font-bold text-primary uppercase mb-0.5">Main</p>
                    <p class="text-xs font-medium text-on-surface truncate">API Documentation</p>
                </div>
            </div>

            <div class="bg-surface-container-low h-40 p-3">
                <span class="text-sm font-semibold text-on-surface-variant/40">05</span>
            </div>

            <div class="bg-surface-container-low h-40 p-3"><span class="text-sm font-semibold text-on-surface-variant/40">06</span></div>
            <div class="bg-surface-container h-40 p-3 group relative hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">07</span>
            </div>
            <div class="bg-surface-container h-40 p-3 group relative hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">08</span>
                <div class="mt-2 p-2 bg-purple-500/20 border-l-2 border-purple-400 rounded-r-lg hover:scale-[1.02] transition-transform calendar-event">
                    <p class="text-[10px] font-bold text-purple-400 uppercase mb-0.5">Planning</p>
                    <p class="text-xs font-medium text-on-surface truncate">Team Sync: Sprint 4</p>
                </div>
            </div>

            <div class="bg-surface-container h-40 p-3 group relative border-2 border-primary/40 ring-4 ring-primary/5 z-10">
                <span class="text-sm font-bold text-primary flex items-center gap-1.5">09 <span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span></span>
                <div class="mt-2 p-2 bg-surface-container-highest border border-outline-variant/20 rounded-lg shadow-xl calendar-event hover:border-primary/50 transition-colors">
                    <p class="text-xs font-semibold text-on-surface">Finalize UI Mockups</p>
                    <div class="flex items-center gap-2 mt-2">
                        <img alt="Team member" class="w-4 h-4 rounded-full" src="https://ui-avatars.com/api/?name=Reviewer&background=818cf8&color=fff&size=16" />
                        <span class="text-[9px] text-on-surface-variant">Reviewing now</span>
                    </div>
                </div>
                <button class="absolute bottom-3 left-1/2 -translate-x-1/2 bg-primary/10 hover:bg-primary/20 text-primary px-3 py-1 rounded-full text-[10px] font-bold transition-all opacity-0 group-hover:opacity-100">
                    + New Event
                </button>
            </div>

            <div class="bg-surface-container h-40 p-3 group relative hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">10</span>
            </div>
            <div class="bg-surface-container h-40 p-3 group relative hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">11</span>
                <div class="mt-2 flex flex-col gap-1">
                    <div class="h-1.5 w-full bg-primary/40 rounded-full"></div>
                    <div class="h-1.5 w-2/3 bg-purple-400/40 rounded-full"></div>
                    <p class="text-[10px] text-on-surface-variant mt-1">+ 2 more tasks</p>
                </div>
            </div>
            <div class="bg-surface-container-low h-40 p-3"><span class="text-sm font-semibold text-on-surface-variant/40">12</span></div>

            <div class="bg-surface-container-low h-40 p-3"><span class="text-sm font-semibold text-on-surface-variant/40">13</span></div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors"><span class="text-sm font-semibold text-on-surface-variant">14</span></div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors"><span class="text-sm font-semibold text-on-surface-variant">15</span></div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors"><span class="text-sm font-semibold text-on-surface-variant">16</span></div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">17</span>
                <div class="mt-2 p-2 bg-primary/20 border border-primary/30 rounded-lg">
                    <p class="text-xs text-on-surface italic">User Research Session</p>
                </div>
            </div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors"><span class="text-sm font-semibold text-on-surface-variant">18</span></div>
            <div class="bg-surface-container-low h-40 p-3"><span class="text-sm font-semibold text-on-surface-variant/40">19</span></div>

            <div class="bg-surface-container-low h-40 p-3"><span class="text-sm font-semibold text-on-surface-variant/40">20</span></div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors"><span class="text-sm font-semibold text-on-surface-variant">21</span></div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors"><span class="text-sm font-semibold text-on-surface-variant">22</span></div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors"><span class="text-sm font-semibold text-on-surface-variant">23</span></div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors"><span class="text-sm font-semibold text-on-surface-variant">24</span></div>
            <div class="bg-surface-container h-40 p-3 hover:bg-surface-container-high transition-colors">
                <span class="text-sm font-semibold text-on-surface-variant">25</span>
                <div class="mt-2 p-2 bg-red-500/20 border-l-2 border-red-500 rounded-r-lg hover:scale-[1.02] transition-transform calendar-event">
                    <p class="text-xs font-medium text-on-surface truncate">Product Launch</p>
                </div>
            </div>
            <div class="bg-surface-container-low h-40 p-3"><span class="text-sm font-semibold text-on-surface-variant/40">26</span></div>
        </div>

        <div class="mt-12 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-surface-container rounded-2xl p-6 shadow-xl border border-outline-variant/5">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-on-surface">Upcoming Focus</h3>
                    <button class="text-primary text-sm font-semibold hover:underline">View All Tasks</button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-surface-container-lowest p-4 rounded-xl border border-outline-variant/10 group hover:border-primary/40 transition-all cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center text-red-400">
                            <span class="material-symbols-outlined">priority_high</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-on-surface">Cloud Security Audit</p>
                            <p class="text-xs text-on-surface-variant">Scheduled for Oct 12 - 4:00 PM</p>
                        </div>
                        <div class="flex -space-x-2">
                            <img alt="Team member avatar" class="w-7 h-7 rounded-full border-2 border-surface-container-low" src="https://ui-avatars.com/api/?name=User+1&background=818cf8&color=fff&size=28" />
                            <img alt="Team member avatar" class="w-7 h-7 rounded-full border-2 border-surface-container-low" src="https://ui-avatars.com/api/?name=User+2&background=c084fc&color=fff&size=28" />
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-surface-container-lowest p-4 rounded-xl border border-outline-variant/10 group hover:border-primary/40 transition-all cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">draw</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-on-surface">Final Logo Export</p>
                            <p class="text-xs text-on-surface-variant">Scheduled for Oct 15 - 10:30 AM</p>
                        </div>
                        <div class="px-3 py-1 bg-surface-container-highest rounded-full text-[10px] font-bold text-primary">IN REVIEW</div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-surface-container to-surface-container-high rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary mb-6">
                        <span class="material-symbols-outlined text-3xl">drag_indicator</span>
                    </div>
                    <h3 class="font-headline text-xl text-primary mb-3">Precision Control</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed mb-6">
                        Need to reschedule? Simply <span class="text-primary font-bold">drag and drop</span> any task slot to a new date.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-xs text-on-surface">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span> Urgent Action Required
                        </li>
                        <li class="flex items-center gap-3 text-xs text-on-surface">
                            <span class="w-2 h-2 rounded-full bg-primary"></span> Standard Workflow
                        </li>
                        <li class="flex items-center gap-3 text-xs text-on-surface">
                            <span class="w-2 h-2 rounded-full bg-purple-400"></span> Review and Discussion
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/tasks-calendar.js') }}"></script>
@endpush
