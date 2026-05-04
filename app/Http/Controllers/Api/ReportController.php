<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\ActivityLog;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use ApiResponse;

    public function dashboard(Request $request)
    {
        $stats = Cache::remember('report_dashboard', 60, function() {
            return [
                'clients' => Client::count(),
                'projects' => Project::count(),
                'active_projects' => Project::whereIn('status', ['active', 'in_progress'])->count(),
                'tasks' => Task::count(),
                'completed_tasks' => Task::where('status', 'done')->count(),
                'pending_invoices' => Invoice::whereIn('status', ['draft', 'sent'])->sum('total'),
            ];
        });

        return $this->success($stats);
    }

    public function activities(Request $request)
    {
        $cacheKey = 'report_activities_' . md5($request->getQueryString());
        
        $activities = Cache::remember($cacheKey, 30, function() use ($request) {
            $query = ActivityLog::with('user:id,name')
                ->orderBy('created_at', 'desc');

            if ($request->has('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            if ($request->has('action')) {
                $query->where('action', 'like', '%' . $request->action . '%');
            }

            if ($request->has('date_from')) {
                $query->where('created_at', '>=', $request->date_from);
            }

            if ($request->has('date_to')) {
                $query->where('created_at', '<=', $request->date_to);
            }

            return $query->paginate(20);
        });

        return $this->success($activities);
    }

    public function clientStats(Request $request)
    {
        $stats = Cache::remember('report_client_stats', 60, function() {
            return [
                'total' => Client::count(),
                'active' => Client::where('status', 'active')->count(),
                'inactive' => Client::where('status', 'inactive')->count(),
                'archived' => Client::where('status', 'archived')->count(),
                'by_tier' => Client::selectRaw('tier, COUNT(*) as count')->groupBy('tier')->get(),
            ];
        });

        return $this->success($stats);
    }

    public function projectStats(Request $request)
    {
        $stats = Cache::remember('report_project_stats', 60, function() {
            return [
                'total' => Project::count(),
                'active' => Project::where('status', 'active')->count(),
                'completed' => Project::where('status', 'completed')->count(),
                'paused' => Project::where('status', 'paused')->count(),
                'cancelled' => Project::where('status', 'cancelled')->count(),
                'by_priority' => Project::selectRaw('priority, COUNT(*) as count')->groupBy('priority')->get(),
                'total_budget' => Project::whereNotNull('budget')->sum('budget'),
            ];
        });

        return $this->success($stats);
    }

    public function taskStats(Request $request)
    {
        $stats = Cache::remember('report_task_stats', 60, function() {
            return [
                'total' => Task::count(),
                'todo' => Task::where('status', 'todo')->count(),
                'in_progress' => Task::where('status', 'in_progress')->count(),
                'review' => Task::where('status', 'review')->count(),
                'done' => Task::where('status', 'done')->count(),
                'overdue' => Task::where('status', '!=', 'done')->whereNotNull('due_date')->where('due_date', '<', now())->count(),
                'by_priority' => Task::selectRaw('priority, COUNT(*) as count')->groupBy('priority')->get(),
            ];
        });

        return $this->success($stats);
    }

    public function userActivity(Request $request)
    {
        $cacheKey = 'report_user_activity_' . md5($request->getQueryString());
        
        $activities = Cache::remember($cacheKey, 30, function() use ($request) {
            $query = ActivityLog::with('user:id,name')
                ->whereNotNull('user_id')
                ->orderBy('created_at', 'desc');

            if ($request->has('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            if ($request->has('date_from')) {
                $query->where('created_at', '>=', $request->date_from);
            }

            if ($request->has('date_to')) {
                $query->where('created_at', '<=', $request->date_to);
            }

            return $query->paginate(20);
        });

        return $this->success($activities);
    }

    public function export(Request $request)
    {
        $request->validate([
            'type' => 'required|in:clients,projects,tasks,activities',
            'format' => 'nullable|in:csv,json',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after:date_from',
        ]);

        $data = match($request->type) {
            'clients' => Client::query(),
            'projects' => Project::query(),
            'tasks' => Task::query(),
            'activities' => ActivityLog::with('user:id,name'),
            default => null,
        };

        if ($request->has('date_from')) {
            $data->where('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $data->where('created_at', '<=', $request->date_to);
        }

        return $this->success([
            'count' => $data->count(),
            'format' => $request->format ?? 'json',
        ]);
    }
}