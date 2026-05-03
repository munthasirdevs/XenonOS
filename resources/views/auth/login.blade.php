<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | XenonOS Command Center</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#6366F1',
                        secondary: '#8B5CF6',
                        tertiary: '#EC4899',
                        surface: '#0F172A',
                        'surface-dim': '#0B0F19',
                        'surface-container-low': '#131C2E',
                        'surface-container': '#1E293B',
                        'surface-container-high': '#334155',
                        'surface-container-highest': '#475569',
                        'on-surface': '#F8FAFC',
                        'on-surface-variant': '#94A3B8',
                        'on-surface-muted': '#64748B',
                        'outline-variant': '#334155',
                        error: '#EF4444',
                        success: '#10B981',
                    },
                    fontFamily: {
                        headline: ['Syne', 'sans-serif'],
                        body: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Syne:wght@400..800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-headline { font-family: 'Syne', sans-serif; }
        
        .bg-grid {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 10px rgba(16, 185, 129, 0.3); }
            50% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.5); }
        }
        .status-glow { animation: pulse-glow 2s ease-in-out infinite; }
    </style>
</head>

<body class="flex min-h-screen bg-surface text-on-surface antialiased overflow-x-hidden">

    <!-- Left Split: Visual -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-surface-container-low flex-col justify-between p-8 border-r border-white/5 overflow-hidden">
        <div class="absolute top-[-20%] left-[-10%] w-[70%] h-[70%] bg-primary/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-20%] w-[60%] h-[60%] bg-emerald-500/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute inset-0 bg-grid opacity-50 pointer-events-none mix-blend-overlay"></div>

        <div class="relative z-10 flex items-center gap-4">
            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/30">
                <span class="material-symbols-outlined text-white text-2xl">bolt</span>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight font-headline">XenonOS</h1>
        </div>

        <div class="relative z-10 space-y-4">
            <h2 class="text-5xl font-bold text-white font-headline leading-tight">
                Command center for<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-emerald-400">system administration.</span>
            </h2>
            <p class="text-on-surface-variant text-lg max-w-xl leading-relaxed">
                Manage users, monitor systems, and control all operations from a unified command interface.
            </p>
            
            <div class="flex items-center gap-4 pt-4">
                <div class="flex items-center -space-x-3">
                    <img src="https://i.pravatar.cc/100?img=1" class="w-10 h-10 rounded-full border-2 border-surface-container">
                    <img src="https://i.pravatar.cc/100?img=2" class="w-10 h-10 rounded-full border-2 border-surface-container">
                    <img src="https://i.pravatar.cc/100?img=3" class="w-10 h-10 rounded-full border-2 border-surface-container">
                </div>
                <div class="space-y-1">
                    <div class="flex gap-1">
                        <span class="material-symbols-outlined text-amber-500 text-sm">star</span>
                        <span class="material-symbols-outlined text-amber-500 text-sm">star</span>
                        <span class="material-symbols-outlined text-amber-500 text-sm">star</span>
                        <span class="material-symbols-outlined text-amber-500 text-sm">star</span>
                        <span class="material-symbols-outlined text-amber-500 text-sm">star</span>
                    </div>
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">Trusted by admins</p>
                </div>
            </div>
        </div>

        <div class="relative z-10 flex items-center justify-between text-[10px] text-on-surface-variant uppercase tracking-widest font-bold">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-500 status-glow"></div>
                Systems Operational
            </div>
            <span>v3.1.0-nexus</span>
        </div>
    </div>

    <!-- Right Split: Auth Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-12 lg:p-24 relative">
        <div class="w-full max-w-md space-y-6">

            <!-- Mobile Logo -->
            <div class="flex lg:hidden items-center justify-center gap-3 mb-10">
                <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/30">
                    <span class="material-symbols-outlined text-white text-xl">bolt</span>
                </div>
                <h1 class="text-xl font-bold text-white tracking-tight font-headline">XenonOS</h1>
            </div>

            <div class="space-y-2">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-white font-headline">Welcome back</h2>
                <p class="text-on-surface-variant text-sm">Enter your credentials to access the command center.</p>
            </div>

            <!-- Session Error -->
            @if(session('error'))
            <div class="bg-error/10 border border-error/30 text-error px-4 py-3 rounded-xl text-sm">
                {{ session('error') }}
            </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
            <div class="bg-error/10 border border-error/30 text-error px-4 py-3 rounded-xl text-sm">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                @csrf

                <div class="space-y-2">
                    <label class="text-[10px] uppercase tracking-widest text-primary font-bold ml-1">Email Address</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">mail</span>
                        <input type="email" name="email" placeholder="admin@xenonos.com" required
                            class="w-full bg-surface-container border border-white/5 rounded-2xl py-4 pl-12 pr-4 text-white placeholder:text-on-surface-muted focus:outline-none focus:ring-2 focus:ring-primary/50 focus:bg-surface-container-high transition-all font-mono text-sm">
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between ml-1">
                        <label class="text-[10px] uppercase tracking-widest text-primary font-bold">Password</label>
                    </div>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">lock</span>
                        <input type="password" name="password" placeholder="••••••••••••" required
                            class="w-full bg-surface-container border border-white/5 rounded-2xl py-4 pl-12 pr-12 text-white placeholder:text-on-surface-muted focus:outline-none focus:ring-2 focus:ring-primary/50 focus:bg-surface-container-high transition-all font-mono text-sm tracking-[0.2em]">
                        <button type="button" onclick="togglePassword(this)"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-base">visibility</span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="remember" id="remember" 
                        class="w-4 h-4 rounded border border-white/10 bg-surface-container flex items-center justify-center cursor-pointer hover:border-primary transition-colors appearance-none">
                    <label for="remember" class="text-xs text-on-surface-variant cursor-pointer">Remember this device for 30 days</label>
                </div>

                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white py-4 rounded-2xl font-bold text-[11px] uppercase tracking-[0.2em] transition-all shadow-lg shadow-primary/20 hover:shadow-primary/30 hover:-translate-y-0.5 mt-4 group">
                    Authenticate Session
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </form>

            <p class="text-center text-xs text-on-surface-variant">
                Don't have admin access?
                <a href="#" class="text-white hover:text-primary font-bold transition-colors ml-1">Request Access</a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword(button) {
            const input = button.parentElement.querySelector('input[type="password"]');
            const icon = button.querySelector('span');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</body>

</html>