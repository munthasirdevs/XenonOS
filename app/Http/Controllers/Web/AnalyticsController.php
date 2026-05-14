<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function executive()
    {
        $totalProjects = Project::count();
        $activeProjects = Project::where('status', 'active')->count();
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'done')->count();
        $totalClients = Client::count();
        $totalUsers = User::count();

        $recentProjects = Project::with(['client', 'owner'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentTasks = Task::with(['project', 'assignee'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('analytics.executive', compact(
            'totalProjects', 'activeProjects', 'totalTasks', 
            'completedTasks', 'totalClients', 'totalUsers',
            'recentProjects', 'recentTasks'
        ));
    }

    public function marketing()
    {
        $totalClients = Client::count();
        $newClientsThisMonth = Client::whereMonth('created_at', now()->month)->count();
        $activeProjects = Project::where('status', 'active')->count();
        $totalRevenue = \App\Models\Payment::where('status', 'completed')->sum('amount') ?? 0;

        $clientsByStatus = Client::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('analytics.marketing', compact(
            'totalClients', 'newClientsThisMonth', 
            'activeProjects', 'totalRevenue', 'clientsByStatus'
        ));
    }

    public function operations()
    {
        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 'todo')->count();
        $inProgressTasks = Task::where('status', 'in_progress')->count();
        $completedTasks = Task::where('status', 'done')->count();

        $tasksByPriority = Task::selectRaw('priority, count(*) as count')
            ->groupBy('priority')
            ->pluck('count', 'priority');

        $topPerformers = User::withCount('assignedTasks')
            ->withCount(['assignedTasks' => function ($q) {
                $q->where('status', 'done');
            }])
            ->orderBy('assigned_tasks_done_count', 'desc')
            ->take(5)
            ->get();

        return view('analytics.operations', compact(
            'totalTasks', 'pendingTasks', 'inProgressTasks',
            'completedTasks', 'tasksByPriority', 'topPerformers'
        ));
    }
}