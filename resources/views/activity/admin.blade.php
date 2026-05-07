@extends('layouts.app')

@section('title', 'Activity Logs - XenonOS')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/activity-admin.css') }}">
@endpush

@section('content')
<x-navbar />
<main class="flex-1 min-h-screen flex flex-col" role="main">
    <div class="flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 md:px-8 lg:px-10 py-6 sm:py-8 md:py-10 lg:py-12">
        <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
            <div class="space-y-1.5 sm:space-y-2">
                <span class="text-[10px] font-bold tracking-[0.2em] text-tertiary uppercase block">Security Protocol 4.0</span>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">Activity Logs</h1>
                <p class="text-on-surface-variant text-xs sm:text-sm md:text-base max-w-lg leading-relaxed">
                    Monitor system-wide actions and login sessions. Real-time observability for infrastructure security.
                </p>
            </div>
            <div class="flex flex-wrap gap-2 sm:gap-3 w-full sm:w-auto">
                <button type="button" class="bg-surface-container hover:bg-surface-container-high active:scale-[0.98] text-on-surface px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl border border-outline-variant/10 inline-flex items-center justify-center gap-2 transition-all w-full sm:w-auto min-h-[44px] text-sm">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">download</span>
                    <span class="text-xs font-bold uppercase tracking-wider">Export PDF</span>
                </button>
                <button type="button" class="bg-primary hover:bg-primary/90 active:scale-[0.98] text-on-primary px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl shadow-lg shadow-primary/10 inline-flex items-center justify-center gap-2 transition-all w-full sm:w-auto min-h-[44px] text-sm">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">description</span>
                    <span class="text-xs font-bold uppercase tracking-wider">CSV Report</span>
                </button>
            </div>
        </header>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8" aria-label="Activity statistics">
            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm group">
                <div class="absolute top-0 left-0 w-1 h-full bg-primary-container shadow-sm" aria-hidden="true"></div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Total Actions</span>
                    <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">24,892</div>
                </div>
                <div class="mt-3 sm:mt-4 flex items-center gap-2 text-primary text-xs">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">trending_up</span>
                    <span>12% from last 24h</span>
                </div>
            </div>
            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm">
                <div class="absolute top-0 left-0 w-1 h-full bg-tertiary shadow-sm" aria-hidden="true"></div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Security Flags</span>
                    <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">14</div>
                </div>
                <div class="mt-3 sm:mt-4 flex items-center gap-2 text-tertiary text-xs">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">report</span>
                    <span>Requires review</span>
                </div>
            </div>
            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 relative overflow-hidden shadow-sm group">
                <div class="absolute top-0 left-0 w-1 h-full bg-success shadow-sm" aria-hidden="true"></div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Login Sessions</span>
                    <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">124</div>
                </div>
                <div class="mt-3 sm:mt-4 flex items-center gap-2 text-success text-xs">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">sensors</span>
                    <span>Active sessions</span>
                </div>
            </div>
        </section>

        <section class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-4 sm:p-6 md:p-8 mb-6 sm:mb-8" aria-label="Activity density trend chart">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 sm:mb-8">
                <div>
                    <h2 class="text-lg sm:text-xl font-headline font-semibold text-on-surface">Activity Intensity Trend</h2>
                    <p class="text-xs text-on-surface-variant">Real-time density of system actions &amp; security events</p>
                </div>
                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-primary" aria-hidden="true"></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">System Actions</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-tertiary" aria-hidden="true"></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Security Flags</span>
                    </div>
                </div>
            </div>
            <div class="h-[250px] sm:h-[300px] w-full relative">
                <canvas id="activityTrendChart" role="img" aria-label="Chart showing activity intensity over time"></canvas>
            </div>
        </section>

        <section class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm p-3 sm:p-4 mb-6 sm:mb-8" aria-label="Activity filters">
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <div class="w-full sm:flex-1 sm:min-w-[220px] relative">
                    <span class="material-symbols-outlined absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 text-on-surface-muted text-sm sm:text-base pointer-events-none" aria-hidden="true">search</span>
                    <input type="search" placeholder="Search User IDs, actions or keywords..." class="w-full bg-surface-container text-on-surface placeholder-on-surface-muted text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 pl-10 sm:pl-12 pr-4 border-0 focus:ring-2 focus:ring-primary transition-all min-h-[44px]" aria-label="Search activity logs" />
                </div>
                <button type="button" class="bg-surface-container hover:bg-surface-container-high active:scale-[0.96] text-on-surface-variant px-4 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl inline-flex items-center gap-2 transition-all min-h-[44px] text-xs sm:text-sm font-bold uppercase tracking-wider border border-outline-variant/10">
                    Action Type
                    <span class="material-symbols-outlined text-xs" aria-hidden="true">expand_more</span>
                </button>
                <button type="button" class="bg-surface-container hover:bg-surface-container-high active:scale-[0.96] text-on-surface-variant px-4 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl inline-flex items-center gap-2 transition-all min-h-[44px] text-xs sm:text-sm font-bold uppercase tracking-wider border border-outline-variant/10">
                    Module
                    <span class="material-symbols-outlined text-xs" aria-hidden="true">expand_more</span>
                </button>
                <button type="button" class="bg-surface-container hover:bg-surface-container-high active:scale-[0.96] text-on-surface-variant px-4 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl inline-flex items-center gap-2 transition-all min-h-[44px] text-xs sm:text-sm font-bold uppercase tracking-wider border border-outline-variant/10">
                    Date Range
                    <span class="material-symbols-outlined text-xs" aria-hidden="true">calendar_today</span>
                </button>
            </div>
        </section>

        <section class="space-y-4 sm:space-y-6">
            <div class="flex gap-4 sm:gap-6 md:gap-8 border-b border-outline-variant/10 overflow-x-auto pb-1" role="tablist" aria-label="Activity sections">
                <button type="button" role="tab" aria-selected="true" aria-current="page" class="pb-3 sm:pb-4 border-b-2 border-primary text-primary text-xs sm:text-sm font-semibold whitespace-nowrap transition-all min-h-[44px] flex items-center">
                    User &amp; System Activity</button>
                <button type="button" role="tab" aria-selected="false" class="pb-3 sm:pb-4 border-b-2 border-transparent text-on-surface-variant text-xs sm:text-sm font-medium hover:text-on-surface transition-all whitespace-nowrap min-h-[44px] flex items-center">
                    Login Sessions</button>
                <button type="button" role="tab" aria-selected="false" class="pb-3 sm:pb-4 border-b-2 border-transparent text-on-surface-variant text-xs sm:text-sm font-medium hover:text-on-surface transition-all whitespace-nowrap min-h-[44px] flex items-center">
                    Admin Controls</button>
            </div>

            <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[640px]" role="table" aria-label="User and system activity log">
                        <thead>
                            <tr class="border-b border-outline-variant/10">
                                <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">User / Entity</th>
                                <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Action Context</th>
                                <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-center">Severity</th>
                                <th scope="col" class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-right">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/5">
                            <tr class="group hover:bg-surface-container-high/60 transition-colors cursor-pointer">
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-surface-container-highest shrink-0">
                                            <img alt="Avatar of user John Smith" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=John+Smith&background=818cf8&color=fff&size=128" loading="lazy" />
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-xs sm:text-sm font-semibold text-on-surface truncate">John Smith</div>
                                            <div class="text-[10px] text-on-surface-variant font-medium">Project Manager</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                    <div class="space-y-1">
                                        <div class="text-xs sm:text-sm text-on-surface flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm text-primary flex-shrink-0" aria-hidden="true">file_upload</span>
                                            Updated project <span class="text-primary">"Obsidian-Core-V2"</span>
                                        </div>
                                        <div class="text-[10px] text-on-surface-variant uppercase tracking-wider">Module: Engineering</div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-center">
                                    <span class="bg-primary/10 text-primary text-[10px] font-bold px-2.5 sm:px-3 py-1 rounded-full uppercase tracking-widest border border-primary/20 whitespace-nowrap">Normal</span>
                                </td>
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right">
                                    <div class="text-xs text-on-surface-variant">2 mins ago</div>
                                    <div class="text-[10px] text-on-surface-muted">14:24:02</div>
                                </td>
                            </tr>

                            <tr class="group hover:bg-surface-container-high/60 transition-colors cursor-pointer">
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-surface-container-highest shrink-0">
                                            <img alt="Avatar of user Anna Lopez" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Anna+Lopez&background=c084fc&color=fff&size=128" loading="lazy" />
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-xs sm:text-sm font-semibold text-on-surface truncate">Anna Lopez</div>
                                            <div class="text-[10px] text-on-surface-variant font-medium">System Admin</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                    <div class="space-y-1">
                                        <div class="text-xs sm:text-sm text-on-surface flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm text-tertiary flex-shrink-0" aria-hidden="true">admin_panel_settings</span>
                                            Edited Role Permissions: <span class="text-tertiary">"Support-Tier-1"</span>
                                        </div>
                                        <div class="text-[10px] text-on-surface-variant uppercase tracking-wider">Module: Security</div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-center">
                                    <span class="bg-tertiary/10 text-tertiary text-[10px] font-bold px-2.5 sm:px-3 py-1 rounded-full uppercase tracking-widest border border-tertiary/20 whitespace-nowrap">Critical</span>
                                </td>
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right">
                                    <div class="text-xs text-on-surface-variant">15 mins ago</div>
                                    <div class="text-[10px] text-on-surface-muted">14:11:45</div>
                                </td>
                            </tr>

                            <tr class="group hover:bg-surface-container-high/60 transition-colors cursor-pointer">
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-surface-container-highest p-2 flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-on-surface-variant" aria-hidden="true">smart_toy</span>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-xs sm:text-sm font-semibold text-on-surface truncate">System Bot</div>
                                            <div class="text-[10px] text-on-surface-variant font-medium">Automated Task</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                                    <div class="space-y-1">
                                        <div class="text-xs sm:text-sm text-on-surface flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm text-on-surface-muted flex-shrink-0" aria-hidden="true">sync</span>
                                            Scheduled backup completed successfully
                                        </div>
                                        <div class="text-[10px] text-on-surface-variant uppercase tracking-wider">Module: Infrastructure</div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-center">
                                    <span class="bg-slate-500/10 text-slate-400 text-[10px] font-bold px-2.5 sm:px-3 py-1 rounded-full uppercase tracking-widest border border-slate-500/20 whitespace-nowrap">Info</span>
                                </td>
                                <td class="px-4 sm:px-6 md:px-8 py-4 sm:py-5 text-right">
                                    <div class="text-xs text-on-surface-variant">42 mins ago</div>
                                    <div class="text-[10px] text-on-surface-muted">13:44:12</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="px-4 sm:px-6 md:px-8 py-4 sm:py-6 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-outline-variant/5">
                    <div class="text-xs text-on-surface-variant">Showing <span class="text-on-surface font-bold">1-10</span> of <span class="text-on-surface font-bold">4,209</span> actions</div>
                    <div class="flex items-center gap-1.5" role="navigation" aria-label="Pagination">
                        <button type="button" class="p-2 hover:bg-surface-container-highest rounded-lg text-on-surface-muted transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center" aria-label="Previous page">
                            <span class="material-symbols-outlined text-sm" aria-hidden="true">chevron_left</span>
                        </button>
                        <button type="button" class="px-3 sm:px-4 py-2 bg-primary text-on-primary text-xs font-bold rounded-lg min-h-[44px]" aria-current="page" aria-label="Page 1">1</button>
                        <button type="button" class="px-3 sm:px-4 py-2 hover:bg-surface-container-highest text-xs font-bold rounded-lg text-on-surface-variant transition-all min-h-[44px]" aria-label="Page 2">2</button>
                        <button type="button" class="px-3 sm:px-4 py-2 hover:bg-surface-container-highest text-xs font-bold rounded-lg text-on-surface-variant transition-all min-h-[44px]" aria-label="Page 3">3</button>
                        <button type="button" class="p-2 hover:bg-surface-container-highest rounded-lg text-on-surface-muted transition-all min-h-[44px] min-w-[44px] inline-flex items-center justify-center" aria-label="Next page">
                            <span class="material-symbols-outlined text-sm" aria-hidden="true">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-4 sm:space-y-6 mt-6 sm:mt-8" aria-label="Recent login sessions">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                <h2 class="text-lg sm:text-xl font-headline font-semibold text-on-surface">Recent Login Sessions</h2>
                <div class="flex items-center gap-2 text-primary min-h-[44px]">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse" aria-hidden="true"></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest">124 Active now</span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-sm border border-outline-variant/5 hover:border-primary/20 transition-all group">
                    <div class="flex justify-between items-start mb-4 sm:mb-6">
                        <div class="flex items-center gap-3">
                            <div class="bg-surface-container-highest p-2.5 rounded-xl shrink-0">
                                <span class="material-symbols-outlined text-primary" aria-hidden="true">desktop_windows</span>
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs sm:text-sm font-bold text-on-surface truncate">MacBook Pro 16"</div>
                                <div class="text-[10px] text-on-surface-variant uppercase tracking-wider">macOS &bull; Chrome 118</div>
                            </div>
                        </div>
                        <span class="bg-green-500/10 text-green-500 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase shrink-0">Active</span>
                    </div>
                    <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">User</span>
                            <span class="text-on-surface font-medium truncate ml-2">david.k&#64;obsidian.io</span>
                        </div>
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">Location</span>
                            <span class="text-on-surface font-medium">San Francisco, US</span>
                        </div>
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">Duration</span>
                            <span class="text-on-surface font-medium">2h 45m</span>
                        </div>
                    </div>
                    <button type="button" class="w-full p-2.5 sm:p-3 bg-error-container/10 text-error hover:bg-error-container/20 border border-error/20 rounded-xl text-xs font-bold uppercase tracking-widest transition-all min-h-[44px]">
                        Force Logout
                    </button>
                </div>

                <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-sm border border-outline-variant/5 hover:border-primary/20 transition-all group">
                    <div class="flex justify-between items-start mb-4 sm:mb-6">
                        <div class="flex items-center gap-3">
                            <div class="bg-surface-container-highest p-2.5 rounded-xl shrink-0">
                                <span class="material-symbols-outlined text-on-surface-muted" aria-hidden="true">smartphone</span>
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs sm:text-sm font-bold text-on-surface truncate">iPhone 15 Pro</div>
                                <div class="text-[10px] text-on-surface-variant uppercase tracking-wider">iOS &bull; Obsidian App</div>
                            </div>
                        </div>
                        <span class="bg-on-surface-variant/10 text-on-surface-variant text-[10px] font-bold px-2 py-0.5 rounded-md uppercase shrink-0">Idle</span>
                    </div>
                    <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">User</span>
                            <span class="text-on-surface font-medium truncate ml-2">sarah.w&#64;obsidian.io</span>
                        </div>
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">Location</span>
                            <span class="text-on-surface font-medium">Berlin, DE</span>
                        </div>
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">Duration</span>
                            <span class="text-on-surface font-medium">5h 12m</span>
                        </div>
                    </div>
                    <button type="button" class="w-full p-2.5 sm:p-3 bg-error-container/10 text-error hover:bg-error-container/20 border border-error/20 rounded-xl text-xs font-bold uppercase tracking-widest transition-all min-h-[44px]">
                        Force Logout
                    </button>
                </div>

                <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-sm border border-outline-variant/5 hover:border-primary/20 transition-all group">
                    <div class="flex justify-between items-start mb-4 sm:mb-6">
                        <div class="flex items-center gap-3">
                            <div class="bg-surface-container-highest p-2.5 rounded-xl shrink-0">
                                <span class="material-symbols-outlined text-primary" aria-hidden="true">laptop_windows</span>
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs sm:text-sm font-bold text-on-surface truncate">Dell XPS 13</div>
                                <div class="text-[10px] text-on-surface-variant uppercase tracking-wider">Windows 11 &bull; Edge</div>
                            </div>
                        </div>
                        <span class="bg-green-500/10 text-green-500 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase shrink-0">Active</span>
                    </div>
                    <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">User</span>
                            <span class="text-on-surface font-medium truncate ml-2">mark.v&#64;obsidian.io</span>
                        </div>
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">Location</span>
                            <span class="text-on-surface font-medium">London, UK</span>
                        </div>
                        <div class="flex justify-between text-xs min-h-[44px] items-center">
                            <span class="text-on-surface-variant">Duration</span>
                            <span class="text-on-surface font-medium">12m</span>
                        </div>
                    </div>
                    <button type="button" class="w-full p-2.5 sm:p-3 bg-error-container/10 text-error hover:bg-error-container/20 border border-error/20 rounded-xl text-xs font-bold uppercase tracking-widest transition-all min-h-[44px]">
                        Force Logout
                    </button>
                </div>
            </div>
            <div class="flex justify-center mt-2 sm:mt-4">
                <button type="button" class="text-primary text-[10px] font-bold uppercase tracking-[0.1em] flex items-center gap-2 hover:gap-3 transition-all group min-h-[44px] px-3">
                    <span class="w-1 h-1 bg-primary rounded-full group-hover:scale-150 transition-transform" aria-hidden="true"></span>
                    View all active sessions
                </button>
            </div>
        </section>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initialize activity chart if element exists
    if (document.getElementById('activityTrendChart')) {
        const ctx = document.getElementById('activityTrendChart').getContext('2d');
        // Chart configuration would go here
    }
</script>
@endpush
