<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Client;
use App\Models\ClientActivity;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Cache;

class ClientService
{
    public function getClients(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return Client::with(['uploader', 'projects', 'invoices'])
            ->where('created_by', $userId)
            ->latest()
            ->get();
    }

    public function getClient(int $clientId): ?Client
    {
        return Client::with(['uploader', 'projects', 'invoices.payments'])
            ->find($clientId);
    }

    public function createClient(array $data, int $userId): Client
    {
        $client = Client::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'company' => $data['company'] ?? null,
            'address' => $data['address'] ?? null,
            'status' => $data['status'] ?? 'active',
            'created_by' => $userId,
        ]);

        $this->logActivity($client->id, $userId, 'created', 'Client created');

        return $client;
    }

    public function updateClient(Client $client, array $data): Client
    {
        $client->update(array_filter($data));
        $this->logActivity($client->id, $client->created_by, 'updated', 'Client updated');
        return $client;
    }

    public function deleteClient(Client $client): void
    {
        $this->logActivity($client->id, $client->created_by, 'deleted', 'Client deleted');
        $client->delete();
    }

    public function getClientStats(int $clientId): array
    {
        $cacheKey = "client_stats_{$clientId}";
        
        return Cache::remember($cacheKey, 300, function () use ($clientId) {
            $client = Client::find($clientId);
            if (!$client) {
                return [];
            }

            $projects = Project::where('client_id', $clientId)->count();
            $activeProjects = Project::where('client_id', $clientId)->where('status', 'active')->count();
            $tasks = Task::whereHas('project', function ($query) use ($clientId) {
                $query->where('client_id', $clientId);
            })->count();

            $totalRevenue = $client->invoices()
                ->where('status', 'paid')
                ->sum('total_amount') ?? 0;

            return [
                'projects' => $projects,
                'active_projects' => $activeProjects,
                'tasks' => $tasks,
                'total_revenue' => $totalRevenue,
            ];
        });
    }

    public function generateInviteCode(int $clientId): string
    {
        $code = strtoupper(substr(md5(uniqid()), 0, 8));
        
        \DB::table('client_invites')->insert([
            'client_id' => $clientId,
            'code' => $code,
            'created_at' => now(),
            'expires_at' => now()->addDays(7),
        ]);

        return $code;
    }

    private function logActivity(int $clientId, int $userId, string $action, string $description): void
    {
        ClientActivity::create([
            'client_id' => $clientId,
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
        ]);
    }
}