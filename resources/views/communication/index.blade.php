@extends('layouts.app')

<x-navbar />

@section('content')
<main class="flex-1 min-h-screen flex flex-col">
    <!-- Main Scrollable Canvas -->
    <div class="pt-24 px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <!-- Section 3: Branding & Strategic Resource Deployment -->
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="text-primary font-bold tracking-widest text-[10px] uppercase">Governance &amp;
                    Security</span>
                <h1 class="text-5xl font-light tracking-tight text-on-surface mt-2">Chat Control</h1>
                <p class="text-on-surface-variant mt-2 max-w-md">Orchestrate communication flows and moderation
                    protocols across all agency workspaces.</p>
            </div>
            <div class="flex space-x-3">
                <button
                    class="flex items-center space-x-2 bg-surface-container-high hover:bg-surface-bright text-on-surface px-5 py-2.5 rounded-xl transition-all font-medium text-sm">
                    <span class="material-symbols-outlined text-lg" data-icon="export_notes">export_notes</span>
                    <span>Export Logs</span>
                </button>
                <button
                    class="flex items-center space-x-2 bg-primary text-on-primary-container px-6 py-2.5 rounded-xl hover:opacity-90 transition-all font-semibold text-sm shadow-[0_8px_20px_rgba(192,193,255,0.2)]">
                    <span class="material-symbols-outlined text-lg" data-icon="add_moderator">add_moderator</span>
                    <span>Add Rule</span>
                </button>
            </div>
        </section>

        <!-- Section 4: Performance Insights Strategy -->
        <section class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <div
                class="col-span-1 md:col-span-4 bg-surface-container-low rounded-2xl p-6 glass-glow relative overflow-hidden group">
                <div class="absolute left-0 top-1/4 bottom-1/4 w-[2px] bg-primary"></div>
                <p class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Live Threads</p>
                <h3 class="text-3xl font-light text-on-surface mt-2">1,284</h3>
                <div class="mt-4 flex items-center text-primary text-xs font-medium">
                    <span class="material-symbols-outlined text-sm mr-1" data-icon="trending_up">trending_up</span>
                    12% vs last week
                </div>
            </div>
            <div class="col-span-1 md:col-span-4 bg-surface-container-low rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute left-0 top-1/4 bottom-1/4 w-[2px] bg-tertiary"></div>
                <p class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Flagged Messages
                </p>
                <h3 class="text-3xl font-light text-on-surface mt-2">24</h3>
                <div class="mt-4 flex items-center text-tertiary text-xs font-medium">
                    <span class="material-symbols-outlined text-sm mr-1" data-icon="warning">warning</span> 3 high
                    priority
                </div>
            </div>
            <div
                class="col-span-1 md:col-span-4 bg-surface-container-low rounded-2xl p-6 flex flex-col justify-between">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Chat
                        Frequency (24h)</p>
                    <span class="text-[10px] text-primary bg-primary/10 px-2 py-0.5 rounded-full">Peak: 2PM</span>
                </div>
                <div class="flex items-end space-x-2 h-16">
                    <div class="flex-1 bg-surface-container-highest rounded-t-sm h-[30%]"></div>
                    <div class="flex-1 bg-surface-container-highest rounded-t-sm h-[50%]"></div>
                    <div class="flex-1 bg-surface-container-highest rounded-t-sm h-[80%]"></div>
                    <div class="flex-1 bg-primary rounded-t-sm h-[100%]"></div>
                    <div class="flex-1 bg-surface-container-highest rounded-t-sm h-[90%]"></div>
                    <div class="flex-1 bg-surface-container-highest rounded-t-sm h-[60%]"></div>
                    <div class="flex-1 bg-surface-container-highest rounded-t-sm h-[40%]"></div>
                    <div class="flex-1 bg-surface-container-highest rounded-t-sm h-[20%]"></div>
                </div>
            </div>
        </section>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Tables & Data -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Active Conversations Table -->
                <div class="bg-surface-container-low rounded-[24px] overflow-hidden">
                    <div class="px-8 py-6 flex justify-between items-center border-b border-outline-variant/5">
                        <h2 class="text-xl font-semibold text-on-surface">Active Conversations</h2>
                        <a class="text-xs font-bold text-primary flex items-center group" href="#">
                            <span
                                class="w-1 h-1 bg-primary rounded-full mr-2 group-hover:w-3 transition-all"></span>
                            VIEW ALL
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr
                                    class="text-on-surface-variant text-[10px] uppercase tracking-widest border-b border-outline-variant/5">
                                    <th class="px-8 py-4 font-bold">Participants</th>
                                    <th class="px-4 py-4 font-bold">Project</th>
                                    <th class="px-4 py-4 font-bold">Status</th>
                                    <th class="px-8 py-4 font-bold text-right">Last Message</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/5">
                                <tr class="group hover:bg-surface-bright/30 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex -space-x-2">
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low"
                                                alt="User avatar image for first participant"
                                                src="https://ui-avatars.com/api/?name=AM%26background=c0c1ff%26color=1a1a2e%26size=32" />
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low"
                                                alt="User avatar image for second participant"
                                                src="https://ui-avatars.com/api/?name=JK%26background=c0c1ff%26color=1a1a2e%26size=32" />
                                            <div
                                                class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-[10px] border-2 border-surface-container-low">
                                                +3</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5 text-sm font-medium">Nebula Cloud Infrastructure</td>
                                    <td class="px-4 py-5">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary uppercase">Active</span>
                                    </td>
                                    <td class="px-8 py-5 text-right text-xs text-on-surface-variant italic">"We need
                                        to review the terraform scripts..."</td>
                                </tr>
                                <tr class="group hover:bg-surface-bright/30 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex -space-x-2">
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low"
                                                alt="User avatar image for participant 3"
                                                src="https://ui-avatars.com/api/?name=RS%26background=c0c1ff%26color=1a1a2e%26size=32" />
                                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low"
                                                alt="User avatar image for participant 4"
                                                src="https://ui-avatars.com/api/?name=TN%26background=c0c1ff%26color=1a1a2e%26size=32" />
                                        </div>
                                    </td>
                                    <td class="px-4 py-5 text-sm font-medium">Vortex Branding V2</td>
                                    <td class="px-4 py-5">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-surface-container-highest text-on-surface-variant uppercase">Idle</span>
                                    </td>
                                    <td class="px-8 py-5 text-right text-xs text-on-surface-variant italic">
                                        "Approved. Ready for handoff."</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Moderation Queue -->
                <div class="bg-surface-container-low rounded-[24px] overflow-hidden">
                    <div class="px-8 py-6 flex justify-between items-center bg-error-container/10">
                        <div class="flex items-center space-x-3">
                            <span class="material-symbols-outlined text-error" data-icon="flag">flag</span>
                            <h2 class="text-xl font-semibold text-on-surface">Moderation Queue</h2>
                        </div>
                        <span class="bg-error text-on-error text-[10px] font-bold px-2 py-0.5 rounded-md">8
                            NEW</span>
                    </div>
                    <div class="p-4 space-y-4">
                        <!-- Flagged Item -->
                        <div class="p-4 bg-surface-container rounded-xl flex items-start justify-between group">
                            <div class="flex space-x-4">
                                <div class="bg-error/20 p-2 rounded-lg self-start">
                                    <span class="material-symbols-outlined text-error text-lg"
                                        data-icon="policy">policy</span>
                                </div>
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <p class="text-sm font-bold text-on-surface">Alex Mercer <span
                                                class="text-xs font-normal text-on-surface-variant">to</span>
                                            Team-Lead</p>
                                        <span class="text-[10px] text-tertiary">#RestrictedWords</span>
                                    </div>
                                    <p class="text-sm text-on-surface-variant mt-1 italic">"Please send the
                                        confidential login details via [LINK REMOVED]..."</p>
                                    <p class="text-[10px] text-outline mt-2 uppercase tracking-tighter">Sent at
                                        14:22 - Project: Alpha Genesis</p>
                                </div>
                            </div>
                            <div
                                class="flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button
                                    class="text-[10px] font-bold text-on-surface bg-surface-container-highest hover:bg-error px-3 py-1 rounded-md transition-all">DELETE</button>
                                <button
                                    class="text-[10px] font-bold text-on-surface bg-surface-container-highest hover:bg-surface-bright px-3 py-1 rounded-md transition-all">DISMISS</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Communicators -->
                <div class="bg-surface-container-low rounded-[24px] p-8">
                    <h2 class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase mb-6">Top
                        Communicators</h2>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full overflow-hidden bg-surface-container-highest">
                                    <img alt="Avatar of Sarah Chen"
                                        src="https://ui-avatars.com/api/?name=Sarah%2BChen%26background=c0c1ff%26color=1a1a2e%26size=32" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Sarah Chen</p>
                                    <p class="text-[10px] text-on-surface-variant">428 messages/wk</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="w-24 h-1 bg-surface-container-highest rounded-full overflow-hidden">
                                    <div class="bg-primary h-full w-[85%]"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full overflow-hidden bg-surface-container-highest">
                                    <img alt="Avatar of Jordan Lee"
                                        src="https://ui-avatars.com/api/?name=Jordan%2BLee%26background=c0c1ff%26color=1a1a2e%26size=32" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Jordan Lee</p>
                                    <p class="text-[10px] text-on-surface-variant">312 messages/wk</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="w-24 h-1 bg-surface-container-highest rounded-full overflow-hidden">
                                    <div class="bg-primary h-full w-[60%]"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Security & Role Protocols -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Role Permissions -->
                <div class="bg-surface-container-low rounded-[24px] p-8 space-y-6">
                    <h2 class="text-xl font-semibold text-on-surface">Role Permissions</h2>
                    <div class="space-y-4">
                        <!-- Permission Row -->
                        <div class="flex items-center justify-between p-3 bg-surface-container rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary"
                                        data-icon="groups">groups</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Project Managers</p>
                                    <p class="text-[10px] text-on-surface-variant uppercase">Global Broadcast</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input checked="" class="sr-only peer" type="checkbox"
                                    aria-label="Enable messaging permissions for Project Managers" />
                                <div
                                    class="w-9 h-5 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary">
                                </div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-surface-container rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center">
                                    <span class="material-symbols-outlined text-outline"
                                        data-icon="person_search">person_search</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">QA Analysts</p>
                                    <p class="text-[10px] text-on-surface-variant uppercase">Internal Team Only</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input checked="" class="sr-only peer" type="checkbox"
                                    aria-label="Enable messaging permissions for QA Analysts" />
                                <div
                                    class="w-9 h-5 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary">
                                </div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-surface-container rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center">
                                    <span class="material-symbols-outlined text-outline"
                                        data-icon="psychology">psychology</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">External Clients</p>
                                    <p class="text-[10px] text-on-surface-variant uppercase">Restricted to PM</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" type="checkbox"
                                    aria-label="Enable messaging permissions for External Clients" />
                                <div
                                    class="w-9 h-5 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary">
                                </div>
                            </label>
                        </div>
                    </div>
                    <button
                        class="p-3 border border-outline-variant/20 rounded-xl text-xs font-bold tracking-widest text-on-surface-variant hover:bg-surface-bright transition-all">
                        MANAGE OVERRIDES
                    </button>
                </div>

                <!-- Review Changes -->
                <div
                    class="bg-surface-container-low rounded-[24px] p-8 border border-primary/20 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-primary/10 blur-3xl rounded-full"></div>
                    <h2 class="text-xl font-semibold text-on-surface mb-6">Review Changes</h2>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start space-x-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1"
                                data-icon="check_circle">check_circle</span>
                            <div>
                                <p class="text-sm font-medium">New rule: Auto-block external links</p>
                                <p class="text-[10px] text-on-surface-variant uppercase">Applies to: All Projects
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1"
                                data-icon="check_circle">check_circle</span>
                            <div>
                                <p class="text-sm font-medium">Updated: Client role restricted</p>
                                <p class="text-[10px] text-on-surface-variant uppercase">Status: Pending Apply</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <button
                            class="flex-1 py-3 bg-primary text-on-primary-container rounded-xl font-bold text-sm shadow-xl">Apply
                            Changes</button>
                        <button class="p-3 bg-surface-container-highest text-on-surface rounded-xl">
                            <span class="material-symbols-outlined" data-icon="delete">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Padding for Scroll -->
    <div class="h-20"></div>
</main>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/communication-index.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/communication-index.js') }}"></script>
@endpush