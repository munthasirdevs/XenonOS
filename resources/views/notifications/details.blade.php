@extends('layouts.app')

@section('title', $notification->title . ' - XenonOS')

@section('content')
<div class="max-w-3xl">
    @php
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
    
    <a href="{{ route('notifications') }}" class="inline-flex items-center gap-2 text-on-surface-variant hover:text-primary mb-6 transition-colors">
        <span class="material-symbols-outlined">arrow_back</span>
        <span class="text-sm font-medium">Back to notifications</span>
    </a>

    <div class="bg-surface-container rounded-3xl p-8 border border-white/5">
        <div class="flex items-start gap-6 mb-6">
            <div class="w-16 h-16 rounded-2xl {{ $iconBg }} flex items-center justify-center">
                <span class="material-symbols-outlined text-3xl">{{ $icon }}</span>
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-headline font-bold text-white mb-2">{{ $notification->title }}</h1>
                <p class="text-sm text-on-surface-variant">{{ $notification->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
        </div>

        <div class="border-t border-white/5 pt-6">
            <p class="text-on-surface-variant text-lg leading-relaxed">{{ $notification->message }}</p>
        </div>

        @if(isset($unread) && $unread)
        <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
            @csrf
            <button type="submit" class="mt-8 px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-xl text-sm font-medium transition-colors">
                Mark as Read
            </button>
        </form>
        @endif
    </div>
</div>
@endsection