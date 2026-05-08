<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'XenonOS')</title>

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
                        'success': '#34d399',
                        'tertiary': '#c084fc',
                    },
                    fontFamily: {
                        headline: ['Syne', 'sans-serif'],
                        body: ['Outfit', 'sans-serif'],
                        label: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    @stack('styles')
</head>

<body class="flex min-h-screen bg-background text-on-surface antialiased">
    <x-navbar />

    <main class="flex-1 md:ml-[260px] min-h-screen transition-all duration-300">
        <div class="h-16 md:h-0"></div>
        <div class="p-6 md:p-8">
            @yield('content')
        </div>

        <footer class="px-6 md:px-8 py-6 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] text-on-surface-variant uppercase tracking-widest font-bold bg-surface/80 backdrop-blur-md">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(16,185,129,0.4)]"></span>
                    Systems Operational
                </span>
            </div>
            <div>&copy; {{ now()->year }} Xenon Studios</div>
        </footer>
    </main>

    <script src="{{ asset('js/api.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    @stack('scripts')
</body>

</html>