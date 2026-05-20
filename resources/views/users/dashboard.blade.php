@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">
@endpush

@section('title', 'Dashboard - XenonOS')

@section('content')
<main class="flex-1 md:ml-[260px] min-h-screen">
        .bg-rose-500\/10 { background-color: rgba(244,63,94,0.1); }
        .text-rose-400 { color: #F43F5E; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #374151; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #4B5563; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            font-size: 20px;
        }
    </style>
</head>

<body class="bg-[#0B0F19] text-on-surface font-sans antialiased overflow-x-hidden min-h-screen">

    <!-- Background Elements -->
    <div class="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-[#6366F1]/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[0%] right-[0%] w-[40%] h-[40%] bg-[#6366F1]/5 rounded-full blur-[100px]"></div>
    </div>

    <!-- Sidebar (from navbar component) -->
    <x-navbar />

    <main class="ml-0 md:ml-64 min-h-screen flex flex-col pt-20">
        <!-- TopNav -->
        <header class="fixed top-0 right-0 w-full md:w-[calc(100%-16rem)] h-20 z-40 bg-[#111827]/80 backdrop-blur-xl flex items-center justify-between px-10 border-b border-white/5">
            <div class="flex items-center gap-4 lg:gap-10 min-w-fit">
                <button onclick="toggleSidebar()" class="p-2 md:hidden text-slate-400 hover:text-white rounded-xl hover:bg-white/5 transition-all">
                    <span class="material-symbols-outlined">menu</span>
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
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-[#6366F1] transition-colors">search</span>
                    <input type="text" placeholder="Search workspace..." class="w-full bg-[#1F2937]/50 border border-white/5 rounded-[1.25rem] py-3 pl-14 pr-6 text-sm text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#6366F1]/40 focus:bg-[#1F2937] transition-all shadow-inner">
                </div>
            </div>

            <div class="flex items-center gap-8 min-w-fit">
                <div class="flex items-center gap-2">
                    <button class="p-2.5 text-slate-400 hover:text-white hover:bg-white/5 rounded-xl transition-all relative group">
                        <span class="material-symbols-outlined">notifications</span>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-[#6366F1] rounded-full border-2 border-[#111827] group-hover:scale-125 transition-transform"></span>
                    </button>
                    <button class="p-2.5 text-slate-400 hover:text-white hover:bg-white/5 rounded-xl transition-all hidden sm:block">
                        <span class="material-symbols-outlined">help</span>
                    </button>
                </div>

                <div class="h-8 w-px bg-white/10 hidden sm:block"></div>

                <button class="flex items-center gap-4 group">
                    <div class="flex items-center gap-3 hidden lg:flex">
                        <p class="text-sm font-bold text-white group-hover:text-[#6366F1] transition-colors tracking-tight">{{ Auth::user()->name ?? 'Client' }}</p>
                        <span class="material-symbols-outlined text-slate-600 group-hover:text-white transition-colors">expand_more</span>
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
                            <span class="material-symbols-outlined text-[14px]">folder</span>
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
                            <span class="material-symbols-outlined text-[14px]">bolt</span>
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
                                    See More <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @forelse($projects as $project)
                                <div class="bg-[#0B0F19]/60 border border-white/5 rounded-2xl p-8 hover:border-[#6366F1]/30 transition-all group cursor-pointer shadow-xl relative overflow-hidden">
                                    <div class="flex justify-between items-start mb-8">
                                        <div class="w-12 h-12 rounded-2xl bg-[#1F2937] flex items-center justify-center text-[#6366F1] group-hover:bg-[#6366F1] group-hover:text-white transition-all shadow-inner">
                                            <span class="material-symbols-outlined text-2xl">bolt</span>
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
                                    <span class="material-symbols-outlined text-4xl mb-2">folder_off</span>
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
                                    <span class="material-symbols-outlined">more_vert</span>
                                </button>
                            </div>
                            <div class="p-8 space-y-4">
                                @forelse($serviceOrders as $order)
                                <div class="bg-[#1F2937]/30 p-5 rounded-2xl flex items-center justify-between border border-white/5 hover:bg-[#1F2937]/50 focus-within:border-[#6366F1]/50 transition-all cursor-pointer group">
                                    <div class="flex items-center gap-5">
                                        <div class="w-12 h-12 rounded-2xl bg-[#1F2937] flex items-center justify-center text-[#6366F1] group-hover:bg-[#6366F1] group-hover:text-white transition-all shadow-inner">
                                            <span class="material-symbols-outlined text-2xl">folder</span>
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
                                    <span class="material-symbols-outlined">more_vert</span>
                                </button>
                            </div>
                            <div class="p-8 space-y-4">
                                @forelse($notifications as $notification)
                                <div class="bg-[#1F2937]/30 p-5 rounded-2xl flex items-center justify-between border border-white/5 hover:bg-[#1F2937]/50 transition-all cursor-pointer group">
                                    <div class="flex items-center gap-5">
                                        <div class="w-12 h-12 rounded-2xl bg-[#1F2937] flex items-center justify-center text-[#6366F1] group-hover:bg-[#6366F1] group-hover:text-white transition-all shadow-inner">
                                            <span class="material-symbols-outlined text-2xl">notifications</span>
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
                                        <span class="material-symbols-outlined text-emerald-400">check_circle</span>
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
                                    <span class="material-symbols-outlined">description</span>
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
                                <span class="material-symbols-outlined text-slate-500">folder</span>
                            </div>
                            <div class="space-y-4">
                                @forelse($recentFiles as $file)
                                <div class="bg-[#0B0F19] p-4 rounded-2xl flex items-center gap-4 border border-white/5 hover:border-[#6366F1]/30 transition-all cursor-pointer group shadow-inner">
                                    <div class="w-10 h-10 rounded-xl bg-[#1F2937] flex items-center justify-center text-red-400 group-hover:bg-red-500 group-hover:text-white transition-all">
                                        <span class="material-symbols-outlined">description</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-white truncate">{{ $file->name }}</p>
                                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-0.5 font-mono"><span>{{ $file->size ?? '0 KB' }}</span> • {{ $file->created_at->format('M d') }}</p>
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
@endsection

@push('scripts')
<script src="{{ asset('js/user-dashboard.js') }}"></script>
@endpush
