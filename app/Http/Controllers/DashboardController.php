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

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalClients' => Client::count(),
            'activeClients' => Client::where('status', 'active')->count(),
            'newClientsThisMonth' => Client::whereMonth('created_at', now()->month)->count(),
            
            'totalProjects' => Project::count(),
            'activeProjects' => Project::where('status', 'active')->count(),
            'completedProjects' => Project::where('status', 'completed')->count(),
            'delayedProjects' => Project::where('status', 'delayed')->count(),
            
            'totalRevenue' => Payment::where('status', 'completed')->sum('amount'),
            'receivedThisMonth' => Payment::where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
            'pendingAmount' => Invoice::where('status', 'pending')->sum('amount'),
            
            'totalTasks' => Task::count(),
            'openTasks' => Task::where('status', 'pending')->count(),
            'highPriorityTasks' => Task::where('priority', 'high')->where('status', 'pending')->count(),
            'overdueTasks' => Task::where('due_date', '<', now()->toDateString())->where('status', 'pending')->count(),
            'completedTasksToday' => Task::where('status', 'completed')
                ->whereDate('updated_at', now()->toDateString())
                ->count(),
        ];

        $recentActivity = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentPayments = Payment::with('invoice.client')
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentClients = Client::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $tasks = Task::where('status', 'pending')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->limit(5)
            ->get();

        $alerts = SecurityLog::whereIn('event', ['failed_login', 'suspicious_activity'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $teamMembers = User::where('id', '!=', auth()->id())
            ->orderBy('name')
            ->limit(3)
            ->get();

        $recentProjects = Project::where('status', 'active')
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get();

        $userNotifications = UserNotification::with('notification')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $notifications = $userNotifications->groupBy(function ($n) {
            return $n->created_at ? $n->created_at->format('Y-m-d') : now()->format('Y-m-d');
        });
        
        $flatNotifications = $userNotifications;

        // Get latest security report
        $latestSecurityReport = Notification::where('type', 'security')
            ->where('title', 'like', 'Security Report%')
            ->orderBy('created_at', 'desc')
            ->first();

        // Weekly billing data
        $weeklyBilling = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $weeklyBilling[] = [
                'day' => now()->subDays($i)->format('D'),
                'amount' => Payment::where('status', 'completed')
                    ->whereDate('created_at', $date)
                    ->sum('amount') ?? 0,
            ];
        }

        $unreadCount = UserNotification::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->count();

        // Weekly billing data
        $weeklyBilling = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $weeklyBilling[] = [
                'day' => now()->subDays($i)->format('D'),
                'amount' => Payment::where('status', 'completed')
                    ->whereDate('created_at', $date)
                    ->sum('amount') ?? 0,
            ];
        }

        return view('dashboard', compact(
            'stats',
            'recentActivity',
            'recentPayments',
            'recentClients',
            'tasks',
            'alerts',
            'notifications',
            'flatNotifications',
            'unreadCount',
            'teamMembers',
            'recentProjects',
            'latestSecurityReport',
            'weeklyBilling'
        ));
    }
}