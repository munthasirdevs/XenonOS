<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\AuditLog;
use App\Models\Client;
use App\Models\ClientActivity;
use App\Models\Profile;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('company')) {
            $query->where('company', 'like', '%' . $request->company . '%');
        }

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('company', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $clients = $query->with(['activities' => function($q) {
            $q->latest()->limit(5);
        }])->orderBy('created_at', 'desc')->paginate(15);

        return $this->success($clients);
    }

    public function store(ClientRequest $request)
    {
        $client = Client::create([
            ...$request->validated(),
            'created_by' => $request->user()->id,
            'status' => 'active',
        ]);

        $this->logActivity($client, 'created', 'Client created', $request->user()->id);

        AuditLog::create([
            'model_type' => Client::class,
            'model_id' => $client->id,
            'changes' => ['created' => $client->toArray()],
            'created_by' => $request->user()->id,
            'action' => 'client_created',
            'description' => 'Client created: ' . $client->name,
        ]);

        return $this->success($client->load('activities'), 'Client created successfully', 201);
    }

    public function show(Request $request, Client $client)
    {
        $client->load(['activities' => function($q) {
            $q->latest()->limit(10);
        }, 'projects', 'invoices']);

        $stats = [
            'projects_count' => $client->projects()->count(),
            'active_tasks' => $client->projects()->withCount('tasks')->get()->sum('tasks_count'),
            'pending_invoices' => $client->invoices()->where('status', 'pending')->count(),
        ];

        return $this->success(array_merge(
            $client->toArray(),
            ['stats' => $stats]
        ));
    }

    public function update(ClientRequest $request, Client $client)
    {
        $oldData = $client->toArray();
        
        $client->update([
            ...$request->validated(),
            'updated_by' => $request->user()->id,
        ]);

        $this->logActivity($client, 'updated', 'Client updated', $request->user()->id);

        AuditLog::create([
            'model_type' => Client::class,
            'model_id' => $client->id,
            'changes' => ['before' => $oldData, 'after' => $client->fresh()->toArray()],
            'created_by' => $request->user()->id,
            'action' => 'client_updated',
            'description' => 'Client updated: ' . $client->name,
        ]);

        return $this->success($client->load('activities'), 'Client updated successfully');
    }

    public function destroy(Request $request, Client $client)
    {
        $clientName = $client->name;
        
        $this->logActivity($client, 'deleted', 'Client deleted', $request->user()->id);

        AuditLog::create([
            'model_type' => Client::class,
            'model_id' => $client->id,
            'changes' => ['deleted' => $clientName],
            'created_by' => $request->user()->id,
            'action' => 'client_deleted',
            'description' => 'Client deleted: ' . $clientName,
        ]);

        $client->delete();

        return $this->success(null, 'Client deleted successfully');
    }

    public function activities(Request $request, Client $client)
    {
        $activities = $client->activities()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return $this->success($activities);
    }

    public function documents(Request $request, Client $client)
    {
        $documents = $client->documents()->with('file')->get();
        return $this->success($documents);
    }

    public function sessions(Request $request, Client $client)
    {
        $sessions = $client->sessions()
            ->orderBy('last_activity', 'desc')
            ->paginate(20);

        return $this->success($sessions);
    }

    private function logActivity(Client $client, string $type, string $description, int $userId): void
    {
        ClientActivity::create([
            'client_id' => $client->id,
            'type' => $type,
            'description' => $description,
            'created_by' => $userId,
        ]);
    }
}