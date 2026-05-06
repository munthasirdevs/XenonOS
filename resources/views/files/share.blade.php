<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shared File - XenonOS</title>
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
                        'error': '#f87171',
                        'emerald-400': '#34d399',
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

<body class="flex min-h-screen bg-surface font-body">
    <main class="flex-1 min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            @if(session('requires_password'))
            <div class="bg-surface-container rounded-3xl p-8 shadow-2xl">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-primary text-3xl">lock</span>
                    </div>
                    <h2 class="text-2xl font-headline font-bold text-on-surface">Password Required</h2>
                    <p class="text-on-surface-variant mt-2">Enter password to access this file</p>
                </div>
                <form method="GET" action="{{ route('files.share.view', $file->share_hash) }}">
                    <input type="password" name="password" required class="w-full bg-surface-container-low text-on-surface rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary mb-4" placeholder="Enter password">
                    <button type="submit" class="w-full bg-primary text-on-primary font-bold py-3 rounded-xl">Access File</button>
                </form>
            </div>
            @elseif($file->share_expires_at && now()->gt($file->share_expires_at))
            <div class="bg-surface-container rounded-3xl p-8 shadow-2xl text-center">
                <div class="w-16 h-16 bg-error/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-error text-3xl">schedule</span>
                </div>
                <h2 class="text-2xl font-headline font-bold text-on-surface">Link Expired</h2>
                <p class="text-on-surface-variant mt-2">This share link has expired and is no longer valid.</p>
            </div>
            @elseif($file->share_views_limit && $file->share_views_used >= $file->share_views_limit)
            <div class="bg-surface-container rounded-3xl p-8 shadow-2xl text-center">
                <div class="w-16 h-16 bg-error/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-error text-3xl">visibility_off</span>
                </div>
                <h2 class="text-2xl font-headline font-bold text-on-surface">View Limit Reached</h2>
                <p class="text-on-surface-variant mt-2">This share link has reached its view limit.</p>
            </div>
            @else
            <div class="bg-surface-container rounded-3xl p-8 shadow-2xl">
                <div class="flex items-center gap-4 mb-6">
                    @php $mime = $file->mime_type ?? ''; @endphp
                    @if(str_contains($mime, 'pdf'))
                    <div class="w-14 h-14 bg-error/10 rounded-xl flex items-center justify-center text-error">
                        <span class="material-symbols-outlined text-2xl">picture_as_pdf</span>
                    </div>
                    @elseif(str_contains($mime, 'image'))
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-2xl">image</span>
                    </div>
                    @else
                    <div class="w-14 h-14 bg-on-surface-variant/10 rounded-xl flex items-center justify-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-2xl">insert_drive_file</span>
                    </div>
                    @endif
                    <div>
                        <h2 class="text-xl font-headline font-bold text-on-surface">{{ $file->name }}</h2>
                        <p class="text-sm text-on-surface-variant">{{ number_format($file->size / 1024, 1) }} KB</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Type</span>
                        <span class="text-on-surface">{{ $mime ?: 'File' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Uploaded</span>
                        <span class="text-on-surface">{{ $file->created_at->format('M d, Y') }}</span>
                    </div>
                    @if($file->share_expires_at)
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Expires</span>
                        <span class="text-on-surface">{{ $file->share_expires_at->format('M d, Y H:i') }}</span>
                    </div>
                    @endif
                    @if($file->share_views_limit)
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Views remaining</span>
                        <span class="text-on-surface">{{ $file->share_views_limit - $file->share_views_used }}</span>
                    </div>
                    @endif
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('files.share.download', $file->share_hash) }}" class="flex-1 bg-primary text-on-primary font-bold py-3 rounded-xl text-center flex items-center justify-center gap-2 hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined">download</span>
                        @if($file->share_access === 'download')
                        Download
                        @else
                        View
                        @endif
                    </a>
                </div>

                <p class="text-xs text-center text-on-surface-variant mt-4">
                    Shared via XenonOS
                </p>
            </div>
            @endif
        </div>
    </main>
</body>

</html>