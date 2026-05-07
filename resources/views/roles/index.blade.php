@extends('layouts.app')

@section('title', 'Roles & Permissions - System Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/roles-index.css') }}">
@endpush

@section('content')
<x-navbar />

<div class="p-8">
    <section class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-5xl font-light font-headline tracking-tight text-on-surface">Roles &amp; Permissions</h2>
            <p class="text-on-surface-variant mt-2 max-w-lg">Manage organizational hierarchies and granular access control for your workspace modules.</p>
        </div>
        <button class="bg-primary text-on-primary font-bold px-6 py-3 rounded-xl flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-lg">add</span>
            Add New Role
        </button>
    </section>

    <section class="grid grid-cols-1 gap-8 mb-12">
        <div class="bg-surface-container-low rounded-2xl overflow-hidden shadow-xl group transition-all duration-300 hover:-translate-y-1">
            <div class="p-6 border-b border-outline-variant/10 flex justify-between items-center">
                <h3 class="text-lg font-semibold font-headline">Active Directory</h3>
                <span class="text-xs text-on-surface-variant font-medium">4 Total Roles</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-surface-container/50 text-on-surface-variant text-[11px] uppercase tracking-widest font-bold">
                        <tr>
                            <th class="px-8 py-4">Role Name</th>
                            <th class="px-8 py-4">Users Assigned</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        <tr class="hover:bg-surface-bright/20 transition-colors">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-8 bg-primary rounded-full"></div>
                                    <div>
                                        <p class="font-semibold text-on-surface">Project Manager</p>
                                        <p class="text-xs text-on-surface-variant">Default administrative role</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex -space-x-2">
                                    <img class="w-8 h-8 rounded-full border-2 border-surface-container-low" alt="Team member Sarah" src="https://ui-avatars.com/api/?name=Sarah&amp;background=random&amp;size=32" />
                                    <img class="w-8 h-8 rounded-full border-2 border-surface-container-low" alt="Team member Marcus" src="https://ui-avatars.com/api/?name=Marcus&amp;background=random&amp;size=32" />
                                    <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface-container-low flex items-center justify-center text-[10px] font-bold">+12</div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase tracking-tighter">Active</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="p-2 hover:bg-surface-container rounded-lg text-slate-400 hover:text-primary transition-all">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                    <button class="p-2 hover:bg-surface-container rounded-lg text-slate-400 hover:text-tertiary transition-all">
                                        <span class="material-symbols-outlined text-lg">content_copy</span>
                                    </button>
                                    <button class="p-2 hover:bg-surface-container rounded-lg text-slate-400 hover:text-error transition-all">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="bg-surface-container/30">
                            <td class="px-8 py-5 border-l-4 border-primary">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-8 bg-tertiary rounded-full"></div>
                                    <div>
                                        <p class="font-semibold text-on-surface">Senior Developer</p>
                                        <p class="text-xs text-on-surface-variant">Write access to main repository</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex -space-x-2">
                                    <img class="w-8 h-8 rounded-full border-2 border-surface-container-low" alt="Team member David" src="https://ui-avatars.com/api/?name=David&amp;background=random&amp;size=32" />
                                    <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface-container-low flex items-center justify-center text-[10px] font-bold">+5</div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase tracking-tighter">Active</span>
                            </td>
                            <td class="px-8 py-5 text-right text-primary font-bold text-xs uppercase tracking-widest italic">Current View</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <section class="lg:col-span-2 space-y-6">
            <div class="bg-surface-container rounded-2xl p-8 shadow-lg relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-transparent"></div>
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="text-xl font-headline font-semibold">Permission Matrix</h3>
                        <p class="text-sm text-on-surface-variant">Configuring: <span class="text-primary font-bold">Project Manager</span></p>
                    </div>
                    <div class="flex gap-2">
                        <button class="text-xs font-bold text-primary px-4 py-2 bg-primary/5 rounded-lg border border-primary/10">SELECT ALL</button>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-xl group hover:bg-surface-bright/10 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">folder</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm">Projects</p>
                                <p class="text-xs text-on-surface-variant">Create, edit and archive workspace projects</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input checked class="sr-only peer" type="checkbox" aria-label="Enable projects permission" />
                            <div class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-xl group hover:bg-surface-bright/10 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">assignment</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm">Tasks &amp; Workflows</p>
                                <p class="text-xs text-on-surface-variant">Assign tickets and update board status</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input checked class="sr-only peer" type="checkbox" aria-label="Enable tasks and workflows permission" />
                            <div class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-xl group hover:bg-surface-bright/10 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-tertiary">
                                <span class="material-symbols-outlined">description</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm">File Management</p>
                                <p class="text-xs text-on-surface-variant">Upload assets and manage storage</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input class="sr-only peer" type="checkbox" aria-label="Enable file management permission" />
                            <div class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-xl group hover:bg-surface-bright/10 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">forum</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm">Chat &amp; Comms</p>
                                <p class="text-xs text-on-surface-variant">Access to global channels and DM history</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input checked class="sr-only peer" type="checkbox" aria-label="Enable chat and communications permission" />
                            <div class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-xl group hover:bg-surface-bright/10 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-error">
                                <span class="material-symbols-outlined">payments</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm">Billing &amp; Invoices</p>
                                <p class="text-xs text-on-surface-variant">View financial statements and subscription</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input class="sr-only peer" type="checkbox" aria-label="Enable billing and invoices permission" />
                            <div class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-8">
            <div class="bg-surface-container-low rounded-2xl p-6">
                <h3 class="font-headline font-semibold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">person_add</span>
                    Assign Users
                </h3>
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between p-3 bg-surface-container rounded-xl">
                        <div class="flex items-center gap-3">
                            <img class="w-8 h-8 rounded-full object-cover" alt="Team member Chloe Jenkins" src="https://ui-avatars.com/api/?name=Chloe+Jenkins&amp;background=random&amp;size=32" />
                            <div>
                                <p class="text-xs font-bold">Chloe Jenkins</p>
                                <p class="text-[10px] text-on-surface-variant">Lead Designer</p>
                            </div>
                        </div>
                        <button class="text-error hover:scale-110 transition-transform" aria-label="Remove Chloe Jenkins">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-surface-container rounded-xl">
                        <div class="flex items-center gap-3">
                            <img class="w-8 h-8 rounded-full object-cover" alt="Team member Ryan Thornton" src="https://ui-avatars.com/api/?name=Ryan+Thornton&amp;background=random&amp;size=32" />
                            <div>
                                <p class="text-xs font-bold">Ryan Thornton</p>
                                <p class="text-[10px] text-on-surface-variant">Motion Artist</p>
                            </div>
                        </div>
                        <button class="text-error hover:scale-110 transition-transform" aria-label="Remove Ryan Thornton">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <input class="w-full bg-surface-container border-none rounded-xl pl-4 pr-10 py-3 text-sm focus:ring-1 focus:ring-primary/50 placeholder:text-slate-500" placeholder="Add users..." type="text" name="search_users" />
                    <span class="material-symbols-outlined absolute right-3 top-3 text-slate-500">search</span>
                </div>
            </div>

            <div class="bg-surface-container-low rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline font-semibold flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary">history</span>
                        Security Log
                    </h3>
                    <a class="text-[10px] font-bold text-primary uppercase tracking-widest hover:underline" href="#">View All</a>
                </div>
                <div class="space-y-4">
                    <div class="flex gap-3 relative pb-4 after:absolute after:left-[7px] after:top-5 after:bottom-0 after:w-px after:bg-outline-variant/20">
                        <div class="w-4 h-4 rounded-full bg-primary mt-1 z-10 shadow-[0_0_8px_rgba(192,193,255,0.4)]"></div>
                        <div>
                            <p class="text-xs font-bold leading-tight">Admin granted 'Billing' to 'Project Manager'</p>
                            <p class="text-[10px] text-on-surface-variant mt-1">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex gap-3 relative pb-4 after:absolute after:left-[7px] after:top-5 after:bottom-0 after:w-px after:bg-outline-variant/20">
                        <div class="w-4 h-4 rounded-full bg-surface-container-highest mt-1 z-10 border border-outline-variant/30"></div>
                        <div>
                            <p class="text-xs font-bold leading-tight">Marcus deleted 'Junior Designer' role</p>
                            <p class="text-[10px] text-on-surface-variant mt-1">Yesterday, 14:20</p>
                        </div>
                    </div>
                    <div class="flex gap-3 relative">
                        <div class="w-4 h-4 rounded-full bg-surface-container-highest mt-1 z-10 border border-outline-variant/30"></div>
                        <div>
                            <p class="text-xs font-bold leading-tight">System audit: 4 users added to 'Team'</p>
                            <p class="text-[10px] text-on-surface-variant mt-1">3 days ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/roles-index.js') }}"></script>
@endpush
