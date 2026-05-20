@extends("layouts.app")

@section("content")
<main class="flex-1 min-h-screen flex flex-col bg-surface antialiased">
    <div class="pt-24 px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <header class="flex justify-between items-end">
            <div>
                <h1 class="font-headline text-4xl font-extrabold tracking-tighter text-primary">Monitor</h1>
                <p class="font-display text-on-surface-variant text-sm mt-1">Real-time communication intelligence</p>
            </div>
            <div class="flex gap-4">
                <div class="flex items-center gap-2 px-4 py-2 rounded-full glass-panel border-l-4 border-primary">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-primary"></span>
                    </span>
                    <span class="text-xs font-bold uppercase tracking-widest">System Live</span>
                </div>
            </div>
        </header>
        <main class="grid grid-cols-12 gap-8">
            <div class="col-span-12">
                <div class="flex flex-wrap gap-3 items-center">
                    <button class="bg-primary text-white px-6 py-2.5 rounded-xl font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">chat</span> Active
                    </button>
                    <button class="glass-panel text-on-surface-variant px-6 py-2.5 rounded-xl font-medium flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">pause_circle</span> Paused
                    </button>
                    <button class="glass-panel text-on-surface-variant px-6 py-2.5 rounded-xl font-medium flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">block</span> Blocked
                    </button>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8 bg-surface-container rounded-2xl p-6 border border-white/5">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline text-xl font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">forum</span>
                        Active Conversations
                    </h3>
                    <span class="text-xs bg-indigo-500/10 text-primary px-3 py-1 rounded-full">42 Live</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-on-surface-variant text-xs uppercase tracking-widest">
                                <th class="pb-4">User A</th>
                                <th class="pb-4">User B</th>
                                <th class="pb-4">Type</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4">Last Message</th>
                                <th class="pb-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-sm">
                            <tr class="group hover:bg-white/[0.02]">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="h-8 w-8 rounded-lg" src="https://ui-avatars.com/api/?name=Alex+Rivera&background=4f46e5&color=fff&size=32" />
                                        <span class="font-medium">Alex Rivera</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="h-8 w-8 rounded-lg" src="https://ui-avatars.com/api/?name=Sarah+Kim&background=ec4899&color=fff&size=32" />
                                        <span class="font-medium">Sarah Kim</span>
                                    </div>
                                </td>
                                <td class="py-4"><span class="px-2 py-1 bg-white/5 rounded text-[10px] uppercase font-bold">DM</span></td>
                                <td class="py-4 text-emerald-400 flex items-center gap-1.5">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> Active
                                </td>
                                <td class="py-4 text-on-surface-variant truncate max-w-[150px]">Can you review the design?</td>
                                <td class="py-4 text-right">
                                    <button class="text-primary font-bold hover:underline">Open</button>
                                </td>
                            </tr>
                            <tr class="group hover:bg-white/[0.02]">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="h-8 w-8 rounded-lg" src="https://ui-avatars.com/api/?name=Elena+Chen&background=8b5cf6&color=fff&size=32" />
                                        <span class="font-medium">Elena Chen</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="h-8 w-8 rounded-lg" src="https://ui-avatars.com/api/?name=David+Park&background=10b981&color=fff&size=32" />
                                        <span class="font-medium">David Park</span>
                                    </div>
                                </td>
                                <td class="py-4"><span class="px-2 py-1 bg-white/5 rounded text-[10px] uppercase font-bold">P2P</span></td>
                                <td class="py-4 text-emerald-400 flex items-center gap-1.5">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> Active
                                </td>
                                <td class="py-4 text-on-surface-variant">Payload verified...</td>
                                <td class="py-4 text-right">
                                    <button class="text-primary font-bold hover:underline">Open</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4 flex flex-col gap-8">
                <div class="bg-surface-container rounded-2xl p-6 border border-white/5">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-headline text-xl font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-rose-500">warning</span>
                            Alerts
                        </h3>
                    </div>
                    <div class="space-y-4">
                        <div class="p-4 bg-rose-500/5 rounded-xl border-l-4 border-rose-500">
                            <div class="flex justify-between text-xs font-bold text-rose-500 mb-1">
                                <span>Suspicious Activity</span>
                                <span>2m ago</span>
                            </div>
                            <p class="text-sm">Multiple rapid login attempts from masked IP.</p>
                        </div>
                        <div class="p-4 bg-amber-500/5 rounded-xl border-l-4 border-amber-500">
                            <div class="flex justify-between text-xs font-bold text-amber-500 mb-1">
                                <span>Spam Detection</span>
                                <span>14m ago</span>
                            </div>
                            <p class="text-sm">Bulk messaging trigger detected.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6 bg-surface-container rounded-2xl p-6">
                <h3 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">groups</span>
                    Group Monitor
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-white/[0.03] rounded-xl border border-white/5">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-bold text-xs">HQ</div>
                            <div>
                                <p class="font-bold text-sm">Strategic Operations</p>
                                <p class="text-xs text-on-surface-variant">24 Members</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6 bg-surface-container rounded-2xl p-6">
                <h3 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">podcasts</span>
                    Channel Monitor
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-white/5 bg-white/[0.02]">
                        <div class="flex justify-between items-start mb-3">
                            <p class="font-bold text-sm">#emergency</p>
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                        </div>
                        <span class="text-[10px] bg-indigo-500/10 text-indigo-300 px-2 py-0.5 rounded">Critical</span>
                    </div>
                    <div class="p-4 rounded-xl border border-white/5 bg-white/[0.02]">
                        <div class="flex justify-between items-start mb-3">
                            <p class="font-bold text-sm">#network</p>
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        </div>
                        <span class="text-[10px] bg-indigo-500/10 text-indigo-300 px-2 py-0.5 rounded">System</span>
                    </div>
                </div>
                <button class="mt-6 p-3 border border-dashed border-white/10 rounded-xl text-on-surface-variant text-sm hover:bg-white/5">+ Create Channel</button>
            </div>
            <div class="col-span-12 bg-primary rounded-2xl p-6 text-white">
                <h3 class="font-headline text-lg font-bold mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <button class="bg-white/10 hover:bg-white/20 py-3 px-2 rounded-xl text-xs font-bold flex flex-col items-center gap-2">
                        <span class="material-symbols-outlined">person_off</span> Block/Mute
                    </button>
                    <button class="bg-white/10 hover:bg-white/20 py-3 px-2 rounded-xl text-xs font-bold flex flex-col items-center gap-2">
                        <span class="material-symbols-outlined">cancel_schedule_send</span> Disable Chat
                    </button>
                    <button class="bg-white/10 hover:bg-white/20 py-3 px-2 rounded-xl text-xs font-bold flex flex-col items-center gap-2">
                        <span class="material-symbols-outlined">lock</span> Lock
                    </button>
                    <button class="bg-black/20 hover:bg-black/30 py-3 px-2 rounded-xl text-xs font-bold flex flex-col items-center gap-2">
                        <span class="material-symbols-outlined">emergency</span> Lockdown
                    </button>
                </div>
            </div>
        </main>
    </div>
</main>
@endsection
