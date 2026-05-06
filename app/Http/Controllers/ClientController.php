<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientActivity;
use App\Models\ClientDocument;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        $inviteStats = Cache::remember('invite_stats', 60, fn() => [
            'created' => DB::table('client_invites')
                ->where('created_at', '>=', now()->subDays(30))
                ->count(),
            'signed_up' => DB::table('client_invites')
                ->whereNotNull('used_at')
                ->where('used_at', '>=', now()->subDays(30))
                ->count(),
            'expired' => DB::table('client_invites')
                ->whereNull('is_used')
                ->where('expires_at', '<', now())
                ->where('created_at', '>=', now()->subDays(30))
                ->count(),
        ]);

        return view('clients.index', compact('clients', 'recentActivities', 'inviteStats') + $stats);
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
            Project::select('id', 'name', 'status', 'priority', 'description', 'end_date')
                ->where('client_id', $id)
                ->latest()
                ->limit(10)
                ->get()
        );

        $activities = ClientActivity::where('client_id', $id)
            ->with('user:id,name')
            ->latest()
            ->limit(10)
            ->get();

        $documents = ClientDocument::where('client_id', $id)
            ->latest()
            ->limit(10)
            ->get();

        return view('clients.clientDetails', compact('client', 'stats', 'recentProjects', 'activities', 'documents'));
    }

    public function uploadDocument(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'title' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $path = $file->store('client-documents/' . $client->id, 'public');

        $document = ClientDocument::create([
            'client_id' => $client->id,
            'uploaded_by' => auth()->id(),
            'title' => $request->title ?? $filename,
            'file_id' => null, // Would link to File model if needed
        ]);

        // Log activity
        ClientActivity::create([
            'client_id' => $client->id,
            'user_id' => auth()->id(),
            'type' => 'document_uploaded',
            'description' => 'Uploaded document: ' . ($request->title ?? $filename),
        ]);

        Cache::forget("client_{$id}_documents");

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully',
            'document' => $document,
        ]);
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

        $activityStats = [
            'project_updates' => 45,
            'file_management' => 30,
            'communications' => 15,
            'tasks' => 10,
        ];

        return view('clients.activity', compact('client', 'activities', 'activityStats'));
    }

    public function allActivity(Request $request)
    {
        $activities = ClientActivity::with('client:id,name')
            ->when($request->type && $request->type !== 'all', fn($q) => $q->where('type', $request->type))
            ->latest()
            ->paginate(20)
            ->appends($request->query());

        return view('clients.activity', compact('activities'));
    }

    public function documents($id)
    {
        $client = Client::findOrFail($id);
        $documents = ClientDocument::where('client_id', $id)->latest()->get();

        return view('clients.documents', compact('client', 'documents'));
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients')->with('success', 'Client deleted successfully.');
    }

    private function generateCode($length = 8)
    {
        $chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789';
        $code = 'xenon';
        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $code;
    }

public function generateInvite(Request $request)
    {
        try {
            $userId = auth()->id();
            $cooldownSeconds = 60; // 1 minute cooldown

            // Check last invite time
            $lastInvite = DB::table('client_invites')
                ->where('invited_by', $userId)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastInvite) {
                $lastCreated = Carbon::parse($lastInvite->created_at);
                $secondsSinceLastInvite = $lastCreated->diffInSeconds(Carbon::now());
                
                if ($secondsSinceLastInvite < $cooldownSeconds) {
                    $remainingTime = $cooldownSeconds - $secondsSinceLastInvite;
                    return response()->json([
                        'success' => false,
                        'message' => 'Please wait ' . ceil($remainingTime) . ' seconds before generating another link.'
                    ], 429);
                }
            }

            $code = $this->generateCode(11);

            $inviteId = DB::table('client_invites')->insertGetId([
                'code' => $code,
                'email' => 'pending@invite',
                'client_id' => null,
                'invited_by' => $userId,
                'expires_at' => now()->addHours(24), // Default 24 hours expiry for the invite link
                'expires_hours' => 24,
                'is_used' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $inviteLink = route('signup.show', $code);

            return response()->json([
                'success' => true,
                'code' => $code,
                'link' => $inviteLink,
                'expires_at' => now()->addHours(24)->format('M d, Y H:i'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showSignup($code)
    {
        $invite = DB::table('client_invites')
            ->where('code', $code)
            ->whereNull('deleted_at')
            ->where('is_used', false)
            ->first();

        if (!$invite) {
            return view('auth.signup', [
                'error' => 'This invite link is invalid or has already been used.',
                'code' => $code,
                'invalid' => true,
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
            ->where('is_used', false)
            ->first();

        if (!$invite) {
            return back()->with('error', 'This invite link is invalid or has already been used.');
        }

        if (now()->gt($invite->expires_at)) {
            return back()->with('error', 'This invite link has expired. Contact Xenon HelpLine for a new invite.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'password' => 'required|min:8',
            'company' => 'nullable|string|max:255',
        ]);

        $fullName = $validated['first_name'] . ' ' . $validated['last_name'];

        // Create User for authentication
        $user = User::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'status' => 'active',
        ]);

        // Create Client record for CRM
        $client = Client::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'status' => 'active',
            'total_revenue' => 0,
            'created_by' => $invite->invited_by,
        ]);

        DB::table('client_invites')
            ->where('code', $code)
            ->update([
                'is_used' => true,
                'used_at' => now(),
                'updated_at' => now(),
            ]);

        if ($invite->client_id) {
            ClientActivity::create([
                'client_id' => $invite->client_id,
                'user_id' => $user->id,
                'type' => 'signup',
                'description' => 'Team member joined: ' . $fullName,
            ]);
        }

        Auth::login($user);

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
        
        return view('users.dashboard', compact('client', 'stats', 'projects', 'serviceOrders', 'notifications', 'recentActivities', 'recentFiles', 'pendingInvoice'));
    }
}