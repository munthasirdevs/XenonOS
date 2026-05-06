<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sessions - XenonOS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'surface-container-highest': '#1a1d26',
                        'surface-bright': '#1e222c',
                        'surface-container': '#12151e',
                        'surface-container-low': '#0f121a',
                        'surface-container-high': '#161922',
                        'background': '#0b0e14',
                        'primary': '#818cf8',
                        'on-primary': '#1e1b4b',
                        'on-surface': '#dfe2f1',
                        'on-surface-variant': '#94a3b8',
                        'on-surface-muted': '#64748b',
                        'error': '#f87171',
                        'success': '#34d399',
                        'tertiary': '#c084fc',
                    },
                    fontFamily: {
                        headline: ['Syne', 'sans-serif'],
                        body: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
</head>

<body class="flex min-h-screen bg-background font-body">
    @include('components.sidebar')
    @include('components.navbar')

    <main class="flex-1 min-h-screen flex flex-col pt-16 lg:pt-0">
        <div class="flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 md:px-8 lg:px-10 py-6 sm:py-8 md:py-10 lg:py-12">

            <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
                <div class="space-y-1.5 sm:space-y-2">
                    <span class="text-[10px] font-bold tracking-[0.2em] text-tertiary uppercase block">Security Protocol 4.0</span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">Login Sessions</h1>
                    <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed">
                        Monitor active user sessions and manage login activity across devices.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2 sm:gap-3 w-full sm:w-auto">
                    <a href="{{ route('activity.export', ['date_from' => now()->subDays(7)->format('Y-m-d')]) }}"
                        class="bg-primary hover:bg-primary/90 active:scale-[0.98] text-on-primary px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl shadow-lg shadow-primary/10 inline-flex items-center justify-center gap-2 transition-all w-full sm:w-auto min-h-[44px] text-sm">
                        <span class="material-symbols-outlined text-sm">description</span>
                        <span class="text-xs font-bold uppercase tracking-wider">Export CSV</span>
                    </a>
                </div>
            </header>

            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
                    <div class="absolute top-0 left-0 w-1 h-full bg-success"></div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Active Sessions</span>
                        <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ number_format($stats['active']) }}</div>
                    </div>
                    <div class="mt-3 sm:mt-4 flex items-center gap-2 text-success text-xs">
                        <span class="material-symbols-outlined text-sm">sensors</span>
                        <span>Currently active</span>
                    </div>
                </div>

                <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
                    <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Idle Sessions</span>
                        <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ number_format($stats['idle']) }}</div>
                    </div>
                    <div class="mt-3 sm:mt-4 flex items-center gap-2 text-yellow-500 text-xs">
                        <span class="material-symbols-outlined text-sm">hourglass_empty</span>
                        <span>Inactive > 30min</span>
                    </div>
                </div>

                <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
                    <div class="absolute top-0 left-0 w-1 h-full bg-on-surface-variant"></div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Total Sessions</span>
                        <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ number_format($stats['total']) }}</div>
                    </div>
                    <div class="mt-3 sm:mt-4 flex items-center gap-2 text-on-surface-variant text-xs">
                        <span class="material-symbols-outlined text-sm">list</span>
                        <span>All time</span>
                    </div>
                </div>
            </section>

            <section class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6 sm:mb-8">
                <h2 class="text-lg sm:text-xl font-headline font-semibold text-on-surface">Recent Login Sessions</h2>
                <div class="flex items-center gap-2 text-primary min-h-[44px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest">{{ $stats['active'] }} Active now</span>
                </div>
            </section>

            <form method="GET" action="{{ route('activity.sessions') }}" class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-3 sm:p-4 mb-6 sm:mb-8">
                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                    <select name="status"
                        class="bg-surface-container text-on-surface-variant text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 px-4 border-0 focus:ring-2 focus:ring-primary transition-all min-h-[44px]">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="idle" {{ request('status') == 'idle' ? 'selected' : '' }}>Idle</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-on-primary px-4 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl inline-flex items-center gap-2 transition-all min-h-[44px] text-sm font-bold">
                        Filter
                    </button>
                </div>
            </form>

            <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
                @forelse($sessions as $session)
                <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-sm border border-outline/5 hover:border-primary/20 transition-all group">
                    <div class="flex justify-between items-start mb-4 sm:mb-6">
                        <div class="flex items-center gap-3">
                            <div class="bg-surface-container-highest p-2.5 rounded-xl shrink-0">
                                <span class="material-symbols-outlined text-primary">
                                    {{ $session->device_type === 'mobile' ? 'smartphone' : ($session->device_type === 'tablet' ? 'tablet' : 'desktop_windows') }}
                                </span>
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs sm:text-sm font-bold text-on-surface truncate">{{ $session->browser ?? 'Browser' }}</div>
                                <div class="text-[10px] text-on-surface-variant uppercase tracking-wider">{{ $session->os ?? 'Unknown' }} &bull; {{ $session->browser ?? 'Unknown' }}</div>
                            </div>
                        </div>
                        @if($session->isActive())
                        <span class="bg-green-500/10 text-green-500 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase shrink-0">Active</span>
                        @else
                        <span class="bg-on-surface-variant/10 text-on-surface-variant text-[10px] font-bold px-2 py-0.5 rounded-md uppercase shrink-0">Idle</span>
                        @endif
                    </div>
                    <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">User</span>
                            <span class="text-on-surface font-medium truncate ml-2">{{ $session->user?->name ?? 'Unknown' }}</span>
                        </div>
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">Location</span>
                            <span class="text-on-surface font-medium">{{ $session->location ?? $session->ip_address ?? 'Unknown' }}</span>
                        </div>
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">Duration</span>
                            <span class="text-on-surface font-medium">
                                @php
                                $lastActivity = is_numeric($session->last_activity) ? \Carbon\Carbon::createFromTimestamp($session->last_activity) : $session->last_activity;
                                $diff = $lastActivity->diff(now());
                                echo $diff->d > 0 ? $diff->d . 'd ' . $diff->h . 'h' : ($diff->h > 0 ? $diff->h . 'h ' . $diff->i . 'm' : $diff->i . 'm');
                                @endphp
                            </span>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('sessions.forceLogout', $session->id) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full p-2.5 sm:p-3 bg-error/10 text-error hover:bg-error/20 border border-error/20 rounded-xl text-xs font-bold uppercase tracking-widest transition-all min-h-[44px]">
                            Force Logout
                        </button>
                    </form>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-8 text-center">
                        <span class="material-symbols-outlined text-4xl text-on-surface-muted mb-4">sensors_off</span>
                        <p class="text-on-surface-variant">No sessions found</p>
                    </div>
                </div>
                @endforelse
            </section>

            @if($sessions->hasPages())
            <div class="mt-6 sm:mt-8 flex justify-center">
                {{ $sessions->links() }}
            </div>
            @endif
        </div>
    </main>
</body>

</html>