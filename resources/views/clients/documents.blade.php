<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $client->name ?? 'Client' }} - Documents | XenonOS</title>

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

            <section class="mb-6 sm:mb-8 md:mb-10">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 sm:gap-8">
                    <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-6 md:gap-8 flex-1 min-w-0">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 rounded-xl bg-surface-container border border-outline-variant/10 overflow-hidden shadow-2xl flex-shrink-0">
                            <img class="w-full h-full object-cover"
                                src="{{ $client->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name ?? 'Client') . '&background=818cf8&color=fff&size=128' }}"
                                alt="{{ $client->name }} logo" />
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-2">
                                <span class="px-2 py-0.5 sm:px-3 sm:py-1 rounded text-[10px] sm:text-xs font-bold tracking-widest bg-primary/10 text-primary uppercase whitespace-nowrap">{{ $client->status ?? 'active' }}</span>
                                <span class="text-on-surface-variant text-xs sm:text-sm font-medium">ID: CL-{{ str_pad($client->id ?? 0, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <h2 class="text-3xl sm:text-4xl md:text-5xl font-headline font-extrabold tracking-tight text-on-surface leading-tight break-words">
                                {{ $client->name }}
                            </h2>
                            <p class="text-on-surface-variant mt-2 max-w-xl font-light text-sm sm:text-base leading-relaxed">
                                {{ $client->company ?? 'No company' }} · {{ $client->email }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="px-6 py-3 rounded-xl bg-surface-container border border-outline-variant/20 font-semibold text-on-surface hover:bg-surface-container-high transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">upload</span>
                            Upload
                        </button>
                    </div>
                </div>

                <div class="flex gap-10 border-b border-outline-variant/10 pb-px mt-8">
                    <a href="{{ route('clients.show', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors relative">Overview</a>
                    <a href="{{ route('clients.projects', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors">Projects</a>
                    <a href="{{ route('clients.activity', $client->id) }}" class="pb-4 text-on-surface-variant font-medium hover:text-on-surface transition-colors">Activity</a>
                    <a href="{{ route('clients.documents', $client->id) }}" class="pb-4 text-primary font-bold transition-colors relative">Documents<span class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-t-full"></span></a>
                </div>
            </section>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($documents as $doc)
                <div class="bg-surface-container rounded-2xl p-6 hover:bg-surface-container-high transition-all group cursor-pointer">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-2xl">description</span>
                        </div>
                        <button class="text-on-surface-muted hover:text-on-surface p-2 rounded-lg hover:bg-surface-container-high transition-all">
                            <span class="material-symbols-outlined">more_vert</span>
                        </button>
                    </div>
                    <h3 class="text-on-surface font-bold mb-2 group-hover:text-primary transition-colors">{{ $doc->name ?? 'Document' }}</h3>
                    <p class="text-xs text-on-surface-muted mb-4">{{ $doc->size ?? '0 KB' }} · {{ $doc->created_at->format('M d, Y') }}</p>
                    <div class="flex items-center gap-2">
                        <button class="flex-1 px-4 py-2 rounded-lg bg-surface-container-low text-on-surface-variant text-sm font-medium hover:bg-surface-container-high hover:text-on-surface transition-all">
                            Download
                        </button>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-surface-container rounded-2xl p-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-on-surface-muted mb-4">folder_off</span>
                    <p class="text-on-surface-variant text-lg mb-4">No documents uploaded yet</p>
                    <button class="px-6 py-3 rounded-xl bg-primary font-bold text-on-primary shadow-lg shadow-primary/20">
                        Upload First Document
                    </button>
                </div>
                @endforelse
            </div>
        </div>
    </main>
</body>

</html>