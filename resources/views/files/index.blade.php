<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager - XenonOS</title>
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
                        'error': '#f87171',
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
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</head>

<body class="flex min-h-screen bg-surface font-body">
    <x-navbar />

    <main class="flex-1 md:ml-[260px] min-h-screen">
        <div class="p-6 md:p-8">
            <!-- Section 3: Branding & File Upload -->
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-4xl font-headline font-light tracking-tight text-on-surface">File Manager</h1>
                    <p class="text-sm text-on-surface-variant mt-2">Manage and organize your project assets with precision.</p>
                </div>
                <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="flex gap-2">
                    @csrf
                    <label class="bg-primary text-on-primary px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-lg shadow-primary/10 cursor-pointer">
                        <span class="material-symbols-outlined">upload</span>
                        <span>Upload File</span>
                        <input type="file" name="file" class="hidden" onchange="this.form.submit()">
                    </label>
                </form>
            </div>

            <!-- Filters -->
            <div class="flex flex-wrap items-center gap-3 mb-6">
                <button class="flex items-center bg-surface-container-low px-4 py-2 rounded-xl text-xs font-medium text-on-surface-variant gap-2 hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined text-sm">folder</span>
                    <span>Project: All</span>
                </button>
                <button class="flex items-center bg-surface-container-low px-4 py-2 rounded-xl text-xs font-medium text-on-surface-variant gap-2 hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined text-sm">description</span>
                    <span>File Type: All</span>
                </button>
                <button class="flex items-center bg-surface-container-low px-4 py-2 rounded-xl text-xs font-medium text-on-surface-variant gap-2 hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                    <span>Date: This Month</span>
                </button>
                <div class="ml-auto flex items-center bg-surface-container-low p-1 rounded-xl">
                    <button class="p-2 rounded-lg bg-surface-bright text-primary">
                        <span class="material-symbols-outlined text-lg">format_list_bulleted</span>
                    </button>
                    <button class="p-2 rounded-lg text-slate-500 hover:text-slate-300">
                        <span class="material-symbols-outlined text-lg">grid_view</span>
                    </button>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-surface-container-low p-4 rounded-xl">
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Total Files</p>
                    <p class="text-2xl font-headline font-bold text-on-surface mt-1">{{ $stats['total_files'] }}</p>
                </div>
                <div class="bg-surface-container-low p-4 rounded-xl">
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Storage Used</p>
                    <p class="text-2xl font-headline font-bold text-on-surface mt-1">{{ number_format($stats['total_size'] / 1024 / 1024, 1) }} MB</p>
                </div>
                <div class="bg-surface-container-low p-4 rounded-xl">
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Uploaded This Month</p>
                    <p class="text-2xl font-headline font-bold text-primary mt-1">{{ $stats['this_month'] }}</p>
                </div>
            </div>

            <!-- File List -->
            <div class="bg-surface-container-low rounded-2xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] uppercase tracking-widest text-on-surface-variant/50 font-bold">
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Uploaded</th>
                            <th class="px-6 py-4">Size</th>
                            <th class="px-6 py-4 w-10"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($files as $file)
                        <tr class="hover:bg-surface-bright/50 cursor-pointer transition-colors border-b border-outline-variant/5 group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @php $mime = $file->mime_type ?? ''; @endphp
                                    @if(str_contains($mime, 'pdf'))
                                    <div class="w-10 h-10 rounded-lg bg-error/10 flex items-center justify-center text-error">
                                        <span class="material-symbols-outlined">picture_as_pdf</span>
                                    </div>
                                    @elseif(str_contains($mime, 'image'))
                                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined">image</span>
                                    </div>
                                    @else
                                    <div class="w-10 h-10 rounded-lg bg-on-surface-variant/10 flex items-center justify-center text-on-surface-variant">
                                        <span class="material-symbols-outlined">insert_drive_file</span>
                                    </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-on-surface">{{ $file->name }}</div>
                                        <div class="text-[10px] text-on-surface-variant">{{ $mime ?: 'File' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-on-surface-variant">
                                {{ $file->uploader?->name ?? 'Unknown' }}
                            </td>
                            <td class="px-6 py-4 text-on-surface-variant">
                                {{ $file->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-on-surface-variant">
                                {{ number_format($file->size / 1024, 1) }} KB
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" onclick="openShareModal({{ $file->id }})" class="p-2 hover:bg-surface-container-high rounded-lg transition-colors" title="Share">
                                        <span class="material-symbols-outlined text-primary text-sm">share</span>
                                    </button>
                                    <form method="POST" action="{{ route('files.destroy', $file->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 hover:bg-surface-container-high rounded-lg transition-colors" title="Delete">
                                            <span class="material-symbols-outlined text-error text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <p class="text-on-surface-variant">No files uploaded yet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Share Modal -->
    <div id="share-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeShareModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-surface-container rounded-3xl shadow-2xl p-6">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-bold text-on-surface">Share File</h3>
                <button type="button" onclick="closeShareModal()" class="p-2 hover:bg-surface-container-high rounded-xl transition-colors">
                    <span class="material-symbols-outlined text-on-surface">close</span>
                </button>
            </div>

            <div id="share-options">
                <div class="space-y-4">
                    <!-- Expiration -->
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Expiration</label>
                        <select id="share-expiration" class="w-full bg-surface-container-low text-on-surface text-sm rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary appearance-none cursor-pointer">
                            <option value="never">No expiry</option>
                            <option value="1h">1 Hour</option>
                            <option value="1d">1 Day</option>
                            <option value="7d">7 Days</option>
                            <option value="30d">30 Days</option>
                        </select>
                    </div>

                    <!-- Password Toggle -->
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Password Protection</label>
                        <div class="flex items-center gap-3 p-3 bg-surface-container-low rounded-xl">
                            <input type="checkbox" id="share-password-enable" class="w-4 h-4 rounded" onchange="togglePasswordField()">
                            <span class="text-sm text-on-surface">Require password</span>
                        </div>
                        <input type="password" id="share-password" class="w-full bg-surface-container-low text-on-surface text-sm rounded-xl py-3 px-4 mt-2 border-0 focus:ring-2 focus:ring-primary hidden" placeholder="Enter password (min 4 chars)">
                    </div>

                    <!-- Views Limit -->
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">View Limit</label>
                        <select id="share-views" class="w-full bg-surface-container-low text-on-surface text-sm rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary appearance-none cursor-pointer">
                            <option value="unlimited">Unlimited</option>
                            <option value="1">1 view</option>
                            <option value="5">5 views</option>
                            <option value="10">10 views</option>
                        </select>
                    </div>

                    <!-- Access -->
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Access</label>
                        <div class="flex gap-2">
                            <button type="button" id="access-view" class="flex-1 py-2 px-3 rounded-lg bg-primary text-on-primary text-sm font-medium" onclick="setAccess('view')">View only</button>
                            <button type="button" id="access-download" class="flex-1 py-2 px-3 rounded-lg bg-surface-container-low text-on-surface-variant text-sm font-medium" onclick="setAccess('download')">Download</button>
                        </div>
                    </div>

                    <button type="button" onclick="generateShareLink()" id="generate-btn" class="w-full bg-primary hover:bg-primary/90 text-on-primary font-semibold py-3 rounded-xl transition-all">Generate Link</button>
                </div>
            </div>

            <div id="share-result" class="hidden space-y-4 pt-4">
                <p class="text-sm text-on-surface-variant">Share link:</p>
                <div class="flex items-center gap-2">
                    <input type="text" id="share-link" readonly class="flex-1 bg-surface-container-low text-on-surface text-sm font-mono rounded-xl py-3 px-4 border-0">
                    <button type="button" onclick="copyShareLink()" class="p-3 bg-surface-container hover:bg-surface-container-high rounded-xl transition-colors">
                        <span class="material-symbols-outlined text-primary">content_copy</span>
                    </button>
                </div>
                <button type="button" onclick="closeShareResult()" class="w-full py-2 text-sm text-on-surface-variant hover:underline">Generate new link</button>
            </div>
        </div>
    </div>

    <script>
        let currentFileId = null;
        let currentAccess = 'view';

        function togglePasswordField() {
            const enable = document.getElementById('share-password-enable');
            const password = document.getElementById('share-password');
            if (enable.checked) {
                password.classList.remove('hidden');
            } else {
                password.classList.add('hidden');
            }
        }

        function setAccess(access) {
            currentAccess = access;
            document.getElementById('access-view').className = access === 'view' ? 'flex-1 py-2 px-3 rounded-lg bg-primary text-on-primary text-sm font-medium' : 'flex-1 py-2 px-3 rounded-lg bg-surface-container-low text-on-surface-variant text-sm font-medium';
            document.getElementById('access-download').className = access === 'download' ? 'flex-1 py-2 px-3 rounded-lg bg-primary text-on-primary text-sm font-medium' : 'flex-1 py-2 px-3 rounded-lg bg-surface-container-low text-on-surface-variant text-sm font-medium';
        }

        function openShareModal(fileId) {
            currentFileId = fileId;
            document.getElementById('share-modal').classList.remove('hidden');
            document.getElementById('share-options').classList.remove('hidden');
            document.getElementById('share-result').classList.add('hidden');
            document.getElementById('share-password-enable').checked = false;
            document.getElementById('share-password').classList.add('hidden');
            setAccess('view');
        }

        function closeShareModal() {
            document.getElementById('share-modal').classList.add('hidden');
        }

        function closeShareResult() {
            document.getElementById('share-options').classList.remove('hidden');
            document.getElementById('share-result').classList.add('hidden');
        }

        function generateShareLink() {
            const btn = document.getElementById('generate-btn');
            btn.disabled = true;
            btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Generating...';

            const expiration = document.getElementById('share-expiration').value;
            const password = document.getElementById('share-password-enable').checked ? document.getElementById('share-password').value : null;
            const views = document.getElementById('share-views').value;

            fetch('/files/' + currentFileId + '/share', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    expiration: expiration,
                    password: password,
                    views_limit: views,
                    access: currentAccess
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('share-link').value = data.share_url;
                    document.getElementById('share-options').classList.add('hidden');
                    document.getElementById('share-result').classList.remove('hidden');
                } else {
                    alert(data.message || 'Error generating link');
                }
            })
            .catch(err => {
                alert('Error generating link');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = 'Generate Link';
            });
        }

        function copyShareLink() {
            const link = document.getElementById('share-link').value;
            navigator.clipboard.writeText(link).then(() => {
                const btn = event.target.closest('button');
                btn.innerHTML = '<span class="material-symbols-outlined text-emerald-400">check</span>';
                setTimeout(() => {
                    btn.innerHTML = '<span class="material-symbols-outlined text-primary">content_copy</span>';
                }, 2000);
            });
        }
    </script>
</body>

</html>