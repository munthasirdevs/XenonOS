@forelse($tasks as $task)
<tr class="group hover:bg-surface-bright/30 transition-colors" data-task-id="{{ $task->id }}">
    <td class="px-6 py-5">
        <input type="checkbox" class="task-checkbox rounded bg-surface-container border-outline-variant/30 text-primary focus:ring-primary h-4 w-4" data-id="{{ $task->id }}" />
    </td>
    <td class="px-6 py-5 cursor-pointer" onclick="window.location.href='/tasks/{{ $task->id }}'">
        <div class="flex flex-col">
            <span class="text-on-surface font-semibold text-sm group-hover:text-primary transition-colors">{{ $task->title }}</span>
            <span class="text-xs text-outline cursor-pointer hover:underline">{{ $task->project->name ?? 'No Project' }}</span>
        </div>
    </td>
    <td class="px-6 py-5">
        <div class="flex -space-x-2">
            @if($task->assignee)
            <img alt="{{ $task->assignee->name }}" class="h-7 w-7 rounded-full border border-surface" src="{{ $task->assignee->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($task->assignee->name) . '&background=c0c1ff&color=1a1a2e&size=28' }}" />
            @else
            <span class="text-xs text-outline">Unassigned</span>
            @endif
        </div>
    </td>
    <td class="px-6 py-5">
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $task->status == 'done' ? 'bg-tertiary-container/20 text-tertiary' : ($task->status == 'in_progress' ? 'bg-secondary-container/30 text-secondary' : 'bg-surface-container-highest text-outline') }}">
            {{ $task->status == 'in_progress' ? 'In Progress' : ($task->status == 'todo' ? 'Pending' : ucfirst($task->status)) }}
        </span>
    </td>
    <td class="px-6 py-5">
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $task->priority == 'high' ? 'bg-error-container/20 text-error' : ($task->priority == 'medium' ? 'bg-tertiary-container/20 text-tertiary' : 'bg-surface-container-highest text-outline') }}">
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