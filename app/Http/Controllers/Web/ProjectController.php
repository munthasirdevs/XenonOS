<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['owner:id,name', 'client:id,name', 'team']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('client', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('client') && $request->client) {
            $query->where('client_id', $request->client);
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'deadline':
                $query->orderBy('end_date', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $projects = $query->paginate(15);

        return view('projects.index', compact('projects'));
    }

    public function filterJson(Request $request)
    {
        $query = Project::with(['owner:id,name', 'client:id,name', 'team', 'tasks']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('client', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('client') && $request->client) {
            $query->where('client_id', $request->client);
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'deadline':
                $query->orderBy('end_date', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $projects = $query->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $projects
        ]);
    }

    public function show(Project $project)
    {
        $project->load(['owner', 'client', 'tasks', 'team']);

        return view('projects.details', compact('project'));
    }

    public function create()
    {
        $clients = \App\Models\Client::orderBy('name')->get();
        return view('projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:active,pending,on_hold',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:low,medium,high,urgent',
            'budget' => 'nullable|numeric|min:0',
        ]);

        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'client_id' => $validated['client_id'],
            'status' => $validated['status'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'priority' => $validated['priority'],
            'budget' => $validated['budget'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('projects.show', $project)->with('success', 'Project created successfully.');
    }

    public function hub()
    {
        $projects = Project::with(['owner', 'client', 'tasks'])
            ->where('status', 'active')
            ->get();

        $stats = [
            'total' => Project::count(),
            'active' => Project::where('status', 'active')->count(),
            'completed' => Project::where('status', 'completed')->count(),
            'onHold' => Project::where('status', 'on_hold')->count(),
        ];

        return view('projects.hub', compact('projects', 'stats'));
    }

    public function assigned()
    {
        $userId = auth()->id();
        
        $projects = Project::with(['owner', 'client', 'tasks'])
            ->whereHas('team', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->paginate(15);

        return view('projects.assigned', compact('projects'));
    }

    public function myAssigned()
    {
        return $this->assigned();
    }

    public function team()
    {
        $projects = Project::with(['owner', 'client', 'team'])
            ->where('status', 'active')
            ->get();

        $users = User::with(['roles'])->get();

        return view('projects.team', compact('projects', 'users'));
    }

    public function overview()
    {
        $projects = Project::with(['owner', 'client', 'tasks'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('projects.overview', compact('projects'));
    }

    public function timeline()
    {
        $projects = Project::with(['owner', 'client'])
            ->orderBy('start_date', 'asc')
            ->get();

        return view('projects.timeline', compact('projects'));
    }

    public function tasksWorkspace()
    {
        $projects = Project::with(['tasks' => function ($query) {
            $query->orderBy('due_date', 'asc');
        }])->get();

        return view('projects.tasks-workspace', compact('projects'));
    }

    public function filesWorkspace()
    {
        $projects = Project::with(['files'])->get();

        return view('projects.files-workspace', compact('projects'));
    }
}