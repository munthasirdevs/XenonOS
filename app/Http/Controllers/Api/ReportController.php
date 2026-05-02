<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use ApiResponse;

    public function dashboard(Request $request)
    {
        $totalClients = DB::table('clients')->count();
        $totalProjects = DB::table('projects')->count();
        $totalTasks = DB::table('tasks')->count();
        
        $activeProjects = DB::table('projects')
            ->whereIn('status', ['active', 'in_progress'])
            ->count();
        
        $completedTasks = DB::table('tasks')
            ->where('status', 'completed')
            ->count();

        $pendingInvoices = DB::table('invoices')
            ->whereIn('status', ['draft', 'sent'])
            ->sum('total');

        return $this->success([
            'clients' => $totalClients,
            'projects' => $totalProjects,
            'active_projects' => $activeProjects,
            'tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
            'pending_invoices' => $pendingInvoices,
        ]);
    }

    public function activities(Request $request)
    {
        $query = DB::table('activity_logs')
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

        $activities = $query->paginate(50);
        return $this->success($activities);
    }

    public function userActivity(Request $request)
    {
        $userId = $request->user_id ?? $request->user()->id;

        $activities = DB::table('activity_logs')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();

        $byAction = DB::table('activity_logs')
            ->where('user_id', $userId)
            ->selectRaw('action, COUNT(*) as count')
            ->groupBy('action')
            ->get();

        return $this->success([
            'recent' => $activities,
            'by_action' => $byAction,
        ]);
    }

    public function taskStats()
    {
        $byStatus = DB::table('tasks')
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $byPriority = DB::table('tasks')
            ->selectRaw('priority, COUNT(*) as count')
            ->groupBy('priority')
            ->get();

        $overdue = DB::table('tasks')
            ->where('due_date', '<', now())
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->count();

        return $this->success([
            'by_status' => $byStatus,
            'by_priority' => $byPriority,
            'overdue' => $overdue,
        ]);
    }

    public function projectStats()
    {
        $byStatus = DB::table('projects')
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $byType = DB::table('projects')
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get();

        return $this->success([
            'by_status' => $byStatus,
            'by_type' => $byType,
        ]);
    }

    public function clientStats()
    {
        $byStatus = DB::table('clients')
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $byIndustry = DB::table('clients')
            ->selectRaw('industry, COUNT(*) as count')
            ->groupBy('industry')
            ->get();

        return $this->success([
            'by_status' => $byStatus,
            'by_industry' => $byIndustry,
        ]);
    }

    public function export(Request $request)
    {
        $type = $request->type ?? 'activities';
        
        $query = DB::table('activity_logs')
            ->orderBy('created_at', 'desc');

        if ($request->has('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->where('created_at', '<=', $request->date_to);
        }

        return $this->success($query->get());
    }
}