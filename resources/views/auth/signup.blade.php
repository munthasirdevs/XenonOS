<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Access | Xenon Studios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .font-sans { font-family: 'Outfit', sans-serif; }
        .font-headline { font-family: 'Syne', sans-serif; }
        .ubuntu { font-family: 'Ubuntu', sans-serif; }
        .space-font { font-family: 'Syne', sans-serif; }
    </style>
</head>

<body class="bg-[#0B0F19] text-[#F9FAFB] font-sans antialiased overflow-x-hidden min-h-screen flex">

    <!-- Left Split: Auth Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-4 md:p-6 lg:p-6 relative order-2 lg:order-1 z-10">
        <div class="w-full max-w-md space-y-1 animate-in fade-in slide-in-from-bottom-4 duration-700 delay-150">

            <!-- Mobile Header Logo -->
            <div class="flex lg:hidden items-center justify-center gap-2 mb-4">
                <div class="w-10 h-10 bg-[#6366F1] rounded-xl flex items-center justify-center shadow-lg shadow-[#6366F1]/30">
                    <span class="text-white font-black text-xl space-font">X</span>
                </div>
                <h1 class="text-xl font-bold text-white tracking-tight font-headline">Xenon OS</h1>
            </div>

            <div class="space-y-1 text-center sm:text-left">
                <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-white font-headline">Request Access</h2>
                <p class="text-slate-400 text-xs outfit">Join Xenon Studios to streamline your agency operations.</p>
            </div>

            @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4">
                <p class="text-emerald-400 text-sm">{{ session('success') }}</p>
            </div>
            @endif

            @if(isset($error))
            <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-4">
                <p class="text-red-400 text-sm">{{ $error }}</p>
            </div>
            @if(isset($already_used) || isset($expired) || isset($invalid))
            <div class="bg-amber-500/10 border border-amber-500/20 rounded-xl p-4 text-center">
                <p class="text-amber-400 text-sm">Contact Xenon HelpLine for a new invite.</p>
            </div>
            @endif
            @else

            <form method="POST" action="{{ route('signup.process', ['code' => $code]) }}" class="space-y-2">
                @csrf
                <input type="hidden" name="code" value="{{ $code }}">

                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1 ubuntu">First Name</label>
                        <input type="text" name="first_name" placeholder="Alex" required
                            class="w-full bg-[#1F2937]/30 border border-white/5 rounded-lg py-2.5 px-3 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937]/80 transition-all font-mono text-xs shadow-inner">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1 ubuntu">Last Name</label>
                        <input type="text" name="last_name" placeholder="Rivera" required
                            class="w-full bg-[#1F2937]/30 border border-white/5 rounded-lg py-2.5 px-3 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937]/80 transition-all font-mono text-xs shadow-inner">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-widest text-[#6366F1] font-bold ml-1 ubuntu">Work Email</label>
                    <div class="relative group">
                        <i data-lucide="mail" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500 group-focus-within:text-[#6366F1] transition-colors"></i>
                        <input type="email" name="email" placeholder="alex@agency.com" required
                            class="w-full bg-[#1F2937]/50 border border-white/5 rounded-lg py-2.5 pl-10 pr-3 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937] transition-all font-mono text-xs shadow-inner">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1 ubuntu">Phone Number</label>
                    <div class="relative group">
                        <i data-lucide="phone" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500 group-focus-within:text-[#6366F1] transition-colors"></i>
                        <input type="tel" name="phone" placeholder="+1 (555) 000-0000"
                            class="w-full bg-[#1F2937]/50 border border-white/5 rounded-lg py-2.5 pl-10 pr-3 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937] transition-all font-mono text-xs shadow-inner">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1 ubuntu">Password</label>
                    <div class="relative group">
                        <i data-lucide="lock" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500 group-focus-within:text-[#6366F1] transition-colors"></i>
                        <input type="password" name="password" placeholder="••••••••••••" required minlength="8"
                            class="w-full bg-[#1F2937]/50 border border-white/5 rounded-lg py-2.5 pl-10 pr-10 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937] transition-all font-mono text-xs shadow-inner tracking-[0.2em]">
                        <button type="button" onclick="togglePassword(this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition-colors">
                            <i data-lucide="eye" class="w-3 h-3"></i>
                        </button>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1 ubuntu">Agency Name</label>
                    <div class="relative group">
                        <i data-lucide="briefcase" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500 group-focus-within:text-[#6366F1] transition-colors"></i>
                        <input type="text" name="company" placeholder="Creative Labs Inc." required
                            class="w-full bg-[#1F2937]/30 border border-white/5 rounded-lg py-2.5 pl-10 pr-3 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937]/80 transition-all font-mono text-xs shadow-inner">
                    </div>
                </div>

                <div class="flex items-start gap-2 mt-3 items-center">
                    <div class="mt-1 w-4 h-4 shrink-0 rounded border border-white/10 bg-[#1F2937] flex items-center justify-center cursor-pointer hover:border-[#6366F1] transition-colors" onclick="toggleTerms(this)">
                        <i data-lucide="check" class="w-3 h-3 text-[#6366F1] opacity-0"></i>
                    </div>
                    <input type="checkbox" name="terms" class="hidden">
                    <div class="pt-1">
                        <p class="text-xs text-slate-400 cursor-pointer outfit leading-snug">
                            I agree to the <a href="#" class="text-white hover:text-[#6366F1] font-bold transition-colors">Terms of Service</a> and
                            <a href="#" class="text-white hover:text-[#6366F1] font-bold transition-colors">Privacy Policy</a>
                        </p>
                    </div>
                </div>

                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#6366F1] hover:bg-[#5355e1] text-white py-3 rounded-lg font-bold text-[10px] uppercase tracking-[0.2em] transition-all shadow-[0_0_20px_rgba(99,102,241,0.2)] hover:shadow-[0_0_30px_rgba(99,102,241,0.3)] hover:-translate-y-0.5 mt-2 group ubuntu">
                    Init Workspace Sequence
                    <i data-lucide="arrow-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>

            <p class="text-center text-xs text-slate-500 outfit pt-2 border-t border-white/5 mt-2">
                Already have an account?
                <a href="{{ route('login') }}" class="text-white hover:text-[#6366F1] font-bold transition-colors ml-1">Sign In</a>
            </p>
            @endif

        </div>
    </div>

    <!-- Right Split: Visual Showcase -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-[#111827] flex-col justify-between p-12 border-l border-white/5 overflow-hidden order-1 lg:order-2">
        <!-- Abstract glowing elements -->
        <div class="absolute top-[-10%] right-[-10%] w-[60%] h-[60%] bg-[#6366F1]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[20%] left-[-10%] w-[70%] h-[70%] bg-purple-500/10 rounded-full blur-[100px] pointer-events-none"></div>

        <!-- Animated structural lines -->
        <div class="absolute inset-0 block opacity-20 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>

        <div class="relative z-10 flex items-center justify-end gap-4 w-full">
            <h1 class="text-xl font-bold text-white tracking-tight font-headline">Xenon OS</h1>
            <div class="w-10 h-10 bg-[#6366F1] rounded-xl flex items-center justify-center shadow-lg shadow-[#6366F1]/30">
                <span class="text-white font-black text-xl space-font">X</span>
            </div>
        </div>

        <div class="relative z-10 space-y-6 animate-in fade-in slide-in-from-right-8 duration-1000">

            <!-- Floating Data blocks -->
            <div class="flex gap-4 mb-4">
                <div class="bg-[#1F2937]/50 backdrop-blur-md border border-white/10 rounded-2xl p-4 shadow-2xl opacity-80 hover:opacity-100 transition-opacity">
                    <i data-lucide="rocket" class="w-6 h-6 text-white mb-2"></i>
                    <p class="text-[9px] uppercase tracking-widest text-[#6366F1] font-bold ubuntu mb-1">Deployment</p>
                    <p class="text-sm font-bold text-white font-mono">14x Faster</p>
                </div>
                <div class="bg-[#1F2937]/50 backdrop-blur-md border border-emerald-500/20 rounded-2xl p-4 shadow-2xl opacity-80 hover:opacity-100 transition-opacity">
                    <i data-lucide="shield-check" class="w-6 h-6 text-emerald-400 mb-2"></i>
                    <p class="text-[9px] uppercase tracking-widest text-emerald-500 font-bold ubuntu mb-1">Security</p>
                    <p class="text-sm font-bold text-white font-mono">Enterprise Level</p>
                </div>
            </div>

            <h2 class="text-5xl font-bold text-white font-headline leading-tight pr-12">
                Launch your agency <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-[#6366F1]">into the future.</span>
            </h2>
            <p class="text-slate-400 text-lg max-w-lg outfit leading-relaxed">
                Connect your workspace directly to the Xenon computing core and manage client deliverables flawlessly.
            </p>

        </div>

        <div class="relative z-10 flex items-center justify-between text-[10px] text-slate-500 uppercase tracking-widest font-bold ubuntu">
            <span>© 2026 Xenon Studios</span>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)] animate-pulse"></div>
                Networks Linked
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function togglePassword(btn) {
            const input = btn.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }

        function toggleTerms(div) {
            div.classList.toggle('border-[#6366F1]');
            const check = div.querySelector('.opacity-0, .opacity-100');
            if (check.classList.contains('opacity-0')) {
                check.classList.remove('opacity-0');
                check.classList.add('opacity-100');
                div.nextElementSibling.nextElementSibling.querySelector('input[type="checkbox"]').checked = true;
            } else {
                check.classList.remove('opacity-100');
                check.classList.add('opacity-0');
                div.nextElementSibling.nextElementSibling.querySelector('input[type="checkbox"]').checked = false;
            }
        }
    </script>
</body>

</html>