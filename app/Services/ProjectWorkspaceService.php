<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Cache;

class ProjectWorkspaceService
{
    public function getWorkspace(Project $project, int $cacheMinutes = 60)
    {
        $cacheKey = "project_workspace_{$project->id}";
        
        return Cache::remember($cacheKey, $cacheMinutes * 60, function () use ($project) {
            return [
                'project' => $this->getProject($project),
                'stats' => $this->getStats($project),
                'tasks' => $this->getTasks($project),
                'team' => $this->getTeam($project),
                'recent_files' => $this->getRecentFiles($project),
                'recent_timeline' => $this->getRecentTimeline($project),
            ];
        });
    }

    public function getProject(Project $project)
    {
        return $project->load(['client', 'creator', 'updater']);
    }

    public function getStats(Project $project)
    {
        $tasks = $project->tasks();
        
        $total = $tasks->count();
        $completed = $tasks->where('status', 'done')->count();
        $pending = $tasks->whereIn('status', ['todo', 'in_progress'])->count();
        $overdue = $tasks->where('status', '!=', 'done')
            ->whereNotNull('due_date')
            ->where('due_date', '<', now())->count();

        return [
            'total_tasks' => $total,
            'completed_tasks' => $completed,
            'pending_tasks' => $pending,
            'overdue_tasks' => $overdue,
            'progress' => $total > 0 ? round(($completed / $total) * 100) : 0,
            'team_members' => $project->users()->count(),
            'files_count' => $project->files()->count(),
            'timeline_events' => $project->timeline()->count(),
        ];
    }

    public function getTasks(Project $project)
    {
        $tasks = $project->tasks()
            ->select('id', 'project_id', 'title', 'status', 'priority', 'assigned_to', 'due_date', 'created_at')
            ->with('assignee:id,name')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('status');

        return [
            'todo' => $tasks->get('todo', collect())->take(10)->values(),
            'in_progress' => $tasks->get('in_progress', collect())->take(10)->values(),
            'done' => $tasks->get('done', collect())->take(10)->values(),
        ];
    }

    public function getTeam(Project $project)
    {
        return $project->users()
            ->select('users.id', 'users.name', 'users.email')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->pivot->role,
                    'assigned_at' => $user->pivot->assigned_at,
                ];
            });
    }

    public function getRecentFiles(Project $project)
    {
        return $project->files()
            ->with('uploader:id,name')
            ->latest()
            ->limit(10)
            ->get();
    }

    public function getRecentTimeline(Project $project)
    {
        return $project->timeline()
            ->with('creator:id,name')
            ->orderBy('event_date', 'desc')
            ->limit(10)
            ->get();
    }

    public function clearCache(Project $project): void
    {
        Cache::forget("project_workspace_{$project->id}");
    }
}