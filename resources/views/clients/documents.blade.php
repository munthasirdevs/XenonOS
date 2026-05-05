<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $client->name }} - Documents - XenonOS</title>
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
                        'indigo-400': '#818cf8',
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

<body class="bg-background text-on-surface font-body">
    <x-navbar />

    <main class="flex-1 md:ml-[260px] min-h-screen">
        <div class="p-6 md:p-8">
            <section class="mb-6 sm:mb-10" aria-label="Client information">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 sm:gap-8">
                    <div class="flex flex-col sm:flex-row items-start gap-6 md:gap-8 flex-1 min-w-0">
                        <div class="w-24 h-24 md:w-28 md:h-28 rounded-xl bg-surface-container border border-outline-variant/10 overflow-hidden shadow-2xl flex-shrink-0">
                            <img class="w-full h-full object-cover" src="{{ $client->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name) . '&background=818cf8&color=fff&size=128' }}" alt="{{ $client->name }} company logo" />
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-2">
                                @if($client->tier === 'premium')
                                <span class="px-3 py-1 rounded text-[10px] font-bold tracking-widest bg-primary/10 text-primary uppercase whitespace-nowrap">Premium Tier</span>
                                @elseif($client->tier === 'standard')
                                <span class="px-3 py-1 rounded text-[10px] font-bold tracking-widest bg-secondary/10 text-secondary uppercase whitespace-nowrap">Standard</span>
                                @else
                                <span class="px-3 py-1 rounded text-[10px] font-bold tracking-widest bg-on-surface-variant/10 text-on-surface-variant uppercase whitespace-nowrap">Basic</span>
                                @endif
                                <span class="text-on-surface-variant text-sm font-medium">ID: CL-{{ str_pad($client->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <h2 class="text-4xl md:text-5xl font-headline font-extrabold tracking-tight text-on-surface leading-tight break-words">{{ $client->name }}</h2>
                            <p class="text-on-surface-variant mt-2 max-w-xl font-light text-sm leading-relaxed">{{ $client->company }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row sm:flex-col lg:flex-row gap-3 flex-shrink-0 w-full sm:w-auto">
                        <button class="min-h-[44px] px-6 py-3 rounded-xl bg-surface-container border border-outline-variant/20 text-on-surface font-medium text-sm hover:bg-surface-container-high transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">mail</span>
                            <span>Message</span>
                        </button>
                        <button class="min-h-[44px] px-6 py-3 rounded-xl bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold text-sm shadow-lg shadow-primary/20 hover:shadow-primary/30 hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span>
                            <span>Create Task</span>
                        </button>
                    </div>
                </div>
            </section>

            <nav class="mb-10 border-b border-outline-variant/10" aria-label="Client sections">
                <div class="flex gap-8 overflow-x-auto">
                    <a href="{{ route('clients.show', $client->id) }}" class="pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap hover:text-on-surface">Overview</a>
                    <a href="{{ route('clients.projects', $client->id) }}" class="pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap hover:text-on-surface">Projects</a>
                    <a href="{{ route('clients.activity', $client->id) }}" class="pb-4 text-on-surface-variant font-medium text-sm whitespace-nowrap hover:text-on-surface">Activity</a>
                    <a href="{{ route('clients.documents', $client->id) }}" class="pb-4 text-primary font-bold text-sm whitespace-nowrap border-b-2 border-primary">Documents</a>
                </div>
            </nav>

            <div class="space-y-8">
                <section class="flex flex-col sm:flex-row sm:items-center justify-between gap-4" aria-label="File manager controls">
                    <div class="flex items-center gap-4">
                        <h4 class="font-headline font-bold text-lg text-on-surface">Central Repository</h4>
                        <span class="px-3 py-1 bg-surface-container-highest text-on-surface-variant text-xs rounded-full font-medium">{{ $documents->count() }} Files</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex bg-surface-container-lowest rounded-lg p-1 border border-outline-variant/10 flex-shrink-0" role="radiogroup" aria-label="File view mode">
                            <button class="min-w-[40px] min-h-[40px] p-2 rounded-md bg-surface-container-high text-primary shadow-sm flex items-center justify-center" role="radio" aria-checked="true">
                                <span class="material-symbols-outlined text-base">grid_view</span>
                            </button>
                            <button class="min-w-[40px] min-h-[40px] p-2 rounded-md text-on-surface-variant hover:bg-surface-container flex items-center justify-center" role="radio" aria-checked="false">
                                <span class="material-symbols-outlined text-base">format_list_bulleted</span>
                            </button>
                        </div>
                        <select class="min-h-[44px] bg-surface-container border border-outline-variant/20 rounded-lg text-sm px-4 py-2 text-on-surface focus:ring-2 focus:ring-primary cursor-pointer">
                            <option>Sort by: Newest First</option>
                            <option>Sort by: Name (A-Z)</option>
                            <option>Sort by: File Size</option>
                        </select>
                        <button class="p-3 bg-surface-container-lowest border border-outline-variant/10 hover:bg-primary/10 hover:text-primary rounded-lg transition-colors flex items-center justify-center">
                            <span class="material-symbols-outlined text-sm">add</span>
                            <span class="text-sm">Add Files</span>
                        </button>
                    </div>
                </section>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5" role="list" aria-label="Client files">
                    @forelse($documents as $doc)
                    <article class="file-card group bg-surface-container rounded-xl p-6 border border-outline-variant/10 hover:border-outline-variant/20 hover:bg-surface-container-high transition-all duration-300 flex flex-col" role="listitem">
                        <div class="flex justify-between items-start mb-6">
                            @if(str_ends_with($doc->title, '.pdf'))
                            <div class="w-12 h-12 rounded-lg bg-red-500/10 flex items-center justify-center text-red-400">
                                <span class="material-symbols-outlined text-2xl">picture_as_pdf</span>
                            </div>
                            @elseif(str_ends_with($doc->title, '.xlsx') || str_ends_with($doc->title, '.xls'))
                            <div class="w-12 h-12 rounded-lg bg-green-500/10 flex items-center justify-center text-green-400">
                                <span class="material-symbols-outlined text-2xl">table_chart</span>
                            </div>
                            @elseif(str_ends_with($doc->title, '.docx') || str_ends_with($doc->title, '.doc'))
                            <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400">
                                <span class="material-symbols-outlined text-2xl">description</span>
                            </div>
                            @elseif(str_ends_with($doc->title, '.pptx') || str_ends_with($doc->title, '.ppt'))
                            <div class="w-12 h-12 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-400">
                                <span class="material-symbols-outlined text-2xl">present_to_all</span>
                            </div>
                            @else
                            <div class="w-12 h-12 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                                <span class="material-symbols-outlined text-2xl">folder</span>
                            </div>
                            @endif
                            <button class="min-w-[36px] min-h-[36px] p-2 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-highest transition-all">
                                <span class="material-symbols-outlined text-base">more_vert</span>
                            </button>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h5 class="font-headline font-bold text-base mb-1 truncate text-on-surface" title="{{ $doc->title }}">{{ $doc->title }}</h5>
                            <p class="text-xs text-on-surface-variant">Modified {{ $doc->created_at ? user_time_ago($doc->created_at) : 'Recently' }}</p>
                        </div>
                        <div class="mt-6 flex gap-2">
                            <button class="flex-1 min-h-[36px] py-2 bg-surface-container-lowest hover:bg-primary/10 hover:text-primary rounded-lg text-xs font-semibold transition-colors flex items-center justify-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                Preview
                            </button>
                            <button class="min-w-[36px] min-h-[36px] p-2 bg-surface-container-lowest hover:bg-primary/10 hover:text-primary rounded-lg transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-sm">download</span>
                            </button>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">folder_open</span>
                        <p class="text-on-surface-variant">No documents yet</p>
                    </div>
                    @endforelse
                </div>

                <section class="bg-surface-container-low rounded-xl p-8 border border-outline-variant/10" aria-label="Recently shared access">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                        <div>
                            <h4 class="font-headline font-bold text-xl text-on-surface">Recently Shared Access</h4>
                            <p class="text-on-surface-variant text-sm mt-1">Manage external stakeholders who can view these documents.</p>
                        </div>
                        <button class="text-primary text-sm font-bold hover:text-primary/80 hover:underline transition-colors self-start sm:self-auto min-h-[44px] px-4 flex items-center">
                            Manage All Access
                        </button>
                    </div>
                    <div class="space-y-3">
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>

</html>
