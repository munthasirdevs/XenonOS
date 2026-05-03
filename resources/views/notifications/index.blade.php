@extends('layouts.app')

@section('title', 'Notification Center - XenonOS')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <section class="flex flex-col md:flex-row justify-between items-end gap-6">
        <div class="space-y-2">
            <h2 class="text-5xl font-light font-headline tracking-tight text-white">Notification Center</h2>
            <div class="flex items-center space-x-2 text-on-surface-variant">
                <div class="w-1 h-1 rounded-full bg-primary"></div>
                <p class="text-sm font-body">You have {{ $unreadCount ?? 0 }} unread updates.</p>
            </div>
        </div>
        @if(($unreadCount ?? 0) > 0)
        <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
            @csrf
            <button type="submit"
                class="px-5 py-2.5 bg-surface-container hover:bg-surface-bright text-primary text-sm font-semibold rounded-2xl transition-all flex items-center space-x-2">
                <span class="material-symbols-outlined text-lg">done_all</span>
                <span>Mark all as read</span>
            </button>
        </form>
        @endif
    </section>

    <!-- Notifications List -->
    <div class="space-y-4">
        @forelse($notifications as $date => $dateNotifications)
            @php
                $formattedDate = \Carbon\Carbon::parse($date)->format('F d, Y');
                if ($date === now()->format('Y-m-d')) $formattedDate = 'Today';
                elseif ($date === now()->subDay()->format('Y-m-d')) $formattedDate = 'Yesterday';
            @endphp
            <div class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mt-6 mb-2">{{ $formattedDate }}</div>
            
            @foreach($dateNotifications as $userNote)
            @php
                $notification = $userNote->notification;
                $isUnread = is_null($userNote->read_at);
                $type = $notification->type ?? 'system';
                $icon = match($type) {
                    'security' => 'priority_high',
                    'task' => 'assignment',
                    'chat', 'message' => 'forum',
                    'project' => 'folder',
                    default => 'notifications'
                };
                $iconBg = match($type) {
                    'security' => 'bg-rose-500/10 text-rose-400',
                    'task' => 'bg-primary/10 text-primary',
                    'chat', 'message' => 'bg-tertiary/10 text-tertiary',
                    'project' => 'bg-emerald-500/10 text-emerald-400',
                    default => 'bg-blue-500/10 text-blue-400'
                };
            @endphp
            <a href="{{ route('notifications.details', $userNote->notification_id) }}"
                class="group relative bg-surface-container hover:bg-surface-container-high rounded-2xl p-5 flex items-start space-x-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 {{ $isUnread ? '' : 'opacity-60' }}">
                @if($isUnread)
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary rounded-l-2xl"></div>
                @endif
                <div class="flex-shrink-0 w-12 h-12 rounded-2xl {{ $iconBg }} flex items-center justify-center">
                    <span class="material-symbols-outlined">{{ $icon }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="text-lg font-semibold text-white truncate {{ $isUnread ? '' : 'text-slate-400' }}">{{ $notification->title }}</h3>
                        <span class="text-xs text-on-surface-variant font-medium">{{ $userNote->created_at ? $userNote->created_at->diffForHumans() : 'Recently' }}</span>
                    </div>
                    <p class="text-sm text-on-surface-variant mb-3 max-w-2xl leading-relaxed line-clamp-2">{{ $notification->message ?? 'No message' }}</p>
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full {{ $isUnread ? 'bg-primary animate-pulse' : 'bg-slate-600' }}"></span>
                        <span class="text-xs font-bold {{ $isUnread ? 'text-primary' : 'text-slate-500' }} uppercase tracking-widest">{{ $isUnread ? 'Unread' : 'Read' }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        @empty
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-6xl text-slate-600">notifications_off</span>
            <p class="text-slate-500 mt-4">No notifications yet</p>
        </div>
        @endforelse
    </div>
</div>
@endsection