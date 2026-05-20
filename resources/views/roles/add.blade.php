@extends('layouts.app')

@section('title', 'Add New Role - XenonOS')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/roles-add.css') }}">
@endpush

@section('content')
<main class="flex-1 min-h-screen flex flex-col">
    <div class="py-8 max-w-7xl mx-auto">
        <header class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <h1 class="font-headline text-5xl font-light tracking-tight text-white">Add New Role</h1>
                <p class="text-on-surface-variant font-body text-lg max-w-xl">Define role name, permissions, and initial user assignments.</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="px-6 py-2.5 rounded-xl border border-outline-variant/20 text-on-surface hover:bg-surface-container transition-colors font-medium">Cancel</button>
                <button class="px-8 py-2.5 rounded-xl bg-primary-container text-on-primary-container font-bold shadow-lg shadow-primary-container/20 active:scale-95 transition-all">Save Role</button>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 space-y-8">
                <section class="bg-surface-container-low p-8 rounded-3xl hover:border-outline-variant/20 transition-all duration-500 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-transparent opacity-50"></div>
                    <h3 class="font-headline text-xl font-semibold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">badge</span>
                        Role Details
                    </h3>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="role_name" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Role Name</label>
                                <input id="role_name" class="w-full bg-surface-container-highest border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-primary/50 text-white placeholder-slate-600 transition-all" placeholder="e.g. Senior Project Lead" type="text" name="role_name" />
                            </div>
                            <div class="space-y-2">
                                <label for="role_status" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Role Status</label>
                                <div role="radiogroup" aria-label="Select role status" class="flex items-center space-x-3 bg-surface-container-highest w-fit p-1 rounded-2xl">
                                    <button role="radio" aria-checked="true" class="px-4 py-2 rounded-xl bg-primary text-on-primary font-bold text-xs transition-all">Active</button>
                                    <button role="radio" aria-checked="false" class="px-4 py-2 rounded-xl text-on-surface-variant hover:text-white font-bold text-xs transition-all">Inactive</button>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="role_description" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Role Description</label>
                            <textarea id="role_description" class="w-full bg-surface-container-highest border-none rounded-2xl py-3 px-4 focus:ring-2 focus:ring-primary/50 text-white placeholder-slate-600 transition-all resize-none" placeholder="Describe the core responsibilities and scope of this role..." rows="3" name="role_description"></textarea>
                        </div>
                    </div>
                </section>

                <section class="bg-surface-container-low p-8 rounded-3xl">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="font-headline text-xl font-semibold flex items-center gap-3">
                            <span class="material-symbols-outlined text-tertiary">lock_open</span>
                            Permissions Matrix
                        </h3>
                        <button class="text-xs font-bold text-primary uppercase tracking-widest flex items-center gap-2 hover:opacity-80">
                            <span class="w-1 h-1 rounded-full bg-primary"></span>
                            Global Select All
                        </button>
                    </div>
                    <div class="space-y-10">
                        <div class="group/module">
                            <div class="flex items-center justify-between mb-4 pb-2 border-b border-outline-variant/10">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-slate-500">folder_managed</span>
                                    <h4 class="font-bold text-slate-200">Projects</h4>
                                </div>
                                <button class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest hover:text-primary transition-colors">Select All</button>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                <label class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all">
                                    <span class="text-sm text-on-surface-variant">View</span>
                                    <input checked class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                                </label>
                                <label class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all">
                                    <span class="text-sm text-on-surface-variant">Edit</span>
                                    <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                                </label>
                                <label class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all">
                                    <span class="text-sm text-on-surface-variant">Delete</span>
                                    <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                                </label>
                                <label class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all">
                                    <span class="text-sm text-on-surface-variant">Assign</span>
                                    <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                                </label>
                            </div>
                        </div>

                        <div class="group/module">
                            <div class="flex items-center justify-between mb-4 pb-2 border-b border-outline-variant/10">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-slate-500">payments</span>
                                    <h4 class="font-bold text-slate-200">Billing</h4>
                                </div>
                                <button class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest hover:text-primary transition-colors">Select All</button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <label class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all">
                                    <span class="text-sm text-on-surface-variant">View Invoices</span>
                                    <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                                </label>
                                <label class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all">
                                    <span class="text-sm text-on-surface-variant">Edit Billing</span>
                                    <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                                </label>
                                <label class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all">
                                    <span class="text-sm text-on-surface-variant">Approve Payments</span>
                                    <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                                </label>
                            </div>
                        </div>

                        <div class="group/module">
                            <div class="flex items-center justify-between mb-4 pb-2 border-b border-outline-variant/10">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-slate-500">notifications_active</span>
                                    <h4 class="font-bold text-slate-200">Notifications</h4>
                                </div>
                                <button class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest hover:text-primary transition-colors">Select All</button>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all">
                                    <div class="flex flex-col">
                                        <span class="text-sm text-on-surface-variant">Manage Settings</span>
                                        <span class="text-[10px] text-slate-500">Global alert configurations</span>
                                    </div>
                                    <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                                </label>
                                <label class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all">
                                    <div class="flex flex-col">
                                        <span class="text-sm text-on-surface-variant">Receive Critical Alerts</span>
                                        <span class="text-[10px] text-slate-500">High priority system notifications</span>
                                    </div>
                                    <input checked class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                                </label>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-4 space-y-8">
                <section class="bg-surface-container p-6 rounded-3xl sticky top-28">
                    <div class="mb-6">
                        <h3 class="font-headline text-lg font-semibold mb-1 flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">person_add</span>
                            Assign Users
                        </h3>
                        <p class="text-xs text-on-surface-variant">Select users to inherit this role immediately.</p>
                    </div>
                    <div class="relative mb-6">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm">person_search</span>
                        <input class="w-full bg-surface-container-highest border-none rounded-2xl py-3 pl-10 pr-4 focus:ring-1 focus:ring-primary/40 text-xs text-white placeholder-slate-600 transition-all" placeholder="Search team members..." type="text" name="search_team_members" />
                    </div>
                    <div class="space-y-3 max-h-[400px] overflow-y-auto hide-scrollbar pr-1">
                        <label class="flex items-center justify-between p-3 bg-surface-container-low rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all border border-transparent hover:border-primary/10">
                            <div class="flex items-center space-x-3">
                                <img alt="Team member" class="w-8 h-8 rounded-full border border-outline-variant/10" src="https://ui-avatars.com/api/?name=Alex+Rivera&background=818cf8&color=fff&size=64" />
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-white">Alex Rivera</span>
                                    <span class="text-[10px] text-slate-500">Design Lead</span>
                                </div>
                            </div>
                            <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                        </label>

                        <label class="flex items-center justify-between p-3 bg-surface-container-low rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all border border-transparent hover:border-primary/10">
                            <div class="flex items-center space-x-3">
                                <img alt="Team member" class="w-8 h-8 rounded-full border border-outline-variant/10" src="https://ui-avatars.com/api/?name=Sarah+Chen&background=c084fc&color=fff&size=64" />
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-white">Sarah Chen</span>
                                    <span class="text-[10px] text-slate-500">Senior Dev</span>
                                </div>
                            </div>
                            <input checked class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                        </label>

                        <label class="flex items-center justify-between p-3 bg-surface-container-low rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all border border-transparent hover:border-primary/10">
                            <div class="flex items-center space-x-3">
                                <img alt="Team member" class="w-8 h-8 rounded-full border border-outline-variant/10" src="https://ui-avatars.com/api/?name=Marcus+Thornton&background=f87171&color=fff&size=64" />
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-white">Marcus Thornton</span>
                                    <span class="text-[10px] text-slate-500">Account Manager</span>
                                </div>
                            </div>
                            <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                        </label>

                        <label class="flex items-center justify-between p-3 bg-surface-container-low rounded-2xl cursor-pointer hover:bg-surface-container-high transition-all border border-transparent hover:border-primary/10">
                            <div class="flex items-center space-x-3">
                                <img alt="Team member" class="w-8 h-8 rounded-full border border-outline-variant/10" src="https://ui-avatars.com/api/?name=Elena+Rodriguez&background=34d399&color=fff&size=64" />
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-white">Elena Rodriguez</span>
                                    <span class="text-[10px] text-slate-500">Junior Designer</span>
                                </div>
                            </div>
                            <input class="rounded-md bg-surface-container-highest border-none text-primary focus:ring-primary focus:ring-offset-0" type="checkbox" />
                        </label>
                    </div>

                    <div class="mt-8 pt-6 border-t border-outline-variant/10">
                        <div class="bg-primary/5 rounded-2xl p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-primary uppercase tracking-widest">Summary</span>
                                <span class="text-xs text-on-surface-variant">1 User Selected</span>
                            </div>
                            <div class="text-[11px] text-slate-400 leading-relaxed">
                                Selected users will receive an email notification about their new role assignments once saved.
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
