@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-hub.css') }}">
@endpush

@section('title', 'Projects Hub - XenonOS')

@section('content')
<x-navbar />

<main class="flex-1 md:ml-[260px] min-h-screen">
    <div class="p-6 md:p-8 space-y-8">
        <!-- Performance & Health Metrics -->
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="md:col-span-2 bg-surface-container rounded-2xl p-6 relative overflow-hidden group hover:scale-[1.02] transition-all duration-400">
                <div class="relative z-10 h-full flex flex-col justify-between">
                    <div>
                        <p class="text-on-surface-variant text-xs font-semibold tracking-widest uppercase">System Performance</p>
                        <h3 class="font-syne font-extrabold text-3xl mt-1 text-[#c0c1ff]">98.2% Efficiency</h3>
                    </div>
                    <div class="mt-8 flex items-end gap-1 h-12">
                        <div class="w-full bg-primary/20 h-4 rounded-full"></div>
                        <div class="w-full bg-primary/40 h-8 rounded-full"></div>
                        <div class="w-full bg-primary/60 h-6 rounded-full"></div>
                        <div class="w-full bg-primary h-12 rounded-full"></div>
                        <div class="w-full bg-primary/30 h-10 rounded-full"></div>
                    </div>
                </div>
                <div class="absolute -right-8 -bottom-8 opacity-10 group-hover:scale-110 transition-transform duration-700">
                    <span class="material-symbols-outlined text-[160px]">analytics</span>
                </div>
            </div>
            <div class="bg-surface-container rounded-2xl p-6 group hover:scale-[1.02] transition-all duration-400">
                <div class="w-10 h-10 rounded-lg bg-tertiary/20 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-tertiary">bolt</span>
                </div>
                <p class="text-on-surface-variant text-sm font-medium">Active Sprints</p>
                <h3 class="font-syne font-extrabold text-4xl mt-1">12</h3>
                <p class="text-xs text-tertiary mt-2">+2 from last week</p>
            </div>
            <div class="bg-surface-container rounded-2xl p-6 group hover:scale-[1.02] transition-all duration-400">
                <div class="w-10 h-10 rounded-lg bg-primary/20 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-primary">group</span>
                </div>
                <p class="text-on-surface-variant text-sm font-medium">Resource Load</p>
                <h3 class="font-syne font-extrabold text-4xl mt-1">84%</h3>
                <div class="w-full bg-surface-container-lowest h-1.5 rounded-full mt-4">
                    <div class="bg-primary w-[84%] h-full rounded-full shadow-[0_0_8px_rgba(99,102,241,0.5)]"></div>
                </div>
            </div>
        </section>

        <!-- Filter/Sort Controls -->
        <section class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <button class="bg-surface-container hover:bg-surface-container-high px-4 py-2 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span>
                    Status: All
                </button>
                <button class="bg-surface-container hover:bg-surface-container-high px-4 py-2 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
                    Client: All
                </button>
                <button class="bg-surface-container hover:bg-surface-container-high px-4 py-2 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
                    Sort: Newest
                </button>
            </div>
            <div class="flex bg-surface-container-lowest p-1 rounded-xl">
                <button class="p-2 bg-surface-container-high text-primary rounded-lg transition-all">
                    <span class="material-symbols-outlined">grid_view</span>
                </button>
                <button class="p-2 text-on-surface-variant hover:text-on-surface rounded-lg transition-all">
                    <span class="material-symbols-outlined">view_list</span>
                </button>
            </div>
        </section>

        <!-- Project Cards Grid -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1: Active -->
            <div class="bg-surface-container rounded-2xl p-6 flex flex-col justify-between h-[320px] group hover:scale-[1.02] transition-all duration-400">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider rounded-full border border-primary/20">Active</span>
                        <button class="text-on-surface-variant hover:text-on-surface"><span class="material-symbols-outlined">more_vert</span></button>
                    </div>
                    <h4 class="font-syne font-extrabold text-xl text-on-surface mb-2">Neural Link Interface</h4>
                    <p class="text-on-surface-variant text-sm line-clamp-2">Implementing asynchronous event streams for high-latency peripheral devices.</p>
                </div>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs mb-2">
                            <span class="text-on-surface-variant">Progress</span>
                            <span class="text-primary font-bold">78%</span>
                        </div>
                        <div class="w-full bg-surface-container-lowest h-2 rounded-full overflow-hidden">
                            <div class="bg-primary h-full rounded-full" style="width: 78%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex -space-x-2">
                            <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=JD&background=818cf8&color=fff" />
                            <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=AS&background=34d399&color=fff" />
                            <div class="w-8 h-8 rounded-full border-2 border-surface-container bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">+3</div>
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            Dec 24, 2024
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Pending -->
            <div class="bg-surface-container rounded-2xl p-6 flex flex-col justify-between h-[320px] group hover:scale-[1.02] transition-all duration-400">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <span class="px-3 py-1 bg-tertiary/10 text-tertiary text-[10px] font-bold uppercase tracking-wider rounded-full border border-tertiary/20">Pending</span>
                        <button class="text-on-surface-variant hover:text-on-surface"><span class="material-symbols-outlined">more_vert</span></button>
                    </div>
                    <h4 class="font-syne font-extrabold text-xl text-on-surface mb-2">Xenon Core OS Update</h4>
                    <p class="text-on-surface-variant text-sm line-clamp-2">Kernel-level security patches and memory management optimization for V5.</p>
                </div>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs mb-2">
                            <span class="text-on-surface-variant">Progress</span>
                            <span class="text-tertiary font-bold">12%</span>
                        </div>
                        <div class="w-full bg-surface-container-lowest h-2 rounded-full overflow-hidden">
                            <div class="bg-tertiary h-full rounded-full" style="width: 12%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex -space-x-2">
                            <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=MK&background=c084fc&color=fff" />
                            <div class="w-8 h-8 rounded-full border-2 border-surface-container bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">+1</div>
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            Jan 15, 2025
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Completed -->
            <div class="bg-surface-container rounded-2xl p-6 flex flex-col justify-between h-[320px] bg-gradient-to-br from-surface-container to-surface-container-low group hover:scale-[1.02] transition-all duration-400">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <span class="px-3 py-1 bg-success/10 text-success text-[10px] font-bold uppercase tracking-wider rounded-full border border-success/20">Completed</span>
                        <button class="text-on-surface-variant hover:text-on-surface"><span class="material-symbols-outlined">more_vert</span></button>
                    </div>
                    <h4 class="font-syne font-extrabold text-xl text-on-surface mb-2">Quantum Encryption Module</h4>
                    <p class="text-on-surface-variant text-sm line-clamp-2">Post-quantum cryptographic library integration for end-to-end user data.</p>
                </div>
                <div class="space-y-4">
                    <div class="bg-surface-container-lowest p-3 rounded-xl flex items-center gap-3">
                        <span class="material-symbols-outlined text-success">verified</span>
                        <span class="text-xs text-on-surface font-medium">Verified by Security Audit Alpha</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex -space-x-2">
                            <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=JT&background=34d399&color=fff" />
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            Nov 10, 2024
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Active -->
            <div class="bg-surface-container rounded-2xl p-6 flex flex-col justify-between h-[320px] group hover:scale-[1.02] transition-all duration-400">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider rounded-full border border-primary/20">Active</span>
                        <button class="text-on-surface-variant hover:text-on-surface"><span class="material-symbols-outlined">more_vert</span></button>
                    </div>
                    <h4 class="font-syne font-extrabold text-xl text-on-surface mb-2">CloudSync Infrastructure</h4>
                    <p class="text-on-surface-variant text-sm line-clamp-2">Multi-region deployment automation and load balancing system.</p>
                </div>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs mb-2">
                            <span class="text-on-surface-variant">Progress</span>
                            <span class="text-primary font-bold">45%</span>
                        </div>
                        <div class="w-full bg-surface-container-lowest h-2 rounded-full overflow-hidden">
                            <div class="bg-primary h-full rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex -space-x-2">
                            <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=RB&background=f472b6&color=fff" />
                            <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=LC&background=60a5fa&color=fff" />
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            Feb 28, 2025
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 5: Delayed -->
            <div class="bg-surface-container rounded-2xl p-6 flex flex-col justify-between h-[320px] group hover:scale-[1.02] transition-all duration-400">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <span class="px-3 py-1 bg-error/10 text-error text-[10px] font-bold uppercase tracking-wider rounded-full border border-error/20">Delayed</span>
                        <button class="text-on-surface-variant hover:text-on-surface"><span class="material-symbols-outlined">more_vert</span></button>
                    </div>
                    <h4 class="font-syne font-extrabold text-xl text-on-surface mb-2">DataLake Migration</h4>
                    <p class="text-on-surface-variant text-sm line-clamp-2">Legacy database migration to modern data lake architecture.</p>
                </div>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs mb-2">
                            <span class="text-on-surface-variant">Progress</span>
                            <span class="text-error font-bold">23%</span>
                        </div>
                        <div class="w-full bg-surface-container-lowest h-2 rounded-full overflow-hidden">
                            <div class="bg-error h-full rounded-full" style="width: 23%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex -space-x-2">
                            <img alt="Team" class="w-8 h-8 rounded-full border-2 border-surface-container object-cover" src="https://ui-avatars.com/api/?name=SN&background=fb923c&color=fff" />
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            Mar 15, 2025
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 6: Add New -->
            <div class="bg-surface-container-low rounded-2xl p-6 flex flex-col justify-between h-[320px] border-2 border-dashed border-surface-container-high group hover:border-primary/50 transition-all duration-400 cursor-pointer">
                <div class="flex-1 flex flex-col items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-surface-container-high flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-on-surface-variant group-hover:text-primary">add</span>
                    </div>
                    <h4 class="font-syne font-extrabold text-xl text-on-surface-variant">New Project</h4>
                    <p class="text-on-surface-variant text-sm mt-2">Create a new project</p>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/projects-hub.js') }}"></script>
@endpush