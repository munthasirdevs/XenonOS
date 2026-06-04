@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/communication-index.css') }}">
@endpush

@section('content')
<main class="flex-1 min-h-screen flex flex-col">
    <div class="pt-24 px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="text-primary font-bold tracking-widest text-[10px] uppercase">Communication</span>
                <h1 class="text-5xl font-light tracking-tight text-on-surface mt-2">Chat Control</h1>
                <p class="text-on-surface-variant mt-2 max-w-md">Orchestrate communication flows across all workspaces.</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="exportLogs()" class="flex items-center space-x-2 bg-surface-container-high hover:bg-surface-bright text-on-surface px-5 py-2.5 rounded-xl transition-all font-medium text-sm">
                    <span class="material-symbols-outlined text-lg">download</span>
                    <span>Export Logs</span>
                </button>
                <button onclick="openNewChatModal()" class="flex items-center space-x-2 bg-primary text-on-primary-container px-6 py-2.5 rounded-xl hover:opacity-90 transition-all font-semibold text-sm shadow-[0_8px_20px_rgba(192,193,255,0.2)]">
                    <span class="material-symbols-outlined text-lg">add_comment</span>
                    <span>New Chat</span>
                </button>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <div class="col-span-1 md:col-span-4 bg-surface-container-low rounded-2xl p-6 glass-glow relative overflow-hidden group">
                <div class="absolute left-0 top-1/4 bottom-1/4 w-[2px] bg-primary"></div>
                <p class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Total Chats</p>
                <h3 class="text-3xl font-light text-on-surface mt-2">{{ $chats->count() }}</h3>
                <div class="mt-4 flex items-center text-primary text-xs font-medium">
                    <span class="material-symbols-outlined text-sm mr-1">trending_up</span>
                    Active conversations
                </div>
            </div>
            <div class="col-span-1 md:col-span-4 bg-surface-container-low rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute left-0 top-1/4 bottom-1/4 w-[2px] bg-tertiary"></div>
                <p class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Private Chats</p>
                <h3 class="text-3xl font-light text-on-surface mt-2">{{ $chats->where('type', 'private')->count() }}</h3>
                <div class="mt-4 flex items-center text-tertiary text-xs font-medium">
                    <span class="material-symbols-outlined text-sm mr-1">lock</span> Direct messages
                </div>
            </div>
            <div class="col-span-1 md:col-span-4 bg-surface-container-low rounded-2xl p-6 flex flex-col justify-between">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Group Chats</p>
                    <span class="text-[10px] text-primary bg-primary/10 px-2 py-0.5 rounded-full">{{ $chats->where('type', 'group')->count() }}</span>
                </div>
                <div class="flex -space-x-1 h-8">
                    <div class="flex-1 bg-surface-container-highest rounded-sm h-[30%]"></div>
                    <div class="flex-1 bg-surface-container-highest rounded-sm h-[50%]"></div>
                    <div class="flex-1 bg-surface-container-highest rounded-sm h-[80%]"></div>
                    <div class="flex-1 bg-primary rounded-sm h-[100%]"></div>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 space-y-8">
                <div class="bg-surface-container-low rounded-[24px] overflow-hidden">
                    <div class="px-8 py-6 flex justify-between items-center border-b border-outline-variant/5">
                        <h2 class="text-xl font-semibold text-on-surface">Active Conversations</h2>
                        <a class="text-xs font-bold text-primary flex items-center group" href="#">
                            <span class="w-1 h-1 bg-primary rounded-full mr-2 group-hover:w-3 transition-all"></span>
                            VIEW ALL
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table id="chats-table" class="w-full text-left">
                            <thead>
                                <tr class="text-on-surface-variant text-[10px] uppercase tracking-widest border-b border-outline-variant/5">
                                    <th class="px-8 py-4 font-bold">Participants</th>
                                    <th class="px-4 py-4 font-bold">Project</th>
                                    <th class="px-4 py-4 font-bold">Status</th>
                                    <th class="px-8 py-4 font-bold text-right">Last Message</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/5">
                                @forelse($chats as $chat)
                                <tr class="group hover:bg-surface-bright/30 transition-colors cursor-pointer" onclick="window.location.href='/communication/{{ $chat->id }}'">
                                    <td class="px-8 py-5">
                                        <div class="flex -space-x-2">
                                            @forelse($chat->users->take(3) as $user)
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low" alt="{{ $user->name }}" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=c0c1ff&color=1a1a2e&size=32" />
                                            @empty
                                            <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-xs">No users</div>
                                            @endforelse
                                            @if($chat->users->count() > 3)
                                            <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface-container-low flex items-center justify-center text-[10px] font-bold">+{{ $chat->users->count() - 3 }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-5 text-sm font-medium">{{ $chat->project->name ?? 'No Project' }}</td>
                                    <td class="px-4 py-5">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary uppercase">{{ $chat->type }}</span>
                                    </td>
                                    <td class="px-8 py-5 text-right text-xs text-on-surface-variant italic">
                                        "{{ $chat->messages->first()?->message ? Str::limit($chat->messages->first()->message, 30) : 'No messages' }}"
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-8 text-center text-on-surface-variant">No chats found. Start a new conversation.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-surface-container-low rounded-[24px] p-8">
                    <h2 class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase mb-6">Recent Activity</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full overflow-hidden bg-surface-container-highest">
                                    <img src="https://ui-avatars.com/api/?name=System&background=c0c1ff&color=1a1a2e&size=32" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold">System ready</p>
                                    <p class="text-[10px] text-on-surface-variant">Chat system loaded</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                <div class="bg-surface-container-low rounded-[24px] p-8 space-y-6">
                    <h2 class="text-xl font-semibold text-on-surface">Chat Rules</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-surface-container rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary">groups</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Moderation</p>
                                    <p class="text-[10px] text-on-surface-variant uppercase">Auto-approve</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input checked class="sr-only peer" type="checkbox" />
                                <div class="w-9 h-5 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                    </div>
                    <button class="p-3 border border-outline-variant/20 rounded-xl text-xs font-bold tracking-widest text-on-surface-variant hover:bg-surface-bright transition-all w-full">
                        MANAGE RULES
                    </button>
                </div>

                <div class="bg-surface-container-low rounded-[24px] p-8">
                    <h2 class="text-xl font-semibold text-on-surface mb-4">Quick Actions</h2>
                    <div class="space-y-2">
                        <button onclick="openNewChatModal()" class="w-full p-4 bg-surface-container rounded-xl text-left hover:bg-surface-bright transition-colors">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">add_comment</span>
                                <span class="text-sm font-medium">Create New Chat</span>
                            </div>
                        </button>
                        <button class="w-full p-4 bg-surface-container rounded-xl text-left hover:bg-surface-bright transition-colors">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-tertiary">group_add</span>
                                <span class="text-sm font-medium">Start Group Chat</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="h-20"></div>
</main>

<!-- New Chat Modal -->
<div id="new-chat-modal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center">
    <div class="bg-surface-container-low rounded-2xl p-8 w-full max-w-md">
        <h3 class="text-xl font-headline font-semibold mb-6">Start New Chat</h3>
        <form onsubmit="createChat(event)">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Chat Type</label>
                <select id="chat-type-input" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50" onchange="toggleChatName()">
                    <option value="private">Private (Direct Message)</option>
                    <option value="group">Group Chat</option>
                </select>
            </div>
            <div class="mb-4" id="chat-name-group" style="display:none;">
                <label class="block text-sm font-medium mb-2">Group Name</label>
                <input type="text" id="chat-name-input" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50" />
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Select Users</label>
                <select id="chat-users-input" multiple class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50 h-32">
                    @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-on-surface-variant mt-1">Hold Ctrl/Cmd to select multiple users</p>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeNewChatModal()" class="flex-1 py-3 bg-surface-container rounded-xl font-bold">Cancel</button>
                <button type="submit" class="flex-1 py-3 bg-primary text-on-primary-container rounded-xl font-bold">Create Chat</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    window.chatRouteTemplate = '/communication/__ID__';
</script>
<script src="{{ asset('js/communication-index.js') }}"></script>
<script>
function openNewChatModal() {
    document.getElementById('new-chat-modal').classList.remove('hidden');
}

function closeNewChatModal() {
    document.getElementById('new-chat-modal').classList.add('hidden');
    document.getElementById('chat-type-input').value = 'private';
    document.getElementById('chat-name-input').value = '';
    toggleChatName();
}

function toggleChatName() {
    const type = document.getElementById('chat-type-input').value;
    document.getElementById('chat-name-group').style.display = type === 'group' ? 'block' : 'none';
}

async function createChat(event) {
    event.preventDefault();
    const type = document.getElementById('chat-type-input').value;
    const name = document.getElementById('chat-name-input').value;
    const usersSelect = document.getElementById('chat-users-input');
    const user_ids = Array.from(usersSelect.selectedOptions).map(opt => parseInt(opt.value));
    
    try {
        await API.chats.create({ type, name, user_ids });
        closeNewChatModal();
        window.location.reload();
    } catch (error) {
        alert('Failed to create chat: ' + error.message);
    }
}

function exportLogs() {
    alert('Export functionality coming soon');
}
</script>
@endpush
@endsection