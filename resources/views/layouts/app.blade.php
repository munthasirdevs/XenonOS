<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        'surface-container-lowest': '#06080c',
                        'background': '#0b0e14',
                        'surface-container-highest': '#1a1d26',
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
                        label: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-headline { font-family: 'Syne', sans-serif; }
        .font-label { font-family: 'Outfit', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            font-size: 20px;
        }
        .active-icon {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #1e222c;
            border-radius: 10px;
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @stack('styles')
</head>

<body class="flex min-h-screen bg-background text-on-surface antialiased">
    <!-- Navbar -->
    <x-navbar />

    <!-- Main Content -->
    <main class="flex-1 md:ml-[260px] min-h-screen transition-all duration-300">
        <!-- Top spacing for mobile menu -->
        <div class="h-16 md:h-0"></div>
        
        <div class="p-6 md:p-8">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>

</html>