<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function insights()
    {
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'done')->count();
        $totalProjects = Project::count();
        $activeProjects = Project::where('status', 'active')->count();

        return view('reports.insights', compact(
            'totalTasks', 'completedTasks', 'totalProjects', 'activeProjects'
        ));
    }

    public function sales()
    {
        $totalClients = Client::count();
        $totalRevenue = Payment::where('status', 'completed')->sum('amount') ?? 0;
        $monthlyRevenue = Payment::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->sum('amount') ?? 0;

        return view('reports.sales', compact('totalClients', 'totalRevenue', 'monthlyRevenue'));
    }

    public function financial()
    {
        $totalRevenue = Payment::where('status', 'completed')->sum('amount') ?? 0;
        $pendingPayments = Payment::where('status', 'pending')->sum('amount') ?? 0;

        return view('reports.financial', compact('totalRevenue', 'pendingPayments'));
    }

    public function support()
    {
        $openTasks = Task::whereIn('status', ['todo', 'in_progress'])->count();

        return view('reports.support', compact('openTasks'));
    }

    public function builder()
    {
        return view('reports.builder');
    }

    public function saved()
    {
        return view('reports.saved');
    }
}