<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $client->name }} - XenonOS</title>
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
                        'on-surface-muted': '#64748b',
                        'outline': '#475569',
                        'outline-variant': '#464554',
                        'error': '#ffb4ab',
                        'emerald-400': '#34d399',
                        'amber-400': '#fbbf24',
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
    <link rel="stylesheet" href="{{ asset('css/xenon.css') }}">
    <style>
        .d-none { display: none !important; }
        .timeline-line { position: absolute; left: 20px; top: 0; bottom: 0; width: 2px; background: linear-gradient(180deg, #818cf8 0%, rgba(129, 140, 248, 0.1) 100%); }
        .timeline-dot { position: absolute; left: 12px; top: 8px; width: 18px; height: 18px; border-radius: 50%; }
    </style>
</head>

<body class="flex min-h-screen bg-surface font-body">
    <x-navbar />

    <main class="flex-1 md:ml-[260px] min-h-screen">
        <div class="p-6 md:p-8">

            <!-- MASTER HEADER -->
            <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
                <div class="space-y-1.5 sm:space-y-2">
                    <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-6">
                        <!-- Client Logo -->
                        <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-xl sm:rounded-2xl bg-surface-container-highest flex items-center justify-center text-primary border border-outline-variant/10 shadow-xl overflow-hidden flex-shrink-0">
                            <img alt="{{ $client->name }} Logo" class="w-full h-full object-cover" src="{{ $client->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name) . '&background=818cf8&color=fff&size=128' }}" />
                        </div>
                        <!-- Client Details -->
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-2">
                                @if($client->tier === 'premium')
                                <span class="px-2 sm:px-3 py-1 bg-primary/10 text-primary text-[9px] sm:text-[10px] font-bold uppercase tracking-widest rounded-full border border-primary/20 flex-shrink-0">Priority A</span>
                                @elseif($client->tier === 'standard')
                                <span class="px-2 sm:px-3 py-1 bg-secondary/10 text-secondary text-[9px] sm:text-[10px] font-bold uppercase tracking-widest rounded-full border border-secondary/20 flex-shrink-0">Standard</span>
                                @else
                                <span class="px-2 sm:px-3 py-1 bg-on-surface-variant/10 text-on-surface-variant text-[9px] sm:text-[10px] font-bold uppercase tracking-widest rounded-full border border-on-surface-variant/20 flex-shrink-0">Basic</span>
                                @endif
                                <span class="text-on-surface-variant text-xs sm:text-sm font-medium">ID: CL-{{ str_pad($client->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface truncate">{{ $client->name }}</h1>
                            <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed mt-2">{{ $client->company ?? 'No company description' }}</p>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-xs sm:text-sm text-on-surface-variant mt-2">
                                @if($client->website)
                                <span class="flex items-center gap-1 min-h-[44px] sm:min-h-0"><span class="material-symbols-outlined text-sm flex-shrink-0">language</span><span class="truncate">{{ $client->website }}</span></span>
                                @endif
                                @if($client->location)
                                <span class="flex items-center gap-1 min-h-[44px] sm:min-h-0"><span class="material-symbols-outlined text-sm flex-shrink-0">location_on</span><span class="truncate">{{ $client->location }}</span></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex flex-row sm:flex-col lg:flex-row gap-3 flex-shrink-0 w-full sm:w-auto">
                    <button class="min-h-[44px] sm:flex-none px-4 sm:px-6 py-3 rounded-xl bg-surface-container border border-outline-variant/20 text-on-surface font-medium text-sm hover:bg-surface-container-high hover:border-outline-variant/30 active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm flex-shrink-0">edit</span>
                        <span class="hidden sm:inline">Edit Profile</span>
                    </button>
                    <button class="min-h-[44px] sm:flex-none px-6 py-3 rounded-xl bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold text-sm shadow-lg shadow-primary/20 hover:shadow-primary/30 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm flex-shrink-0">mail</span>
                        <span class="hidden sm:inline">Message</span>
                    </button>
                </div>
            </header>
            <!-- END MASTER HEADER -->

            <!-- MASTER TAB NAVIGATION -->
            <nav class="mb-6 sm:mb-8 md:mb-10 border-b border-outline-variant/10" aria-label="Client sections">
                <div class="flex gap-4 sm:gap-6 md:gap-8 overflow-x-auto pb-1" role="tablist">
                    <button data-tab="overview" class="client-tab pb-3 sm:pb-4 text-primary font-bold text-sm whitespace-nowrap border-b-2 border-primary cursor-pointer" role="tab" aria-selected="true">Overview</button>
                    <button data-tab="projects" class="client-tab pb-3 sm:pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap transition-colors duration-200 hover:text-on-surface cursor-pointer" role="tab" aria-selected="false">Projects ({{ $stats['total_projects'] }})</button>
                    <button data-tab="activity" class="client-tab pb-3 sm:pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap transition-colors duration-200 hover:text-on-surface cursor-pointer" role="tab" aria-selected="false">Activity</button>
                    <button data-tab="documents" class="client-tab pb-3 sm:pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap transition-colors duration-200 hover:text-on-surface cursor-pointer" role="tab" aria-selected="false">Documents</button>
                </div>
            </nav>
            <!-- END TAB NAV -->

            <!-- BODY PANELS -->

            <!-- PANEL: OVERVIEW (default visible) -->
            <div id="panel-overview" class="client-panel" data-panel="overview">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-8">
                    <!-- Main Content (8 cols) -->
                    <div class="lg:col-span-8 space-y-5 sm:space-y-6">
                        <!-- Quick Stats -->
                        <section class="bg-surface-container-low p-3 sm:p-4 md:p-5 rounded-2xl sm:rounded-3xl shadow-sm" aria-label="Quick stats">
                            <h3 class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-4 sm:mb-5">Quick Stats</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                                <div class="p-3 sm:p-4 bg-surface-container rounded-xl sm:rounded-2xl">
                                    <p class="text-[10px] text-on-surface-variant mb-1">Total Projects</p>
                                    <p class="text-xl sm:text-2xl font-headline font-bold text-on-surface">{{ $stats['total_projects'] }}</p>
                                </div>
                                <div class="p-3 sm:p-4 bg-surface-container rounded-xl sm:rounded-2xl">
                                    <p class="text-[10px] text-on-surface-variant mb-1">Active Projects</p>
                                    <p class="text-xl sm:text-2xl font-headline font-bold text-emerald-400">{{ $stats['active_projects'] }}</p>
                                </div>
                                <div class="p-3 sm:p-4 bg-surface-container rounded-xl sm:rounded-2xl">
                                    <p class="text-[10px] text-on-surface-variant mb-1">Total Revenue</p>
                                    <p class="text-xl sm:text-2xl font-headline font-bold text-on-surface">${{ number_format($client->total_revenue ?? 0, 0) }}</p>
                                </div>
                            </div>
                        </section>

                        <!-- Recent Projects -->
                        <section class="bg-surface-container-low p-3 sm:p-4 md:p-5 rounded-2xl sm:rounded-3xl">
                            <div class="flex justify-between items-center mb-4 sm:mb-5">
                                <h3 class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Recent Projects</h3>
                            </div>
                            <div class="space-y-3">
                                @forelse($recentProjects as $project)
                                <div class="flex items-center justify-between p-3 sm:p-4 bg-surface-container rounded-xl hover:bg-surface-container-high transition-colors">
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                            <span class="material-symbols-outlined text-lg">folder</span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-on-surface text-sm">{{ $project->name }}</p>
                                            <p class="text-xs text-on-surface-variant">{{ $project->description ?? 'No description' }}</p>
                                        </div>
                                    </div>
                                    @if($project->status === 'active')
                                    <span class="px-2 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400">Active</span>
                                    @elseif($project->status === 'completed')
                                    <span class="px-2 py-1 rounded-full text-[10px] font-bold bg-blue-500/10 text-blue-400">Completed</span>
                                    @else
                                    <span class="px-2 py-1 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-400">{{ ucfirst($project->status) }}</span>
                                    @endif
                                </div>
                                @empty
                                <p class="text-on-surface-variant text-center py-8">No projects yet</p>
                                @endforelse
                            </div>
                        </section>
                    </div>

                    <!-- Sidebar (4 cols) -->
                    <div class="lg:col-span-4 space-y-5 sm:space-y-6">
                        <!-- Client Info -->
                        <section class="bg-surface-container-low p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl">
                            <h3 class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-4">Client Info</h3>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-on-surface-variant">mail</span>
                                    <div>
                                        <p class="text-[10px] text-on-surface-variant">Email</p>
                                        <p class="text-sm text-on-surface">{{ $client->email }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-on-surface-variant">phone</span>
                                    <div>
                                        <p class="text-[10px] text-on-surface-variant">Phone</p>
                                        <p class="text-sm text-on-surface">{{ $client->phone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                @if($client->location)
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-on-surface-variant">location_on</span>
                                    <div>
                                        <p class="text-[10px] text-on-surface-variant">Location</p>
                                        <p class="text-sm text-on-surface">{{ $client->location }}</p>
                                    </div>
                                </div>
                                @endif
                                @if($client->website)
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-on-surface-variant">language</span>
                                    <div>
                                        <p class="text-[10px] text-on-surface-variant">Website</p>
                                        <p class="text-sm text-primary">{{ $client->website }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- END PANEL: OVERVIEW -->

            <!-- PANEL: PROJECTS (hidden) -->
            <div id="panel-projects" class="client-panel d-none" data-panel="projects">
                <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @forelse($recentProjects as $project)
                    <div class="bg-surface-container rounded-[1.5rem] p-4 sm:p-6 hover:bg-surface-container-high transition-all duration-400 group">
                        <div class="flex items-center justify-between mb-4">
                            @if($project->status === 'active')
                            <span class="text-xs font-bold text-emerald-400 bg-emerald-400/10 px-2 py-1 rounded">ACTIVE</span>
                            @elseif($project->status === 'completed')
                            <span class="text-xs font-bold text-blue-400 bg-blue-400/10 px-2 py-1 rounded">COMPLETED</span>
                            @else
                            <span class="text-xs font-bold text-amber-400 bg-amber-400/10 px-2 py-1 rounded">{{ strtoupper($project->status) }}</span>
                            @endif
                            <span class="material-symbols-outlined text-on-surface-variant">more_vert</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-headline font-bold text-on-surface mb-2">{{ $project->name }}</h3>
                        <p class="text-on-surface-variant text-sm mb-4">{{ $project->description ?? 'No description' }}</p>
                        @if($project->end_date)
                        <div class="flex justify-between text-xs text-on-surface-variant mb-3">
                            <span>Due: {{ $project->end_date->format('M d, Y') }}</span>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="col-span-full bg-surface-container-low rounded-2xl p-8 text-center">
                        <p class="text-on-surface-variant">No projects yet</p>
                    </div>
                    @endforelse
                </section>
            </div>
            <!-- END PANEL: PROJECTS -->

            <!-- PANEL: ACTIVITY (hidden) -->
            <div id="panel-activity" class="client-panel d-none" data-panel="activity">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-8">
                    <!-- Activity Timeline (8 cols) -->
                    <div class="lg:col-span-8 space-y-5 sm:space-y-6">
                        <!-- Filter Bar -->
                        <section class="bg-surface-container-low p-3 sm:p-4 md:p-5 rounded-2xl sm:rounded-3xl shadow-sm" aria-label="Activity filters">
                            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                                <button class="flex items-center gap-2 px-3 py-2.5 sm:py-3 bg-surface-container hover:bg-surface-container-high active:scale-[0.96] rounded-xl sm:rounded-2xl transition-all duration-150 min-h-[44px] min-w-[44px] flex-1 sm:flex-none justify-between sm:justify-start">
                                    <span class="material-symbols-outlined text-base text-on-surface-variant flex-shrink-0">calendar_today</span>
                                    <span class="text-on-surface font-medium text-sm truncate">Last 30 Days</span>
                                    <span class="material-symbols-outlined text-base text-on-surface-variant flex-shrink-0">expand_more</span>
                                </button>
                                <button class="flex items-center gap-2 px-3 py-2.5 sm:py-3 bg-surface-container hover:bg-surface-container-high active:scale-[0.96] rounded-xl sm:rounded-2xl transition-all duration-150 min-h-[44px] min-w-[44px] flex-1 sm:flex-none justify-between sm:justify-start">
                                    <span class="material-symbols-outlined text-base text-on-surface-variant flex-shrink-0">filter_list</span>
                                    <span class="text-on-surface font-medium text-sm truncate">Type: All</span>
                                    <span class="material-symbols-outlined text-base text-on-surface-variant flex-shrink-0">expand_more</span>
                                </button>
                                <div class="text-[10px] uppercase tracking-widest text-on-surface-variant font-bold px-3 py-2.5 sm:py-3 min-h-[44px] flex items-center whitespace-nowrap">{{ $activities->count() }} Events</div>
                            </div>
                        </section>

                        <!-- Timeline Items -->
                        <div class="relative pl-8 sm:pl-10 md:pl-12" role="feed" aria-label="Activity timeline">
                            @forelse($activities as $activity)
                            <article class="relative mb-6 sm:mb-8 sm:group" aria-label="Activity item">
                                <div class="timeline-dot bg-surface border-2 border-primary sm:group-hover:scale-110 transition-transform" aria-hidden="true"></div>
                                <div class="timeline-content bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-5 md:p-6 shadow-sm hover:border-primary/20 transition-all duration-400">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-primary text-lg">history</span>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <h3 class="text-sm font-bold text-on-surface leading-tight">{{ $activity->description ?? 'Activity recorded' }}</h3>
                                            <p class="text-[11px] text-on-surface-variant mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @empty
                            <p class="text-on-surface-variant text-center py-8">No activity yet</p>
                            @endforelse
                        </div>
                    </div>
                    <!-- Activity Sidebar (4 cols) -->
                    <div class="lg:col-span-4 space-y-5 sm:space-y-6">
                        <section class="bg-surface-container-low p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl">
                            <h3 class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-4">Search Activity</h3>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
                                <input type="search" placeholder="Search logs..." class="w-full bg-surface-container text-on-surface text-sm rounded-xl pl-10 pr-4 py-2.5 border-0 focus:ring-2 focus:ring-primary">
                            </div>
                        </section>
                        <section class="bg-surface-container-low p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl">
                            <h3 class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-4">Export Data</h3>
                            <button class="w-full py-2.5 bg-surface-container hover:bg-surface-container-high rounded-xl text-xs font-medium transition-colors">Export CSV</button>
                        </section>
                    </div>
                </div>
            </div>
            <!-- END PANEL: ACTIVITY -->

            <!-- PANEL: DOCUMENTS (hidden) -->
            <div id="panel-documents" class="client-panel d-none" data-panel="documents">
                <div class="space-y-6 sm:space-y-8">
                    <!-- Upload Zone -->
                    <section class="relative group" aria-label="File upload area">
                        <form id="upload-form" enctype="multipart/form-data" class="relative">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-primary/20 to-tertiary/20 rounded-xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-1000 pointer-events-none"></div>
                            <label class="relative block border-2 border-dashed border-outline-variant/30 rounded-xl p-8 sm:p-12 text-center hover:border-primary/50 transition-colors cursor-pointer">
                                <input type="file" name="file" id="file-input" class="hidden" accept="*/*" onchange="handleFileSelect(this)">
                                <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-4">cloud_upload</span>
                                <p class="text-on-surface font-medium mb-2" id="upload-text">Drag & drop files here</p>
                                <p class="text-on-surface-variant text-sm">or <span class="text-primary">browse</span> to upload</p>
                            </label>
                        </form>
                    </section>
                    
                    <!-- Upload Progress -->
                    <div id="upload-progress" class="hidden bg-surface-container-low rounded-2xl p-4">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-primary animate-spin">sync</span>
                            <p class="text-sm text-on-surface" id="upload-status">Uploading...</p>
                        </div>
                        <div class="h-2 bg-surface-container-highest rounded-full overflow-hidden">
                            <div id="progress-bar" class="h-full bg-primary rounded-full transition-all" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Upload Result -->
                    <div id="upload-result" class="hidden"></div>

                    <!-- Documents Grid -->
                    <section class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-on-surface">All Files</h3>
                            <p class="text-xs text-on-surface-variant">{{ $documents->count() }} files</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="p-2 bg-surface-container rounded-lg hover:bg-surface-container-high transition-colors"><span class="material-symbols-outlined text-on-surface-variant text-sm">grid_view</span></button>
                            <button class="p-2 bg-surface-container-high rounded-lg hover:bg-surface-container-high transition-colors"><span class="material-symbols-outlined text-on-surface-variant text-sm">list</span></button>
                        </div>
                    </section>
                    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="documents-grid">
                        @forelse($documents as $doc)
                        <div class="bg-surface-container rounded-2xl p-4 hover:bg-surface-container-high transition-colors cursor-pointer">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-3">
                                <span class="material-symbols-outlined text-primary">description</span>
                            </div>
                            <p class="text-sm font-medium text-on-surface truncate">{{ $doc->title ?? 'Document' }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $doc->created_at->format('M d, Y') }}</p>
                        </div>
                        @empty
                        <div class="col-span-full bg-surface-container-low rounded-2xl p-8 text-center">
                            <p class="text-on-surface-variant">No documents yet</p>
                        </div>
                        @endforelse
                    </section>
                </div>
            </div>
            <!-- END PANEL: DOCUMENTS -->

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.client-tab');
            const panels = document.querySelectorAll('.client-panel');

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = tab.dataset.tab;
                    if (!target) return;

                    tabs.forEach(t => {
                        t.classList.remove('text-primary', 'font-bold', 'border-b-2', 'border-primary');
                        t.classList.add('text-on-surface-variant', 'font-medium');
                        t.setAttribute('aria-selected', 'false');
                    });

                    tab.classList.remove('text-on-surface-variant', 'font-medium');
                    tab.classList.add('text-primary', 'font-bold', 'border-b-2', 'border-primary');
                    tab.setAttribute('aria-selected', 'true');

                    panels.forEach(panel => {
                        if (panel.dataset.panel === target) {
                            panel.classList.remove('d-none');
                        } else {
                            panel.classList.add('d-none');
                        }
                    });
                });
            });
        });

        // File Upload Handler
        function handleFileSelect(input) {
            const file = input.files[0];
            if (!file) return;

            const clientId = {{ $client->id }};
            const formData = new FormData();
            formData.append('file', file);
            formData.append('title', file.name);

            const progressDiv = document.getElementById('upload-progress');
            const progressBar = document.getElementById('progress-bar');
            const uploadStatus = document.getElementById('upload-status');
            const uploadText = document.getElementById('upload-text');
            const resultDiv = document.getElementById('upload-result');

            progressDiv.classList.remove('hidden');
            uploadText.textContent = 'Uploading ' + file.name + '...';
            progressBar.style.width = '30%';

            fetch('/clients/' + clientId + '/documents', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                progressBar.style.width = '100%';
                uploadStatus.textContent = 'Upload complete!';
                
                if (data.success) {
                    // Add new document to grid
                    const grid = document.getElementById('documents-grid');
                    const emptyDiv = grid.querySelector('.col-span-full');
                    if (emptyDiv) emptyDiv.remove();

                    const doc = data.document;
                    const newDoc = document.createElement('div');
                    newDoc.className = 'bg-surface-container rounded-2xl p-4 hover:bg-surface-container-high transition-colors cursor-pointer';
                    newDoc.innerHTML = `
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-3">
                            <span class="material-symbols-outlined text-primary">description</span>
                        </div>
                        <p class="text-sm font-medium text-on-surface truncate">${doc.title || 'Document'}</p>
                        <p class="text-xs text-on-surface-variant">Just now</p>
                    `;
                    grid.insertBefore(newDoc, grid.firstChild);

                    // Reset form
                    input.value = '';
                    uploadText.textContent = 'File uploaded successfully!';
                } else {
                    uploadStatus.textContent = 'Upload failed: ' + (data.message || 'Unknown error');
                }

                setTimeout(() => {
                    progressDiv.classList.add('hidden');
                    uploadText.textContent = 'Drag & drop files here';
                    progressBar.style.width = '0%';
                }, 2000);
            })
            .catch(err => {
                progressBar.style.width = '100%';
                uploadStatus.textContent = 'Upload failed: Network error';
                setTimeout(() => {
                    progressDiv.classList.add('hidden');
                    progressBar.style.width = '0%';
                }, 3000);
            });
        }
    </script>
</body>

</html>