@extends('layouts.app')

@section('content')
<x-navbar />

<main class="flex-1 min-h-screen flex flex-col">
    <!-- Main Scrollable Canvas -->
    <div class="p-8">
        <!-- Section 3: Branding & Strategic Resource Deployment -->
        <header class="mb-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="text-primary font-label text-[0.6875rem] font-bold tracking-[0.05em] uppercase block mb-2">Workspace</span>
                    <h1 class="font-headline text-5xl md:text-6xl font-light tracking-[-0.02em] text-on-surface">
                        Active Tasks</h1>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex -space-x-3">
                        <img alt="Team Member Avatar A" class="h-10 w-10 rounded-full border-2 border-surface" src="https://ui-avatars.com/api/?name=Emma+James&amp;background=c0c1ff&amp;color=1a1a2e&amp;size=40" />
                        <img alt="Team Member Avatar B" class="h-10 w-10 rounded-full border-2 border-surface" src="https://ui-avatars.com/api/?name=Kim+Dan&amp;background=e0e1ff&amp;color=1a1a2e&amp;size=40" />
                        <img alt="Team Member Avatar C" class="h-10 w-10 rounded-full border-2 border-surface" src="https://ui-avatars.com/api/?name=Moe+Alex&amp;background=f0f0ff&amp;color=1a1a2e&amp;size=40" />
                        <div class="h-10 w-10 rounded-full bg-surface-container-high border-2 border-surface flex items-center justify-center text-xs font-bold text-on-surface-variant">+4</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Section 4: Operational Filter Infrastructure -->
        <section class="sticky top-[0.5rem] z-30 bg-surface/95 backdrop-blur-md mb-8 py-4 rounded-xl">
            <div class="bg-surface-container-low p-4 rounded-xl shadow-lg flex flex-wrap items-center gap-4">
                <!-- Search -->
                <div class="relative flex-grow min-w-[240px]">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
                    <input id="task-search" class="w-full bg-surface-container border-none rounded-lg pl-10 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-primary/50 text-on-surface" placeholder="Search task names..." type="text" name="search_tasks" aria-label="Search tasks by name" />
                </div>
                <!-- Dropdowns -->
                <div class="flex flex-wrap items-center gap-3">
                    <label for="filter-project" class="sr-only">Filter by project</label>
                    <select id="filter-project" class="bg-surface-container-high border-none rounded-lg px-4 py-2.5 text-sm font-medium text-on-surface focus:ring-2 focus:ring-primary/50 appearance-none min-w-[140px]" name="filter_project" aria-label="Filter tasks by project">
                        <option>All Projects</option>
                        <option>Obsidian UI</option>
                        <option>Nike Campaign</option>
                        <option>Tesla Rebrand</option>
                    </select>
                    <label for="filter-status" class="sr-only">Filter by status</label>
                    <select id="filter-status" class="bg-surface-container-high border-none rounded-lg px-4 py-2.5 text-sm font-medium text-on-surface focus:ring-2 focus:ring-primary/50 appearance-none min-w-[140px]" name="filter_status" aria-label="Filter tasks by status">
                        <option>Any Status</option>
                        <option>Pending</option>
                        <option>In Progress</option>
                        <option>Completed</option>
                    </select>
                    <label for="filter-priority" class="sr-only">Filter by priority</label>
                    <select id="filter-priority" class="bg-surface-container-high border-none rounded-lg px-4 py-2.5 text-sm font-medium text-on-surface focus:ring-2 focus:ring-primary/50 appearance-none min-w-[140px]" name="filter_priority" aria-label="Filter tasks by priority">
                        <option>Priority</option>
                        <option>High</option>
                        <option>Medium</option>
                        <option>Low</option>
                    </select>
                </div>
                <div class="h-8 w-[1px] bg-outline-variant/20 mx-2"></div>
                <button class="bg-primary-container text-on-primary-fixed-variant px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 hover:brightness-110 active:scale-95 transition-all">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Add New Task
                </button>
            </div>
        </section>

        <section>
            <!-- Section 5: Bulk Dynamic Action Interface -->
            <div class="mb-4 flex items-center justify-between px-2">
                <div class="flex items-center gap-4">
                    <input id="select-all-tasks" class="rounded bg-surface-container border-outline-variant/30 text-primary focus:ring-primary h-5 w-5" type="checkbox" aria-label="Select all tasks" />
                    <label for="select-all-tasks" class="text-sm text-outline font-medium">Select All Tasks</label>
                </div>
                <div class="flex items-center gap-2">
                    <button class="text-xs font-bold text-outline uppercase tracking-wider hover:text-on-surface px-3 py-1 transition-colors">Bulk Archive</button>
                    <button class="text-xs font-bold text-error uppercase tracking-wider hover:brightness-110 px-3 py-1 transition-colors">Bulk Delete</button>
                </div>
            </div>

            <!-- Section 6: Mission Command Registry -->
            <div class="bg-surface-container-low rounded-xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-high/50 text-[0.6875rem] uppercase tracking-widest font-bold text-outline">
                                <th class="px-6 py-4 w-12"></th>
                                <th class="px-6 py-4">Task Details</th>
                                <th class="px-6 py-4">Assigned</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Priority</th>
                                <th class="px-6 py-4">Due Date</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/5">
                            <!-- Task Item 1 -->
                            <tr class="group hover:bg-surface-bright/30 transition-colors">
                                <td class="px-6 py-5">
                                    <input id="task-1" class="rounded bg-surface-container border-outline-variant/30 text-primary focus:ring-primary h-4 w-4" type="checkbox" aria-label="Select task: Design System Refresh" />
                                    <label for="task-1" class="sr-only">Select task: Design System Refresh</label>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-on-surface font-semibold text-sm group-hover:text-primary transition-colors cursor-pointer">Design System Refresh</span>
                                        <span class="text-xs text-outline cursor-pointer hover:underline">Obsidian UI</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex -space-x-2">
                                        <img alt="Emma's profile picture" class="h-7 w-7 rounded-full border border-surface shadow-sm" src="https://ui-avatars.com/api/?name=Emma+S&amp;background=c0c1ff&amp;color=1a1a2e&amp;size=28" />
                                        <img alt="James's profile picture" class="h-7 w-7 rounded-full border border-surface shadow-sm" src="https://ui-avatars.com/api/?name=James+M&amp;background=e0e1ff&amp;color=1a1a2e&amp;size=28" />
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-secondary-container/30 text-secondary">
                                        <span class="h-1.5 w-1.5 rounded-full bg-secondary"></span>
                                        In Progress
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-error-container/20 text-error">High</span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm text-on-surface-variant">Oct 24, 2023</span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="p-2 text-outline hover:text-primary transition-colors"><span class="material-symbols-outlined text-lg">edit</span></button>
                                        <button class="p-2 text-outline hover:text-on-surface transition-colors"><span class="material-symbols-outlined text-lg">more_vert</span></button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Task Item 2 -->
                            <tr class="group hover:bg-surface-bright/30 transition-colors">
                                <td class="px-6 py-5">
                                    <input aria-label="Select task: Onboarding Flows" class="rounded bg-surface-container border-outline-variant/30 text-primary focus:ring-primary h-4 w-4" type="checkbox" />
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-on-surface font-semibold text-sm group-hover:text-primary transition-colors cursor-pointer">Onboarding Flows</span>
                                        <span class="text-xs text-outline cursor-pointer hover:underline">Nike Campaign</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex -space-x-2">
                                        <img alt="Kim's profile picture" class="h-7 w-7 rounded-full border border-surface shadow-sm" src="https://ui-avatars.com/api/?name=Kim+T&amp;background=f0f0ff&amp;color=1a1a2e&amp;size=28" />
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-tertiary-container/20 text-tertiary">
                                        <span class="h-1.5 w-1.5 rounded-full bg-tertiary"></span>
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-tertiary-container/20 text-tertiary">Medium</span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm text-on-surface-variant">Nov 02, 2023</span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="p-2 text-outline hover:text-primary transition-colors"><span class="material-symbols-outlined text-lg">edit</span></button>
                                        <button class="p-2 text-outline hover:text-on-surface transition-colors"><span class="material-symbols-outlined text-lg">more_vert</span></button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Task Item 3 -->
                            <tr class="group hover:bg-surface-bright/30 transition-colors">
                                <td class="px-6 py-5">
                                    <input aria-label="Select task: Competitor Audit" class="rounded bg-surface-container border-outline-variant/30 text-primary focus:ring-primary h-4 w-4" type="checkbox" />
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-on-surface font-semibold text-sm group-hover:text-primary transition-colors cursor-pointer">Competitor Audit</span>
                                        <span class="text-xs text-outline cursor-pointer hover:underline">Tesla Rebrand</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex -space-x-2">
                                        <img alt="Dan's profile picture" class="h-7 w-7 rounded-full border border-surface shadow-sm" src="https://ui-avatars.com/api/?name=Dan+L&amp;background=c0c1ff&amp;color=1a1a2e&amp;size=28" />
                                        <img alt="Moe's profile picture" class="h-7 w-7 rounded-full border border-surface shadow-sm" src="https://ui-avatars.com/api/?name=Moe+S&amp;background=e0e1ff&amp;color=1a1a2e&amp;size=28" />
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-primary-container/20 text-primary">
                                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                                        Completed
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-surface-container-highest text-outline">Low</span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm text-on-surface-variant">Oct 12, 2023</span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="p-2 text-outline hover:text-primary transition-colors"><span class="material-symbols-outlined text-lg">edit</span></button>
                                        <button class="p-2 text-outline hover:text-on-surface transition-colors"><span class="material-symbols-outlined text-lg">more_vert</span></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination / Footer -->
                <div class="px-6 py-4 bg-surface-container-high/20 border-t border-outline-variant/5 flex items-center justify-between">
                    <span class="text-xs text-outline font-medium">Showing 1 to 3 of 42 tasks</span>
                    <div class="flex items-center gap-1">
                        <button class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline disabled:opacity-30" disabled="">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                        </button>
                        <button class="h-8 w-8 rounded-lg bg-primary/20 text-primary font-bold text-xs">1</button>
                        <button class="h-8 w-8 rounded-lg hover:bg-surface-container-highest text-outline font-medium text-xs">2</button>
                        <button class="h-8 w-8 rounded-lg hover:bg-surface-container-highest text-outline font-medium text-xs">3</button>
                        <button class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 7: Multi-Dimensional Velocity Analytics -->
        <section class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-surface-container-low p-6 rounded-xl border-l-2 border-primary">
                <p class="font-label text-[0.6875rem] font-bold text-outline tracking-wider uppercase mb-1">Weekly Velocity</p>
                <div class="flex items-end gap-3">
                    <span class="text-3xl font-headline font-semibold text-on-surface">18</span>
                    <span class="text-xs text-primary pb-1">+12% from last week</span>
                </div>
                <div class="mt-4 w-full h-1 bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="h-full bg-primary w-[65%]"></div>
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-xl border-l-2 border-tertiary">
                <p class="font-label text-[0.6875rem] font-bold text-outline tracking-wider uppercase mb-1">Overdue Items</p>
                <div class="flex items-end gap-3">
                    <span class="text-3xl font-headline font-semibold text-on-surface">04</span>
                    <span class="text-xs text-tertiary pb-1">Requires Attention</span>
                </div>
                <div class="mt-4 flex gap-1">
                    <div class="flex-grow h-1 bg-tertiary rounded-full"></div>
                    <div class="flex-grow h-1 bg-tertiary rounded-full"></div>
                    <div class="flex-grow h-1 bg-tertiary rounded-full"></div>
                    <div class="flex-grow h-1 bg-tertiary rounded-full"></div>
                    <div class="flex-grow h-1 bg-surface-container-highest rounded-full"></div>
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-xl border-l-2 border-primary-container">
                <p class="font-label text-[0.6875rem] font-bold text-outline tracking-wider uppercase mb-1">Resource Load</p>
                <div class="flex items-end gap-3">
                    <span class="text-3xl font-headline font-semibold text-on-surface">92%</span>
                    <span class="text-xs text-primary-container pb-1">Near Capacity</span>
                </div>
                <div class="mt-4 flex -space-x-1.5">
                    <div class="h-6 w-6 rounded-full bg-primary-container border-2 border-surface-container-low text-[8px] flex items-center justify-center font-bold">EM</div>
                    <div class="h-6 w-6 rounded-full bg-primary border-2 border-surface-container-low text-[8px] flex items-center justify-center font-bold">JS</div>
                    <div class="h-6 w-6 rounded-full bg-tertiary-container border-2 border-surface-container-low text-[8px] flex items-center justify-center font-bold">KT</div>
                    <div class="h-6 w-6 rounded-full bg-outline border-2 border-surface-container-low text-[8px] flex items-center justify-center font-bold">+2</div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tasks-index.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('js/tasks-index.js') }}"></script>
@endpush
