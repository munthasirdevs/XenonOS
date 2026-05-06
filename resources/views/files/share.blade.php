@extends('layouts.app')

@section('title', 'Shared File - XenonOS')

@section('content')
<div class="flex min-h-screen items-center justify-center p-6">
    <div class="w-full max-w-md">
        @if(session('requires_password'))
        <div class="bg-surface-container rounded-3xl p-8 shadow-2xl">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-primary text-3xl">lock</span>
                </div>
                <h2 class="text-2xl font-headline font-bold text-on-surface">Password Required</h2>
                <p class="text-on-surface-variant mt-2">Enter password to access this file</p>
            </div>
            <form method="GET" action="{{ route('files.share.view', $file->share_hash) }}">
                <input type="password" name="password" required class="w-full bg-surface-container-low text-on-surface rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary mb-4" placeholder="Enter password">
                <button type="submit" class="w-full bg-primary text-on-primary font-bold py-3 rounded-xl">Access File</button>
            </form>
        </div>
        @elseif($file->share_expires_at && now()->gt($file->share_expires_at))
        <div class="bg-surface-container rounded-3xl p-8 shadow-2xl text-center">
            <div class="w-16 h-16 bg-error/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-error text-3xl">schedule</span>
            </div>
            <h2 class="text-2xl font-headline font-bold text-on-surface">Link Expired</h2>
            <p class="text-on-surface-variant mt-2">This share link has expired.</p>
        </div>
        @elseif($file->share_views_limit && $file->share_views_used >= $file->share_views_limit)
        <div class="bg-surface-container rounded-3xl p-8 shadow-2xl text-center">
            <div class="w-16 h-16 bg-error/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-error text-3xl">visibility_off</span>
            </div>
            <h2 class="text-2xl font-headline font-bold text-on-surface">View Limit Reached</h2>
            <p class="text-on-surface-variant mt-2">This share link has reached its view limit.</p>
        </div>
        @else
        <div class="bg-surface-container rounded-3xl p-8 shadow-2xl">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">description</span>
                </div>
                <div>
                    <h2 class="text-xl font-headline font-bold text-on-surface">{{ $file->name }}</h2>
                    <p class="text-sm text-on-surface-variant">{{ number_format($file->size / 1024, 1) }} KB</p>
                </div>
            </div>
            <div class="space-y-3 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-on-surface-variant">Type</span>
                    <span class="text-on-surface">{{ $file->mime_type ?? 'File' }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-on-surface-variant">Uploaded</span>
                    <span class="text-on-surface">{{ $file->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            <a href="{{ route('files.share.download', $file->share_hash) }}" class="w-full bg-primary text-on-primary font-bold py-3 rounded-xl text-center flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">download</span>
                {{ $file->share_access === 'download' ? 'Download' : 'View' }}
            </a>
        </div>
        @endif
    </div>
</div>
@endsection