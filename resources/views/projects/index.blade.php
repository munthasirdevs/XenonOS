@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-index.css') }}">
@endpush

@section('title', 'Projects - XenonOS')

@section('content')
<main>
    <div class="pt-2 px-6 md:px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <h1 class="text-4xl md:text-5xl font-headline font-light text-white tracking-tight">Projects</h1>
                <p class="text-on-surface-variant font-body">Manage all client projects.</p>
            </div>
            <a href="{{ route('projects.create') }}"
                class="bg-primary text-on-primary-container px-6 py-3 rounded-2xl font-bold flex items-center gap-2 hover:bg-primary-container transition-colors shadow-lg shadow-primary/10">
                <span class="material-symbols-outlined">add_circle</span>
                Create Project
            </a>
        </div>

        <div class="grid grid-cols-12 gap-6 md:gap-8">
            <div class="col-span-12 lg:col-span-9 space-y-6">
                <form method="GET" class="bg-surface-container-low p-4 rounded-3xl flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2 bg-surface-container px-4 py-2 rounded-2xl">
                        <span class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Status:</span>
                        <select name="status" aria-label="Filter projects by status"
                            class="bg-transparent border-none text-sm p-0 focus:ring-0 text-primary font-medium cursor-pointer"
                            onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="on_hold" {{ request('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2 bg-surface-container px-4 py-2 rounded-2xl">
                        <span class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Client:</span>
                        <select name="client" aria-label="Filter projects by client"
                            class="bg-transparent border-none text-sm p-0 focus:ring-0 text-primary font-medium cursor-pointer"
                            onchange="this.form.submit()">
                            <option value="">All Clients</option>
                            @php
                            $clients = \App\Models\Client::orderBy('name')->get();
                            @endphp
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ request('client') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-2 bg-surface-container px-4 py-2 rounded-2xl">
                        <span class="material-symbols-outlined text-on-surface-variant text-sm">search</span>
                        <input type="text" name="search" placeholder="Search projects..."
                            value="{{ request('search') }}"
                            class="bg-transparent border-none text-sm p-0 focus:ring-0 text-primary font-medium placeholder:text-on-surface-variant/50 w-40 focus:w-64 transition-all duration-300"
                            onchange="this.form.submit()">
                    </div>
                    @if(request()->hasAny(['search', 'status', 'client', 'sort']))
                    <a href="{{ route('projects.index') }}" data-clear-filters class="flex items-center gap-2 bg-surface-container px-4 py-2 rounded-2xl text-on-surface-variant hover:text-primary transition-colors" style="display: flex;">
                        <span class="material-symbols-outlined text-sm">close</span>
                        <span class="text-xs font-medium">Clear</span>
                    </a>
                    @else
                    <a href="#" data-clear-filters class="flex items-center gap-2 bg-surface-container px-4 py-2 rounded-2xl text-on-surface-variant hover:text-primary transition-colors" style="display: none;">
                        <span class="material-symbols-outlined text-sm">close</span>
                        <span class="text-xs font-medium">Clear</span>
                    </a>
                    @endif
                </form>

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
                                @forelse($projects as $project)
                                @php
                                $taskCount = $project->tasks()->count();
                                $completedTasks = $project->tasks()->where('status', 'completed')->count();
                                $progress = $taskCount > 0 ? round(($completedTasks / $taskCount) * 100) : 0;

                                $statusClasses = [
                                'active' => 'bg-primary/10 text-primary',
                                'completed' => 'bg-success/10 text-success',
                                'pending' => 'bg-tertiary/20 text-tertiary',
                                'on_hold' => 'bg-outline/20 text-outline',
                                ];
                                $statusClass = $statusClasses[$project->status] ?? 'bg-primary/10 text-primary';

                                $statusLabel = [
                                'active' => 'Active',
                                'completed' => 'Completed',
                                'pending' => 'Pending',
                                'on_hold' => 'On Hold',
                                ];
                                @endphp
                                <tr class="group hover:bg-surface-container transition-all duration-200 cursor-pointer" onclick="window.location='{{ route('projects.show', $project) }}'">
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col">
                                            <span class="text-white font-medium">{{ $project->name }}</span>
                                            <span class="text-xs text-on-surface-variant">{{ $project->description }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-sm">{{ $project->client?->name ?? 'No Client' }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full {{ $statusClass }} text-[10px] font-bold uppercase tracking-tighter">
                                            {{ $statusLabel[$project->status] ?? 'Active' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col gap-1.5 w-32">
                                            <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                                                <div class="h-full bg-primary rounded-full" style="width: {{ $progress }}%"></div>
                                            </div>
                                            <span class="text-[10px] text-on-surface-variant font-medium">{{ $progress }}% Complete</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex -space-x-2">
                                            @foreach($project->team()->limit(3)->get() as $member)
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low object-cover"
                                                alt="Team" src="https://ui-avatars.com/api/?name={{ urlencode($member->name ?? 'U') }}&background=818cf8&color=fff" />
                                            @endforeach
                                            @php $moreCount = $project->team()->count() - 3; @endphp
                                            @if($moreCount > 0)
                                            <div class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center text-[10px] font-bold border-2 border-surface-container-low">+{{ $moreCount }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <button class="p-2 text-on-surface-variant hover:text-white">
                                            <span class="material-symbols-outlined">more_horiz</span>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">
                                        No projects found. Create your first project to get started.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($projects->hasPages())
                    <div class="p-4 border-t border-white/5">
                        {{ $projects->links() }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-span-12 lg:col-span-3 space-y-6">
                <div class="bg-surface-container-low p-6 rounded-3xl">
                    <h3 class="text-xs font-label text-on-surface-variant uppercase tracking-widest mb-4">Overview</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Total Projects</span>
                            <span class="text-xl font-bold text-white">{{ \App\Models\Project::count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Active</span>
                            <span class="text-xl font-bold text-primary">{{ \App\Models\Project::where('status', 'active')->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Completed</span>
                            <span class="text-xl font-bold text-success">{{ \App\Models\Project::where('status', 'completed')->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Pending</span>
                            <span class="text-xl font-bold text-tertiary">{{ \App\Models\Project::where('status', 'pending')->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-surface-container-low p-6 rounded-3xl">
                    <h3 class="text-xs font-label text-on-surface-variant uppercase tracking-widest mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        @php
                        $recentProjects = \App\Models\Project::with('owner')->orderBy('updated_at', 'desc')->limit(3)->get();
                        @endphp
                        @forelse($recentProjects as $recent)
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-primary mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm text-white">{{ $recent->name }} updated</p>
                                <p class="text-xs text-on-surface-variant">{{ $recent->updated_at?->diffForHumans() ?? 'Just now' }}</p>
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
<script src="{{ asset('js/projects-index.js') }}"></script>
@endpush