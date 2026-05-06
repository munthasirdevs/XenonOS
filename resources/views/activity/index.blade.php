@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/activity.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('title', 'Activity Logs - XenonOS')

@section('content')
<header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
    <div class="space-y-1.5 sm:space-y-2">
        <span class="text-[10px] font-bold tracking-[0.2em] text-tertiary uppercase block">Security Protocol 4.0</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">Activity Logs</h1>
        <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed">Monitor system-wide actions and login sessions. Real-time observability for infrastructure security.</p>
    </div>
    <div class="flex flex-wrap gap-2 sm:gap-3 w-full sm:w-auto">
        <a href="{{ route('activity.export', ['format' => 'csv', 'date_from' => now()->subDays(7)->format('Y-m-d')]) }}" class="bg-surface-container hover:bg-surface-container-high active:scale-[0.98] text-on-surface px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl border border-outline/10 inline-flex items-center justify-center gap-2 transition-all w-full sm:w-auto min-h-[44px] text-sm">
            <span class="material-symbols-outlined text-sm">download</span>
            <span class="text-xs font-bold uppercase tracking-wider">Export PDF</span>
        </a>
        <a href="{{ route('activity.export', ['date_from' => now()->subDays(7)->format('Y-m-d')]) }}" class="bg-primary hover:bg-primary/90 active:scale-[0.98] text-on-primary px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl shadow-lg shadow-primary/10 inline-flex items-center justify-center gap-2 transition-all w-full sm:w-auto min-h-[44px] text-sm">
            <span class="material-symbols-outlined text-sm">description</span>
            <span class="text-xs font-bold uppercase tracking-wider">CSV Report</span>
        </a>
    </div>
</header>

<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
    <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
        <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
        <div class="flex flex-col gap-1">
            <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Total Actions</span>
            <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ number_format($stats['total_actions']) }}</div>
        </div>
        <div class="mt-3 sm:mt-4 flex items-center gap-2 text-primary text-xs">
            <span class="material-symbols-outlined text-sm">trending_up</span>
            <span>{{ number_format($stats['recent_actions']) }} from last 24h</span>
        </div>
    </div>
    <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
        <div class="absolute top-0 left-0 w-1 h-full bg-tertiary"></div>
        <div class="flex flex-col gap-1">
            <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Security Flags</span>
            <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ number_format($stats['security_flags']) }}</div>
        </div>
        <div class="mt-3 sm:mt-4 flex items-center gap-2 text-tertiary text-xs">
            <span class="material-symbols-outlined text-sm">report</span>
            <span>Requires review</span>
        </div>
    </div>
    <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
        <div class="absolute top-0 left-0 w-1 h-full bg-success"></div>
        <div class="flex flex-col gap-1">
            <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Login Sessions</span>
            <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ number_format($stats['active_sessions']) }}</div>
        </div>
        <div class="mt-3 sm:mt-4 flex items-center gap-2 text-success text-xs">
            <span class="material-symbols-outlined text-sm">sensors</span>
            <span>Active sessions</span>
        </div>
    </div>
</section>

<section class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8 mb-6 sm:mb-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 sm:mb-8">
        <div>
            <h2 class="text-lg sm:text-xl font-headline font-semibold text-on-surface">Activity Intensity Trend</h2>
            <p class="text-xs text-on-surface-variant">Real-time density of system actions & security events</p>
        </div>
        <div class="flex flex-wrap items-center gap-3 sm:gap-4">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-primary"></span>
                <span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">System Actions</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-tertiary"></span>
                <span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Security Flags</span>
            </div>
        </div>
    </div>
    <div class="h-[250px] sm:h-[300px] w-full relative">
        <canvas id="activityTrendChart" role="img" aria-label="Chart showing activity intensity over time"></canvas>
    </div>
</section>

<form method="GET" action="{{ route('activity') }}" class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-3 sm:p-4 mb-6 sm:mb-8">
    <div class="flex flex-wrap items-center gap-3 sm:gap-4">
        <div class="w-full sm:flex-1 sm:min-w-[220px] relative">
            <span class="material-symbols-outlined absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 text-on-surface-muted text-sm sm:text-base pointer-events-none">search</span>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search User IDs, actions or keywords..." class="w-full bg-surface-container text-on-surface placeholder-on-surface-muted text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 pl-10 sm:pl-12 pr-4 border-0 focus:ring-2 focus:ring-primary transition-all min-h-[44px]" />
        </div>
        <select name="action_type" class="bg-surface-container text-on-surface-variant text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 px-4 border-0 focus:ring-2 focus:ring-primary transition-all min-h-[44px]">
            <option value="">Action Type</option>
            @foreach($actionTypes as $action)
            <option value="{{ $action }}" {{ request('action_type') == $action ? 'selected' : '' }}>{{ ucfirst($action) }}</option>
            @endforeach
        </select>
        <select name="module" class="bg-surface-container text-on-surface-variant text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 px-4 border-0 focus:ring-2 focus:ring-primary transition-all min-h-[44px]">
            <option value="">Module</option>
            @foreach($modules as $module)
            <option value="{{ $module }}" {{ request('module') == $module ? 'selected' : '' }}>{{ $module }}</option>
            @endforeach
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="bg-surface-container text-on-surface-variant text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 px-4 border-0 focus:ring-2 focus:ring-primary transition-all min-h-[44px]" />
        <button type="submit" class="bg-primary hover:bg-primary/90 text-on-primary px-4 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl inline-flex items-center gap-2 transition-all min-h-[44px] text-sm font-bold">Filter</button>
    </div>
</form>

<section class="space-y-4 sm:space-y-6">
    <div class="flex gap-4 sm:gap-6 md:gap-8 border-b border-outline/10 overflow-x-auto pb-1">
        <a href="{{ route('activity') }}" class="activity-tab active pb-3 sm:pb-4 text-xs sm:text-sm font-semibold whitespace-nowrap flex items-center {{ request()->routeIs('activity') && !request()->routeIs('activity.*') ? '' : 'text-on-surface-variant' }}">User & System Activity</a>
        <a href="{{ route('activity.sessions') }}" class="activity-tab pb-3 sm:pb-4 text-xs sm:text-sm font-medium hover:text-on-surface transition-all whitespace-nowrap flex items-center {{ request()->routeIs('activity.sessions') ? 'active' : '' }}">Login Sessions</a>
        <a href="{{ route('activity.security') }}" class="activity-tab pb-3 sm:pb-4 text-xs sm:text-sm font-medium hover:text-on-surface transition-all whitespace-nowrap flex items-center {{ request()->routeIs('activity.security') ? 'active' : '' }}">Admin Controls</a>
    </div>

    <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[640px]">
                <thead>
                    <tr class="border-b border-outline/10">
                        <th class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">User / Entity</th>
                        <th class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Action Context</th>
                        <th class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-center">Severity</th>
                        <th class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-right">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline/5">
                    @forelse($activities as $activity)
                    <tr class="group hover:bg-surface-container-high/60 transition-colors">
                        <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                            <div class="flex items-center gap-3 sm:gap-4">
                                @if($activity->user)
                                <img alt="Avatar" class="w-10 h-10 rounded-xl object-cover" src="{{ $activity->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($activity->user->name) . '&background=818cf8&color=fff' }}" />
                                <div class="min-w-0">
                                    <div class="text-xs sm:text-sm font-semibold text-on-surface truncate">{{ $activity->user->name }}</div>
                                    <div class="text-[10px] text-on-surface-variant">{{ $activity->user->getRoleNames()->first() ?? 'User' }}</div>
                                </div>
                                @else
                                <div class="w-10 h-10 rounded-xl bg-surface-container-highest flex items-center justify-center">
                                    <span class="material-symbols-outlined text-on-surface-variant">smart_toy</span>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs sm:text-sm font-semibold text-on-surface truncate">System Bot</div>
                                    <div class="text-[10px] text-on-surface-variant">Automated Task</div>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                            <div class="space-y-1">
                                <div class="text-xs sm:text-sm text-on-surface flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm text-primary flex-shrink-0">{{ $activity->action === 'create' ? 'add' : ($activity->action === 'delete' ? 'delete' : ($activity->action === 'update' ? 'edit' : 'sync')) }}</span>
                                    {{ $activity->description ?? $activity->action }}
                                </div>
                                <div class="text-[10px] text-on-surface-variant uppercase tracking-wider">Module: {{ $activity->computed_module }}</div>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-center">
                            @php $severity = $activity->computed_severity; @endphp
                            <span class="severity-{{ $severity }} text-[10px] font-bold px-2.5 sm:px-3 py-1 rounded-full uppercase tracking-widest whitespace-nowrap">{{ $severity }}</span>
                        </td>
                        <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right">
                            <div class="text-xs text-on-surface-variant">{{ $activity->created_at->diffForHumans() }}</div>
                            <div class="text-[10px] text-on-surface-muted">{{ $activity->created_at->format('H:i:s') }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-12 text-center text-on-surface-variant">No activity logs found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 sm:px-6 md:px-8 py-4 sm:py-6 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-outline/5">
            <div class="text-xs text-on-surface-variant">Showing <span class="text-on-surface font-bold">{{ $activities->firstItem() }}</span> to <span class="text-on-surface font-bold">{{ $activities->lastItem() }}</span> of <span class="text-on-surface font-bold">{{ $activities->total() }}</span> actions</div>
            <div class="flex items-center gap-1.5">{{ $activities->links() }}</div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/activity.js') }}"></script>
@endpush