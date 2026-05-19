@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-hub.css') }}">
@endpush

@section('title', 'Projects Hub - XenonOS')

@section('content')
<x-navbar />

<main class="flex-1 md:ml-[260px] min-h-screen">
    <div class="p-6 md:p-8 space-y-8">
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="md:col-span-2 bg-surface-container rounded-2xl p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-400">
                <div class="relative z-10 h-full flex flex-col justify-between">
                    <div>
                        <p class="text-on-surface-variant text-xs font-semibold tracking-widest uppercase">System Performance</p>
                        @php
                            $completedProjects = \App\Models\Project::where('status', 'completed')->count();
                            $totalProjects = \App\Models\Project::count();
                            $efficiency = $totalProjects > 0 ? round(($completedProjects / $totalProjects) * 100) : 0;
                        @endphp
                        <h3 class="font-syne font-extrabold text-3xl mt-1 text-[#c0c1ff]">{{ $efficiency }}% Efficiency</h3>
                    </div>
                    <div class="mt-8 flex items-end gap-1 h-12">
                        <div class="w-full bg-primary/20 h-4 rounded-full"></div>
                        <div class="w-full bg-primary/40 h-8 rounded-full"></div>
                        <div class="w-full bg-primary/60 h-6 rounded-full"></div>
                        <div class="w-full bg-primary h-12 rounded-full"></div>
                        <div class="w-full bg-primary/30 h-10 rounded-full"></div>
                    </div>
                </div>
                <div class="absolute -right-8 -bottom-8 opacity-10 group-hover:scale-110 transition-transform duration-700">
                    <span class="material-symbols-outlined text-[160px]">analytics</span>
                </div>
            </div>
            <div class="bg-surface-container rounded-2xl p-6 group hover:scale-[1.02] transition-all duration-400">
                <div class="w-10 h-10 rounded-lg bg-tertiary/20 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-tertiary">bolt</span>
                </div>
                <p class="text-on-surface-variant text-sm font-medium">Active Sprints</p>
                <h3 class="font-syne font-extrabold text-4xl mt-1">{{ $stats['active'] }}</h3>
                <p class="text-xs text-tertiary mt-2">Active projects</p>
            </div>
            <div class="bg-surface-container rounded-2xl p-6 group hover:scale-[1.02] transition-all duration-400">
                <div class="w-10 h-10 rounded-lg bg-primary/20 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-primary">group</span>
                </div>
                <p class="text-on-surface-variant text-sm font-medium">Total Team</p>
                <h3 class="font-syne font-extrabold text-4xl mt-1">{{ \App\Models\User::count() }}</h3>
                <div class="w-full bg-surface-container-lowest h-1.5 rounded-full mt-4">
                    <div class="bg-primary w-full h-full rounded-full shadow-[0_0_8px_rgba(99,102,241,0.5)]"></div>
                </div>
            </div>
        </section>

        <section class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <button class="bg-surface-container hover:bg-surface-container-high px-4 py-2 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span>
                    Status: All
                </button>
                <button class="bg-surface-container hover:bg-surface-container-high px-4 py-2 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
                    Client: All
                </button>
                <button class="bg-surface-container hover:bg-surface-container-high px-4 py-2 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
                    Sort: Newest
                </button>
            </div>
            <div class="flex bg-surface-container-lowest p-1 rounded-xl">
                <button class="p-2 bg-surface-container-high text-primary rounded-lg transition-all">
                    <span class="material-symbols-outlined">grid_view</span>
                </button>
                <button class="p-2 text-on-surface-variant hover:text-on-surface rounded-lg transition-all">
                    <span class="material-symbols-outlined">view_list</span>
                </button>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
                @php
                    $taskCount = $project->tasks()->count();
                    $completedTasks = $project->tasks()->where('status', 'completed')->count();
                    $progress = $taskCount > 0 ? round(($completedTasks / $taskCount) * 100) : 0;
                    
                    $statusClasses = [
                        'active' => 'bg-primary/10 text-primary border-primary/20',
                        'completed' => 'bg-success/10 text-success border-success/20',
                        'pending' => 'bg-tertiary/10 text-tertiary border-tertiary/20',
                        'on_hold' => 'bg-outline/10 text-outline border-outline/20',
                    ];
                    $statusClass = $statusClasses[$project->status] ?? 'bg-primary/10 text-primary border-primary/20';
                    
                    $statusLabel = [
                        'active' => 'Active',
                        'completed' => 'Completed',
                        'pending' => 'Pending',
                        'on_hold' => 'On Hold',
                    ];
                @endphp
                <div class="bg-surface-container rounded-2xl p-6 flex flex-col justify-between h-[320px] group hover:scale-[1.02] transition-all duration-400" onclick="window.location='{{ route('projects.show', $project) }}'">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-3 py-1 {{ $statusClass }} text-[10px] font-bold uppercase tracking-wider rounded-full border">{{ $statusLabel[$project->status] ?? 'Active' }}</span>
                            <button class="text-on-surface-variant hover:text-on-surface"><span class="material-symbols-outlined">more_vert</span></button>
                        </div>
                        <h4 class="font-syne font-extrabold text-xl text-on-surface mb-2">{{ $project->name }}</h4>
                        <p class="text-on-surface-variant text-sm line-clamp-2">{{ $project->description }}</p>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-xs mb-2">
                                <span class="text-on-surface-variant">Progress</span>
                                <span class="text-primary font-bold">{{ $progress }}%</span>
                            </div>
                            <div class="w-full bg-surface-container-lowest h-2 rounded-full overflow-hidden">
                                <div class="bg-primary h-full rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-2">
                                @foreach($project->team()->limit(3)->get() as $member)
                                    <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($member->user?->name ?? 'U') }}&background=818cf8&color=fff" />
                                @endforeach
                                @php $moreCount = $project->team()->count() - 3; @endphp
                                @if($moreCount > 0)
                                    <div class="w-8 h-8 rounded-full border-2 border-surface-container bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">+{{ $moreCount }}</div>
                                @endif
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                {{ $project->end_date?->format('M d, Y') ?? 'No deadline' }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-surface-container rounded-2xl p-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">folder_off</span>
                    <h3 class="font-syne font-extrabold text-xl text-on-surface mb-2">No Active Projects</h3>
                    <p class="text-on-surface-variant">Create your first project to get started.</p>
                </div>
            @endforelse

            <div class="bg-surface-container-low rounded-2xl p-6 flex flex-col justify-between h-[320px] border-2 border-dashed border-surface-container-high group hover:border-primary/50 transition-all duration-400 cursor-pointer">
                <div class="flex-1 flex flex-col items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-surface-container-high flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-on-surface-variant group-hover:text-primary">add</span>
                    </div>
                    <h4 class="font-syne font-extrabold text-xl text-on-surface-variant">New Project</h4>
                    <p class="text-on-surface-variant text-sm mt-2">Create a new project</p>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/projects-hub.js') }}"></script>
@endpush