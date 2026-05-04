<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientActivity;
use App\Models\ClientDocument;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::select(['id', 'name', 'email', 'company', 'status', 'total_revenue', 'avatar_url', 'created_at'])
            ->withCount('projects')
            ->orderBy('created_at', 'desc')
            ->when($request->search, fn($q) => $q->where(fn($q) => $q->where('name', 'like', "%{$request->search}%")->orWhere('email', 'like', "%{$request->search}%")->orWhere('company', 'like', "%{$request->search}%")))
            ->when($request->status && $request->status !== 'all', fn($q) => $q->where('status', $request->status))
            ->paginate(10)
            ->appends($request->query());

        $stats = Cache::remember('client_stats', 60, fn() => [
            'totalClients' => Client::count(),
            'activeClients' => Client::where('status', 'active')->count(),
            'newThisMonth' => Client::whereMonth('created_at', now()->month)->count(),
        ]);

        $recentActivities = Cache::remember('recent_activities', 30, fn() => 
            ClientActivity::select('id', 'client_id', 'description', 'type', 'created_at')
                ->with('client:id,name')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
        );

        return view('clients.index', compact('clients', 'recentActivities') + $stats);
    }

    public function show($id)
    {
        $client = Client::withCount(['projects' => fn($q) => $q->where('status', 'active'), 'projects' => fn($q) => $q->where('status', 'completed')])
            ->findOrFail($id);

        $stats = [
            'total_projects' => $client->projects_count,
            'active_projects' => $client->projects_active_count ?? 0,
            'completed_projects' => $client->projects_completed_count ?? 0,
        ];

        $recentProjects = Cache::remember("client_{$id}_projects", 60, fn() => 
            Project::select('id', 'name', 'status', 'priority', 'description')
                ->where('client_id', $id)
                ->latest()
                ->limit(3)
                ->get()
        );

        return view('clients.show', compact('client', 'stats', 'recentProjects'));
    }

    public function projects($id)
    {
        $client = Client::findOrFail($id);
        $projects = Project::where('client_id', $id)->latest()->get();

        return view('clients.projects', compact('client', 'projects'));
    }

    public function activity(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $activities = ClientActivity::with('user:id,name')
            ->where('client_id', $id)
            ->when($request->type && $request->type !== 'all', fn($q) => $q->where('type', $request->type))
            ->latest()
            ->paginate(15)
            ->appends($request->query());

        return view('clients.activity', compact('client', 'activities'));
    }

    public function documents($id)
    {
        $client = Client::findOrFail($id);
        $documents = ClientDocument::where('client_id', $id)->latest()->get();

        return view('clients.documents', compact('client', 'documents'));
    }
}