<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunicationController extends Controller
{
    public function index()
    {
        $chats = Chat::with(['users:id,name', 'messages' => function($q) {
            $q->latest()->limit(1);
        }, 'project:id,name'])->get();

        return view('communication.index', compact('chats'));
    }

    public function chat($chatId)
    {
        $chat = Chat::with(['users', 'messages.sender:id,name,avatar_url'])
            ->withCount('messages', 'users')
            ->findOrFail($chatId);

        return view('communication.chat-details', compact('chat'));
    }

    public function store(Request $request)
    {
        if ($request->has('chat_id')) {
            $request->validate([
                'chat_id' => 'required|exists:chats,id',
                'message' => 'required|string',
            ]);

            $chat = Chat::findOrFail($request->chat_id);

            Message::create([
                'chat_id' => $chat->id,
                'sender_id' => auth()->id(),
                'message' => $request->message,
            ]);

            return redirect()->route('communication.chat', $chat->id)->with('success', 'Message sent');
        }

        $request->validate([
            'type' => 'required|in:private,group',
            'name' => 'nullable|string|max:255',
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
        ]);

        $chat = DB::transaction(function () use ($request) {
            $chat = Chat::create([
                'type' => $request->type,
                'name' => $request->name,
                'created_by' => auth()->id(),
            ]);

            $userIds = array_merge($request->user_ids, [auth()->id()]);
            $chat->users()->sync($userIds);

            return $chat;
        });

        return redirect()->route('communication.chat', $chat->id)->with('success', 'Chat created successfully');
    }

    public function monitor()
    {
        $chats = Chat::with(['users', 'messages'])
            ->withCount('messages')
            ->orderBy('messages_count', 'desc')
            ->get();

        $stats = [
            'total' => Chat::count(),
            'private' => Chat::where('type', 'private')->count(),
            'group' => Chat::where('type', 'group')->count(),
        ];

        return view('communication.messaging-monitor', compact('chats', 'stats'));
    }

    public function control()
    {
        $chats = Chat::with(['users'])->get();

        return view('communication.message-control', compact('chats'));
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('communication.create-conversation', compact('users'));
    }
}