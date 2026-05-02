<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Xenon Studios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700&family=Ubuntu:wght@300;400;500;700&display=swap');
        
        .font-headline { font-family: 'Space Grotesk', sans-serif; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .font-ubuntu { font-family: 'Ubuntu', sans-serif; }
        .space-font { font-family: 'Space Grotesk', sans-serif; }
        
        .bg-gradient-to-r { background: linear-gradient(to right, #6366F1, #10B981); }
        .text-gradient {
            background: linear-gradient(to right, #6366F1, #10B981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Grid pattern */
        .bg-grid {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        /* Glow effects */
        .glow-indigo {
            background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
        }
        .glow-emerald {
            background: radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #1F2937; }
        ::-webkit-scrollbar-thumb { background: #4B5563; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #6B7280; }
        
        /* Input styling */
        input[type="email"],
        input[type="password"] {
            letter-spacing: 0.05em;
        }
        input::placeholder {
            color: #475569;
        }
        
        /* Focus states */
        input:focus {
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3), 0 0 20px rgba(99, 102, 241, 0.1);
        }
        
        /* Checkbox custom */
        .checkbox-custom:checked {
            background-color: #6366F1;
            border-color: #6366F1;
        }
        .checkbox-custom:checked::after {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 10px rgba(16, 185, 129, 0.3); }
            50% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.5); }
        }
        .status-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-[#0B0F19] text-white font-sans antialiased overflow-x-hidden min-h-screen flex">

    <!-- Left Split: Visual Showcase -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-[#111827] flex-col justify-between p-8 border-r border-white/5 overflow-hidden">
        <!-- Abstract glowing elements -->
        <div class="absolute top-[-20%] left-[-10%] w-[70%] h-[70%] rounded-full pointer-events-none glow-indigo blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-20%] w-[60%] h-[60%] rounded-full pointer-events-none glow-emerald blur-[100px]"></div>

        <!-- Grid pattern overlay -->
        <div class="absolute inset-0 bg-grid opacity-50 pointer-events-none mix-blend-overlay"></div>

        <div class="relative z-10 flex items-center gap-4">
            <div class="w-12 h-12 bg-[#6366F1] rounded-xl flex items-center justify-center shadow-lg shadow-[#6366F1]/30">
                <span class="text-white font-black text-2xl space-font">X</span>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight font-headline">Xenon OS</h1>
        </div>

        <div class="relative z-10 space-y-4">
            <h2 class="text-5xl font-bold text-white font-headline leading-tight">
                Secure access to your <br>
                <span class="text-gradient">digital command center.</span>
            </h2>
            <p class="text-slate-400 text-lg max-w-xl font-outfit leading-relaxed">
                Log in to coordinate projects, deploy high-end creative solutions, and manage your agency deliverables in real-time.
            </p>

            <div class="flex items-center gap-4 pt-4">
                <div class="flex items-center -space-x-3">
                    <img src="https://i.pravatar.cc/100?img=1" class="w-10 h-10 rounded-full border-2 border-[#111827]">
                    <img src="https://i.pravatar.cc/100?img=2" class="w-10 h-10 rounded-full border-2 border-[#111827]">
                    <img src="https://i.pravatar.cc/100?img=3" class="w-10 h-10 rounded-full border-2 border-[#111827]">
                </div>
                <div class="space-y-1">
                    <div class="flex gap-1">
                        <i class="fas fa-star text-amber-500"></i>
                        <i class="fas fa-star text-amber-500"></i>
                        <i class="fas fa-star text-amber-500"></i>
                        <i class="fas fa-star text-amber-500"></i>
                        <i class="fas fa-star text-amber-500"></i>
                    </div>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold font-ubuntu">Trusted by top agencies</p>
                </div>
            </div>
        </div>

        <div class="relative z-10 flex items-center justify-between text-[10px] text-slate-500 uppercase tracking-widest font-bold font-ubuntu">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-500 status-glow"></div>
                Systems Operational
            </div>
            <span>v3.1.0-nexus</span>
        </div>
    </div>

    <!-- Right Split: Auth Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-12 lg:p-24 relative">
        <div class="w-full max-w-md space-y-4">

            <!-- Mobile Header Logo -->
            <div class="flex lg:hidden items-center justify-center gap-3 mb-10">
                <div class="w-10 h-10 bg-[#6366F1] rounded-xl flex items-center justify-center shadow-lg shadow-[#6366F1]/30">
                    <span class="text-white font-black text-xl space-font">X</span>
                </div>
                <h1 class="text-xl font-bold text-white tracking-tight font-headline">Xenon OS</h1>
            </div>

            <div class="space-y-3 text-center sm:text-left">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-white font-headline">Welcome back</h2>
                <p class="text-slate-400 text-sm font-outfit">Enter your credentials to access your workspace.</p>
            </div>

            <!-- Session Error Message -->
            @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl text-sm font-outfit">
                {{ session('error') }}
            </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl text-sm font-outfit">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="text-[10px] uppercase tracking-widest text-[#6366F1] font-bold ml-1 font-ubuntu">Email Address</label>
                    <div class="relative group">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500 group-focus-within:text-[#6366F1] transition-colors"></i>
                        <input type="email" name="email" placeholder="alex@agency.com" required
                            class="w-full bg-[#1F2937]/50 border border-white/5 rounded-2xl py-4 pl-12 pr-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937] transition-all font-mono text-sm shadow-inner">
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between ml-1">
                        <label class="text-[10px] uppercase tracking-widest text-[#6366F1] font-bold font-ubuntu">Password</label>
                        <a href="{{ route('password.request') }}"
                            class="text-[10px] uppercase tracking-widest text-slate-500 hover:text-white font-bold font-ubuntu transition-colors">Forgot?</a>
                    </div>
                    <div class="relative group">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500 group-focus-within:text-[#6366F1] transition-colors"></i>
                        <input type="password" name="password" placeholder="••••••••••••" required
                            class="w-full bg-[#1F2937]/50 border border-white/5 rounded-2xl py-4 pl-12 pr-12 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937] transition-all font-mono text-sm shadow-inner tracking-[0.2em]">
                        <button type="button" onclick="togglePassword(this)"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition-colors">
                            <i class="fas fa-eye w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="remember" id="remember" 
                        class="checkbox-custom w-4 h-4 rounded border border-white/10 bg-[#1F2937] flex items-center justify-center cursor-pointer hover:border-[#6366F1] transition-colors appearance-none">
                    <label for="remember" class="text-xs text-slate-400 cursor-pointer font-outfit">Remember this device for 30 days</label>
                </div>

                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-[#6366F1] hover:bg-[#5355e1] text-white py-4 rounded-2xl font-bold text-[11px] uppercase tracking-[0.2em] transition-all shadow-[0_0_20px_rgba(99,102,241,0.2)] hover:shadow-[0_0_30px_rgba(99,102,241,0.3)] hover:-translate-y-0.5 mt-4 group font-ubuntu">
                    Authenticate Session
                    <i class="fas fa-arrow-right w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>

            <div class="relative py-2">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-white/5"></div>
                </div>
            </div>

            <p class="text-center text-xs text-slate-500 font-outfit">
                Don't have an agency account yet?
                <a href="{{ route('register') }}" class="text-white hover:text-[#6366F1] font-bold transition-colors ml-1">Request Access</a>
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function togglePassword(button) {
            const input = button.parentElement.querySelector('input[type="password"]');
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>