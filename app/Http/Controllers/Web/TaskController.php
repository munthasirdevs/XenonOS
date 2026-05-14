<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with(['project:id,name', 'assignee:id,name,avatar_url']);

        if ($request->has('status') && $request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('priority') && $request->priority && $request->priority !== 'all') {
            $query->where('priority', $request->priority);
        }

        if ($request->has('project_id') && $request->project_id && $request->project_id !== 'all') {
            $query->where('project_id', $request->project_id);
        }

        if ($request->has('q') && $request->q) {
            $query->where(fn($q) => $q->where('title', 'like', '%' . $request->q . '%')
                ->orWhere('description', 'like', '%' . $request->q . '%'));
        }

        $tasks = $query->orderBy('created_at', 'desc')->paginate(15);
        $projects = Project::select('id', 'name')->get();

        if ($request->ajax() || $request->wantsJson()) {
            return view('tasks.partials.task-table', compact('tasks'))->render();
        }

        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function search(Request $request)
    {
        $query = Task::with(['project:id,name', 'assignee:id,name,avatar_url']);

        if ($request->has('status') && $request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('priority') && $request->priority && $request->priority !== 'all') {
            $query->where('priority', $request->priority);
        }

        if ($request->has('project_id') && $request->project_id && $request->project_id !== 'all') {
            $query->where('project_id', $request->project_id);
        }

        if ($request->has('q') && $request->q) {
            $query->where(fn($q) => $q->where('title', 'like', '%' . $request->q . '%')
                ->orWhere('description', 'like', '%' . $request->q . '%'));
        }

        $tasks = $query->orderBy('created_at', 'desc')->paginate(15);

        return response()->json([
            'html' => view('tasks.partials.task-table', compact('tasks'))->render(),
            'pagination' => view('tasks.partials.pagination', compact('tasks'))->render(),
            'total' => $tasks->total(),
            'count' => $tasks->count()
        ]);
    }

    public function show(Task $task)
    {
        $task->load(['project', 'assignee', 'logs', 'creator']);

        return view('tasks.details', compact('task'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:todo,in_progress,review,done',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'todo',
            'priority' => $request->priority ?? 'medium',
            'due_date' => $request->due_date,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('tasks.show', $task->id)->with('success', 'Task created successfully');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:todo,in_progress,review,done',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->back()->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks')->with('success', 'Task deleted successfully');
    }

    public function hub()
    {
        $stats = [
            'total' => Task::count(),
            'todo' => Task::where('status', 'todo')->count(),
            'inProgress' => Task::where('status', 'in_progress')->count(),
            'review' => Task::where('status', 'review')->count(),
            'done' => Task::where('status', 'done')->count(),
            'overdue' => Task::where('due_date', '<', now())->whereNot('status', 'done')->count(),
        ];

        $recentTasks = Task::with(['project', 'assignee'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('tasks.hub', compact('stats', 'recentTasks'));
    }

    public function calendar(Request $request)
    {
        $tasks = Task::with(['project', 'assignee'])
            ->whereNotNull('due_date')
            ->when($request->month, function ($query) use ($request) {
                $query->whereMonth('due_date', $request->month ?? now()->month);
            })
            ->orderBy('due_date', 'asc')
            ->get();

        return view('tasks.calendar', compact('tasks'));
    }

    public function analytics()
    {
        $stats = [
            'total' => Task::count(),
            'completed' => Task::where('status', 'done')->count(),
            'inProgress' => Task::where('status', 'in_progress')->count(),
            'overdue' => Task::where('due_date', '<', now())->whereNot('status', 'done')->count(),
        ];

        $byPriority = Task::selectRaw('priority, count(*) as count')
            ->groupBy('priority')
            ->pluck('count', 'priority');

        $byStatus = Task::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $topAssignees = User::withCount(['assignedTasks' => function ($q) {
            $q->where('status', 'done');
        }])
        ->orderBy('assigned_tasks_count', 'desc')
        ->take(5)
        ->get();

        return view('tasks.analytics', compact('stats', 'byPriority', 'byStatus', 'topAssignees'));
    }

    public function assign()
    {
        $tasks = Task::with(['project', 'assignee'])
            ->whereNull('assignee_id')
            ->orWhere('status', 'todo')
            ->get();

        $users = User::with(['roles'])->get();

        $projects = Project::with(['tasks'])->get();

        return view('tasks.assign', compact('tasks', 'users', 'projects'));
    }

    public function manage(Request $request)
    {
        $query = Task::with(['project', 'assignee']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $tasks = $query->orderBy('updated_at', 'desc')->paginate(20);

        return view('tasks.manage', compact('tasks'));
    }
}