<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\AuditLog;
use App\Models\Task;
use App\Models\TaskLog;
use App\Models\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    use ApiResponse;

    private function getCacheKey(Request $request): string
    {
        return 'api_tasks_' . md5($request->getQueryString());
    }

    public function index(Request $request)
    {
        $cacheKey = $this->getCacheKey($request);
        
        $tasks = Cache::remember($cacheKey, 30, function() use ($request) {
            $query = Task::select(['id', 'project_id', 'title', 'description', 'status', 'priority', 'assigned_to', 'start_date', 'due_date', 'estimated_hours', 'actual_hours', 'created_by', 'updated_by', 'created_at', 'updated_at'])
                ->with(['project:id,name', 'assignee:id,name,email'])
                ->orderBy('created_at', 'desc');

            if ($request->has('project_id')) {
                $query->where('project_id', $request->project_id);
            }

            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            if ($request->has('priority')) {
                $query->where('priority', $request->priority);
            }

            if ($request->has('assigned_to')) {
                $query->where('assigned_to', $request->assigned_to);
            }

            if ($request->has('q')) {
                $query->where(fn($q) => $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%'));
            }

            if ($request->has('overdue')) {
                $query->where('status', '!=', 'done')
                    ->whereNotNull('due_date')
                    ->where('due_date', '<', now());
            }

            return $query->paginate(15);
        });

        return $this->success($tasks);
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create([
            ...$request->validated(),
            'created_by' => $request->user()->id,
            'status' => $request->status ?? 'todo',
            'priority' => $request->priority ?? 'medium',
        ]);

        $this->logActivity($task, 'created', 'Task created', $request->user()->id);

        AuditLog::create([
            'model_type' => Task::class,
            'model_id' => $task->id,
            'changes' => ['created' => $task->toArray()],
            'created_by' => $request->user()->id,
            'action' => 'task_created',
            'description' => 'Task created: ' . $task->title,
        ]);

        Cache::forget('api_tasks_*');
        Cache::forget('task_stats');

        return $this->success($task->load(['project:id,name', 'assignee:id,name,email']), 'Task created successfully', 201);
    }

    public function show(Task $task)
    {
        $taskKey = "task_{$task->id}";
        
        $taskData = Cache::remember($taskKey, 60, fn() => $task->load([
            'project:id,name,description',
            'assignee:id,name,email',
            'creator:id,name,email',
            'logs' => fn($q) => $q->select('id', 'task_id', 'action', 'description', 'created_by', 'created_at')->latest()->limit(20)
        ]));

        return $this->success($taskData);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $oldData = $task->toArray();
        $oldStatus = $task->status;
        
        $task->update($request->validated());

        if ($oldStatus !== $task->status) {
            $this->logActivity($task, 'status_changed', 'Status changed from ' . $oldStatus . ' to ' . $task->status, $request->user()->id);
        }

        $this->logActivity($task, 'updated', 'Task updated', $request->user()->id);

        AuditLog::create([
            'model_type' => Task::class,
            'model_id' => $task->id,
            'changes' => ['before' => $oldData, 'after' => $task->fresh()->toArray()],
            'created_by' => $request->user()->id,
            'action' => 'task_updated',
            'description' => 'Task updated: ' . $task->title,
        ]);

        Cache::forget("task_{$task->id}");
        Cache::forget('api_tasks_*');

        return $this->success($task->fresh()->load(['project:id,name', 'assignee:id,name,email']), 'Task updated successfully');
    }

    public function destroy(Request $request, Task $task)
    {
        $taskTitle = $task->title;
        
        $this->logActivity($task, 'deleted', 'Task deleted', $request->user()->id);

        AuditLog::create([
            'model_type' => Task::class,
            'model_id' => $task->id,
            'changes' => ['deleted' => $taskTitle],
            'created_by' => $request->user()->id,
            'action' => 'task_deleted',
            'description' => 'Task deleted: ' . $taskTitle,
        ]);

        $task->delete();

        Cache::forget("task_{$task->id}");
        Cache::forget('api_tasks_*');
        Cache::forget('task_stats');

        return $this->success(null, 'Task deleted successfully');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:todo,in_progress,review,done',
        ]);

        $oldStatus = $task->status;
        $task->update(['status' => $request->status]);

        $this->logActivity($task, 'status_changed', 'Status changed from ' . $oldStatus . ' to ' . $request->status, $request->user()->id);

        Cache::forget("task_{$task->id}");
        Cache::forget('api_tasks_*');

        return $this->success($task, 'Task status updated successfully');
    }

    public function assign(Request $request, Task $task)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $task->update(['assigned_to' => $request->user_id]);

        $this->logActivity($task, 'assigned', 'Task assigned to user', $request->user()->id);

        Cache::forget("task_{$task->id}");

        return $this->success($task->load('assignee:id,name,email'), 'Task assigned successfully');
    }

    public function logs(Task $task)
    {
        $cacheKey = "task_{$task->id}_logs_" . ($request->get('page', 1) ?? 1);
        
        $logs = Cache::remember($cacheKey, 30, fn() => 
            TaskLog::where('task_id', $task->id)
                ->select('id', 'task_id', 'action', 'description', 'created_by', 'created_at')
                ->latest()
                ->paginate(20)
        );

        return $this->success($logs);
    }

    public function analytics(Request $request)
    {
        $cacheKey = 'task_analytics_' . md5($request->getQueryString());
        
        $analytics = Cache::remember($cacheKey, 60, function() use ($request) {
            $query = Task::query();

            if ($request->has('project_id')) {
                $query->where('project_id', $request->project_id);
            }

            if ($request->has('user_id')) {
                $query->where('assigned_to', $request->user_id);
            }

            $tasks = $query->get();

            $total = $tasks->count();
            $completed = $tasks->where('status', 'done')->count();
            $todo = $tasks->where('status', 'todo')->count();
            $inProgress = $tasks->where('status', 'in_progress')->count();
            $review = $tasks->where('status', 'review')->count();

            $overdue = $tasks->filter(fn($task) => $task->due_date && $task->due_date->isPast() && $task->status !== 'done')->count();
            $onTime = $tasks->filter(fn($task) => $task->status === 'done' && $task->due_date && $task->due_date->isAfter($task->updated_at))->count();

            return [
                'total' => $total,
                'completed' => $completed,
                'todo' => $todo,
                'in_progress' => $inProgress,
                'review' => $review,
                'overdue' => $overdue,
                'completion_rate' => $total > 0 ? round(($completed / $total) * 100) : 0,
                'on_time_completion' => $completed > 0 ? round(($onTime / $completed) * 100) : 0,
                'high_priority' => $tasks->where('priority', 'high')->count(),
                'urgent' => $tasks->where('priority', 'urgent')->count(),
            ];
        });

        return $this->success($analytics);
    }

    public function calendar(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        $cacheKey = "task_calendar_{$request->start}_{$request->end}";
        
        $tasks = Cache::remember($cacheKey, 60, fn() => 
            Task::whereNotNull('due_date')
                ->whereBetween('due_date', [$request->start, $request->end])
                ->select('id', 'project_id', 'title', 'status', 'priority', 'start_date', 'due_date', 'assigned_to')
                ->with(['project:id,name', 'assignee:id,name'])
                ->get()
                ->map(fn($task) => [
                    'id' => $task->id,
                    'title' => $task->title,
                    'start' => $task->start_date ?? $task->due_date,
                    'end' => $task->due_date,
                    'status' => $task->status,
                    'priority' => $task->priority,
                    'color' => ['todo' => '#6b7280', 'in_progress' => '#3b82f6', 'review' => '#f59e0b', 'done' => '#10b981'][$task->status] ?? '#6b7280',
                    'project' => $task->project->name ?? null,
                    'assignee' => $task->assignee?->name,
                ])
        );

        return $this->success($tasks);
    }

    public function reschedule(Request $request, Task $task)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
        ]);

        $changes = [];
        if ($task->start_date !== $request->start_date) {
            $changes[] = 'Start date changed';
        }
        if ($task->due_date !== $request->due_date) {
            $changes[] = 'Due date changed';
        }

        if (!empty($changes)) {
            $task->update($request->only(['start_date', 'due_date']));
            $this->logActivity($task, 'rescheduled', implode(', ', $changes), $request->user()->id);
            
            Cache::forget("task_{$task->id}");
        }

        return $this->success($task, 'Task rescheduled successfully');
    }

    private function logActivity(Task $task, string $type, string $description, int $userId): void
    {
        TaskLog::create([
            'task_id' => $task->id,
            'action' => $type,
            'description' => $description,
            'created_by' => $userId,
        ]);
    }
}