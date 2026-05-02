<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $chats = $request->user()->chats()
            ->with(['users:id,name,email', 'messages' => function($q) {
                $q->latest()->limit(1);
            }])
            ->get();

        return $this->success($chats);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:private,group,project',
            'name' => 'nullable|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $chat = Chat::create([
            'type' => $request->type,
            'name' => $request->name,
            'project_id' => $request->project_id,
            'created_by' => $request->user()->id,
        ]);

        $userIds = array_merge($request->user_ids, [$request->user()->id]);
        $chat->users()->sync($userIds);

        return $this->success($chat->load('users'), 'Chat created successfully', 201);
    }

    public function show(Chat $chat)
    {
        $chat->load(['users', 'messages' => function($q) {
            $q->latest()->limit(50);
        }]);
        return $this->success($chat);
    }

    public function destroy(Chat $chat)
    {
        $chat->delete();
        return $this->success(null, 'Chat deleted successfully');
    }

    public function messages(Request $request, Chat $chat)
    {
        $messages = $chat->messages()
            ->with('sender:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return $this->success($messages);
    }

    public function sendMessage(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = $chat->messages()->create([
            'sender_id' => $request->user()->id,
            'message' => $request->message,
            'type' => 'text',
        ]);

        return $this->success($message->load('sender:id,name'), 'Message sent successfully', 201);
    }

    public function deleteMessage(Request $request, Message $message)
    {
        if ($message->chat->created_by !== $request->user()->id && !$request->user()->hasRole('admin')) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $message->delete();
        return $this->success(null, 'Message deleted successfully');
    }

    public function flagMessage(Request $request, Message $message)
    {
        $message->update(['is_flagged' => true]);
        
        \App\Models\ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'message_flagged',
            'description' => 'Message flagged in chat ' . $message->chat_id,
        ]);

        return $this->success(null, 'Message flagged successfully');
    }

    public function muteUser(Request $request, User $user)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'duration' => 'nullable|integer|min:1',
        ]);

        $chat = Chat::findOrFail($request->chat_id);
        
        $chat->mutedUsers()->syncWithoutDetaching([
            $user->id => [
                'muted_by' => $request->user()->id,
                'muted_at' => now(),
                'expires_at' => now()->addDays($request->duration ?? 7),
            ]
        ]);

        return $this->success(null, 'User muted successfully');
    }

    public function unmuteUser(Request $request, User $user)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
        ]);

        $chat = Chat::findOrFail($request->chat_id);
        $chat->mutedUsers()->detach($user->id);

        return $this->success(null, 'User unmuted successfully');
    }

    public function mutedUsers(Request $request, Chat $chat)
    {
        $muted = $chat->mutedUsers()->get();
        return $this->success($muted);
    }
}