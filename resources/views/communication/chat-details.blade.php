@extends('layouts.app')

<x-navbar />

@section('content')
<main class="flex-1 min-h-screen flex flex-col bg-surface">
    <div class="pt-24 px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 h-full">
            <aside class="lg:col-span-3 space-y-6">
                <section class="bg-surface-container rounded-2xl p-5 shadow-sm">
                    <h3 class="font-label font-bold text-sm mb-4 tracking-wider text-indigo-300">PARTICIPANTS</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <img class="w-9 h-9 rounded-full object-cover grayscale group-hover:grayscale-0 transition-all" src="https://ui-avatars.com/api/?name=Admin+Xenon&background=1e1b4b&color=fff&size=36" />
                                <div>
                                    <p class="text-sm font-semibold">Admin_Xenon</p>
                                    <p class="text-[10px] text-indigo-400 font-label">Lead Architect</p>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-variant text-sm">verified</span>
                        </div>
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <img class="w-9 h-9 rounded-full object-cover grayscale group-hover:grayscale-0 transition-all" src="https://ui-avatars.com/api/?name=Nova+Protocol&background=312e81&color=fff&size=36" />
                                <div>
                                    <p class="text-sm font-semibold">Nova_Protocol</p>
                                    <p class="text-[10px] text-on-surface-variant font-label">Read/Write</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between group opacity-60">
                            <div class="flex items-center gap-3">
                                <img class="w-9 h-9 rounded-full object-cover grayscale group-hover:grayscale-0 transition-all" src="https://ui-avatars.com/api/?name=Void+Walker&background=881337&color=fff&size=36" />
                                <div>
                                    <p class="text-sm font-semibold">Void_Walker</p>
                                    <p class="text-[10px] text-red-400 font-label">Muted</p>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-red-500 text-sm">volume_off</span>
                        </div>
                    </div>
                    <button class="w-full mt-6 py-2 border-t border-outline-variant/10 text-xs font-label text-on-surface-variant hover:text-indigo-400 transition-colors">Manage Permissions</button>
                </section>
                <section class="bg-surface-container rounded-2xl p-5 relative overflow-hidden shadow-sm">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-600/5 blur-2xl -mr-12 -mt-12"></div>
                    <h3 class="font-label font-bold text-sm mb-4 tracking-wider text-indigo-300">PROTOCOL RULES</h3>
                    <div class="space-y-4">
                        <div class="p-3 rounded-xl bg-surface-container-low">
                            <p class="text-xs font-label text-indigo-300 mb-1">Access Level</p>
                            <p class="text-sm font-medium">Restricted: Xenon-42</p>
                        </div>
                        <div class="p-3 rounded-xl bg-surface-container-low">
                            <p class="text-xs font-label text-on-surface-variant mb-1">Expiry Date</p>
                            <p class="text-sm font-medium">Infinite Session</p>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm text-green-400">link</span>
                            Linked to Project: <span class="text-indigo-300 font-medium italic underline underline-offset-4 cursor-pointer">X-Gate-24</span>
                        </div>
                    </div>
                </section>
            </aside>
            <div class="lg:col-span-6 space-y-6">
                <nav class="flex items-center justify-between bg-surface-container/60 backdrop-blur-md p-2 rounded-2xl">
                    <div class="flex items-center gap-1">
                        <button class="p-3 hover:bg-surface-container-low rounded-xl text-on-surface-variant hover:text-indigo-400 transition-all flex items-center gap-2 text-sm font-label">
                            <span class="material-symbols-outlined">delete</span> Delete
                        </button>
                        <button class="p-3 hover:bg-surface-container-low rounded-xl text-on-surface-variant hover:text-indigo-400 transition-all flex items-center gap-2 text-sm font-label">
                            <span class="material-symbols-outlined">visibility_off</span> Hide
                        </button>
                    </div>
                    <div class="flex items-center gap-1">
                        <button class="p-3 hover:bg-surface-container-low rounded-xl text-on-surface-variant hover:text-red-400 transition-all flex items-center gap-2 text-sm font-label">
                            <span class="material-symbols-outlined">flag</span> Flag
                        </button>
                        <button class="p-3 hover:bg-surface-container-low rounded-xl text-on-surface-variant hover:text-green-400 transition-all flex items-center gap-2 text-sm font-label">
                            <span class="material-symbols-outlined">restore_from_trash</span> Restore
                        </button>
                    </div>
                </nav>
                <section class="bg-surface-container rounded-2xl p-6 min-h-[500px] flex flex-col shadow-sm">
                    <div class="flex-1 space-y-8">
                        <div class="flex gap-4">
                            <img class="w-10 h-10 rounded-xl object-cover shrink-0" src="https://ui-avatars.com/api/?name=Admin+Xenon&background=1e1b4b&color=fff&size=40" />
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-bold text-indigo-300">Admin_Xenon</span>
                                    <span class="text-[10px] text-on-surface-variant/60 font-label">14:22:18 - DELIVERED</span>
                                </div>
                                <div class="bg-surface-container-low p-4 rounded-2xl rounded-tl-none max-w-[85%]">
                                    <p class="text-sm leading-relaxed">System scan complete. Initializing node cluster 04. Please verify the integrity hashes before proceeding with the P2P handshake.</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4 flex-row-reverse">
                            <img class="w-10 h-10 rounded-xl object-cover shrink-0" src="https://ui-avatars.com/api/?name=Nova+Protocol&background=312e81&color=fff&size=40" />
                            <div class="flex-1">
                                <div class="flex items-center flex-row-reverse justify-between mb-1">
                                    <span class="text-sm font-bold text-on-surface">Nova_Protocol</span>
                                    <span class="text-[10px] text-on-surface-variant/60 font-label">14:24:05 - READ</span>
                                </div>
                                <div class="bg-primary/10 ml-auto p-4 rounded-2xl rounded-tr-none border border-primary/20 max-w-[85%]">
                                    <p class="text-sm leading-relaxed">Copy that. Running hash verification now. Node 04-A is reporting stable telemetry.</p>
                                    <div class="mt-3 flex items-center gap-3 bg-surface-container-high p-2.5 rounded-lg">
                                        <span class="material-symbols-outlined text-indigo-400">description</span>
                                        <div class="flex-1">
                                            <p class="text-[10px] font-bold">hash_report_v2.log</p>
                                            <p class="text-[9px] text-on-surface-variant">1.4 MB - JSON</p>
                                        </div>
                                        <span class="material-symbols-outlined text-sm cursor-pointer hover:text-indigo-400">download</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="px-4 py-1.5 bg-surface-container-low rounded-full flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                <span class="text-[10px] font-label text-on-surface-variant uppercase tracking-widest">Protocol Override by Void_Walker</span>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <img class="w-10 h-10 rounded-xl object-cover shrink-0 opacity-40" src="https://ui-avatars.com/api/?name=Void+Walker&background=881337&color=fff&size=40" />
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-bold text-red-400">Void_Walker (MUTED)</span>
                                    <span class="text-[10px] text-on-surface-variant/60 font-label">14:30:12 - FLAG_PENDING</span>
                                </div>
                                <div class="bg-error-container/10 p-4 rounded-2xl rounded-tl-none max-w-[85%] blur-[0.5px]">
                                    <p class="text-sm italic text-on-surface-variant">Message flagged for rule violation: Unauthorized script injection attempt detected.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-4 border-t border-outline-variant/10">
                        <div class="flex items-center gap-4 bg-surface-container-low p-2 rounded-xl">
                            <button class="p-2 hover:text-indigo-400 transition-colors">
                                <span class="material-symbols-outlined">add_circle</span>
                            </button>
                            <input class="bg-transparent border-none focus:ring-0 w-full text-sm font-label" placeholder="Send system command or message..." type="text" />
                            <button class="bg-indigo-600 p-2 px-4 rounded-lg hover:bg-indigo-500 transition-colors">
                                <span class="material-symbols-outlined text-white">send</span>
                            </button>
                        </div>
                    </div>
                </section>
            </div>
            <aside class="lg:col-span-3 space-y-6">
                <section class="bg-surface-container rounded-2xl p-5 shadow-sm">
                    <h3 class="font-label font-bold text-sm mb-4 tracking-wider text-indigo-300">VISIBILITY MATRIX</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-on-surface-variant">public</span>
                                <span class="text-xs font-label">Public View</span>
                            </div>
                            <div class="w-8 h-4 bg-surface-container-highest rounded-full relative cursor-pointer">
                                <div class="absolute top-0.5 left-0.5 w-3 h-3 bg-on-surface-variant rounded-full"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-indigo-400">
                                <span class="material-symbols-outlined">shield</span>
                                <span class="text-xs font-label font-bold">Encrypted Archive</span>
                            </div>
                            <div class="w-8 h-4 bg-indigo-600 rounded-full relative cursor-pointer">
                                <div class="absolute top-0.5 right-0.5 w-3 h-3 bg-white rounded-full"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-on-surface-variant">edit_note</span>
                                <span class="text-xs font-label">Write Access</span>
                            </div>
                            <div class="w-8 h-4 bg-indigo-600 rounded-full relative cursor-pointer">
                                <div class="absolute top-0.5 right-0.5 w-3 h-3 bg-white rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-surface-container rounded-2xl p-5 shadow-sm">
                    <h3 class="font-label font-bold text-sm mb-4 tracking-wider text-indigo-300">ACTIVITY LOG</h3>
                    <div class="space-y-5">
                        <div class="flex gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 mt-1.5 shrink-0"></div>
                            <div>
                                <p class="text-xs font-medium">Chat name modified</p>
                                <p class="text-[10px] text-on-surface-variant font-label">Admin_Xenon - 45m ago</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></div>
                            <div>
                                <p class="text-xs font-medium text-red-400">Security breach attempt</p>
                                <p class="text-[10px] text-on-surface-variant font-label">IP: 192.168.1.1 - 2h ago</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-green-500 mt-1.5 shrink-0"></div>
                            <div>
                                <p class="text-xs font-medium">New participant added</p>
                                <p class="text-[10px] text-on-surface-variant font-label">Nova_Protocol - 5h ago</p>
                            </div>
                        </div>
                    </div>
                    <button class="w-full mt-6 flex items-center justify-center gap-2 text-[10px] font-label font-bold uppercase tracking-widest text-indigo-400 hover:text-indigo-300">
                        View Full History <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </button>
                </section>
                <section class="bg-surface-container-high rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-indigo-400">analytics</span>
                        <h3 class="font-label font-bold text-xs tracking-wider">NETWORK IMPACT</h3>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-lg font-bold">1.2 TB</p>
                            <p class="text-[9px] text-on-surface-variant font-label uppercase">Data Flow</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold">99.9%</p>
                            <p class="text-[9px] text-on-surface-variant font-label uppercase">Uptime</p>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </div>
</main>
@endsection
