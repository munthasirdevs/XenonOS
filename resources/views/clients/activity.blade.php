@php
$isAllActivity = !isset($client);
@endphp
<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $client->name ?? 'All Clients' }} - Activity | XenonOS</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'primary': '#818cf8', 'on-primary': '#1e1b4b',
                        'surface': '#0b0e14', 'surface-container': '#1e293b', 'surface-container-low': '#131c2e', 'surface-container-high': '#334155',
                        'on-surface': '#dfe2f1', 'on-surface-variant': '#94a3b8', 'on-surface-muted': '#64748b',
                        'tertiary': '#a855f7', 'error': '#f87171',
                    },
                    fontFamily: { headline: ['Syne', 'sans-serif'], body: ['Outfit', 'sans-serif'], label: ['Outfit', 'sans-serif'] }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Syne:wght@400..800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        .font-headline { font-family: 'Syne', sans-serif; }
        .font-body { font-family: 'Outfit', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>

<body class="flex min-h-screen bg-surface font-body">
    <x-navbar />

    <main class="flex-1 ml-0 md:ml-64 min-h-screen flex flex-col pt-20">
        <div class="flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 md:px-8 lg:px-10 py-6 sm:py-8 md:py-10 lg:py-12">

            @if($isAllActivity)
            <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
                <div class="space-y-1.5 sm:space-y-2">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">Activity Log</h1>
                    <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed">All client activities across the platform.</p>
                </div>
            </header>
            @else
            <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
                <div class="space-y-1.5 sm:space-y-2">
                    <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-6">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-xl sm:rounded-2xl bg-surface-container-highest flex items-center justify-center text-primary border border-outline-variant/10 shadow-xl overflow-hidden flex-shrink-0">
                            <img alt="{{ $client->name }} Logo" class="w-full h-full object-cover"
                                src="{{ $client->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name ?? 'Client') . '&background=818cf8&color=fff&size=128' }}" />
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-2">
                                <span class="px-2 sm:px-3 py-1 bg-primary/10 text-primary text-[9px] sm:text-[10px] font-bold uppercase tracking-widest rounded-full border border-primary/20 flex-shrink-0">Client #{{ $client->id }}</span>
                            </div>
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface truncate">
                                {{ $client->name }}
                            </h1>
                            <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed mt-2">
                                {{ $client->company ?? 'No company' }} · {{ $client->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex gap-10 border-b border-outline-variant/10 pb-px mb-8">
                <a href="{{ route('clients.show', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors relative">Overview</a>
                <a href="{{ route('clients.projects', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors">Projects</a>
                <a href="{{ route('clients.activity', $client->id) }}" class="pb-4 text-primary font-bold transition-colors relative">Activity<span class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-t-full"></span></a>
                <a href="{{ route('clients.documents', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors">Documents</a>
            </div>
            @endif

            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden">
                <div class="p-6 border-b border-outline-variant/10">
                    <div class="flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary">history</span>
                        <h2 class="text-xl font-headline font-bold text-on-surface">Activity Log</h2>
                    </div>
                </div>
                <div class="divide-y divide-outline-variant/5">
                    @forelse($activities as $activity)
                    <div class="p-6 hover:bg-surface-container/50 transition-colors">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">
                                    @switch($activity->type)
                                    @case('project')folder@break
                                    @case('document')description@break
                                    @case('payment')payments@break
                                    @case('message')chat@break
                                    @defaulthistory@endswitch
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4 mb-1">
                                    <p class="text-on-surface font-medium">{{ $activity->description ?? 'Activity recorded' }}</p>
                                    <time class="text-xs text-on-surface-muted whitespace-nowrap">{{ $activity->created_at->diffForHumans() }}</time>
                                </div>
                                @if($activity->user)
                                <p class="text-xs text-on-surface-muted">by {{ $activity->user->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-12 text-center">
                        <span class="material-symbols-outlined text-6xl text-on-surface-muted mb-4">history</span>
                        <p class="text-on-surface-variant">No activity recorded yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @if($isAllActivity && isset($activities) && $activities->hasPages())
            <nav class="px-6 py-4 border-t border-outline-variant/10">
                {{ $activities->links() }}
            </nav>
            @endif
        </div>
    </main>
</body>

</html>