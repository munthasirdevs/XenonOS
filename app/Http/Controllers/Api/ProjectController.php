<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\AuditLog;
use App\Models\Client;
use App\Models\File;
use App\Models\Project;
use App\Models\ProjectTimeline;
use App\Models\User;
use App\Models\Task;
use App\Models\ProjectFile;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    use ApiResponse;

    private function getCacheKey(Request $request)
    {
        return 'api_projects_' . md5($request->getQueryString());
    }

    private function clearProjectCache(?int $projectId = null): void
    {
        if ($projectId) {
            Cache::forget("project_{$projectId}");
            Cache::forget("project_{$projectId}_stats");
            Cache::forget("project_{$projectId}_users");
            Cache::forget("project_{$projectId}_timeline");
            Cache::forget("project_{$projectId}_files");
        }
        Cache::forget('project_stats');
        try {
            Cache::tags(['projects'])->flush();
        } catch (\Exception $e) {
        }
    }

    public function index(Request $request)
    {
        $cacheKey = $this->getCacheKey($request);
        
        $projects = Cache::tags(['projects'])->remember($cacheKey, 30, function() use ($request) {
            $query = Project::select(['id', 'client_id', 'name', 'description', 'status', 'priority', 'start_date', 'end_date', 'budget', 'created_by', 'updated_by', 'created_at', 'updated_at'])
                ->with(['client:id,name,company', 'users:id,name,email'])
                ->orderBy('created_at', 'desc');

            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            if ($request->has('priority')) {
                $query->where('priority', $request->priority);
            }

            if ($request->has('client_id')) {
                $query->where('client_id', $request->client_id);
            }

            if ($request->has('assigned_to')) {
                $query->whereHas('users', function($q) use ($request) { $q->where('user_id', $request->assigned_to); });
            }

            if ($request->has('q')) {
                $query->where(function($q) use ($request) { 
                    $q->where('name', 'like', '%' . $request->q . '%')
                      ->orWhere('description', 'like', '%' . $request->q . '%');
                });
            }

            if ($request->has('date_from')) {
                $query->whereDate('start_date', '>=', $request->date_from);
            }

            if ($request->has('date_to')) {
                $query->whereDate('end_date', '<=', $request->date_to);
            }

            return $query->paginate(15);
        });

        return $this->success($projects);
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::create([
            ...$request->validated(),
            'created_by' => $request->user()->id,
            'status' => $request->status ?? 'active',
            'priority' => $request->priority ?? 'medium',
        ]);

        $this->logTimeline($project, 'created', 'Project created', $request->user()->id);

        AuditLog::create([
            'model_type' => Project::class,
            'model_id' => $project->id,
            'changes' => ['created' => $project->toArray()],
            'created_by' => $request->user()->id,
            'action' => 'project_created',
            'description' => 'Project created: ' . $project->name,
        ]);

        $this->clearProjectCache($project->id);

        return $this->success($project->load(['client:id,name', 'users:id,name,email']), 'Project created successfully', 201);
    }

    public function show(Request $request, Project $project)
    {
        $projectKey = "project_{$project->id}";
        
        $projectData = Cache::remember($projectKey, 60, function() use ($project) {
            return $project->load([
                'client:id,name,company,email',
                'users:id,name,email',
                'tasks' => function($q) { $q->select('id', 'project_id', 'title', 'status', 'priority', 'assigned_to', 'due_date')->latest()->limit(20); },
                'timeline' => function($q) { $q->select('id', 'project_id', 'title', 'event_type', 'event_date')->latest()->limit(10); }
            ]);
        });

        $stats = Cache::remember("project_{$project->id}_stats", 60, function() use ($project) {
            $totalTasks = Task::where('project_id', $project->id)->count();
            $completedTasks = Task::where('project_id', $project->id)->where('status', 'done')->count();
            
            return [
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks,
                'team_members' => $project->users()->count(),
                'files_count' => ProjectFile::where('project_id', $project->id)->count(),
                'timeline_events' => ProjectTimeline::where('project_id', $project->id)->count(),
                'progress' => $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0,
            ];
        });

        return $this->success(array_merge($projectData->toArray(), ['stats' => $stats]));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $oldData = $project->toArray();
        $oldStatus = $project->status;
        
        $project->update([
            ...$request->validated(),
            'updated_by' => $request->user()->id,
        ]);

        if ($oldStatus !== $project->status) {
            $this->logTimeline($project, 'status_change', 'Status changed from ' . $oldStatus . ' to ' . $project->status, $request->user()->id);
        }

        $this->logTimeline($project, 'updated', 'Project updated', $request->user()->id);

        AuditLog::create([
            'model_type' => Project::class,
            'model_id' => $project->id,
            'changes' => ['before' => $oldData, 'after' => $project->fresh()->toArray()],
            'created_by' => $request->user()->id,
            'action' => 'project_updated',
            'description' => 'Project updated: ' . $project->name,
        ]);

        $this->clearProjectCache($project->id);

        return $this->success($project->fresh()->load(['client:id,name', 'users:id,name,email']), 'Project updated successfully');
    }

    public function destroy(Request $request, Project $project)
    {
        $projectName = $project->name;
        
        $this->logTimeline($project, 'deleted', 'Project deleted', $request->user()->id);

        AuditLog::create([
            'model_type' => Project::class,
            'model_id' => $project->id,
            'changes' => ['deleted' => $projectName],
            'created_by' => $request->user()->id,
            'action' => 'project_deleted',
            'description' => 'Project deleted: ' . $projectName,
        ]);

        $project->delete();

        $this->clearProjectCache($project->id);

        return $this->success(null, 'Project deleted successfully');
    }

    public function users(Request $request, Project $project)
    {
        $cacheKey = "project_{$project->id}_users";
        
        $users = Cache::remember($cacheKey, 30, function() use ($project) {
            return $project->users()->select('users.id', 'users.name', 'users.email')->get();
        });
        
        return $this->success($users);
    }

    public function assignUsers(Request $request, Project $project)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'roles' => 'nullable|array',
        ]);

        $oldUsers = $project->users()->pluck('users.id')->toArray();
        
        $syncData = [];
        foreach ($request->user_ids as $index => $userId) {
            $syncData[$userId] = [
                'role' => $request->roles[$index] ?? 'member',
                'assigned_at' => now(),
            ];
        }
        
        $project->users()->sync($syncData);

        AuditLog::create([
            'model_type' => Project::class,
            'model_id' => $project->id,
            'changes' => ['before' => $oldUsers, 'after' => $request->user_ids],
            'created_by' => $request->user()->id,
            'action' => 'users_assigned',
            'description' => 'Users assigned to project: ' . $project->name,
        ]);

        $this->logTimeline($project, 'user_assigned', 'Team members updated', $request->user()->id);

        Cache::forget("project_{$project->id}_users");
        
        return $this->success($project->load('users:id,name,email'), 'Users assigned successfully');
    }

    public function removeUser(Request $request, Project $project, User $user)
    {
        $project->users()->detach($user->id);

        AuditLog::create([
            'model_type' => Project::class,
            'model_id' => $project->id,
            'changes' => ['removed_user' => $user->id],
            'created_by' => $request->user()->id,
            'action' => 'user_removed',
            'description' => 'User removed from project: ' . $project->name,
        ]);

        Cache::forget("project_{$project->id}_users");

        return $this->success($project->load('users:id,name,email'), 'User removed successfully');
    }

    public function timeline(Request $request, Project $project)
    {
        $page = $request->get('page', 1);
        $cacheKey = "project_{$project->id}_timeline_{$page}";
        
        $events = Cache::remember($cacheKey, 30, function() use ($project) {
            return ProjectTimeline::where('project_id', $project->id)
                ->select('id', 'project_id', 'title', 'description', 'event_type', 'event_date', 'created_by', 'created_at')
                ->latest()
                ->paginate(20);
        });

        return $this->success($events);
    }

    public function addTimeline(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_type' => 'required|in:milestone,update,status_change',
            'event_date' => 'nullable|date',
        ]);

        $event = $project->timeline()->create([
            'title' => $request->title,
            'description' => $request->description,
            'event_type' => $request->event_type,
            'event_date' => $request->event_date ?? now(),
            'created_by' => $request->user()->id,
        ]);

        Cache::forget("project_{$project->id}_timeline_*");

        return $this->success($event, 'Timeline event added successfully', 201);
    }

    public function files(Request $request, Project $project)
    {
        $cacheKey = "project_{$project->id}_files";
        
        $files = Cache::remember($cacheKey, 60, function() use ($project) {
            return File::whereIn('id', ProjectFile::where('project_id', $project->id)->pluck('file_id'))
                ->select('id', 'name', 'size', 'type', 'mime_type')
                ->get();
        });

        return $this->success($files);
    }

    public function linkFile(Request $request, Project $project)
    {
        $request->validate(['file_id' => 'required|exists:files,id']);

        $exists = ProjectFile::where('project_id', $project->id)->where('file_id', $request->file_id)->exists();
        if ($exists) {
            return $this->error('File already linked to this project', 400);
        }

        $project->files()->attach($request->file_id);

        $this->logTimeline($project, 'file_added', 'File linked to project', $request->user()->id);

        Cache::forget("project_{$project->id}_files");

        return $this->success($project->load('files'), 'File linked successfully');
    }

    private function logTimeline(Project $project, string $type, string $description, int $userId)
    {
        $project->timeline()->create([
            'event_type' => $type,
            'description' => $description,
            'created_by' => $userId,
            'event_date' => now(),
        ]);
    }

    public function workspace(Request $request, Project $project)
    {
        $workspaceKey = "project_{$project->id}_workspace";
        
        $workspace = Cache::remember($workspaceKey, 60, function() use ($project) {
            return [
                'project' => $project->only(['id', 'name', 'description', 'status', 'priority']),
                'client' => $project->client ? $project->client->only(['id', 'name', 'company']) : null,
                'tasks' => $project->tasks()->select('id', 'title', 'status', 'priority', 'due_date')->get(),
                'files' => $project->files()->select('id', 'name', 'type')->get(),
                'team' => $project->users()->select('users.id', 'users.name', 'users.email')->get(),
            ];
        });
        
        return $this->success($workspace);
    }
}