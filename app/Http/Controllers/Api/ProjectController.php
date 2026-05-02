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
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Project::query()->with(['client', 'users']);

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
            $query->whereHas('users', function($q) use ($request) {
                $q->where('user_id', $request->assigned_to);
            });
        }

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('date_from')) {
            $query->whereDate('start_date', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('end_date', '<=', $request->date_to);
        }

        $projects = $query->orderBy('created_at', 'desc')->paginate(15);

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

        return $this->success($project->load(['client', 'users']), 'Project created successfully', 201);
    }

    public function show(Request $request, Project $project)
    {
        $project->load([
            'client',
            'users',
            'tasks',
            'timeline' => function($q) {
                $q->latest()->limit(10);
            }
        ]);

        $stats = [
            'total_tasks' => $project->tasks()->count(),
            'completed_tasks' => $project->tasks()->where('status', 'done')->count(),
            'team_members' => $project->users()->count(),
            'files_count' => $project->files()->count(),
            'timeline_events' => $project->timeline()->count(),
        ];

        $completedTasks = $project->tasks()->where('status', 'done')->count();
        $totalTasks = $project->tasks()->count();
        $stats['progress'] = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        return $this->success(array_merge($project->toArray(), ['stats' => $stats]));
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

        return $this->success($project->load(['client', 'users']), 'Project updated successfully');
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

        return $this->success(null, 'Project deleted successfully');
    }

    public function users(Request $request, Project $project)
    {
        $users = $project->users()->get();
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

        return $this->success($project->load('users'), 'Users assigned successfully');
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

        return $this->success($project->load('users'), 'User removed successfully');
    }

    public function timeline(Request $request, Project $project)
    {
        $events = $project->timeline()
            ->orderBy('event_date', 'desc')
            ->paginate(20);

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

        return $this->success($event, 'Timeline event added successfully', 201);
    }

    public function files(Request $request, Project $project)
    {
        $files = $project->files()->with('uploader')->get();
        return $this->success($files);
    }

    public function linkFile(Request $request, Project $project)
    {
        $request->validate([
            'file_id' => 'required|exists:files,id',
        ]);

        $exists = $project->files()->where('file_id', $request->file_id)->exists();
        if ($exists) {
            return $this->error('File already linked to this project', 400);
        }

        $project->files()->attach($request->file_id);

        $this->logTimeline($project, 'file_added', 'File linked to project', $request->user()->id);

        return $this->success($project->load('files'), 'File linked successfully');
    }

    private function logTimeline(Project $project, string $type, string $description, int $userId): void
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
        $workspaceService = new \App\Services\ProjectWorkspaceService();
        
        $workspace = $workspaceService->getWorkspace($project);
        
        return $this->success($workspace);
    }
}