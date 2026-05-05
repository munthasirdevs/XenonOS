<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Access | Xenon Studios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .font-sans { font-family: 'Outfit', sans-serif; }
        .font-headline { font-family: 'Syne', sans-serif; }
        .font-mono { font-family: 'ui-monospace', 'SFMono-Regular', monospace; }
        .bg-surface { background-color: #0B0F19; }
        .bg-surface-container { background-color: #1F2937; }
        .bg-surface-container-low { background-color: #1F2937/50; }
        .text-on-surface { color: #F9FAFB; }
        .text-on-surface-variant { color: #9CA3AF; }
        .bg-primary { background-color: #6366F1; }
        .text-primary { color: #6366F1; }
        .bg-tertiary { background-color: #8B5CF6; }
        .border-white\/5 { border-color: rgba(255,255,255,0.05); }
        .bg-emerald-500\/10 { background-color: rgba(16,185,129,0.1); }
        .text-emerald-400 { color: #10B981; }
        .bg-rose-500\/10 { background-color: rgba(244,63,94,0.1); }
        .text-rose-400 { color: #F43F5E; }
        .space-font { font-family: 'Syne', sans-serif; }
    </style>
</head>

<body class="bg-[#0B0F19] text-on-surface font-sans antialiased overflow-x-hidden min-h-screen flex">

    <!-- Left Split: Auth Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-8 lg:p-12 relative order-2 lg:order-1 z-10">
        <div class="w-full max-w-md space-y-2 animate-in fade-in slide-in-from-bottom-4 duration-700 delay-150">

            <!-- Mobile Header Logo -->
            <div class="flex lg:hidden items-center justify-center gap-3 mb-8">
                <div class="w-10 h-10 bg-[#6366F1] rounded-xl flex items-center justify-center shadow-lg shadow-[#6366F1]/30">
                    <span class="text-white font-black text-xl space-font">X</span>
                </div>
                <h1 class="text-xl font-bold text-white tracking-tight font-headline">Xenon OS</h1>
            </div>

            <div class="space-y-3 text-center sm:text-left">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-white font-headline">Request Access</h2>
                <p class="text-slate-400 text-sm">Join Xenon Studios to streamline your agency operations.</p>
            </div>

            @if(isset($error))
            <div class="bg-rose-500/10 border border-rose-500/20 rounded-xl p-4">
                <p class="text-rose-400 text-sm">{{ $error }}</p>
            </div>
            @if(isset($already_used) || isset($expired) || isset($invalid))
            <div class="bg-amber-500/10 border border-amber-500/20 rounded-xl p-4 text-center">
                <p class="text-amber-400 text-sm">Contact Xenon HelpLine for a new invite.</p>
            </div>
            @endif
            @else

            <form method="POST" action="{{ route('signup.process', $code) }}" class="space-y-3">
                @csrf
                <input type="hidden" name="code" value="{{ $code }}">

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1">First Name</label>
                        <input type="text" name="first_name" placeholder="Alex" required
                            class="w-full bg-[#1F2937]/30 border border-white/5 rounded-xl py-3.5 px-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937]/80 transition-all font-mono text-sm shadow-inner">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1">Last Name</label>
                        <input type="text" name="last_name" placeholder="Rivera" required
                            class="w-full bg-[#1F2937]/30 border border-white/5 rounded-xl py-3.5 px-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937]/80 transition-all font-mono text-sm shadow-inner">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] uppercase tracking-widest text-[#6366F1] font-bold ml-1">Work Email</label>
                    <div class="relative group">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500 group-focus-within:text-[#6366F1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input type="email" name="email" value="" placeholder="you@company.com" required
                            class="w-full bg-[#1F2937]/50 border border-white/5 rounded-xl py-3.5 pl-12 pr-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937] transition-all font-mono text-sm shadow-inner">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1">Password</label>
                    <div class="relative group">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password" name="password" placeholder="••••••••••••" required minlength="8"
                            class="w-full bg-[#1F2937]/50 border border-white/5 rounded-xl py-3.5 pl-12 pr-12 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937] transition-all font-mono text-sm shadow-inner tracking-[0.2em]">
                        <button type="button" onclick="togglePassword(this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1">Confirm Password</label>
                    <div class="relative group">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password" name="password_confirmation" placeholder="••••••••••••" required minlength="8"
                            class="w-full bg-[#1F2937]/50 border border-white/5 rounded-xl py-3.5 pl-12 pr-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937] transition-all font-mono text-sm shadow-inner tracking-[0.2em]">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] uppercase tracking-widest text-slate-400 font-bold ml-1">Agency Name</label>
                    <div class="relative group">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <input type="text" name="company" placeholder="Creative Labs Inc." 
                            class="w-full bg-[#1F2937]/30 border border-white/5 rounded-xl py-3.5 pl-12 pr-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 focus:bg-[#1F2937]/80 transition-all font-mono text-sm shadow-inner">
                    </div>
                </div>

                <div class="flex items-start gap-3 mt-6 items-center">
                    <div class="mt-1 w-4 h-4 shrink-0 rounded border border-white/10 bg-[#1F2937] flex items-center justify-center cursor-pointer hover:border-[#6366F1] transition-colors">
                        <svg class="w-3 h-3 text-[#6366F1] hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="pt-1">
                        <p class="text-xs text-slate-400 cursor-pointer leading-snug">
                            I agree to the <a href="#" class="text-white hover:text-[#6366F1] font-bold transition-colors">Terms of Service</a> and
                            <a href="#" class="text-white hover:text-[#6366F1] font-bold transition-colors">Privacy Policy</a>
                        </p>
                    </div>
                </div>

                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#6366F1] hover:bg-[#5355e1] text-white py-4 rounded-xl font-bold text-[11px] uppercase tracking-[0.2em] transition-all shadow-[0_0_20px_rgba(99,102,241,0.2)] hover:shadow-[0_0_30px_rgba(99,102,241,0.3)] hover:-translate-y-0.5 mt-6 group">
                    Init Workspace Sequence
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>

            <p class="text-center text-xs text-slate-500 pt-4 border-t border-white/5 mt-8">
                Already have an account?
                <a href="{{ route('login') }}" class="text-white hover:text-[#6366F1] font-bold transition-colors ml-1">Sign In</a>
            </p>
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
                    <svg class="w-6 h-6 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <p class="text-[9px] uppercase tracking-widest text-[#6366F1] font-bold mb-1">Deployment</p>
                    <p class="text-sm font-bold text-white font-mono">14x Faster</p>
                </div>
                <div class="bg-[#1F2937]/50 backdrop-blur-md border border-emerald-500/20 rounded-2xl p-4 shadow-2xl opacity-80 hover:opacity-100 transition-opacity">
                    <svg class="w-6 h-6 text-emerald-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <p class="text-[9px] uppercase tracking-widest text-emerald-500 font-bold mb-1">Security</p>
                    <p class="text-sm font-bold text-white font-mono">Enterprise Level</p>
                </div>
            </div>

            <h2 class="text-5xl font-bold text-white font-headline leading-tight pr-12">
                Launch your agency <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-[#6366F1]">into the future.</span>
            </h2>
            <p class="text-slate-400 text-lg max-w-lg leading-relaxed">
                Connect your workspace directly to the Xenon computing core and manage client deliverables flawlessly.
            </p>
        </div>

        <div class="relative z-10 flex items-center justify-between text-[10px] text-slate-500 uppercase tracking-widest font-bold">
            <span>© 2026 Xenon Studios</span>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)] animate-pulse"></div>
                Networks Linked
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(btn) {
            const input = btn.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }

        // Checkbox toggle
        document.querySelector('.w-4.h-4.shrink-0.rounded.border').addEventListener('click', function() {
            this.classList.toggle('border-[#6366F1]');
            const check = this.querySelector('svg');
            if (check) {
                check.classList.toggle('hidden');
            }
        });
    </script>
</body>

</html>