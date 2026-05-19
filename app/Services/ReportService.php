<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\Project;
use App\Models\Task;
use App\Models\Client;
use App\Models\Payment;
use Carbon\Carbon;

class ReportService
{
    public function getDashboardReport(int $userId): array
    {
        $clients = Client::where('created_by', $userId)->pluck('id');
        
        return [
            'clients' => [
                'total' => Client::whereIn('id', $clients)->count(),
                'active' => Client::whereIn('id', $clients)->where('status', 'active')->count(),
            ],
            'projects' => [
                'total' => Project::whereIn('client_id', $clients)->count(),
                'active' => Project::whereIn('client_id', $clients)->where('status', 'active')->count(),
                'completed' => Project::whereIn('client_id', $clients)->where('status', 'completed')->count(),
            ],
            'tasks' => [
                'total' => Task::whereHas('project', fn($q) => $q->whereIn('client_id', $clients))->count(),
                'pending' => Task::whereHas('project', fn($q) => $q->whereIn('client_id', $clients))->where('status', 'todo')->count(),
                'completed' => Task::whereHas('project', fn($q) => $q->whereIn('client_id', $clients))->where('status', 'done')->count(),
            ],
            'revenue' => [
                'total' => Payment::whereIn('invoice_id', fn($q) => $q->select('id')->from('invoices')->whereIn('client_id', $clients))
                    ->where('status', 'completed')->sum('amount') ?? 0,
            ],
        ];
    }

    public function getActivityReport(int $userId, ?Carbon $startDate = null, ?Carbon $endDate = null): array
    {
        $startDate = $startDate ?? now()->subDays(30);
        $endDate = $endDate ?? now();
        
        $activities = ActivityLog::where('user_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return [
            'total' => $activities->count(),
            'by_type' => $activities->groupBy('action')->map(fn($g) => $g->count())->toArray(),
            'activities' => $activities->take(50)->toArray(),
        ];
    }

    public function getTaskReport(int $userId): array
    {
        $tasks = Task::whereHas('project', fn($q) => $q->where('created_by', $userId));
        
        return [
            'total' => $tasks->count(),
            'by_status' => $tasks->groupBy('status')->map(fn($g) => $g->count())->toArray(),
            'by_priority' => $tasks->groupBy('priority')->map(fn($g) => $g->count())->toArray(),
            'overdue' => $tasks->where('due_date', '<', now())->where('status', '!=', 'done')->count(),
        ];
    }

    public function getProjectReport(int $userId): array
    {
        $projects = Project::whereIn('client_id', fn($q) => $q->select('id')->from('clients')->where('created_by', $userId));
        
        return [
            'total' => $projects->count(),
            'by_status' => $projects->groupBy('status')->map(fn($g) => $g->count())->toArray(),
            'total_budget' => $projects->sum('budget') ?? 0,
            'avg_progress' => $projects->avg('progress') ?? 0,
        ];
    }

    public function getClientReport(int $userId): array
    {
        $clients = Client::where('created_by', $userId);
        
        return [
            'total' => $clients->count(),
            'active' => $clients->where('status', 'active')->count(),
            'inactive' => $clients->where('status', 'inactive')->count(),
            'by_industry' => $clients->groupBy('industry')->map(fn($g) => $g->count())->toArray(),
        ];
    }

    public function exportToCsv(array $data, string $filename): string
    {
        $handle = fopen('php://temp', 'r+');
        
        if (!empty($data)) {
            fputcsv($handle, array_keys($data[0]));
            foreach ($data as $row) {
                fputcsv($handle, $row);
            }
        }
        
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);
        
        return $csv;
    }
}