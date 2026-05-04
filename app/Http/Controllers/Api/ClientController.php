<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\AuditLog;
use App\Models\Client;
use App\Models\ClientActivity;
use App\Models\ClientDocument;
use App\Models\ClientSession;
use App\Models\Invoice;
use App\Models\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{
    use ApiResponse;

    private function getCacheKey(Request $request)
    {
        return 'api_clients_' . md5($request->getQueryString());
    }

    public function index(Request $request)
    {
        $cacheKey = $this->getCacheKey($request);
        
        $clients = Cache::remember($cacheKey, 30, function() use ($request) {
            $query = Client::select(['id', 'name', 'email', 'phone', 'company', 'company_name', 'address', 'website', 'tier', 'status', 'total_revenue', 'location', 'avatar_url', 'notes', 'created_by', 'updated_by', 'created_at', 'updated_at'])
                ->with(['activities' => function($q) { $q->select('id', 'client_id', 'type', 'description', 'created_at')->latest()->limit(5); }])
                ->orderBy('created_at', 'desc');

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

            return $query->paginate(15);
        });

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

        Cache::forget('api_clients_*');
        Cache::forget('client_stats');

        return $this->success($client->load('activities'), 'Client created successfully', 201);
    }

    public function show(Request $request, Client $client)
    {
        $clientKey = "client_{$client->id}";
        
        $clientData = Cache::remember($clientKey, 60, function() use ($client) {
            return $client->load(['activities' => function($q) { $q->select('id', 'client_id', 'type', 'description', 'created_at')->latest()->limit(10); }]);
        });

        $stats = Cache::remember("client_{$client->id}_stats", 60, function() use ($client) {
            return [
                'projects_count' => Project::where('client_id', $client->id)->count(),
                'active_tasks' => Project::where('client_id', $client->id)->withCount('tasks')->get()->sum('tasks_count'),
                'pending_invoices' => Invoice::where('client_id', $client->id)->where('status', 'pending')->count(),
            ];
        });

        return $this->success(array_merge($clientData->toArray(), ['stats' => $stats]));
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

        Cache::forget("client_{$client->id}");
        Cache::forget("client_{$client->id}_stats");
        Cache::forget('api_clients_*');

        return $this->success($client->fresh()->load('activities'), 'Client updated successfully');
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

        Cache::forget("client_{$client->id}");
        Cache::forget("client_{$client->id}_stats");
        Cache::forget('api_clients_*');
        Cache::forget('client_stats');

        return $this->success(null, 'Client deleted successfully');
    }

    public function activities(Request $request, Client $client)
    {
        $page = $request->get('page', 1);
        $cacheKey = "client_{$client->id}_activities_{$page}";
        
        $activities = Cache::remember($cacheKey, 30, function() use ($client) {
            return ClientActivity::where('client_id', $client->id)
                ->select('id', 'client_id', 'type', 'description', 'metadata', 'user_id', 'created_at', 'updated_at')
                ->latest()
                ->paginate(20);
        });

        return $this->success($activities);
    }

    public function documents(Request $request, Client $client)
    {
        $cacheKey = "client_{$client->id}_documents";
        
        $documents = Cache::remember($cacheKey, 60, function() use ($client) {
            return ClientDocument::where('client_id', $client->id)
                ->select('id', 'client_id', 'file_id', 'title', 'description', 'uploaded_by', 'created_at')
                ->with('file:id,name,size,type')
                ->get();
        });

        return $this->success($documents);
    }

    public function sessions(Request $request, Client $client)
    {
        $page = $request->get('page', 1);
        $cacheKey = "client_{$client->id}_sessions_{$page}";
        
        $sessions = Cache::remember($cacheKey, 30, function() use ($client) {
            return ClientSession::where('client_id', $client->id)
                ->select('id', 'client_id', 'ip_address', 'device_info', 'last_activity')
                ->latest()
                ->paginate(20);
        });

        return $this->success($sessions);
    }

    private function logActivity(Client $client, string $type, string $description, int $userId)
    {
        ClientActivity::create([
            'client_id' => $client->id,
            'type' => $type,
            'description' => $description,
            'created_by' => $userId,
        ]);
    }
}