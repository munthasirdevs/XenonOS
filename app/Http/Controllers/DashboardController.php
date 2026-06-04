<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\ActivityLog;
use App\Models\SecurityLog;
use App\Models\Notification;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $stats = Cache::remember("dashboard_stats_{$userId}", 60, function() {
            return [
                'totalClients' => Client::count(),
                'activeClients' => Client::where('status', 'active')->count(),
                'newClientsThisMonth' => Client::whereMonth('created_at', now()->month)->count(),
                'totalProjects' => Project::count(),
                'activeProjects' => Project::where('status', 'active')->count(),
                'completedProjects' => Project::where('status', 'completed')->count(),
                'delayedProjects' => Project::where('status', 'on_hold')->count(),
                'totalRevenue' => Payment::where('status', 'completed')->sum('amount'),
                'receivedThisMonth' => Payment::where('status', 'completed')->whereMonth('created_at', now()->month)->sum('amount'),
                'pendingAmount' => Invoice::whereIn('status', ['draft', 'sent'])->sum('amount'),
                'totalTasks' => Task::count(),
                'openTasks' => Task::whereIn('status', ['todo', 'in_progress', 'review'])->count(),
                'highPriorityTasks' => Task::where('priority', 'high')->whereIn('status', ['todo', 'in_progress', 'review'])->count(),
                'overdueTasks' => Task::where('due_date', '<', now()->toDateString())->where('status', '!=', 'done')->count(),
                'completedTasksToday' => Task::where('status', 'done')->whereDate('updated_at', now()->toDateString())->count(),
            ];
        });

        $recentActivity = Cache::remember("recent_activity_{$userId}", 30, function() {
            return ActivityLog::with('user:id,name')->latest()->limit(5)->get();
        });

        $recentPayments = Cache::remember("recent_payments_{$userId}", 30, function() {
            return Payment::with('invoice.client:id,name')->where('status', 'completed')->latest()->limit(5)->get();
        });

        $recentClients = Cache::remember("recent_clients_{$userId}", 60, function() {
            return Client::select('id', 'name', 'email', 'company', 'status', 'created_at')->latest()->limit(5)->get();
        });

        $tasks = Task::select('id', 'title', 'status', 'priority', 'due_date')
            ->whereIn('status', ['todo', 'in_progress', 'review'])
            ->orderByRaw("FIELD(priority, 'urgent', 'high', 'medium', 'low')")
            ->limit(5)
            ->get();

        $alerts = Cache::remember("security_alerts_{$userId}", 30, function() {
            return SecurityLog::whereIn('event', ['failed_login', 'suspicious_activity'])->latest()->limit(3)->get();
        });

        $teamMembers = User::select('id', 'name', 'email')
            ->where('id', '!=', $userId)
            ->orderBy('name')
            ->limit(3)
            ->get();

        $recentProjects = Cache::remember("recent_projects_{$userId}", 30, function() {
            return Project::select('id', 'name', 'status', 'priority', 'end_date')->where('status', 'active')->latest()->limit(3)->get();
        });

        $userNotifications = UserNotification::with('notification:id,title,message,type,created_at')
            ->where('user_id', $userId)
            ->latest()
            ->limit(10)
            ->get();

        $notifications = $userNotifications->groupBy(function($n) {
            return $n->created_at ? $n->created_at->format('Y-m-d') : now()->format('Y-m-d');
        });
        $flatNotifications = $userNotifications;

        $latestSecurityReport = Notification::where('type', 'security')
            ->where('title', 'like', 'Security Report%')
            ->latest()
            ->first();

        $weeklyBilling = Cache::remember("weekly_billing_{$userId}", 60, function() {
            $results = Payment::selectRaw('DATE(created_at) as date, SUM(amount) as total')
                ->where('status', 'completed')
                ->where('created_at', '>=', now()->subDays(6))
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->keyBy('date');

            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->toDateString();
                $data[] = [
                    'day' => now()->subDays($i)->format('D'),
                    'amount' => $results[$date]->total ?? 0,
                ];
            }
            return $data;
        });

        $unreadCount = UserNotification::where('user_id', $userId)->whereNull('read_at')->count();

        return view('dashboard', compact(
            'stats', 'recentActivity', 'recentPayments', 'recentClients', 'tasks',
            'alerts', 'notifications', 'flatNotifications', 'unreadCount',
            'teamMembers', 'recentProjects', 'latestSecurityReport', 'weeklyBilling'
        ));
    }
}