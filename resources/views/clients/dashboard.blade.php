<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Xenon Studios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .font-sans { font-family: 'Outfit', sans-serif; }
        .font-headline { font-family: 'Syne', sans-serif; }
        .font-mono { font-family: 'ui-monospace', 'SFMono-Regular', monospace; }
        .bg-surface { background-color: #0B0F19; }
        .bg-surface-container { background-color: #1F2937; }
        .bg-surface-container-low { background-color: #1F2937/30; }
        .text-on-surface { color: #F9FAFB; }
        .text-on-surface-variant { color: #9CA3AF; }
        .bg-primary { background-color: #6366F1; }
        .text-primary { color: #6366F1; }
        .bg-tertiary { background-color: #8B5CF6; }
        .border-white\/5 { border-color: rgba(255,255,255,0.05); }
        .bg-emerald-500\/10 { background-color: rgba(16,185,129,0.1); }
        .text-emerald-400 { color: #10B981; }
        .bg-blue-500\/10 { background-color: rgba(59,130,246,0.1); }
        .text-blue-400 { color: #60A5FA; }
        .bg-amber-500\/10 { background-color: rgba(245,158,11,0.1); }
        .text-amber-400 { color: #FBBF24; }
        .bg-rose-500\/10 { background-color: rgba(244,63,94,0.1); }
        .text-rose-400 { color: #F43F5E; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #374151; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #4B5563; }
    </style>
</head>

<body class="bg-[#0B0F19] text-on-surface font-sans antialiased overflow-x-hidden min-h-screen">

    <!-- Background Elements -->
    <div class="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-[#6366F1]/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[0%] right-[0%] w-[40%] h-[40%] bg-[#6366F1]/5 rounded-full blur-[100px]"></div>
    </div>

    <main class="ml-0 md:ml-64 min-h-screen flex flex-col pt-20">
        <!-- TopNav -->
        <header class="fixed top-0 right-0 w-full md:w-[calc(100%-16rem)] h-20 z-40 bg-[#111827]/80 backdrop-blur-xl flex items-center justify-between px-10 border-b border-white/5">
            <div class="flex items-center gap-4 lg:gap-10 min-w-fit">
                <button onclick="toggleMobileMenu()" class="p-2 md:hidden text-slate-400 hover:text-white rounded-xl hover:bg-white/5 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h2 class="text-xl font-bold text-white tracking-tight font-headline">Command Center</h2>

                <nav class="hidden xl:flex items-center gap-8">
                    <button onclick="window.location.href='{{ route('settings') }}'" class="px-5 py-2 bg-[#1F2937] text-[#dfe2f1] text-[10px] font-bold uppercase tracking-[0.2em] rounded-xl hover:text-white hover:bg-[#2d3a4d] transition-all border border-white/5 shadow-xl">
                        Settings
                    </button>
                    <button class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.2em] hover:text-white transition-all">
                        Support
                    </button>
                </nav>
            </div>

            <div class="flex-1 flex justify-center px-16 hidden lg:flex">
                <div class="relative w-full max-w-2xl group">
                    <svg class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-[#6366F1] transition-colors w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Search workspace..." class="w-full bg-[#1F2937]/50 border border-white/5 rounded-[1.25rem] py-3 pl-14 pr-6 text-sm text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/40 focus:bg-[#1F2937] transition-all shadow-inner">
                </div>
            </div>

            <div class="flex items-center gap-8 min-w-fit">
                <div class="flex items-center gap-2">
                    <button class="p-2.5 text-slate-400 hover:text-white hover:bg-white/5 rounded-xl transition-all relative group">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.175 6 7.478 6 9v5.159c0 .297.116.583.748.739L11 16h3l.585.293A2.044 2.044 0 0115 17z"/>
                        </svg>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-[#6366F1] rounded-full border-2 border-[#111827] group-hover:scale-125 transition-transform"></span>
                    </button>
                    <button class="p-2.5 text-slate-400 hover:text-white hover:bg-white/5 rounded-xl transition-all hidden sm:block">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.172l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                </div>

                <div class="h-8 w-px bg-white/10 hidden sm:block"></div>

                <button class="flex items-center gap-4 group">
                    <div class="flex items-center gap-3 hidden lg:flex">
                        <p class="text-sm font-bold text-white group-hover:text-[#6366F1] transition-colors tracking-tight">{{ Auth::user()->name ?? 'Client' }}</p>
                        <svg class="text-slate-600 group-hover:text-white transition-colors w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="w-11 h-11 rounded-full p-0.5 bg-gradient-to-tr from-[#6366F1] to-transparent border border-white/5 shadow-2xl group-hover:scale-105 transition-transform shrink-0">
                        <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Client') . '&background=6366F1&color=fff&size=128' }}" alt="Profile" class="w-full h-full rounded-full object-cover border-2 border-[#111827]">
                    </div>
                </button>
            </div>
        </header>

        <!-- Dynamic Content Area -->
        <div class="px-10 pb-12 pt-8 flex-1">
            <div class="space-y-10">
                <!-- Header Section -->
                <section class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="space-y-1">
                        <h1 class="text-4xl font-bold text-white tracking-tight font-headline uppercase">Command Center</h1>
                        <p class="text-[#c7c4d7] text-sm font-medium max-w-lg">Real-time overview of your digital ecosystem performance and project health.</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <button class="bg-[#1F2937] border border-white/5 px-6 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest text-[#dfe2f1] hover:bg-[#2d3a4d] transition-all active:scale-95">
                            View All Projects
                        </button>
                        <button class="bg-[#6366F1] text-white px-6 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest shadow-[0_0_20px_rgba(99,102,241,0.2)] hover:shadow-[0_0_30px_rgba(99,102,241,0.3)] transition-all hover:bg-[#5355e1] active:scale-95">
                            Order New Service
                        </button>
                    </div>
                </section>

                <!-- Stats Cards Row -->
                <section class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="bg-[#0B0F19]/50 border border-white/5 p-8 rounded-2xl flex flex-col justify-between group relative overflow-hidden transition-all hover:-translate-y-1 hover:border-white/10 shadow-xl">
                        <div class="space-y-1 relative z-10">
                            <span class="text-[10px] uppercase tracking-widest text-slate-500 font-bold">Total Projects</span>
                            <div class="text-4xl font-bold text-white tracking-tight">{{ $stats['total_projects'] ?? 0 }}</div>
                        </div>
                        <div class="mt-6 flex items-center gap-2 text-[#6366F1] text-[10px] font-bold uppercase tracking-widest relative z-10">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                            <span>+{{ $stats['new_this_month'] ?? 0 }} this month</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-br from-[#6366F1]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="bg-[#0B0F19]/50 border border-white/5 p-8 rounded-2xl flex flex-col justify-between group relative overflow-hidden transition-all hover:-translate-y-1 hover:border-white/10 shadow-xl">
                        <div class="space-y-1 relative z-10">
                            <span class="text-[10px] uppercase tracking-widest text-slate-500 font-bold">Completed</span>
                            <div class="text-4xl font-bold text-white tracking-tight">{{ $stats['completion_rate'] ?? 0 }}%</div>
                        </div>
                        <div class="mt-6 space-y-2 relative z-10">
                            <div class="w-full h-1.5 bg-[#0B0F19] rounded-full overflow-hidden p-0.5 border border-white/5">
                                <div class="h-full bg-emerald-400 rounded-full shadow-[0_0_10px_rgba(52,211,153,0.4)]" style="width: {{ $stats['completion_rate'] ?? 0 }}%"></div>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="bg-[#0B0F19]/50 border border-white/5 p-8 rounded-2xl flex flex-col justify-between group relative overflow-hidden transition-all hover:-translate-y-1 hover:border-white/10 shadow-xl">
                        <div class="space-y-1 relative z-10">
                            <span class="text-[10px] uppercase tracking-widest text-slate-500 font-bold">Ongoing Tasks</span>
                            <div class="text-4xl font-bold text-white tracking-tight">{{ $stats['active_projects'] ?? 0 }}</div>
                        </div>
                        <div class="mt-6 flex items-center gap-2 text-amber-400 text-[10px] font-bold uppercase tracking-widest relative z-10">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span>{{ $stats['due_today'] ?? 0 }} due today</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                </section>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
                    <!-- Left Column -->
                    <div class="col-span-1 lg:col-span-8 space-y-10">
                        <!-- Active Projects -->
                        <section class="space-y-6">
                            <div class="flex justify-between items-center px-2">
                                <h3 class="text-xl font-bold text-white tracking-tight font-headline">Active Projects</h3>
                                <button class="text-[10px] text-[#6366F1] font-bold uppercase tracking-widest hover:text-[#818cf8] transition-colors flex items-center gap-1">
                                    See More <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @forelse($projects as $project)
                                <div class="bg-[#0B0F19]/60 border border-white/5 rounded-2xl p-8 hover:border-[#6366F1]/30 transition-all group cursor-pointer shadow-xl relative overflow-hidden">
                                    <div class="flex justify-between items-start mb-8">
                                        <div class="w-12 h-12 rounded-2xl bg-[#1F2937] flex items-center justify-center text-[#6366F1] group-hover:bg-[#6366F1] group-hover:text-white transition-all shadow-inner">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border bg-emerald-500/10 text-emerald-400 border-emerald-500/20">{{ $project->status }}</span>
                                    </div>
                                    <h4 class="text-xl font-bold text-white mb-1 group-hover:text-[#6366F1] transition-colors tracking-tight font-headline">{{ $project->name }}</h4>
                                    <p class="text-sm text-slate-500 mb-8 line-clamp-1 italic">{{ $project->description ?? 'No description' }}</p>
                                    <div class="space-y-4">
                                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest text-slate-500">
                                            <span>Progress</span>
                                            <span class="text-white font-mono">{{ $project->progress ?? 0 }}%</span>
                                        </div>
                                        <div class="h-1.5 w-full bg-[#111827] rounded-full overflow-hidden p-0.5 border border-white/5">
                                            <div class="h-full bg-[#6366F1] rounded-full shadow-[0_0_10px_rgba(99,102,241,0.4)]" style="width: {{ $project->progress ?? 0 }}%"></div>
                                        </div>
                                    </div>
                                    <div class="mt-8 flex justify-between items-center pt-8 border-t border-white/5">
                                        <div class="flex -space-x-3">
                                            <div class="w-8 h-8 rounded-xl bg-[#1F2937] border-2 border-[#111827] flex items-center justify-center text-[10px] font-bold text-slate-400 shadow-lg font-mono">+0</div>
                                        </div>
                                        <div class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Due {{ $project->end_date ? $project->end_date->format('M d') : 'TBD' }}</div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-span-2 text-center py-12 text-slate-500">
                                    <p>No active projects</p>
                                </div>
                                @endforelse
                            </div>
                        </section>

                        <!-- Service Orders -->
                        <section class="bg-[#0B0F19]/60 border border-white/5 rounded-2xl overflow-hidden shadow-xl">
                            <div class="p-8 flex justify-between items-center border-b border-white/5 bg-[#111827]/50">
                                <h3 class="text-xl font-bold text-white tracking-tight font-headline">Service Orders</h3>
                                <button class="p-2 text-slate-500 hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                                </button>
                            </div>
                            <div class="p-8 space-y-4">
                                @forelse($serviceOrders as $order)
                                <div class="bg-[#1F2937]/30 p-5 rounded-2xl flex items-center justify-between border border-white/5 hover:bg-[#1F2937]/50 focus-within:border-[#6366F1]/50 transition-all cursor-pointer group">
                                    <div class="flex items-center gap-5">
                                        <div class="w-12 h-12 rounded-2xl bg-[#1F2937] flex items-center justify-center text-[#6366F1] group-hover:bg-[#6366F1] group-hover:text-white transition-all shadow-inner">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-base font-bold text-white tracking-tight">{{ $order->name }}</p>
                                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-0.5 font-mono">Order #{{ $order->id }} • {{ $order->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest border text-blue-400 bg-blue-500/10 border-blue-500/20">{{ $order->status }}</span>
                                    </div>
                                </div>
                                @empty
                                <p class="text-slate-500 text-sm">No service orders</p>
                                @endforelse
                            </div>
                        </section>

                        <!-- Notifications Section -->
                        <section class="bg-[#0B0F19]/60 border border-white/5 rounded-2xl overflow-hidden shadow-xl">
                            <div class="p-8 flex justify-between items-center border-b border-white/5 bg-[#111827]/50">
                                <h3 class="text-xl font-bold text-white tracking-tight font-headline">Notifications</h3>
                                <button class="p-2 text-slate-500 hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                                </button>
                            </div>
                            <div class="p-8 space-y-4">
                                @forelse($notifications as $notification)
                                <div class="bg-[#1F2937]/30 p-5 rounded-2xl flex items-center justify-between border border-white/5 hover:bg-[#1F2937]/50 transition-all cursor-pointer group">
                                    <div class="flex items-center gap-5">
                                        <div class="w-12 h-12 rounded-2xl bg-[#1F2937] flex items-center justify-center text-[#6366F1] group-hover:bg-[#6366F1] group-hover:text-white transition-all shadow-inner">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.175 6 7.478 6 9v5.159c0 .297.116.583.748.739L11 16h3l.585.293A2.044 2.044 0 0115 17z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-base font-bold text-white tracking-tight">{{ $notification->title }}</p>
                                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-0.5 font-mono">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <button class="px-6 py-2 rounded-xl bg-[#1F2937] text-[#dfe2f1] text-[10px] font-bold uppercase tracking-widest hover:bg-[#2d3a4d] transition-all">
                                        View Details
                                    </button>
                                </div>
                                @empty
                                <p class="text-slate-500 text-sm">No notifications</p>
                                @endforelse
                            </div>
                        </section>
                    </div>

                    <!-- Right Column -->
                    <div class="col-span-1 lg:col-span-4 space-y-8">
                        <section class="bg-[#0B0F19]/60 border border-white/5 rounded-2xl p-8 shadow-xl">
                            <h3 class="text-xl font-bold text-white tracking-tight mb-8 font-headline">Recent Activity</h3>
                            <div class="space-y-8 relative">
                                <div class="absolute left-[19px] top-2 bottom-2 w-px bg-white/5"></div>
                                @foreach($recentActivities as $activity)
                                <div class="flex gap-6 relative z-10">
                                    <div class="w-10 h-10 rounded-xl bg-[#111827] border border-white/5 flex items-center justify-center text-[#6366F1] shadow-xl shrink-0">
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div class="space-y-1.5">
                                        <p class="text-sm text-[#dfe2f1] leading-relaxed font-medium">{{ $activity->description }}</p>
                                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest font-mono">{{ $activity->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="cursor-pointer bg-[#0B0F19]/60 border border-white/5 rounded-2xl p-8 shadow-xl relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#6366F1]/5 rounded-full -mr-16 -mt-16 blur-3xl group-hover:bg-[#6366F1]/10 transition-colors"></div>
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 rounded-xl bg-[#6366F1]/10 flex items-center justify-center text-[#6366F1]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <h3 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Billing Summary</h3>
                            </div>
                            <div class="space-y-8 relative z-10">
                                <div class="flex justify-between items-end">
                                    <div class="space-y-1">
                                        <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest">Latest Invoice</p>
                                        <p class="text-4xl font-bold text-white tracking-tight font-mono">${{ number_format($pendingInvoice ?? 0, 2) }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-amber-500/10 text-amber-400 text-[10px] font-bold rounded-lg uppercase tracking-widest border border-amber-500/20">Pending</span>
                                </div>
                            </div>
                        </section>

                        <!-- Recent Files -->
                        <section class="bg-[#0B0F19]/60 border border-white/5 rounded-2xl p-8 shadow-xl">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-xl font-bold text-white tracking-tight font-headline">Recent Files</h3>
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                            </div>
                            <div class="space-y-4">
                                @forelse($recentFiles as $file)
                                <div class="bg-[#0B0F19] p-4 rounded-2xl flex items-center gap-4 border border-white/5 hover:border-[#6366F1]/30 transition-all cursor-pointer group shadow-inner">
                                    <div class="w-10 h-10 rounded-xl bg-[#1F2937] flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-white truncate">{{ $file->name }}</p>
                                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-0.5 font-mono"><span class="font-mono">{{ $file->size ?? '0 KB' }}</span> • {{ $file->created_at->format('M d') }}</p>
                                    </div>
                                </div>
                                @empty
                                <p class="text-slate-500 text-sm">No files</p>
                                @endforelse
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <footer class="px-10 py-6 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] text-slate-500 uppercase tracking-widest font-bold bg-[#0B0F19]/80 backdrop-blur-md">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.4)]"></span>
                    Systems Operational
                </span>
                <span class="h-1 w-1 bg-white/10 rounded-full"></span>
                <span class="font-mono">Last Updated: {{ now()->diffForHumans() }}</span>
            </div>
            <div>
                © 2026 Xenon Studios • v3.1.0-nexus
            </div>
        </footer>
    </main>

    <script>
        function toggleMobileMenu() {
            document.querySelector('main').classList.toggle('ml-0');
        }
    </script>
</body>

</html>