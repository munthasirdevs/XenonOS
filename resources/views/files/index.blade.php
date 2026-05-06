@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/files.css') }}">
@endpush

@section('title', 'Files - XenonOS')

@section('content')
<header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8">
    <div>
        <span class="text-[10px] font-bold tracking-[0.2em] text-primary uppercase block">Storage</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-headline font-light tracking-tighter text-on-surface">Files</h1>
    </div>
    <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data" class="flex gap-2">
        @csrf
        <label class="bg-primary hover:bg-primary/90 text-on-primary px-4 py-2.5 rounded-xl cursor-pointer transition-all text-sm font-bold">
            <input type="file" name="file" class="hidden" onchange="this.form.submit()" required>
            <span class="flex items-center gap-2">
                <span class="material-symbols-outlined">add</span>
                Upload
            </span>
        </label>
    </form>
</header>

<div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-outline/10">
                    <th class="px-6 py-4 text-[10px] uppercase tracking-widest text-on-surface-muted">Name</th>
                    <th class="px-6 py-4 text-[10px] uppercase tracking-widest text-on-surface-muted">Size</th>
                    <th class="px-6 py-4 text-[10px] uppercase tracking-widest text-on-surface-muted">Uploaded</th>
                    <th class="px-6 py-4 text-right text-[10px] uppercase tracking-widest text-on-surface-muted">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline/5">
                @forelse($files as $file)
                <tr class="group hover:bg-surface-container-high/60 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">description</span>
                            <span class="text-sm font-medium text-on-surface">{{ $file->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-on-surface-variant">{{ number_format($file->size / 1024, 1) }} KB</td>
                    <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $file->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" onclick="openShareModal({{ $file->id }})" class="p-2 hover:bg-surface-container-high rounded-lg transition-colors" title="Share">
                                <span class="material-symbols-outlined text-primary text-sm">share</span>
                            </button>
                            <form method="POST" action="{{ route('files.destroy', $file->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 hover:bg-surface-container-high rounded-lg transition-colors" title="Delete">
                                    <span class="material-symbols-outlined text-error text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-12 text-center text-on-surface-variant">No files uploaded yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Share Modal -->
<div id="share-modal" class="hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeShareModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-surface-container rounded-3xl shadow-2xl p-6">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-bold text-on-surface">Share File</h3>
            <button type="button" onclick="closeShareModal()" class="p-2 hover:bg-surface-container-high rounded-xl transition-colors">
                <span class="material-symbols-outlined text-on-surface">close</span>
            </button>
        </div>
        <div id="share-options">
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Expiration</label>
                    <select id="share-expiration" class="w-full bg-surface-container-low text-on-surface text-sm rounded-xl py-3 px-4 border-0">
                        <option value="never">No expiry</option>
                        <option value="1h">1 Hour</option>
                        <option value="1d">1 Day</option>
                        <option value="7d">7 Days</option>
                        <option value="30d">30 Days</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Password Protection</label>
                    <div class="flex items-center gap-3 p-3 bg-surface-container-low rounded-xl">
                        <input type="checkbox" id="share-password-enable" class="w-4 h-4 rounded" onchange="togglePasswordField()">
                        <span class="text-sm text-on-surface">Require password</span>
                    </div>
                    <input type="password" id="share-password" class="w-full bg-surface-container-low text-on-surface text-sm rounded-xl py-3 px-4 mt-2 border-0 hidden" placeholder="Enter password (min 4 chars)">
                </div>
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">View Limit</label>
                    <select id="share-views" class="w-full bg-surface-container-low text-on-surface text-sm rounded-xl py-3 px-4 border-0">
                        <option value="unlimited">Unlimited</option>
                        <option value="1">1 view</option>
                        <option value="5">5 views</option>
                        <option value="10">10 views</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Access</label>
                    <div class="flex gap-2">
                        <button type="button" id="access-view" class="flex-1 py-2 px-3 rounded-lg bg-primary text-on-primary text-sm font-medium" onclick="setAccess('view')">View only</button>
                        <button type="button" id="access-download" class="flex-1 py-2 px-3 rounded-lg bg-surface-container-low text-on-surface-variant text-sm font-medium" onclick="setAccess('download')">Download</button>
                    </div>
                </div>
                <button type="button" id="generate-btn" onclick="generateShareLink()" class="w-full bg-primary hover:bg-primary/90 text-on-primary font-semibold py-3 rounded-xl transition-all">Generate Link</button>
            </div>
        </div>
        <div id="share-result" class="hidden space-y-4 pt-4">
            <p class="text-sm text-on-surface-variant">Share link:</p>
            <div class="flex items-center gap-2">
                <input type="text" id="share-link" readonly class="flex-1 bg-surface-container-low text-on-surface text-sm font-mono rounded-xl py-3 px-4 border-0">
                <button type="button" onclick="copyShareLink()" class="p-3 bg-surface-container hover:bg-surface-container-high rounded-xl transition-colors">
                    <span class="material-symbols-outlined text-primary">content_copy</span>
                </button>
            </div>
            <button type="button" onclick="closeShareResult()" class="w-full py-2 text-sm text-on-surface-variant hover:underline">Generate new link</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/files.js') }}"></script>
@endpush