@extends('layouts.app')

@section('content')
<div class="p-8">
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
                </div>
            </div>
        </div>
    </header>

    <section class="sticky top-[0.5rem] z-30 bg-surface/95 backdrop-blur-md mb-8 py-4 rounded-xl">
        <div class="bg-surface-container-low p-4 rounded-xl shadow-lg flex flex-wrap items-center gap-4">
            <div class="relative flex-grow min-w-[240px]">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
                <input id="task-search" value="{{ request('q', '') }}" class="w-full bg-surface-container border-none rounded-lg pl-10 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-primary/50 text-on-surface" placeholder="Search task names..." type="text" name="search_tasks" aria-label="Search tasks by name" />
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <select id="filter-project" class="bg-surface-container-high border-none rounded-lg px-4 py-2.5 text-sm font-medium text-on-surface focus:ring-2 focus:ring-primary/50 appearance-none min-w-[140px]" name="filter_project" aria-label="Filter tasks by project">
                    <option value="">All Projects</option>
                    @foreach($projects ?? [] as $project)
                    <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                    @endforeach
                </select>
                <select id="filter-status" class="bg-surface-container-high border-none rounded-lg px-4 py-2.5 text-sm font-medium text-on-surface focus:ring-2 focus:ring-primary/50 appearance-none min-w-[140px]" name="filter_status" aria-label="Filter tasks by status">
                    <option value="">Any Status</option>
                    <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="review" {{ request('status') == 'review' ? 'selected' : '' }}>Review</option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Completed</option>
                </select>
                <select id="filter-priority" class="bg-surface-container-high border-none rounded-lg px-4 py-2.5 text-sm font-medium text-on-surface focus:ring-2 focus:ring-primary/50 appearance-none min-w-[140px]" name="filter_priority" aria-label="Filter tasks by priority">
                    <option value="">Priority</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            <div class="h-8 w-[1px] bg-outline-variant/20 mx-2"></div>
            <button onclick="openAddTaskModal()" class="bg-primary-container text-on-primary-fixed-variant px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 hover:brightness-110 active:scale-95 transition-all">
                <span class="material-symbols-outlined text-sm">add</span>
                Add New Task
            </button>
        </div>
    </section>

    <section>
        <div class="mb-4 flex items-center justify-between px-2">
            <div class="flex items-center gap-4">
                <input id="select-all-tasks" class="rounded bg-surface-container border-outline-variant/30 text-primary focus:ring-primary h-5 w-5" type="checkbox" aria-label="Select all tasks" />
                <label for="select-all-tasks" class="text-sm text-outline font-medium">Select All Tasks</label>
            </div>
            <div class="flex items-center gap-2">
                <button class="text-xs font-bold text-outline uppercase tracking-wider hover:text-on-surface px-3 py-1 transition-colors">Bulk Archive</button>
                <button onclick="bulkDeleteTasks()" class="text-xs font-bold text-error uppercase tracking-wider hover:brightness-110 px-3 py-1 transition-colors">Bulk Delete</button>
            </div>
        </div>

        <div class="bg-surface-container-low rounded-xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table id="tasks-table" class="w-full text-left border-collapse">
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
                        @forelse($tasks ?? [] as $task)
                        <tr class="group hover:bg-surface-bright/30 transition-colors" data-task-id="{{ $task->id }}">
                            <td class="px-6 py-5">
                                <input class="task-checkbox rounded bg-surface-container border-outline-variant/30 text-primary focus:ring-primary h-4 w-4" type="checkbox" data-id="{{ $task->id }}" />
                            </td>
                            <td class="px-6 py-5 cursor-pointer" onclick="viewTask({{ $task->id }})">
                                <div class="flex flex-col">
                                    <span class="text-on-surface font-semibold text-sm group-hover:text-primary transition-colors cursor-pointer">{{ $task->title }}</span>
                                    <span class="text-xs text-outline cursor-pointer hover:underline">{{ $task->project->name ?? 'No Project' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex -space-x-2">
                                    @if($task->assignee)
                                    <img alt="{{ $task->assignee->name }}" class="h-7 w-7 rounded-full border border-surface" src="https://ui-avatars.com/api/?name={{ urlencode($task->assignee->name) }}&background=c0c1ff&color=1a1a2e&size=28" />
                                    @else
                                    <span class="text-xs text-outline">Unassigned</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ getStatusClass($task->status) }}">
                                    {{ $task->status == 'in_progress' ? 'In Progress' : ($task->status == 'todo' ? 'Pending' : ucfirst($task->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ getPriorityClass($task->priority) }}">
                                    {{ $task->priority }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-sm text-on-surface-variant">{{ $task->due_date ? $task->due_date->format('M d, Y') : '-' }}</span>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button onclick="editTask(event, {{ $task->id }})" class="p-2 text-outline hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                    <button onclick="deleteTask(event, {{ $task->id }})" class="p-2 text-outline hover:text-error transition-colors">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-on-surface-variant">No tasks found. Create your first task to get started.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(isset($tasks) && $tasks->hasPages())
            <div class="pagination-container px-6 py-4 bg-surface-container-high/20 border-t border-outline-variant/5 flex items-center justify-between">
                <span class="text-xs text-outline font-medium">Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} tasks</span>
                <div class="flex items-center gap-1">
                    @if($tasks->onFirstPage())
                    <button class="p-1.5 rounded-lg text-outline disabled:opacity-30" disabled>
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    @else
                    <a href="{{ $tasks->previousPageUrl() }}" class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </a>
                    @endif

                    @foreach($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="h-8 w-8 rounded-lg {{ $page == $tasks->currentPage() ? 'bg-primary/20 text-primary font-bold' : 'hover:bg-surface-container-highest text-outline font-medium' }}">{{ $page }}</a>
                    @endforeach

                    @if($tasks->hasMorePages())
                    <a href="{{ $tasks->nextPageUrl() }}" class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </a>
                    @else
                    <button class="p-1.5 rounded-lg text-outline disabled:opacity-30" disabled>
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </section>

    <section class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-surface-container-low p-6 rounded-xl border-l-2 border-primary">
            <p class="font-label text-[0.6875rem] font-bold text-outline tracking-wider uppercase mb-1">Total Tasks</p>
            <div class="flex items-end gap-3">
                <span class="text-3xl font-headline font-semibold text-on-surface task-stat-total">{{ $tasks->total() ?? 0 }}</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl border-l-2 border-tertiary">
            <p class="font-label text-[0.6875rem] font-bold text-outline tracking-wider uppercase mb-1">Overdue</p>
            <div class="flex items-end gap-3">
                <span class="text-3xl font-headline font-semibold text-on-surface">{{ $tasks->where('due_date', '<', now())->where('status', '!=', 'done')->count() ?? 0 }}</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl border-l-2 border-primary-container">
            <p class="font-label text-[0.6875rem] font-bold text-outline tracking-wider uppercase mb-1">Completed</p>
            <div class="flex items-end gap-3">
                <span class="text-3xl font-headline font-semibold text-on-surface">{{ $tasks->where('status', 'done')->count() ?? 0 }}</span>
            </div>
        </div>
    </section>
</div>

<!-- Add Task Modal -->
<div id="add-task-modal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center">
    <div class="bg-surface-container-low rounded-2xl p-8 w-full max-w-md">
        <h3 class="text-xl font-headline font-semibold mb-6">Add New Task</h3>
        <form onsubmit="createTask(event)">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Task Title</label>
                <input type="text" id="task-title-input" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50" required />
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Description</label>
                <textarea id="task-description-input" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Status</label>
                <select id="task-status-input" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50">
                    <option value="todo">Pending</option>
                    <option value="in_progress">In Progress</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Priority</label>
                <select id="task-priority-input" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Due Date</label>
                <input type="date" id="task-due-date-input" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50" />
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeAddTaskModal()" class="flex-1 py-3 bg-surface-container rounded-xl font-bold">Cancel</button>
                <button type="submit" class="flex-1 py-3 bg-primary text-on-primary-container rounded-xl font-bold">Create Task</button>
            </div>
        </form>
    </div>
</div>

@php
function getStatusClass($status) {
$classes = [
'done' => 'bg-tertiary-container/20 text-tertiary',
'in_progress' => 'bg-secondary-container/30 text-secondary',
'review' => 'bg-tertiary-container/20 text-tertiary',
'todo' => 'bg-surface-container-highest text-outline'
];
return $classes[$status] ?? $classes['todo'];
}

function getPriorityClass($priority) {
$classes = [
'high' => 'bg-error-container/20 text-error',
'medium' => 'bg-tertiary-container/20 text-tertiary',
'low' => 'bg-surface-container-highest text-outline'
];
return $classes[$priority] ?? $classes['medium'];
}
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tasks-index.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/tasks-index.js') }}"></script>
<script>
    function openAddTaskModal() {
        document.getElementById('add-task-modal').classList.remove('hidden');
    }

    function closeAddTaskModal() {
        document.getElementById('add-task-modal').classList.add('hidden');
        document.getElementById('task-title-input').value = '';
        document.getElementById('task-description-input').value = '';
        document.getElementById('task-status-input').value = 'todo';
        document.getElementById('task-priority-input').value = 'medium';
        document.getElementById('task-due-date-input').value = '';
    }

    async function createTask(event) {
        event.preventDefault();
        const title = document.getElementById('task-title-input').value;
        const description = document.getElementById('task-description-input').value;
        const status = document.getElementById('task-status-input').value;
        const priority = document.getElementById('task-priority-input').value;
        const due_date = document.getElementById('task-due-date-input').value;

        try {
            await API.tasks.create({
                title,
                description,
                status,
                priority,
                due_date
            });
            closeAddTaskModal();
            window.location.reload();
        } catch (error) {
            alert('Failed to create task: ' + error.message);
        }
    }

    function viewTask(taskId) {
        window.location.href = '/tasks/' + taskId;
    }

    async function editTask(event, taskId) {
        event.stopPropagation();
        window.location.href = '/tasks/' + taskId;
    }

    async function deleteTask(event, taskId) {
        event.stopPropagation();
        if (!confirm('Are you sure you want to delete this task?')) return;

        try {
            await API.tasks.delete(taskId);
            window.location.reload();
        } catch (error) {
            alert('Failed to delete task: ' + error.message);
        }
    }

    function bulkDeleteTasks() {
        const checkboxes = document.querySelectorAll('.task-checkbox:checked');
        if (checkboxes.length === 0) {
            alert('Please select at least one task');
            return;
        }

        if (!confirm('Are you sure you want to delete ' + checkboxes.length + ' task(s)?')) return;

        checkboxes.forEach(async (checkbox) => {
            try {
                await API.tasks.delete(checkbox.dataset.id);
            } catch (error) {
                console.error('Failed to delete task:', error);
            }
        });

        window.location.reload();
    }

    // ==========================================
    // REAL-TIME INSTANT SEARCH & FILTER (AJAX)
    // ==========================================

    const TASK_SEARCH_ENDPOINT = '{{ route("tasks.search") }}';
    let tasksDebounceTimer = null;
    let currentTasksPage = 1;

    // Get filter values
    function getTaskFilters() {
        const searchInput = document.getElementById('task-search');
        const filterProject = document.getElementById('filter-project');
        const filterStatus = document.getElementById('filter-status');
        const filterPriority = document.getElementById('filter-priority');

        return {
            q: searchInput ? searchInput.value : '',
            project_id: filterProject ? filterProject.value : '',
            status: filterStatus ? filterStatus.value : '',
            priority: filterPriority ? filterPriority.value : ''
        };
    }

    // Fetch tasks via AJAX
    async function fetchTasks(filters, page = 1) {
        const tbody = document.querySelector('#tasks-table tbody');
        const paginationContainer = document.querySelector('.pagination-container');

        if (!tbody) return;

        // Show loading state
        tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-8 text-center"><div class="flex items-center justify-center gap-2"><span class="material-symbols-outlined animate-spin">sync</span> Searching...</div></td></tr>`;

        // Build query string
        const params = new URLSearchParams();
        if (filters.q) params.set('q', filters.q);
        if (filters.project_id) params.set('project_id', filters.project_id);
        if (filters.status) params.set('status', filters.status);
        if (filters.priority) params.set('priority', filters.priority);
        params.set('page', page);

        try {
            const response = await fetch(`${TASK_SEARCH_ENDPOINT}?${params.toString()}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            // Update table body
            tbody.innerHTML = data.html || '<tr><td colspan="7" class="px-6 py-8 text-center text-on-surface-variant">No tasks found</td></tr>';

            // Update pagination
            if (paginationContainer && data.pagination) {
                paginationContainer.innerHTML = data.pagination;
            }

            // Update stats
            updateTaskStats(data.total);

        } catch (error) {
            console.error('Search error:', error);
            tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-8 text-center text-error">Error: ${error.message}</td></tr>`;
        }
    }

    // Update task statistics
    function updateTaskStats(total) {
        const statElements = document.querySelectorAll('.task-stat-total');
        statElements.forEach(el => {
            el.textContent = total || 0;
        });
    }

    // Load page from pagination click
    function loadTasksPage(url) {
        const params = new URLSearchParams(url.split('?')[1] || '');
        const filters = getTaskFilters();
        const page = params.get('page') || 1;
        fetchTasks(filters, page);
    }

    // Real-time search handler - INSTANT (no debounce or minimal)
    const searchInput = document.getElementById('task-search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            // TRULY INSTANT - no delay at all
            fetchTasks(getTaskFilters(), 1);
        });
    }

    // Filter handlers - instant update
    const filterProject = document.getElementById('filter-project');
    const filterStatus = document.getElementById('filter-status');
    const filterPriority = document.getElementById('filter-priority');

    if (filterProject) {
        filterProject.addEventListener('change', function() {
            fetchTasks(getTaskFilters(), 1);
        });
    }

    if (filterStatus) {
        filterStatus.addEventListener('change', function() {
            fetchTasks(getTaskFilters(), 1);
        });
    }

    if (filterPriority) {
        filterPriority.addEventListener('change', function() {
            fetchTasks(getTaskFilters(), 1);
        });
    }

    // Clear all filters
    function clearTaskFilters() {
        const searchInput = document.getElementById('task-search');
        const filterProject = document.getElementById('filter-project');
        const filterStatus = document.getElementById('filter-status');
        const filterPriority = document.getElementById('filter-priority');

        if (searchInput) searchInput.value = '';
        if (filterProject) filterProject.value = '';
        if (filterStatus) filterStatus.value = '';
        if (filterPriority) filterPriority.value = '';

        fetchTasks({
            q: '',
            project_id: '',
            status: '',
            priority: ''
        }, 1);
    }

    // Add clear button functionality
    document.addEventListener('DOMContentLoaded', function() {
        const clearBtn = document.querySelector('.clear-filters-btn');
        if (clearBtn) {
            clearBtn.addEventListener('click', clearTaskFilters);
        }
    });
</script>
@endpush
@endsection