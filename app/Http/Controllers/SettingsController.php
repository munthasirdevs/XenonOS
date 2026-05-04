<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $sessions = Cache::remember("user_sessions_{$user->id}", 300, function() use ($user) {
            return \Illuminate\Support\Facades\DB::table('sessions')
                ->where('user_id', $user->id)
                ->orderBy('last_activity', 'desc')
                ->get();
        });
        
        $securityLogs = Cache::remember("security_logs_{$user->id}", 60, function() use ($user) {
            return \Illuminate\Support\Facades\DB::table('security_logs')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        });
        
        $userPreferences = (object)[
            'timezone' => $user->timezone ?? 'London',
            'date_format' => $user->date_format ?? 'dd-mm-yyyy',
            'email_notifications' => $user->email_notifications ?? true,
            'push_notifications' => $user->push_notifications ?? true,
            'marketing_emails' => $user->marketing_emails ?? true,
            'survey_invites' => $user->survey_invites ?? false,
        ];
        
        return view('settings', compact('user', 'sessions', 'securityLogs', 'userPreferences'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        
        if (!password_verify($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->update(['password' => $request->new_password]);
        
        return back()->with('success', 'Password updated successfully.');
    }

    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        
        $user->update([
            'timezone' => $request->timezone ?? 'London',
            'date_format' => $request->date_format ?? 'dd-mm-yyyy',
        ]);
        
        return back()->with('success', 'Preferences updated successfully.');
    }

    public function logoutSession(Request $request, $sessionId)
    {
        \Illuminate\Support\Facades\DB::table('sessions')->where('id', $sessionId)->delete();
        
        return back()->with('success', 'Session logged out.');
    }

    public function purgeCache(Request $request)
    {
        Cache::flush();
        
        return back()->with('success', 'Cache purged successfully.');
    }
}