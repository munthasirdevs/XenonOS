@extends("layouts.app")

@section("content")
<main class="flex-1 min-h-screen flex flex-col bg-surface text-on-surface font-body selection:bg-primary/30">
<div class="pt-24 px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <form id="create-conversation-form" method="POST" action="{{ route('communication.store') }}" class="contents">
            @csrf
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="font-headline font-extrabold text-4xl tracking-tighter text-on-surface mb-2">Create Conversation</h1>
                <p class="text-on-surface-variant max-w-xl">Architect a new communication hub.</p>
            </div>
        <div class="flex items-center gap-4 bg-surface-container-low p-1.5 rounded-2xl border border-outline-variant/10">
                <button type="submit" form="create-conversation-form" class="px-6 py-2.5 rounded-xl text-sm font-semibold bg-primary text-on-primary shadow-lg">Create</button>
                <a href="{{ route('communication') }}" class="px-6 py-2.5 rounded-xl text-sm font-semibold text-on-surface-variant hover:bg-surface-container-highest">Cancel</a>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-8 space-y-8">
                <section class="bg-surface-container rounded-2xl p-8 shadow-sm">
                    <div class="grid grid-cols-3 gap-4 mb-10">
                        <label class="relative cursor-pointer group">
                            <input checked class="peer sr-only" name="conv_type" type="radio" />
                            <div class="p-4 rounded-xl border border-outline-variant/20 bg-surface-container-low peer-checked:border-primary peer-checked:bg-primary/5 transition-all flex flex-col items-center gap-2">
                                <span class="material-symbols-outlined text-primary">person</span>
                                <span class="text-xs font-bold uppercase tracking-widest">P2P</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input class="peer sr-only" name="conv_type" type="radio" />
                            <div class="p-4 rounded-xl border border-outline-variant/20 bg-surface-container-low peer-checked:border-primary peer-checked:bg-primary/5 transition-all flex flex-col items-center gap-2">
                                <span class="material-symbols-outlined text-primary">group</span>
                                <span class="text-xs font-bold uppercase tracking-widest">Group</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input class="peer sr-only" name="conv_type" type="radio" />
                            <div class="p-4 rounded-xl border border-outline-variant/20 bg-surface-container-low peer-checked:border-primary peer-checked:bg-primary/5 transition-all flex flex-col items-center gap-2">
                                <span class="material-symbols-outlined text-primary">podcasts</span>
                                <span class="text-xs font-bold uppercase tracking-widest">Channel</span>
                            </div>
                        </label>
                    </div>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-on-surface-variant ml-1">Conversation Name</label>
                            <input class="w-full bg-surface border-none rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-primary/40 text-on-surface" placeholder="e.g. Q4 Strategy Sync" type="text" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-on-surface-variant ml-1">Description</label>
                            <textarea class="w-full bg-surface border-none rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-primary/40 text-on-surface" placeholder="Define the objective..." rows="3"></textarea>
                        </div>
                    </div>
                </section>
                <div class="space-y-6">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                        <input type="text" placeholder="Search workers..." class="w-full bg-surface-container-low border-none rounded-2xl pl-14 pr-4 py-4 focus:ring-2 focus:ring-primary/40 text-on-surface" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-surface-container rounded-2xl p-6 flex flex-col h-[400px]">
                            <h3 class="font-headline font-bold text-lg mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">engineering</span>
                                Workers
                            </h3>
                            <div class="overflow-y-auto space-y-3 flex-1 pr-2">
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-surface-container-low hover:bg-surface-container-high group">
                                    <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Erik+Johansson&background=4f46e5&color=fff&size=40" />
                                    <div>
                                        <p class="text-sm font-semibold">Erik Johansson</p>
                                        <p class="text-xs text-on-surface-variant">Lead Architect</p>
                                    </div>
                                    <span class="material-symbols-outlined ml-auto opacity-0 group-hover:opacity-100 text-primary">add_circle</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-surface-container-low hover:bg-surface-container-high group">
                                    <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Sarah+Chen&background=8b5cf6&color=fff&size=40" />
                                    <div>
                                        <p class="text-sm font-semibold">Sarah Chen</p>
                                        <p class="text-xs text-on-surface-variant">UI Designer</p>
                                    </div>
                                    <span class="material-symbols-outlined ml-auto opacity-0 group-hover:opacity-100 text-primary">add_circle</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-surface-container rounded-2xl p-6 flex flex-col h-[400px]">
                            <h3 class="font-headline font-bold text-lg mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">groups</span>
                                Clients
                            </h3>
                            <div class="overflow-y-auto space-y-3 flex-1 pr-2">
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-surface-container-low hover:bg-surface-container-high group">
                                    <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Elena+Rodriguez&background=10b981&color=fff&size=40" />
                                    <div>
                                        <p class="text-sm font-semibold">Elena Rodriguez</p>
                                        <p class="text-xs text-on-surface-variant">Nexus Corp</p>
                                    </div>
                                    <span class="material-symbols-outlined ml-auto opacity-0 group-hover:opacity-100 text-primary">add_circle</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="bg-surface-container rounded-2xl overflow-hidden shadow-sm">
                    <div class="p-6 border-b border-outline-variant/10 flex justify-between items-center">
                        <h3 class="font-headline font-bold text-lg">Selected People</h3>
                        <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full">4 Active</span>
                    </div>
                    <table class="w-full text-left text-sm">
                        <thead class="bg-surface-container-low">
                            <tr>
                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-surface-container-high">
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold text-xs">EJ</div>
                                    Erik Johansson
                                </td>
                                <td class="px-6 py-4">
                                    <select class="bg-surface border-none rounded-lg text-xs py-1.5">
                                        <option>Admin</option>
                                        <option selected>Member</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="w-8 h-4 bg-primary/40 rounded-full relative mx-auto">
                                        <div class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <section class="bg-surface-container rounded-2xl p-6">
                        <h3 class="font-headline font-bold text-lg mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">security</span>
                            Global Permissions
                        </h3>
                        <div class="space-y-5">
                            <div class="flex items-center justify-between">
                                <span class="text-sm">Allow messages</span>
                                <div class="w-10 h-5 bg-primary/40 rounded-full relative cursor-pointer">
                                    <div class="absolute right-1 top-1 w-3 h-3 bg-white rounded-full"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm">Allow replies</span>
                                <div class="w-10 h-5 bg-primary/40 rounded-full relative cursor-pointer">
                                    <div class="absolute right-1 top-1 w-3 h-3 bg-white rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="bg-surface-container rounded-2xl p-6">
                        <h3 class="font-headline font-bold text-lg mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">visibility_off</span>
                            Visibility
                        </h3>
                        <div class="space-y-4">
                            <div class="p-3 rounded-xl bg-surface-container-low border border-primary/20">
                                <p class="text-sm font-semibold">Public</p>
                                <p class="text-xs text-on-surface-variant">Visible to workspace</p>
                            </div>
                            <div class="p-3 rounded-xl bg-surface-container-low">
                                <p class="text-sm font-semibold">Private</p>
                                <p class="text-xs text-on-surface-variant">Only invited</p>
                            </div>
                        </div>
                    </section>
                </div>
                <section class="bg-surface-container rounded-2xl p-8">
                    <h3 class="font-headline font-bold text-lg mb-4">Initial Message</h3>
                    <textarea class="w-full bg-surface border-none rounded-xl px-4 py-4" placeholder="Start the conversation..." rows="4"></textarea>
                </section>
            </div>
            <div class="lg:col-span-4 sticky top-12 space-y-6">
                <div class="bg-surface-container-high rounded-2xl p-6 shadow-2xl">
                    <h2 class="font-headline font-bold text-xl mb-6">Summary</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-surface-container rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="font-bold">Participants</span>
                            </div>
                            <span class="font-headline font-extrabold text-2xl text-primary">04</span>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-sm">
                                <span class="material-symbols-outlined text-primary text-sm">check_circle</span>
                                Public
                            </li>
                        </ul>
                        <button type="submit" class="w-full bg-primary text-on-primary font-bold p-4 rounded-xl">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
