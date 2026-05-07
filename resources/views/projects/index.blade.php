@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-index.css') }}">
@endpush

@section('title', 'Projects - XenonOS')

@section('content')
<x-navbar />

<main class="flex-1 md:ml-[260px] min-h-screen">
    <div class="pt-24 px-6 md:px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <!-- Branding & Strategic Project Controls -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <h1 class="text-4xl md:text-5xl font-headline font-light text-white tracking-tight">Projects</h1>
                <p class="text-on-surface-variant font-body">Manage all client projects.</p>
            </div>
            <button class="bg-primary text-on-primary-container px-6 py-3 rounded-2xl font-bold flex items-center gap-2 hover:bg-primary-container transition-colors shadow-lg shadow-primary/10">
                <span class="material-symbols-outlined">add_circle</span>
                Create Project
            </button>
        </div>

        <div class="grid grid-cols-12 gap-6 md:gap-8">
            <!-- Main Grid Column -->
            <div class="col-span-12 lg:col-span-9 space-y-6">
                <!-- Filter Bar -->
                <div class="bg-surface-container-low p-4 rounded-3xl flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2 bg-surface-container px-4 py-2 rounded-2xl">
                        <span class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Status:</span>
                        <select aria-label="Filter projects by status" class="bg-transparent border-none text-sm p-0 focus:ring-0 text-primary font-medium cursor-pointer">
                            <option>Active</option>
                            <option>Completed</option>
                            <option>Pending</option>
                            <option>Delayed</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2 bg-surface-container px-4 py-2 rounded-2xl">
                        <span class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Client:</span>
                        <select aria-label="Filter projects by client" class="bg-transparent border-none text-sm p-0 focus:ring-0 text-primary font-medium cursor-pointer">
                            <option>All Clients</option>
                            <option>Aura Dynamics</option>
                            <option>Solaris Media</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2 bg-surface-container px-4 py-2 rounded-2xl">
                        <span class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Sort:</span>
                        <select aria-label="Sort projects by" class="bg-transparent border-none text-sm p-0 focus:ring-0 text-primary font-medium cursor-pointer">
                            <option>Newest First</option>
                            <option>Oldest First</option>
                            <option>Deadline</option>
                        </select>
                    </div>
                    <div class="ml-auto flex items-center bg-surface-container p-1 rounded-xl">
                        <button class="p-2 bg-surface-bright text-primary rounded-lg shadow-sm">
                            <span class="material-symbols-outlined text-sm">grid_view</span>
                        </button>
                        <button class="p-2 text-on-surface-variant hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined text-sm">table_rows</span>
                        </button>
                    </div>
                </div>

                <!-- Projects Table -->
                <div class="bg-surface-container-low rounded-3xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="border-b border-white/5 bg-surface-container-low/50">
                                <tr>
                                    <th class="px-6 py-5 text-xs font-label text-on-surface-variant uppercase tracking-widest">Project Name</th>
                                    <th class="px-6 py-5 text-xs font-label text-on-surface-variant uppercase tracking-widest">Client</th>
                                    <th class="px-6 py-5 text-xs font-label text-on-surface-variant uppercase tracking-widest">Status</th>
                                    <th class="px-6 py-5 text-xs font-label text-on-surface-variant uppercase tracking-widest">Progress</th>
                                    <th class="px-6 py-5 text-xs font-label text-on-surface-variant uppercase tracking-widest">Team</th>
                                    <th class="px-6 py-5 text-xs font-label text-on-surface-variant uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                <!-- Row 1 -->
                                <tr class="group hover:bg-surface-container transition-all duration-200 cursor-pointer">
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col">
                                            <span class="text-white font-medium">Lumina Rebrand</span>
                                            <span class="text-xs text-on-surface-variant">Q4 Brand Identity</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-sm">Aura Dynamics</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-tighter">Active</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col gap-1.5 w-32">
                                            <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                                                <div class="h-full bg-primary rounded-full" style="width: 75%"></div>
                                            </div>
                                            <span class="text-[10px] text-on-surface-variant font-medium">75% Complete</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex -space-x-2">
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low object-cover" alt="Team" src="https://ui-avatars.com/api/?name=JD&background=818cf8&color=fff" />
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low object-cover" alt="Team" src="https://ui-avatars.com/api/?name=AS&background=34d399&color=fff" />
                                            <div class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center text-[10px] font-bold border-2 border-surface-container-low">+3</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <button class="p-2 text-on-surface-variant hover:text-white">
                                            <span class="material-symbols-outlined">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 2 -->
                                <tr class="group hover:bg-surface-container transition-all duration-200 cursor-pointer">
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col">
                                            <span class="text-white font-medium">Ether Mobile App</span>
                                            <span class="text-xs text-on-surface-variant">UX Audit & UI Design</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-sm">Solaris Media</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-tertiary/20 text-tertiary text-[10px] font-bold uppercase tracking-tighter">Delayed</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col gap-1.5 w-32">
                                            <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                                                <div class="h-full bg-tertiary rounded-full" style="width: 32%"></div>
                                            </div>
                                            <span class="text-[10px] text-on-surface-variant font-medium">32% Complete</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex -space-x-2">
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low object-cover" alt="Team" src="https://ui-avatars.com/api/?name=MK&background=c084fc&color=fff" />
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low object-cover" alt="Team" src="https://ui-avatars.com/api/?name=RB&background=f472b6&color=fff" />
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <button class="p-2 text-on-surface-variant hover:text-white">
                                            <span class="material-symbols-outlined">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row 3 -->
                                <tr class="group hover:bg-surface-container transition-all duration-200 cursor-pointer">
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col">
                                            <span class="text-white font-medium">Nexus Platform</span>
                                            <span class="text-xs text-on-surface-variant">Full Stack Development</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-sm">TechVentures</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-success/10 text-success text-[10px] font-bold uppercase tracking-tighter">Completed</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col gap-1.5 w-32">
                                            <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                                                <div class="h-full bg-success rounded-full" style="width: 100%"></div>
                                            </div>
                                            <span class="text-[10px] text-on-surface-variant font-medium">100% Complete</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex -space-x-2">
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low object-cover" alt="Team" src="https://ui-avatars.com/api/?name=JT&background=818cf8&color=fff" />
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <button class="p-2 text-on-surface-variant hover:text-white">
                                            <span class="material-symbols-outlined">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-span-12 lg:col-span-3 space-y-6">
                <!-- Stats -->
                <div class="bg-surface-container-low p-6 rounded-3xl">
                    <h3 class="text-xs font-label text-on-surface-variant uppercase tracking-widest mb-4">Overview</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Total Projects</span>
                            <span class="text-xl font-bold text-white">24</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Active</span>
                            <span class="text-xl font-bold text-primary">12</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Completed</span>
                            <span class="text-xl font-bold text-success">8</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Delayed</span>
                            <span class="text-xl font-bold text-tertiary">4</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-surface-container-low p-6 rounded-3xl">
                    <h3 class="text-xs font-label text-on-surface-variant uppercase tracking-widest mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-primary mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm text-white">Lumina Rebrand updated</p>
                                <p class="text-xs text-on-surface-variant">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-success mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm text-white">Nexus completed</p>
                                <p class="text-xs text-on-surface-variant">Yesterday</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-tertiary mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm text-white">Ether delayed</p>
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
<script src="{{ asset('js/projects-index.js') }}"></script>
@endpush