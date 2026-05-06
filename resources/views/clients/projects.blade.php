<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $client->name ?? 'Client' }} - Projects | XenonOS</title>

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

            <section class="mb-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-10">
                    <div class="flex items-start gap-8">
                        <div class="relative group">
                            <img alt="Organization profile image" title="Organization profile image"
                                class="w-32 h-32 rounded-3xl object-cover shadow-2xl border border-outline-variant/10"
                                src="{{ $client->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name ?? 'Client') . '&background=818cf8&color=fff&size=128' }}" />
                        </div>
                        <div class="pt-2">
                            <div class="flex items-center gap-4 mb-2">
                                <h2 class="text-4xl font-headline font-extrabold tracking-tight text-on-surface">{{ $client->name }}</h2>
                                <span class="px-3 py-1 rounded-full bg-{{ $client->status === 'active' ? 'emerald' : ($client->status === 'pending' ? 'amber' : 'red') }}-500/10 text-{{ $client->status === 'active' ? 'emerald' : ($client->status === 'pending' ? 'amber' : 'red') }}-400 text-xs font-bold tracking-widest uppercase">{{ $client->status ?? 'active' }}</span>
                            </div>
                            <p class="text-on-surface-variant max-w-lg leading-relaxed">{{ $client->company ?? 'No company' }} · {{ $client->email }}</p>
                            <div class="flex items-center gap-6 mt-6">
                                <div class="flex items-center gap-2 text-sm text-on-surface-variant">
                                    <span class="material-symbols-outlined text-base">mail</span>
                                    <span>{{ $client->email }}</span>
                                </div>
                                @if($client->phone)
                                <div class="flex items-center gap-2 text-sm text-on-surface-variant">
                                    <span class="material-symbols-outlined text-base">phone</span>
                                    <span>{{ $client->phone }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="px-6 py-3 rounded-xl border border-outline-variant/20 font-semibold text-on-surface hover:bg-surface-container-high transition-all">
                            Edit Profile
                        </button>
                        <button class="px-6 py-3 rounded-xl bg-primary font-bold text-on-primary shadow-lg shadow-primary/20 scale-100 hover:scale-[1.02] transition-transform flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">add</span>
                            Create Project
                        </button>
                    </div>
                </div>

                <div class="flex gap-10 border-b border-outline-variant/10 pb-px">
                    <a href="{{ route('clients.show', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors relative">Overview</a>
                    <a href="{{ route('clients.projects', $client->id) }}" class="pb-4 text-primary font-bold transition-colors relative">Projects<span class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-t-full"></span></a>
                    <a href="{{ route('clients.activity', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors">Activity</a>
                    <a href="{{ route('clients.documents', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors">Documents</a>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects as $project)
                <div class="lg:col-span-{{ $project->priority === 'high' ? '2' : '1' }} bg-surface-container rounded-[1.5rem] p-8 hover:bg-surface-container-high transition-all duration-400 group relative overflow-hidden shadow-xl">
                    @if($project->priority === 'high')
                    <div class="absolute top-0 right-0 p-8">
                        <span class="px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-widest uppercase">High Priority</span>
                    </div>
                    @endif
                    <div class="flex flex-col h-full justify-between">
                        <div>
                            <h3 class="text-3xl font-headline font-extrabold text-primary mb-2 group-hover:translate-x-1 transition-transform">{{ $project->name }}</h3>
                            <p class="text-on-surface-variant font-medium mb-8">{{ $client->name }} · {{ $project->category ?? 'General' }}</p>
                            <div class="grid grid-cols-2 gap-8 mb-8">
                                <div>
                                    <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest mb-1">Status</p>
                                    <p class="text-on-surface font-semibold flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-{{ $project->status === 'completed' ? 'emerald' : ($project->status === 'in_progress' ? 'amber' : 'red') }}-400"></span>
                                        {{ ucfirst(str_replace('_', ' ', $project->status ?? 'pending')) }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest mb-1">Deadline</p>
                                    <p class="text-on-surface font-semibold">{{ $project->end_date ? $project->end_date->format('M d, Y') : 'TBD' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-on-surface-variant">
                                <span>Progress</span>
                                <span>{{ $project->progress ?? 0 }}%</span>
                            </div>
                            <div class="h-2 bg-surface-container-highest rounded-full overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: {{ $project->progress ?? 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-surface-container rounded-[1.5rem] p-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-on-surface-muted mb-4">folder_off</span>
                    <p class="text-on-surface-variant text-lg">No projects yet</p>
                    <button class="mt-4 px-6 py-3 rounded-xl bg-primary font-bold text-on-primary shadow-lg shadow-primary/20">
                        Create First Project
                    </button>
                </div>
                @endforelse
            </section>
        </div>
    </main>
</body>

</html>