<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
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
}