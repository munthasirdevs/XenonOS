<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'XenonOS')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Syne:wght@400..800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    @stack('styles')
</head>

<body class="flex min-h-screen bg-background text-on-surface antialiased">
    <x-navbar />

    <main id="main-content" class="flex-1 min-h-screen transition-all duration-300">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/swal-custom.js') }}"></script>
    <script src="{{ asset('js/api.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    @stack('scripts')
    
    @if(session('success'))
    <div data-flash-success="{{ session('success') }}"></div>
    @endif
    
    @if(session('error'))
    <div data-flash-error="{{ session('error') }}"></div>
    @endif
    
    @if(session('warning'))
    <div data-flash-warning="{{ session('warning') }}"></div>
    @endif
</body>

</html>