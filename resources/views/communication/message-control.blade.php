@extends("layouts.app")

<x-navbar />

@section("content")
<main class="flex-1 min-h-screen flex flex-col bg-surface">
    <div class="pt-24 px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-4xl font-extrabold font-headline tracking-tight text-primary">XenonOS</h1>
                <p class="text-on-surface-variant font-label mt-2 text-lg">Message Control Panel - v2.4.0</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-surface-container-high hover:bg-primary/20 text-on-surface px-5 py-2.5 rounded-xl font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">terminal</span>
                    System Logs
                </button>
                <button class="bg-primary hover:bg-primary/90 text-on-primary px-6 py-2.5 rounded-xl font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined">bolt</span>
                    Deploy
                </button>
            </div>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <section class="md:col-span-8 space-y-8">
                <div class="bg-surface-container-low p-8 rounded-3xl border border-white/5">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="p-3 bg-primary/10 rounded-2xl">
                            <span class="material-symbols-outlined text-primary text-2xl">settings_input_component</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-headline font-bold text-on-surface">Global Messaging Control</h2>
                            <p class="text-xs text-on-surface-variant mt-1">Master communication toggles</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-center justify-between p-5 bg-surface-container rounded-2xl border border-primary/20">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-sm">toggle_on</span>
                                    <span class="font-bold text-on-surface">System Enable</span>
                                </div>
                                <span class="text-xs text-on-surface-variant ml-6">Master override switch</span>
                            </div>
                            <button class="w-12 h-6 bg-primary rounded-full relative">
                                <div class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full"></div>
                            </button>
                        </div>
                        <div class="flex items-center justify-between p-5 bg-surface-container rounded-2xl border border-white/5">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-on-surface-variant text-sm">toggle_off</span>
                                    <span class="font-bold text-on-surface">Client-Client</span>
                                </div>
                                <span class="text-xs text-on-surface-variant ml-6">Peer communication</span>
                            </div>
                            <button class="w-12 h-6 bg-surface-container-highest rounded-full relative">
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white/40 rounded-full"></div>
                            </button>
                        </div>
                        <div class="flex items-center justify-between p-5 bg-surface-container rounded-2xl border border-primary/20">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-sm">toggle_on</span>
                                    <span class="font-bold text-on-surface">Client-Team</span>
                                </div>
                                <span class="text-xs text-on-surface-variant ml-6">Support channels</span>
                            </div>
                            <button class="w-12 h-6 bg-primary rounded-full relative">
                                <div class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full"></div>
                            </button>
                        </div>
                        <div class="flex items-center justify-between p-5 bg-surface-container rounded-2xl border border-primary/20">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-sm">toggle_on</span>
                                    <span class="font-bold text-on-surface">Team-Team</span>
                                </div>
                                <span class="text-xs text-on-surface-variant ml-6">Internal collaboration</span>
                            </div>
                            <button class="w-12 h-6 bg-primary rounded-full relative">
                                <div class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full"></div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8">
                    <div class="bg-surface-container-low p-6 rounded-3xl">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-emerald-500/10 rounded-xl">
                                    <span class="material-symbols-outlined text-emerald-400">chat</span>
                                </div>
                                <div>
                                    <h2 class="text-xl font-headline font-bold text-on-surface">P2P Chats</h2>
                                </div>
                            </div>
                            <button class="p-3 bg-emerald-500/10 text-emerald-400 rounded-xl">
                                <span class="material-symbols-outlined">chat</span>
                            </button>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400/20 to-primary/20 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-lg">person</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-on-surface">Erik Johansson</div>
                                        <div class="text-xs text-on-surface-variant flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span>
                                            Active - Encrypted
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="p-2 rounded-lg bg-surface-container-highest text-on-surface-variant hover:text-primary">
                                        <span class="material-symbols-outlined text-lg">call</span>
                                    </button>
                                    <button class="p-2 rounded-lg bg-surface-container-highest text-on-surface-variant hover:text-primary">
                                        <span class="material-symbols-outlined text-lg">more_vert</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center">
                                        <span class="material-symbols-outlined text-lg">person</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-on-surface">Sarah Chen</div>
                                        <div class="text-xs text-on-surface-variant flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                                            Idle
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="p-2 rounded-lg bg-surface-container-highest text-on-surface-variant hover:text-primary">
                                        <span class="material-symbols-outlined text-lg">more_vert</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container-low p-6 rounded-3xl">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-primary/10 rounded-xl">
                                    <span class="material-symbols-outlined text-primary">groups</span>
                                </div>
                                <div>
                                    <h2 class="text-xl font-headline font-bold text-on-surface">Group Management</h2>
                                </div>
                            </div>
                            <button class="p-3 bg-primary/10 text-primary rounded-xl">
                                <span class="material-symbols-outlined">add</span>
                            </button>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl border border-primary/20">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-purple-500 flex items-center justify-center text-white font-bold text-sm">QA</div>
                                    <div>
                                        <div class="text-sm font-bold text-on-surface">QA Cluster 7</div>
                                        <div class="text-xs text-on-surface-variant">12 Members</div>
                                    </div>
                                </div>
                                <button class="p-2 rounded-lg bg-surface-container-highest text-primary">
                                    <span class="material-symbols-outlined text-lg">lock_open</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container-low p-6 rounded-3xl">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-tertiary/10 rounded-xl">
                                    <span class="material-symbols-outlined text-tertiary">campaign</span>
                                </div>
                                <div>
                                    <h2 class="text-xl font-headline font-bold text-on-surface">Channels</h2>
                                </div>
                            </div>
                            <button class="p-3 bg-tertiary/10 text-tertiary rounded-xl">
                                <span class="material-symbols-outlined">create_new_folder</span>
                            </button>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-tertiary/20 to-tertiary/10 flex items-center justify-center text-tertiary">
                                        <span class="material-symbols-outlined">campaign</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-on-surface">Global Broadcast</div>
                                        <div class="text-xs text-on-surface-variant">Read-Only</div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="p-2 rounded-lg bg-surface-container-highest text-on-surface-variant">
                                        <span class="material-symbols-outlined text-lg">archive</span>
                                    </button>
                                    <button class="p-2 rounded-lg bg-surface-container-highest text-red-400">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <aside class="md:col-span-4 space-y-8">
                <div class="bg-surface-container-low p-6 rounded-3xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-primary/10 rounded-xl">
                            <span class="material-symbols-outlined text-primary">security</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-headline font-bold text-on-surface">Permissions</h2>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div class="p-4 bg-surface-container rounded-2xl border-l-4 border-blue-400">
                            <div class="flex items-center gap-2 mb-3 text-blue-400">
                                <span class="material-symbols-outlined text-sm">person</span>
                                <span class="font-label font-bold text-xs uppercase">Client Role</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1.5 bg-blue-400/10 text-blue-400 rounded-lg text-xs font-bold">Read</span>
                                <span class="px-3 py-1.5 bg-surface-container-highest text-on-surface-variant rounded-lg text-xs">Write</span>
                            </div>
                        </div>
                        <div class="p-4 bg-surface-container rounded-2xl border-l-4 border-primary">
                            <div class="flex items-center gap-2 mb-3 text-primary">
                                <span class="material-symbols-outlined text-sm">badge</span>
                                <span class="font-label font-bold text-xs uppercase">Member Role</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1.5 bg-primary/10 text-primary rounded-lg text-xs font-bold">Read</span>
                                <span class="px-3 py-1.5 bg-primary/10 text-primary rounded-lg text-xs font-bold">Write</span>
                                <span class="px-3 py-1.5 bg-primary/10 text-primary rounded-lg text-xs font-bold">Reply</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-surface-container-low p-6 rounded-3xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-rose-500/10 rounded-xl">
                            <span class="material-symbols-outlined text-rose-400">lock</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-headline font-bold text-on-surface">Restrictions</h2>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-surface-container rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-rose-400">block</span>
                                <span class="text-sm">Disable File Sharing</span>
                            </div>
                            <span class="material-symbols-outlined text-rose-400">toggle_on</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-surface-container rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">filter_alt</span>
                                <span class="text-sm">External Link Filter</span>
                            </div>
                            <span class="material-symbols-outlined text-primary">toggle_on</span>
                        </div>
                    </div>
                </div>
                <div class="bg-surface-container-low p-6 rounded-3xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-emerald-500/10 rounded-xl">
                            <span class="material-symbols-outlined text-emerald-400">history</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-headline font-bold text-on-surface">Activity</h2>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="w-6 h-6 rounded-full bg-primary flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-sm">verified</span>
                            </div>
                            <div class="flex-1 bg-surface-container rounded-xl p-3">
                                <div class="text-xs font-bold text-on-surface">Permissions Updated</div>
                                <div class="text-[10px] text-on-surface-variant">Admin - 2m ago</div>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-6 h-6 rounded-full bg-amber-500 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-sm">lock_reset</span>
                            </div>
                            <div class="flex-1 bg-surface-container rounded-xl p-3">
                                <div class="text-xs font-bold text-on-surface">Channel Restricted</div>
                                <div class="text-[10px] text-on-surface-variant">Security Bot - 14m ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>
@endsection
