<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $client->name }} - XenonOS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/xenon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
</head>

<body class="flex min-h-screen bg-surface">
    <x-navbar />

    <main class="flex-1 md:ml-[260px] min-h-screen">
        <div class="p-6 md:p-8">
            <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
                <div class="flex flex-col sm:flex-row items-start gap-6 flex-1">
                    <div class="w-24 h-24 rounded-2xl bg-surface-container-highest flex items-center justify-center text-primary border border-outline-variant/10 shadow-xl overflow-hidden flex-shrink-0">
                        <img alt="{{ $client->name }} Logo" class="w-full h-full object-cover" src="{{ $client->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name) . '&background=818cf8&color=fff&size=128' }}" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            @if($client->tier === 'premium')
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest rounded-full border border-primary/20">Priority A</span>
                            @elseif($client->tier === 'standard')
                            <span class="px-3 py-1 bg-secondary/10 text-secondary text-[10px] font-bold uppercase tracking-widest rounded-full border border-secondary/20">Standard</span>
                            @else
                            <span class="px-3 py-1 bg-on-surface-variant/10 text-on-surface-variant text-[10px] font-bold uppercase tracking-widest rounded-full border border-on-surface-variant/20">Basic</span>
                            @endif
                            <span class="text-on-surface-variant text-sm font-medium">ID: CL-{{ str_pad($client->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-headline font-light tracking-tighter text-on-surface truncate">{{ $client->name }}</h1>
                        <p class="text-on-surface-variant text-sm max-w-lg mt-2">{{ $client->company }}</p>
                        <div class="flex items-center gap-4 text-sm text-on-surface-variant mt-2">
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">language</span>{{ $client->website }}</span>
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">location_on</span>{{ $client->location }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('clients.projects', $client->id) }}" class="min-h-[44px] px-6 py-3 rounded-xl bg-surface-container border border-outline-variant/20 text-on-surface font-medium text-sm hover:bg-surface-container-high transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        <span>Edit Profile</span>
                    </a>
                    <a href="{{ route('clients.activity', $client->id) }}" class="min-h-[44px] px-6 py-3 rounded-xl bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold text-sm shadow-lg shadow-primary/20 hover:shadow-primary/30 hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">mail</span>
                        <span>Message</span>
                    </a>
                </div>
            </header>

            <nav class="mb-10 border-b border-outline-variant/10" aria-label="Client sections">
                <div class="flex gap-8 overflow-x-auto">
                    <a href="{{ route('clients.show', $client->id) }}" class="pb-4 text-primary font-bold text-sm whitespace-nowrap border-b-2 border-primary">Overview</a>
                    <a href="{{ route('clients.projects', $client->id) }}" class="pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap hover:text-on-surface">Projects ({{ $stats['total_projects'] }})</a>
                    <a href="{{ route('clients.activity', $client->id) }}" class="pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap hover:text-on-surface">Activity</a>
                    <a href="{{ route('clients.documents', $client->id) }}" class="pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap hover:text-on-surface">Documents</a>
                </div>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-8 space-y-6">
                    <section class="bg-surface-container-low p-6 rounded-3xl">
                        <h3 class="text-sm font-bold uppercase tracking-widest text-on-surface-variant mb-5">Quick Stats</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="p-4 bg-surface-container rounded-2xl">
                                <p class="text-xs text-on-surface-variant mb-1">Total Projects</p>
                                <p class="text-2xl font-headline font-bold text-on-surface">{{ $stats['total_projects'] }}</p>
                            </div>
                            <div class="p-4 bg-surface-container rounded-2xl">
                                <p class="text-xs text-on-surface-variant mb-1">Active Projects</p>
                                <p class="text-2xl font-headline font-bold text-emerald-400">{{ $stats['active_projects'] }}</p>
                            </div>
                            <div class="p-4 bg-surface-container rounded-2xl">
                                <p class="text-xs text-on-surface-variant mb-1">Total Revenue</p>
                                <p class="text-2xl font-headline font-bold text-on-surface">${{ number_format($client->total_revenue ?? 0, 0) }}</p>
                            </div>
                        </div>
                    </section>

                    <section class="bg-surface-container-low p-6 rounded-3xl">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-sm font-bold uppercase tracking-widest text-on-surface-variant">Recent Projects</h3>
                            <a href="{{ route('clients.projects', $client->id) }}" class="text-xs text-primary font-bold hover:text-primary/80">View All</a>
                        </div>
                        <div class="space-y-3">
                            @foreach($recentProjects as $project)
                            <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl hover:bg-surface-container-high transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary"><span class="material-symbols-outlined">folder</span></div>
                                    <div>
                                        <p class="font-medium text-on-surface">{{ $project->name }}</p>
                                        <p class="text-xs text-on-surface-variant">{{ $project->description }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    @if($project->status === 'active')
                                    <span class="px-2 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400">Active</span>
                                    @elseif($project->status === 'completed')
                                    <span class="px-2 py-1 rounded-full text-[10px] font-bold bg-blue-500/10 text-blue-400">Completed</span>
                                    @else
                                    <span class="px-2 py-1 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-400">{{ ucfirst($project->status) }}</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                </div>

                <aside class="lg:col-span-4 space-y-6">
                    <div class="bg-surface-container-low p-6 rounded-3xl">
                        <h3 class="text-sm font-bold uppercase tracking-widest text-on-surface-variant mb-5">Client Info</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-on-surface-variant">mail</span>
                                <div>
                                    <p class="text-xs text-on-surface-variant">Email</p>
                                    <p class="text-sm text-on-surface">{{ $client->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-on-surface-variant">phone</span>
                                <div>
                                    <p class="text-xs text-on-surface-variant">Phone</p>
                                    <p class="text-sm text-on-surface">{{ $client->phone ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-on-surface-variant">location_on</span>
                                <div>
                                    <p class="text-xs text-on-surface-variant">Location</p>
                                    <p class="text-sm text-on-surface">{{ $client->location ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-on-surface-variant">language</span>
                                <div>
                                    <p class="text-xs text-on-surface-variant">Website</p>
                                    <p class="text-sm text-primary">{{ $client->website ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-on-surface-variant">phone</span>
                        <div>
                            <p class="text-xs text-on-surface-variant">Phone</p>
                            <p class="text-sm text-on-surface">{{ $client->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-on-surface-variant">location_on</span>
                        <div>
                            <p class="text-xs text-on-surface-variant">Location</p>
                            <p class="text-sm text-on-surface">{{ $client->location ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-on-surface-variant">language</span>
                        <div>
                            <p class="text-xs text-on-surface-variant">Website</p>
                            <p class="text-sm text-primary">{{ $client->website ?? 'N/A' }}</p>
                        </div>
                    </div>
            </div>
        </div>
        </aside>
        </div>
        </div>
    </main>
    <script src="{{ asset('js/clients.js') }}"></script>
</body>

</html>
