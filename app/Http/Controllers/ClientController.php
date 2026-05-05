<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientActivity;
use App\Models\ClientDocument;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'status' => 'nullable|in:active,inactive,blocked',
        ]);

        $client = Client::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'status' => $validated['status'] ?? 'active',
            'total_revenue' => 0,
        ]);

        if ($client) {
            ClientActivity::create([
                'client_id' => $client->id,
                'user_id' => auth()->id(),
                'type' => 'created',
                'description' => 'Client created',
            ]);
        }

        Cache::forget('client_stats');
        Cache::forget('recent_activities');

        return back()->with('success', 'Client created successfully.');
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

    private function generateRandomCode($length = 6)
    {
        $chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $code;
    }

    public function generateInvite(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'expires_hours' => 'nullable|integer|in:8,12,24,48',
        ]);

        $expiresHours = (int) ($validated['expires_hours'] ?? 24);
        $clientId = $validated['client_id'] ?? null;
        
        $code = $this->generateRandomCode(6);
        
        $invite = DB::table('client_invites')->insertGetId([
            'code' => $code,
            'email' => 'pending@invite',
            'client_id' => $clientId,
            'invited_by' => auth()->id(),
            'expires_at' => now()->addHours($expiresHours),
            'expires_hours' => $expiresHours,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $inviteLink = route('signup.show', $code);
        
        return response()->json([
            'success' => true,
            'code' => $code,
            'link' => $inviteLink,
            'expires_at' => now()->addHours($expiresHours)->format('M d, Y H:i'),
        ]);
    }

    public function showSignup($code)
    {
        $invite = DB::table('client_invites')
            ->where('code', $code)
            ->whereNull('deleted_at')
            ->first();

        if (!$invite) {
            return view('auth.signup', [
                'error' => 'This invite link is invalid.',
                'code' => $code,
                'invalid' => true,
            ]);
        }

        if ($invite->used_at) {
            return view('auth.signup', [
                'error' => 'This invite link has already been used.',
                'code' => $code,
                'already_used' => true,
                'contact' => 'Contact Xenon HelpLine for a new invite.',
            ]);
        }

        if (now()->gt($invite->expires_at)) {
            return view('auth.signup', [
                'error' => 'This invite link has expired.',
                'code' => $code,
                'expired' => true,
                'contact' => 'Contact Xenon HelpLine for a new invite.',
            ]);
        }

        return view('auth.signup', [
            'code' => $code,
            'email' => $invite->email,
            'client_id' => $invite->client_id,
            'expires_at' => $invite->expires_at,
        ]);
    }

    public function processSignup(Request $request, $code)
    {
        $invite = DB::table('client_invites')
            ->where('code', $code)
            ->whereNull('deleted_at')
            ->first();

        if (!$invite) {
            return back()->with('error', 'This invite link is invalid.');
        }

        if ($invite->used_at) {
            return back()->with('error', 'This invite link has already been used. Contact Xenon HelpLine for a new invite.');
        }

        if (now()->gt($invite->expires_at)) {
            return back()->with('error', 'This invite link has expired. Contact Xenon HelpLine for a new invite.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|confirmed',
            'company' => 'nullable|string|max:255',
        ]);

        $fullName = $validated['first_name'] . ' ' . $validated['last_name'];

        $client = Client::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'company' => $validated['company'] ?? null,
            'status' => 'active',
            'password' => $validated['password'],
            'total_revenue' => 0,
        ]);

        DB::table('client_invites')
            ->where('code', $code)
            ->update([
                'used_at' => now(),
                'updated_at' => now(),
            ]);

        if ($invite->client_id) {
            ClientActivity::create([
                'client_id' => $invite->client_id,
                'user_id' => $client->id,
                'type' => 'signup',
                'description' => 'Team member joined: ' . $fullName,
            ]);
        }

        // Auto-login the new client
        Auth::login($client);

        return redirect()->route('client.dashboard')->with('success', 'Welcome! Your account has been created.');
    }

    public function clientDashboard()
    {
        $client = auth()->user();
        
        $stats = [
            'total_projects' => 0,
            'completion_rate' => 68,
            'active_projects' => 0,
            'new_this_month' => 0,
            'due_today' => 0,
        ];
        
        $projects = collect([]);
        $serviceOrders = collect([]);
        $notifications = collect([]);
        $recentActivities = collect([]);
        $recentFiles = collect([]);
        $pendingInvoice = 4250.00;
        
        return view('clients.dashboard', compact('client', 'stats', 'projects', 'serviceOrders', 'notifications', 'recentActivities', 'recentFiles', 'pendingInvoice'));
    }
}