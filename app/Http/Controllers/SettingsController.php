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

        $user->update(['password' => bcrypt($request->new_password)]);
        
        return back()->with('success', 'Password updated successfully.');
    }

    public function updatePreferences(Request $request)
    {
        $request->validate([
            'timezone' => 'nullable|string|max:50',
            'date_format' => 'nullable|in:dd-mm-yyyy,mm-dd-yyyy',
        ]);

        $user = Auth::user();
        
        $user->update($request->only([
            'timezone',
            'date_format',
            'email_notifications',
            'push_notifications',
            'marketing_emails',
            'survey_invites',
            'quiet_hours_start',
            'quiet_hours_end',
        ]));
        
        Cache::forget("user_sessions_{$user->id}");
        Cache::forget("security_logs_{$user->id}");
        
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

    public function exportData(Request $request)
    {
        $user = Auth::user();
        $format = $request->get('format', 'json');
        
        $data = [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at?->toIso8601String(),
                'last_login_at' => $user->last_login_at?->toIso8601String(),
            ],
            'preferences' => [
                'timezone' => $user->timezone,
                'date_format' => $user->date_format,
                'email_notifications' => $user->email_notifications,
                'push_notifications' => $user->push_notifications,
                'marketing_emails' => $user->marketing_emails,
                'survey_invites' => $user->survey_invites,
                'quiet_hours_start' => $user->quiet_hours_start,
                'quiet_hours_end' => $user->quiet_hours_end,
            ],
            'security' => [
                'two_factor_enabled' => !empty($user->two_factor_secret),
                'security_score' => $user->security_score ?? 98,
            ],
            'exported_at' => now()->toIso8601String(),
        ];
        
        $user->update(['last_export_at' => now()]);
        
        if ($format === 'json') {
            return response()->json($data)
                ->header('Content-Disposition', 'attachment; filename="xenon-user-export-' . $user->id . '.json"');
        }
        
        return back()->with('error', 'Export format not supported.');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'confirm' => 'required|string|in:DELETE_MY_ACCOUNT',
        ]);
        
        $user = Auth::user();
        
        $user->update([
            'deleted_at' => now(),
            'email' => 'deleted_' . $user->id . '_' . $user->email,
            'name' => 'Deleted User',
        ]);
        
        auth()->logout();
        
        return redirect()->route('login')->with('success', 'Your account has been deleted.');
    }

    public function toggle2FA(Request $request)
    {
        $user = Auth::user();
        $enable = $request->get('enable', false);
        
        if ($enable && !$user->two_factor_secret) {
            $secret = bin2hex(random_bytes(20));
            $user->update(['two_factor_secret' => $secret]);
            $message = '2FA has been enabled.';
        } elseif (!$enable && $user->two_factor_secret) {
            $user->update(['two_factor_secret' => null]);
            $message = '2FA has been disabled.';
        } else {
            $message = 'No changes made.';
        }
        
        return back()->with('success', $message);
    }

    public function toggleChatChannel(Request $request)
    {
        $user = Auth::user();
        $channel = $request->get('channel');
        
        $channels = json_decode($user->chat_channels ?? '[]', true);
        
        if (in_array($channel, $channels)) {
            $channels = array_diff($channels, [$channel]);
        } else {
            $channels[] = $channel;
        }
        
        $user->update(['chat_channels' => json_encode(array_values($channels))]);
        
        return response()->json(['success' => true, 'channels' => $channels]);
    }

    public function updateNotificationSetting(Request $request)
    {
        $user = Auth::user();
        $setting = $request->get('setting');
        $value = $request->get('value', false);
        
        $allowedSettings = [
            'project_in_app', 'project_email', 'project_push',
            'file_in_app', 'file_email', 'file_push',
            'billing_in_app', 'billing_email', 'billing_push',
            'mention_in_app', 'mention_email', 'mention_push',
        ];
        
        if (!in_array($setting, $allowedSettings)) {
            return response()->json(['error' => 'Invalid setting'], 422);
        }
        
        $matrix = json_decode($user->notification_matrix ?? '{}', true);
        $matrix[$setting] = (bool) $value;
        $user->update(['notification_matrix' => json_encode($matrix)]);
        
        return response()->json(['success' => true]);
    }

    public function updateQuietHours(Request $request)
    {
        $user = Auth::user();
        
        $user->update([
            'quiet_hours_start' => $request->quiet_hours_start ?? '22:00',
            'quiet_hours_end' => $request->quiet_hours_end ?? '08:00',
        ]);
        
        return back()->with('success', 'Quiet hours updated.');
    }

    public function updateAuthRule(Request $request)
    {
        $user = Auth::user();
        $rule = $request->get('rule');
        $enabled = $request->get('enabled', false);
        
        $rules = json_decode($user->auth_rules ?? '{"complex_passwords":true,"2fa_enforcement":false,"sensitive_reauth":false}', true);
        
        if (in_array($rule, ['complex_passwords', '2fa_enforcement', 'sensitive_reauth'])) {
            $rules[$rule] = (bool) $enabled;
            $user->update(['auth_rules' => json_encode($rules)]);
        }
        
        return response()->json(['success' => true]);
    }
}