<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $client->name }} - Projects - XenonOS</title>
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
                        'surface-container-lowest': '#06080c',
                        'background': '#0b0e14',
                        'primary': '#818cf8',
                        'primary-container': '#4f46e5',
                        'secondary': '#a5b4fc',
                        'tertiary': '#ffb783',
                        'on-primary': '#1e1b4b',
                        'on-surface': '#dfe2f1',
                        'on-surface-variant': '#94a3b8',
                        'outline': '#475569',
                        'outline-variant': '#464554',
                        'error': '#ffb4ab',
                        'emerald-400': '#34d399',
                        'emerald-500': '#10b981',
                        'amber-400': '#fbbf24',
                        'amber-500': '#f59e0b',
                        'blue-400': '#60a5fa',
                        'rose-400': '#fb7185',
                        'rose-500': '#f43f5e',
                        'purple-600': '#9333ea',
                    },
                    fontFamily: {
                        headline: ['Syne', 'sans-serif'],
                        body: ['Outfit', 'sans-serif'],
                        label: ['Outfit', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .font-headline {
            font-family: 'Syne', sans-serif;
        }

        .font-label {
            font-family: 'Outfit', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            font-size: 20px;
        }
    </style>
</head>

<body class="flex min-h-screen bg-background">
    <x-navbar />

    <main class="flex-1 md:ml-[260px] min-h-screen">
        <div class="p-6 md:p-8">
            <section class="mb-12">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-10">
                    <div class="flex items-start gap-8">
                        <div class="relative group">
                            <img alt="Organization profile image" class="w-32 h-32 rounded-3xl object-cover shadow-2xl border border-outline-variant/10" src="{{ $client->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name) . '&background=818cf8&color=fff&size=128' }}" />
                            <div class="absolute -bottom-2 -right-2 bg-primary p-2 rounded-xl text-on-primary shadow-lg">
                                <span class="material-symbols-outlined text-lg">verified</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="flex items-center gap-4 mb-2">
                                <h2 class="text-4xl font-headline font-extrabold tracking-tight text-on-surface">{{ $client->name }}</h2>
                                <span class="px-3 py-1 rounded-full bg-secondary-container/30 text-secondary text-xs font-bold tracking-widest uppercase">{{ $client->tier ?? 'standard' }}</span>
                            </div>
                            <p class="text-on-surface-variant max-w-lg leading-relaxed">{{ $client->company }}</p>
                            <div class="flex items-center gap-6 mt-6">
                                <div class="flex items-center gap-2 text-sm text-on-surface-variant">
                                    <span class="material-symbols-outlined text-base">location_on</span>
                                    <span>{{ $client->location }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-on-surface-variant">
                                    <span class="material-symbols-outlined text-base">mail</span>
                                    <span>{{ $client->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="px-6 py-3 rounded-xl border border-outline-variant/20 font-semibold text-on-surface hover:bg-surface-container-high transition-all">Edit Profile</button>
                        <button class="px-6 py-3 rounded-xl bg-gradient-to-br from-primary to-primary-container font-bold text-on-primary shadow-lg shadow-primary/20 scale-100 hover:scale-[1.02] transition-transform flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">add</span>
                            Create Project
                        </button>
                    </div>
                </div>

                <nav class="flex gap-10 border-b border-outline-variant/10 pb-px">
                    <a href="{{ route('clients.show', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors">Overview</a>
                    <a href="{{ route('clients.projects', $client->id) }}" class="pb-4 text-primary font-bold transition-colors relative">
                        Projects
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-t-full"></span>
                    </a>
                    <a href="{{ route('clients.activity', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors">Activity</a>
                    <a href="{{ route('clients.documents', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors">Documents</a>
                </nav>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                @if($loop->first && $loop->index === 0)
                <div class="lg:col-span-2 bg-surface-container rounded-[1.5rem] p-8 hover:bg-surface-container-high transition-all duration-400 group relative overflow-hidden shadow-xl">
                    <div class="absolute top-0 right-0 p-8">
                        @if($project->priority === 'high')
                        <span class="px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-widest uppercase">High Priority</span>
                        @elseif($project->priority === 'urgent')
                        <span class="px-4 py-1.5 rounded-full bg-rose-500/10 text-rose-400 text-xs font-bold tracking-widest uppercase">Urgent</span>
                        @else
                        <span class="px-4 py-1.5 rounded-full bg-surface-container-highest text-on-surface-variant text-xs font-bold tracking-widest uppercase">{{ ucfirst($project->priority) }}</span>
                        @endif
                    </div>
                    <div class="flex flex-col h-full justify-between">
                        <div>
                            <h3 class="text-3xl font-headline font-extrabold text-primary mb-2 group-hover:translate-x-1 transition-transform">{{ $project->name }}</h3>
                            <p class="text-on-surface-variant font-medium mb-8">{{ $client->name }} • {{ $project->status }}</p>
                            <div class="grid grid-cols-2 gap-8 mb-8">
                                <div>
                                    <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest mb-1">Status</p>
                                    <p class="text-on-surface font-semibold flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                        {{ ucfirst($project->status) }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest mb-1">Deadline</p>
                                    <p class="text-on-surface font-semibold">{{ $project->end_date ? format_user_time($project->end_date, 'M d, Y') : 'TBD' }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-end mb-3">
                                <div>
                                    <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest mb-1">Progress</p>
                                    <p class="text-2xl font-headline font-bold text-on-surface">{{ $project->status === 'completed' ? '100%' : ($project->status === 'active' ? '68%' : '15%') }}</p>
                                </div>
                                <div class="flex -space-x-3">
                                    <img alt="Team member" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBXq5AJM5HwBj67BUl9R-Q6_Y1rWolnpHclY3bblp891lpPSIecsMSQOv4TC11uJSXnP-CIEUuaRMggNpU2hugK4YHldVVG0bJ1hNZwbajRI6biQOi0OvoZ2DOim3YpEo1qB_Grln3rDYnBUaxe77WbScs5SPmIvEsnW6vRURp6GgKP65UDhsXzx8CRVqbU2hKfpP-a_FD_hTUAXFwQ1SuwM9EN2jjvIv9TtHtT25nXe3elt8QxHJZbH3JVC5dYjdcjnCk-wMc2rLw" />
                                    <img alt="Team member" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9p1OKtvDRzGtvU6Z8uJm2e2vMIqKkPPIoyqzy0E2f9D1aLiKOARBlyL6YxAx4gfCj4kSiXWd8tE01sbqqxniXBYltW9lXxCGdhD_v7W6Gv36fWl2QZ6z3jtrg_bTQgl5MMmsXS-5XcOUuKl3LWPmYoCVgePpmIHC0rbA_RW44uOPuIQnzhDx8vaSiJGf6D9lOY7XmHDQJ4X5oQKF7XWaaDuqXOFlB-TzrmRhWTsY_4Z9EPI-USTHlxEHdXDIF26TbSJNku45kdYA" />
                                    <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface-container flex items-center justify-center text-[10px] font-bold text-on-surface-variant">+2</div>
                                </div>
                            </div>
                            <div class="h-2 w-full bg-surface-container-lowest rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-primary to-primary-container {{ $project->status === 'completed' ? 'w-full' : ($project->status === 'active' ? 'w-[68%]' : 'w-[15%]') }} rounded-full shadow-[0_0_12px_rgba(192,193,255,0.4)]"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-surface-container rounded-[1.5rem] p-8 hover:bg-surface-container-high transition-all duration-400 group shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        @if($project->priority === 'high')
                        <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-2xl">folder</span>
                        </div>
                        @elseif($project->priority === 'urgent')
                        <div class="w-12 h-12 rounded-2xl bg-rose-500/10 flex items-center justify-center text-rose-400">
                            <span class="material-symbols-outlined text-2xl">warning</span>
                        </div>
                        @else
                        <div class="w-12 h-12 rounded-2xl bg-secondary-container/20 flex items-center justify-center text-secondary">
                            <span class="material-symbols-outlined text-2xl">description</span>
                        </div>
                        @endif
                        @if($project->status === 'active')
                        <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-bold tracking-widest uppercase">Active</span>
                        @elseif($project->status === 'completed')
                        <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-[10px] font-bold tracking-widest uppercase">Done</span>
                        @elseif($project->status === 'paused')
                        <span class="px-3 py-1 rounded-full bg-amber-500/10 text-amber-400 text-[10px] font-bold tracking-widest uppercase">Paused</span>
                        @else
                        <span class="px-3 py-1 rounded-full bg-surface-container-highest text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">{{ ucfirst($project->status) }}</span>
                        @endif
                    </div>
                    <h3 class="text-xl font-headline font-bold text-on-surface mb-1 group-hover:text-primary transition-colors">{{ $project->name }}</h3>
                    <p class="text-xs text-on-surface-variant mb-8">{{ $client->name }} • {{ $project->priority }}</p>
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between text-[10px] text-on-surface-variant font-bold uppercase tracking-widest mb-2">
                                <span>Deadline</span>
                                <span>Status</span>
                            </div>
                            <div class="flex justify-between font-semibold text-sm">
                                <span>{{ $project->end_date ? format_user_time($project->end_date, 'M d') : 'TBD' }}</span>
                                <span class="text-primary">{{ ucfirst($project->status) }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest mb-2">Completion</p>
                            <div class="h-1.5 w-full bg-surface-container-lowest rounded-full overflow-hidden">
                                <div class="h-full bg-primary {{ $project->status === 'completed' ? 'w-full' : 'w-[45%]' }} rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </section>
        </div>
    </main>
</body>

</html>
