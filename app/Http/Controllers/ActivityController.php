<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\SecurityLog;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session as LaravelSession;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user:id,name,avatar_url')
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('description', 'like', "%{$request->search}%")
                        ->orWhere('action', 'like', "%{$request->search}%")
                        ->orWhereHas('user', function ($q) use ($request) {
                            $q->where('name', 'like', "%{$request->search}%");
                        });
                });
            })
            ->when($request->action_type, function ($q) use ($request) {
                $q->where('action', 'like', "{$request->action_type}%");
            })
            ->when($request->module, function ($q) use ($request) {
                $q->where('module', $request->module);
            })
            ->when($request->date_from, function ($q) use ($request) {
                $q->where('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($q) use ($request) {
                $q->where('created_at', '<=', $request->date_to . ' 23:59:59');
            })
            ->when($request->severity, function ($q) use ($request) {
                $q->where('severity', $request->severity);
            });

        $activities = $query->latest()->paginate(15);

        $stats = $this->getActivityStats();

        $modules = ActivityLog::distinct()->pluck('module')->filter()->values();
        $actionTypes = ActivityLog::distinct()->pluck('action')->filter()->values();

        return view('activity.index', compact('activities', 'stats', 'modules', 'actionTypes'));
    }

    public function sessions(Request $request)
    {
        $query = Session::with('user:id,name,avatar_url')
            ->when($request->status, function ($q) use ($request) {
                if ($request->status === 'active') {
                    $q->active();
                } elseif ($request->status === 'idle') {
                    $q->where('last_activity', '<', now()->subMinutes(30)->getTimestamp())
                        ->where('last_activity', '>=', now()->subHours(24)->getTimestamp());
                } elseif ($request->status === 'expired') {
                    $q->where(function ($q) {
                        $q->where('expires_at', '<', now())
                            ->orWhere('last_activity', '<', now()->subHours(24)->getTimestamp());
                    });
                }
            })
            ->when($request->user_id, function ($q) use ($request) {
                $q->where('user_id', $request->user_id);
            });

        $sessions = $query->latest('last_activity')->paginate(12);

        $stats = [
            'active' => Session::active()->count(),
            'idle' => Session::where('last_activity', '<', now()->subMinutes(30)->getTimestamp())
                ->where('last_activity', '>=', now()->subHours(24)->getTimestamp())->count(),
            'total' => Session::count(),
        ];

        return view('activity.sessions', compact('sessions', 'stats'));
    }

    public function security(Request $request)
    {
        $query = SecurityLog::with('user:id,name,avatar_url')
            ->when($request->event, function ($q) use ($request) {
                $q->where('event', $request->event);
            })
            ->when($request->date_from, function ($q) use ($request) {
                $q->where('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($q) use ($request) {
                $q->where('created_at', '<=', $request->date_to . ' 23:59:59');
            });

        $logs = $query->latest()->paginate(15);

        $stats = [
            'total' => SecurityLog::count(),
            'failed_logins' => SecurityLog::where('event', 'failed_login')->count(),
            'suspicious' => SecurityLog::where('event', 'suspicious_activity')->count(),
            'recent' => SecurityLog::where('created_at', '>=', now()->subHours(24))->count(),
        ];

        $events = SecurityLog::distinct()->pluck('event');

        return view('activity.security', compact('logs', 'stats', 'events'));
    }

    public function exportCsv(Request $request)
    {
        $activities = ActivityLog::with('user:id,name')
            ->when($request->date_from, fn($q) => $q->where('created_at', '>=', $request->date_from))
            ->when($request->date_to, fn($q) => $q->where('created_at', '<=', $request->date_to . ' 23:59:59'))
            ->latest()
            ->get();

        $filename = 'activity_logs_' . now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($activities) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'User', 'Action', 'Description', 'Module', 'Severity', 'IP Address', 'Timestamp']);

            foreach ($activities as $activity) {
                fputcsv($handle, [
                    $activity->id,
                    $activity->user?->name ?? 'System',
                    $activity->action,
                    $activity->description,
                    $activity->computed_module,
                    $activity->computed_severity,
                    $activity->ip_address,
                    $activity->created_at->toDateTimeString(),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $activities = ActivityLog::with('user:id,name')
            ->when($request->date_from, fn($q) => $q->where('created_at', '>=', $request->date_from))
            ->when($request->date_to, fn($q) => $q->where('created_at', '<=', $request->date_to . ' 23:59:59'))
            ->latest()
            ->limit(100)
            ->get();

        $stats = $this->getActivityStats();

        $pdf = \Pdf::loadView('activity.pdf', compact('activities', 'stats'));

        return $pdf->download('activity_logs_' . now()->format('Y-m-d') . '.pdf');
    }

    public function forceLogout($id)
    {
        $session = Session::findOrFail($id);

        $userName = $session->user?->name ?? 'Unknown';

        DB::transaction(function () use ($session, $userName) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'force_logout',
                'description' => "Force logged out user: {$userName}",
                'module' => 'Security',
                'severity' => 'critical',
                'ip_address' => request()->ip(),
            ]);

            $session->delete();
        });

        return back()->with('success', 'Session terminated successfully');
    }

    public function charts()
    {
        $days = request()->get('days', 7);

        $data = ActivityLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->pluck('count', 'date');

        $securityData = SecurityLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->pluck('count', 'date');

        $labels = [];
        $activityCounts = [];
        $securityCounts = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('M d');
            $activityCounts[] = $data[$date] ?? 0;
            $securityCounts[] = $securityData[$date] ?? 0;
        }

        return response()->json([
            'labels' => $labels,
            'activity' => $activityCounts,
            'security' => $securityCounts,
        ]);
    }

    public function admin()
    {
        $logs = ActivityLog::with('user:id,name')
            ->where(function($q) {
                $q->where('severity', 'critical')
                    ->orWhere('action', 'like', 'role%')
                    ->orWhere('action', 'like', 'permission%');
            })
            ->latest()
            ->paginate(15);

        $stats = [
            'total' => ActivityLog::count(),
            'security' => SecurityLog::count(),
            'recent' => ActivityLog::where('created_at', '>=', now()->subHours(24))->count(),
        ];

        return view('activity.admin', compact('logs', 'stats'));
    }

    protected function getActivityStats(): array
    {
        return Cache::remember('activity_stats', 60, function () {
            return [
                'total_actions' => ActivityLog::count(),
                'security_flags' => SecurityLog::where('created_at', '>=', now()->subDays(7))->count(),
                'active_sessions' => Session::active()->count(),
                'recent_actions' => ActivityLog::where('created_at', '>=', now()->subHours(24))->count(),
            ];
        });
    }
}