<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $client->name }} - Activity - XenonOS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/xenon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
    <style>
        .timeline-line {
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #464554 0%, transparent 100%);
        }

        .timeline-dot {
            position: absolute;
            left: 10px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
        }
    </style>
</head>

<body class="flex min-h-screen bg-surface">
    <x-navbar />

    <main class="flex-1 md:ml-[260px] min-h-screen">
        <div class="p-6 md:p-8">
            <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
                <div class="flex flex-col sm:flex-row items-start gap-6 flex-1">
                    <div class="w-20 h-20 rounded-2xl bg-surface-container-highest flex items-center justify-center text-primary border border-outline-variant/10 shadow-xl overflow-hidden flex-shrink-0">
                        <img alt="{{ $client->name }} Logo" class="w-full h-full object-cover" src="{{ $client->avatar_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuAdsutWN3dSe1C9s1z1T09w2CQEGzGY7NUXrrF9vIvSiGX-qHq-1Ty8SNDz5H2f2v-KN43tKSeYY4aZ94NQ52JcxBF1cr0Lk_A1YSQjb6Wcpo7wSiYM6ahtNkO7w6R1U2XZotD17laHQjivb70K0KIV8Ve_z0ttjpIjJ3hZZIO4OsNTyj63D42_pEcORgqBAFO80KhPsOJYmMpEJeIHNpeA3UidFUmqNqNY26f6fcdEIwAnXKtKTO7SU7r3dP3QEwudGqBULNSoYc' }}" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest rounded-full border border-primary/20">{{ $client->tier ?? 'standard' }}</span>
                            <span class="text-on-surface-variant text-sm font-medium">ID: CL-{{ str_pad($client->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-headline font-light tracking-tighter text-on-surface truncate">{{ $client->name }}</h1>
                        <p class="text-on-surface-variant text-sm max-w-lg mt-2">{{ $client->company }}</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('clients.show', $client->id) }}" class="min-h-[44px] px-6 py-3 rounded-xl bg-surface-container border border-outline-variant/20 text-on-surface font-medium text-sm hover:bg-surface-container-high transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        <span>Edit Profile</span>
                    </a>
                    <a href="#" class="min-h-[44px] px-6 py-3 rounded-xl bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold text-sm shadow-lg shadow-primary/20 hover:shadow-primary/30 hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">mail</span>
                        <span>Message</span>
                    </a>
                </div>
            </header>

            <nav class="mb-10 border-b border-outline-variant/10" aria-label="Client sections">
                <div class="flex gap-8 overflow-x-auto">
                    <a href="{{ route('clients.show', $client->id) }}" class="pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap hover:text-on-surface">Overview</a>
                    <a href="{{ route('clients.projects', $client->id) }}" class="pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap hover:text-on-surface">Projects</a>
                    <a href="{{ route('clients.activity', $client->id) }}" class="pb-4 text-primary font-bold text-sm whitespace-nowrap border-b-2 border-primary">Activity</a>
                    <a href="{{ route('clients.documents', $client->id) }}" class="pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap hover:text-on-surface">Documents</a>
                </div>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-8 space-y-6">
                    <section class="bg-surface-container-low p-5 rounded-3xl">
                        <div class="flex flex-wrap items-center gap-4">
                            <button class="flex items-center gap-2 px-3 py-3 bg-surface-container hover:bg-surface-container-high rounded-2xl transition-all min-h-[44px] flex-1 justify-between">
                                <span class="material-symbols-outlined text-base text-on-surface-variant">calendar_today</span>
                                <span class="text-on-surface font-medium text-sm">Last 30 Days</span>
                                <span class="material-symbols-outlined text-base text-on-surface-variant">expand_more</span>
                            </button>
                            <button class="flex items-center gap-2 px-3 py-3 bg-surface-container hover:bg-surface-container-high rounded-2xl transition-all min-h-[44px] flex-1 justify-between">
                                <span class="material-symbols-outlined text-base text-on-surface-variant">filter_list</span>
                                <span class="text-on-surface font-medium text-sm">Type: All</span>
                                <span class="material-symbols-outlined text-base text-on-surface-variant">expand_more</span>
                            </button>
                            <div class="text-[10px] uppercase tracking-widest text-on-surface-variant font-bold px-3 py-3 min-h-[44px] flex items-center">{{ $activities->total() }} Total Events</div>
                        </div>
                    </section>

                    <div class="relative pl-12 md:pl-12" role="feed" aria-label="Activity timeline">
                        <div class="timeline-line"></div>

                        @foreach($activities as $activity)
                        <article class="relative mb-8 group">
                            <div class="timeline-dot bg-surface border-2 border-primary group-hover:scale-110 transition-transform"></div>
                            <div class="ml-4 bg-surface-container-low rounded-3xl p-6 shadow-sm hover:border-primary/20 transition-all">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3 mb-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                            @if($activity->type === 'payment')
                                            <span class="material-symbols-outlined text-primary text-lg">payments</span>
                                            @elseif($activity->type === 'document')
                                            <span class="material-symbols-outlined text-primary text-lg">description</span>
                                            @elseif($activity->type === 'milestone')
                                            <span class="material-symbols-outlined text-primary text-lg">flag</span>
                                            @elseif($activity->type === 'contract')
                                            <span class="material-symbols-outlined text-primary text-lg">verified</span>
                                            @else
                                            <span class="material-symbols-outlined text-primary text-lg">article</span>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <h3 class="text-sm font-bold text-on-surface leading-tight">
                                                @if($activity->type === 'payment')
                                                <span class="text-emerald-400">Payment received</span>
                                                @else
                                                <span class="text-primary">{{ ucfirst($activity->type) }}</span> @endif
                                                - {{ $activity->description }}
                                            </h3>
                                            <p class="text-[11px] text-on-surface-variant mt-1">{{ $activity->created_at ? $activity->created_at->diffForHumans() : 'Recently' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endforeach

                        <div class="flex justify-center mt-10">
                            {{ $activities->links() }}
                        </div>
                    </div>
                </div>

                <aside class="lg:col-span-4 space-y-6">
                    <div class="p-6 bg-surface-container-low rounded-3xl">
                        <h2 class="text-sm font-headline font-bold text-on-surface mb-5 uppercase tracking-wider">Activity Distribution</h2>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-xs mb-2">
                                    <span class="text-on-surface-variant">Project Updates</span>
                                    <span class="text-on-surface font-bold">{{ $activityStats['project_updates'] }}%</span>
                                </div>
                                <div class="w-full h-2 bg-surface-container-lowest rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full" style="width: {{ $activityStats['project_updates'] }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-2">
                                    <span class="text-on-surface-variant">File Management</span>
                                    <span class="text-on-surface font-bold">{{ $activityStats['file_management'] }}%</span>
                                </div>
                                <div class="w-full h-2 bg-surface-container-lowest rounded-full overflow-hidden">
                                    <div class="h-full bg-secondary rounded-full" style="width: {{ $activityStats['file_management'] }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-2">
                                    <span class="text-on-surface-variant">Client Communication</span>
                                    <span class="text-on-surface font-bold">{{ $activityStats['client_communication'] }}%</span>
                                </div>
                                <div class="w-full h-2 bg-surface-container-lowest rounded-full overflow-hidden">
                                    <div class="h-full bg-tertiary rounded-full" style="width: {{ $activityStats['client_communication'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-surface-container-low rounded-3xl">
                        <h2 class="text-sm font-headline font-bold text-on-surface mb-5 uppercase tracking-wider">Quick Search</h2>
                        <div class="relative">
                            <input class="w-full bg-surface-container border border-outline-variant/10 rounded-2xl pl-4 pr-12 py-3 text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-on-surface-variant/50 min-h-[44px]" placeholder="Keywords, files, users..." type="search" />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant pointer-events-none">search</span>
                        </div>
                    </div>

                    <div class="p-6 bg-surface-container-low rounded-3xl border border-outline-variant/10 relative overflow-hidden group">
                        <span class="material-symbols-outlined text-primary text-3xl mb-4 block">summarize</span>
                        <h2 class="text-lg font-headline font-bold text-on-surface mb-2">Export Log</h2>
                        <p class="text-sm text-on-surface-variant leading-relaxed mb-6">Generate a comprehensive CSV or PDF activity report for stakeholders.</p>
                        <button class="w-full bg-surface-container-highest hover:bg-surface-variant active:scale-[0.98] text-on-surface py-3 px-4 rounded-2xl text-xs font-bold uppercase tracking-widest transition-all flex items-center justify-center gap-2 min-h-[48px]">
                            <span class="material-symbols-outlined text-sm">download</span>
                            Generate Report
                        </button>
                    </div>
                </aside>
            </div>
        </div>
    </main>
</body>

</html>
