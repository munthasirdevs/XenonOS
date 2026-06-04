@extends('layouts.app')

@section('content')
<main class="flex-1 min-h-screen flex flex-col bg-surface">
    <div class="pt-24 px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 h-full">
                <aside class="lg:col-span-3 space-y-6">
                    <section class="bg-surface-container rounded-2xl p-5 shadow-sm">
                        <h3 class="font-label font-bold text-sm mb-4 tracking-wider text-indigo-300">PARTICIPANTS</h3>
                        <div class="space-y-4">
                            @forelse($chat->users as $user)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <img class="w-9 h-9 rounded-full object-cover grayscale group-hover:grayscale-0 transition-all" src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=1e1b4b&color=fff&size=36' }}" />
                                    <div>
                                        <p class="text-sm font-semibold">{{ $user->name }}</p>
                                        <p class="text-[10px] text-indigo-400 font-label">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-xs text-on-surface-variant">No participants</p>
                            @endforelse
                        </div>
                    </section>
                    <section class="bg-surface-container rounded-2xl p-5 relative overflow-hidden shadow-sm">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-600/5 blur-2xl -mr-12 -mt-12"></div>
                        <h3 class="font-label font-bold text-sm mb-4 tracking-wider text-indigo-300">CHAT INFO</h3>
                        <div class="space-y-4">
                            <div class="p-3 rounded-xl bg-surface-container-low">
                                <p class="text-xs font-label text-indigo-300 mb-1">Name</p>
                                <p class="text-sm font-medium">{{ $chat->name ?? 'Unnamed Chat' }}</p>
                            </div>
                            <div class="p-3 rounded-xl bg-surface-container-low">
                                <p class="text-xs font-label text-on-surface-variant mb-1">Type</p>
                                <p class="text-sm font-medium capitalize">{{ $chat->type ?? 'N/A' }}</p>
                            </div>
                            <div class="p-3 rounded-xl bg-surface-container-low">
                                <p class="text-xs font-label text-on-surface-variant mb-1">Created</p>
                                <p class="text-sm font-medium">{{ $chat->created_at ? $chat->created_at->format('M d, Y') : 'N/A' }}</p>
                            </div>
                        </div>
                    </section>
                </aside>
            <div class="lg:col-span-6 space-y-6">
                <nav class="flex items-center justify-between bg-surface-container/60 backdrop-blur-md p-2 rounded-2xl">
                    <div class="flex items-center gap-1">
                        <button class="p-3 hover:bg-surface-container-low rounded-xl text-on-surface-variant hover:text-indigo-400 transition-all flex items-center gap-2 text-sm font-label">
                            <span class="material-symbols-outlined">delete</span> Delete
                        </button>
                        <button class="p-3 hover:bg-surface-container-low rounded-xl text-on-surface-variant hover:text-indigo-400 transition-all flex items-center gap-2 text-sm font-label">
                            <span class="material-symbols-outlined">visibility_off</span> Hide
                        </button>
                    </div>
                    <div class="flex items-center gap-1">
                        <button class="p-3 hover:bg-surface-container-low rounded-xl text-on-surface-variant hover:text-red-400 transition-all flex items-center gap-2 text-sm font-label">
                            <span class="material-symbols-outlined">flag</span> Flag
                        </button>
                        <button class="p-3 hover:bg-surface-container-low rounded-xl text-on-surface-variant hover:text-green-400 transition-all flex items-center gap-2 text-sm font-label">
                            <span class="material-symbols-outlined">restore_from_trash</span> Restore
                        </button>
                    </div>
                </nav>
                <section class="bg-surface-container rounded-2xl p-6 min-h-[500px] flex flex-col shadow-sm">
                    <div class="flex-1 space-y-8">
                        @forelse($chat->messages as $message)
                        <div class="flex gap-4 {{ $message->user_id === auth()->id() ? 'flex-row-reverse' : '' }}">
                            <img class="w-10 h-10 rounded-xl object-cover shrink-0" src="{{ $message->sender?->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($message->sender?->name ?? 'User') . '&background=1e1b4b&color=fff&size=40' }}" />
                            <div class="flex-1">
                                <div class="flex items-center {{ $message->sender_id === auth()->id() ? 'flex-row-reverse' : '' }} justify-between mb-1">
                                    <span class="text-sm font-bold {{ $message->sender_id === auth()->id() ? 'text-on-surface' : 'text-indigo-300' }}">{{ $message->sender?->name ?? 'Unknown' }}</span>
                                    <span class="text-[10px] text-on-surface-variant/60 font-label">{{ $message->created_at ? $message->created_at->format('H:i:s') : '' }}</span>
                                </div>
                                <div class="{{ $message->sender_id === auth()->id() ? 'bg-primary/10 ml-auto border border-primary/20' : 'bg-surface-container-low' }} p-4 rounded-2xl {{ $message->sender_id === auth()->id() ? 'rounded-tr-none' : 'rounded-tl-none' }} max-w-[85%]">
                                    <p class="text-sm leading-relaxed">{{ $message->message ?? $message->body ?? 'No content' }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12 text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl block mb-2">chat</span>
                            <p class="font-medium">No messages yet</p>
                            <p class="text-xs mt-1">Start the conversation below</p>
                        </div>
                        @endforelse
                    </div>
                    <div class="mt-8 pt-4 border-t border-outline-variant/10">
                        <form method="POST" action="{{ route('communication.store') }}" class="flex items-center gap-4 bg-surface-container-low p-2 rounded-xl">
                            @csrf
                            <input type="hidden" name="chat_id" value="{{ $chat->id }}">
                            <input name="message" class="bg-transparent border-none focus:ring-0 w-full text-sm font-label" placeholder="Send a message..." type="text" />
                            <button type="submit" class="bg-indigo-600 p-2 px-4 rounded-lg hover:bg-indigo-500 transition-colors">
                                <span class="material-symbols-outlined text-white">send</span>
                            </button>
                        </form>
                    </div>
                </section>
            </div>
            <aside class="lg:col-span-3 space-y-6">
                <section class="bg-surface-container rounded-2xl p-5 shadow-sm">
                    <h3 class="font-label font-bold text-sm mb-4 tracking-wider text-indigo-300">QUICK STATS</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-lg font-bold">{{ $chat->messages_count ?? $chat->messages->count() }}</p>
                            <p class="text-[9px] text-on-surface-variant font-label uppercase">Messages</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold">{{ $chat->users_count ?? $chat->users->count() }}</p>
                            <p class="text-[9px] text-on-surface-variant font-label uppercase">Participants</p>
                        </div>
                    </div>
                </section>
                <section class="bg-surface-container rounded-2xl p-5 shadow-sm">
                    <h3 class="font-label font-bold text-sm mb-4 tracking-wider text-indigo-300">ACTIVITY LOG</h3>
                    <div class="space-y-5">
                        <div class="flex gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 mt-1.5 shrink-0"></div>
                            <div>
                                <p class="text-xs font-medium">Chat created</p>
                                <p class="text-[10px] text-on-surface-variant font-label">{{ $chat->created_at ? $chat->created_at->diffForHumans() : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </div>
</main>
@endsection
