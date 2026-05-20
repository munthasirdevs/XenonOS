@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-details.css') }}">
@endpush

@section('title', 'Project Details - XenonOS')

@section('content')

<main class="flex-1 md:ml-[260px] min-h-screen">
    <div class="p-6 md:p-8">
        @php
            $taskCount = $project->tasks()->count();
            $completedTasks = $project->tasks()->where('status', 'completed')->count();
            $progress = $taskCount > 0 ? round(($completedTasks / $taskCount) * 100) : 0;
            
            $statusClasses = [
                'active' => 'bg-primary/10 text-primary border-primary/20',
                'completed' => 'bg-success/10 text-success border-success/20',
                'pending' => 'bg-tertiary/20 text-tertiary border-tertiary/20',
                'on_hold' => 'bg-outline/20 text-outline border-outline/20',
            ];
            $statusClass = $statusClasses[$project->status] ?? 'bg-primary/10 text-primary border-primary/20';
            
            $statusLabel = [
                'active' => 'Active',
                'completed' => 'Completed',
                'pending' => 'Pending',
                'on_hold' => 'On Hold',
            ];
            
            $priorityColors = [
                'high' => 'bg-tertiary',
                'medium' => 'bg-primary',
                'low' => 'bg-success',
            ];
            $priorityLabel = [
                'high' => 'High Priority',
                'medium' => 'Medium Priority', 
                'low' => 'Low Priority',
            ];
        @endphp

        <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12">
            <div class="space-y-4 max-w-2xl">
                <div class="flex items-center gap-3">
                    <span class="{{ $statusClass }} px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase border">{{ $statusLabel[$project->status] ?? 'Active' }}</span>
                    @if($project->priority)
                    <span class="text-on-surface-variant text-sm font-medium flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full {{ $priorityColors[$project->priority] ?? 'bg-tertiary' }}"></span>
                        {{ $priorityLabel[$project->priority] ?? 'Medium Priority' }}
                    </span>
                    @endif
                </div>
                <h1 class="text-4xl md:text-5xl font-headline font-light tracking-tight text-on-surface">
                    {{ $project->name }}
                </h1>
                <div class="flex flex-col gap-2">
                    @if($project->client)
                    <a class="text-primary hover:text-primary-container transition-colors text-lg font-semibold flex items-center gap-2" href="#">
                        {{ $project->client->name }}
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                    </a>
                    @endif
                    <p class="text-on-surface-variant leading-relaxed max-w-xl">
                        {{ $project->description ?? 'No description provided.' }}
                    </p>
                </div>
            </div>
            <div class="flex gap-3">
                <button class="px-6 py-2.5 bg-surface-container border border-outline-variant/20 rounded-xl text-sm font-semibold hover:bg-surface-bright transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">edit</span>
                    Edit Project
                </button>
                <button class="p-2.5 bg-surface-container border border-outline-variant/20 rounded-xl hover:bg-surface-bright transition-colors">
                    <span class="material-symbols-outlined">more_vert</span>
                </button>
            </div>
        </header>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-surface-container-low p-6 rounded-3xl border-l-2 border-primary/50">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase mb-4 block">Current Progress</span>
                <div class="flex items-end justify-between mb-2">
                    <span class="text-3xl font-headline font-semibold text-primary">{{ $progress }}%</span>
                    <span class="text-xs text-on-surface-variant font-medium">{{ $completedTasks }} of {{ $taskCount }} tasks</span>
                </div>
                <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="h-full bg-primary rounded-full" style="width: {{ $progress }}%"></div>
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-3xl border-l-2 border-tertiary/50">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase mb-4 block">Deadline</span>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-tertiary">event</span>
                    <div>
                        <span class="text-xl font-headline font-semibold block text-on-surface">{{ $project->end_date?->format('M d, Y') ?? 'No deadline' }}</span>
                        @if($project->end_date)
                            <span class="text-xs text-on-surface-variant">{{ $project->end_date->diffForHumans() }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-3xl border-l-2 border-outline-variant/50">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase mb-4 block">Assigned Team</span>
                <div class="flex -space-x-3 items-center flex-wrap">
                    @forelse($project->team()->limit(4)->get() as $member)
                        <img alt="Team" class="w-10 h-10 rounded-full border-2 border-surface-container-low object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($member->name ?? 'U') }}&background=818cf8&color=fff" />
                    @empty
                        <span class="text-xs text-on-surface-variant">No team members</span>
                    @endforelse
                    @php $moreCount = $project->team()->count() - 4; @endphp
                    @if($moreCount > 0)
                        <div class="w-10 h-10 rounded-full border-2 border-surface-container-low bg-surface-container-highest flex items-center justify-center text-xs font-bold text-primary">+{{ $moreCount }}</div>
                    @endif
                    <span class="ml-4 text-xs text-on-surface-variant font-medium">{{ $project->team()->count() }} Members</span>
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-3xl border-l-2 border-secondary/50">
                <span class="text-[10px] font-bold tracking-widest text-on-surface-variant uppercase mb-4 block">Budget</span>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">payments</span>
                    <div>
                        <span class="text-lg font-headline font-semibold block text-on-surface leading-tight">${{ number_format($project->budget ?? 0, 2) }}</span>
                        <span class="text-xs text-on-surface-variant">Allocated Budget</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-8 space-y-8">
                <section class="bg-surface-container-low rounded-3xl p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-xl font-headline font-semibold text-on-surface">Active Tasks</h3>
                            <p class="text-sm text-on-surface-variant">Milestones for the current sprint</p>
                        </div>
                        <button class="text-primary font-bold text-xs tracking-wide flex items-center gap-2">
                            <span class="w-1 h-1 bg-primary rounded-full"></span>
                            VIEW ALL TASKS
                        </button>
                    </div>
                    <div class="space-y-4">
                        @forelse($project->tasks()->limit(4)->get() as $task)
                            @php
                                $taskStatusClasses = [
                                    'completed' => 'text-primary line-through opacity-60',
                                    'in_progress' => 'text-tertiary',
                                    'pending' => 'text-outline',
                                ];
                                $taskStatusLabel = [
                                    'completed' => 'Done',
                                    'in_progress' => 'In Progress',
                                    'pending' => 'Pending',
                                ];
                                $taskStatusClass = $taskStatusClasses[$task->status] ?? 'text-outline';
                            @endphp
                            <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl hover:bg-surface-bright transition-all">
                                <div class="flex items-center gap-4">
                                    @if($task->status == 'completed')
                                        <span class="material-symbols-outlined text-primary">check_circle</span>
                                    @elseif($task->status == 'in_progress')
                                        <span class="material-symbols-outlined text-tertiary">radio_button_checked</span>
                                    @else
                                        <span class="material-symbols-outlined text-outline">circle</span>
                                    @endif
                                    <span class="text-sm font-medium {{ $taskStatusClass }}">{{ $task->title }}</span>
                                </div>
                                <span class="text-[10px] font-bold {{ $task->status == 'completed' ? 'bg-primary/10 text-primary' : ($task->status == 'in_progress' ? 'bg-tertiary/20 text-tertiary' : 'text-on-surface-variant') }} px-2 py-0.5 rounded uppercase">{{ $taskStatusLabel[$task->status] ?? 'Pending' }}</span>
                            </div>
                        @empty
                            <p class="text-on-surface-variant text-center py-8">No tasks found for this project.</p>
                        @endforelse
                    </div>
                    <button class="mt-6 p-4 border-2 border-dashed border-outline-variant/20 rounded-2xl text-on-surface-variant hover:text-primary hover:border-primary/40 hover:bg-primary/5 transition-all font-medium text-sm flex items-center justify-center gap-2 w-full">
                        <span class="material-symbols-outlined text-lg">add_circle</span>
                        Add New Task
                    </button>
                </section>

                <section class="bg-surface-container-low rounded-3xl p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-xl font-headline font-semibold text-on-surface">Asset Vault</h3>
                        <button class="px-4 py-2 bg-primary text-on-primary rounded-xl text-xs font-bold hover:scale-95 transition-transform flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">upload</span>
                            UPLOAD
                        </button>
                    </div>
                    @forelse($project->files()->limit(4)->get() as $file)
                        <div class="p-4 bg-surface-container rounded-2xl border border-outline-variant/10 flex items-center gap-4 group hover:bg-surface-bright transition-colors mb-2">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">folder_zip</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-on-surface truncate">{{ $file->name }}</p>
                                <p class="text-[10px] text-on-surface-variant">{{ $file->created_at?->format('M d') }}</p>
                            </div>
                            <button class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100">download</button>
                        </div>
                    @empty
                        <p class="text-on-surface-variant text-center py-8">No files uploaded yet.</p>
                    @endforelse
                </section>
            </div>

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-surface-container-low p-6 rounded-3xl">
                    <h3 class="text-lg font-headline font-semibold text-on-surface mb-6">Activity</h3>
                    <div class="space-y-4">
                        @forelse(\App\Models\ActivityLog::where('project_id', $project->id)->limit(5)->get() as $activity)
                            <div class="flex items-start gap-3">
                                <img alt="User" class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($activity->user?->name ?? 'U') }}&background=818cf8&color=fff" />
                                <div>
                                    <p class="text-sm text-on-surface"><span class="font-semibold">{{ $activity->user?->name ?? 'System' }}</span> {{ $activity->action }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $activity->created_at?->diffForHumans() ?? 'Just now' }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-on-surface-variant">No recent activity</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/projects-details.js') }}"></script>
@endpush