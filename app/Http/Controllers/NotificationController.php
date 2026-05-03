<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        $userNotifications = UserNotification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $notifications = $userNotifications->groupBy(function ($n) {
            return $n->created_at ? $n->created_at->format('Y-m-d') : now()->format('Y-m-d');
        });

        $unreadCount = UserNotification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();

        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    public function details($notification_id)
    {
        $user = auth()->user();
        
        $userNotification = UserNotification::where('user_id', $user->id)
            ->where('notification_id', $notification_id)
            ->first();
        
        if (!$userNotification) {
            abort(404);
        }

        $notification = Notification::find($notification_id);
        
        if (!$notification) {
            abort(404);
        }

        if (!$userNotification->read_at) {
            $userNotification->update([
                'read_at' => now(),
            ]);
        }

        $unread = is_null($userNotification->refresh()->read_at);

        return view('notifications.details', compact('notification', 'unread'));
    }

    public function markAsRead($notification_id)
    {
        $user = auth()->user();
        
        UserNotification::where('user_id', $user->id)
            ->where('notification_id', $notification_id)
            ->update([
                'read_at' => now(),
            ]);

        return back();
    }

    public function markAllAsRead()
    {
        $user = auth()->user();
        
        UserNotification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return back()->with('success', 'All notifications marked as read');
    }
}