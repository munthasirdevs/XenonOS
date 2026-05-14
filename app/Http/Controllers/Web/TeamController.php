<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'client'])
            ->when(request()->has('search'), function ($query) {
                $search = request('search');
                $query->where(fn($q) => $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%'));
            })
            ->paginate(15);

        return view('team.index', compact('users'));
    }

    public function assign(Request $request)
    {
        $users = User::with(['roles'])->get();
        $projects = \App\Models\Project::with(['tasks'])->get();

        return view('team.assign', compact('users', 'projects'));
    }

    public function assignUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'project_id' => 'nullable|exists:projects,id',
            'task_id' => 'nullable|exists:tasks,id',
        ]);

        // Assign logic here

        return redirect()->back()->with('success', 'User assigned successfully');
    }
}