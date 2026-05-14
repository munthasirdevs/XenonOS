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
        $query = Project::with(['owner:id,name', 'client:id,name']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $projects = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load(['owner', 'client', 'tasks', 'team']);

        return view('projects.details', compact('project'));
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