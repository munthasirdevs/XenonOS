<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $notifications = $request->user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return $this->success($notifications);
    }

    public function unread(Request $request)
    {
        $notifications = $request->user()
            ->notifications()
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->success($notifications);
    }

    public function unreadCount(Request $request)
    {
        $count = $request->user()
            ->notifications()
            ->whereNull('read_at')
            ->count();

        return $this->success(['count' => $count]);
    }

    public function markRead(Request $request, UserNotification $notification)
    {
        if ($notification->user_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $notification->markAsRead($request->user()->id);
        return $this->success(null, 'Notification marked as read');
    }

    public function markAllRead(Request $request)
    {
        $request->user()
            ->notifications()
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
                'read_by' => $request->user()->id,
            ]);

        return $this->success(null, 'All notifications marked as read');
    }

    public function destroy(UserNotification $notification, Request $request)
    {
        if ($notification->user_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $notification->delete();
        return $this->success(null, 'Notification deleted');
    }

    public function clear(Request $request)
    {
        $request->user()
            ->notifications()
            ->whereNotNull('read_at')
            ->delete();

        return $this->success(null, 'Read notifications cleared');
    }

    public function send(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'data' => 'nullable|array',
        ]);

        $notification = UserNotification::create($request->all());
        
        if ($request->has('send_email') && $request->send_email) {
            $user = \App\Models\User::find($request->user_id);
            $user->notify(new \App\Notifications\GeneralNotification($notification));
        }

        return $this->success($notification, 'Notification sent', 201);
    }
}