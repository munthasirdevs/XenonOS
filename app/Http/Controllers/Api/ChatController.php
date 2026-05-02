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
}