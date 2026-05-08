<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    public function index()
    {
        $chats = Chat::with(['users:id,name', 'messages' => function($q) {
            $q->latest()->limit(1);
        }])->get();

        return view('communication.index', compact('chats'));
    }

    public function chat($chatId)
    {
        $chat = Chat::with(['users', 'messages' => function($q) {
            $q->latest()->limit(50);
        }])->findOrFail($chatId);

        return view('communication.chat-details', compact('chat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:private,group',
            'name' => 'nullable|string|max:255',
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
        ]);

        $chat = Chat::create([
            'type' => $request->type,
            'name' => $request->name,
            'created_by' => auth()->id(),
        ]);

        $userIds = array_merge($request->user_ids, [auth()->id()]);
        $chat->users()->sync($userIds);

        return redirect()->route('communication.chat', $chat->id)->with('success', 'Chat created successfully');
    }
}