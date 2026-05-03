@extends('layouts.app')

@section('title', 'Command Center - XenonOS')

@section('content')
<!-- Page Branding -->
<section class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
    <div>
        <h2 class="text-on-surface font-headline font-light text-3xl sm:text-4xl md:text-5xl tracking-tight">Command Center</h2>
        <p class="text-on-surface-variant font-body text-xs sm:text-sm mt-1">Complete system overview and real-time analytics.</p>
    </div>
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        <div class="flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20">
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">System Online</span>
        </div>
        <button class="bg-primary hover:bg-primary/90 text-on-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2 transition-all shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-sm">add</span>
            Quick Action
        </button>
    </div>
</section>

<!-- Stats Grid -->
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
    <div class="bg-surface-container-low rounded-3xl p-6 md:p-8 relative overflow-hidden border border-white/5 hover:border-primary/30 transition-all">
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-400 rounded-full"></div>
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-blue-400/10 rounded-xl"><span class="material-symbols-outlined text-blue-400 text-xl">groups</span></div>
        </div>
        <p class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Total Clients</p>
        <h3 class="text-3xl font-headline font-semibold text-on-surface mt-1">{{ $stats['totalClients'] ?? 0 }}</h3>
        <p class="text-[10px] text-on-surface-variant mt-2">{{ $stats['activeClients'] ?? 0 }} Active</p>
    </div>

    <div class="bg-surface-container-low rounded-3xl p-6 md:p-8 relative overflow-hidden border border-white/5 hover:border-primary/30 transition-all">
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary rounded-full"></div>
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-primary/10 rounded-xl"><span class="material-symbols-outlined text-primary text-xl">folder_open</span></div>
        </div>
        <p class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Active Projects</p>
        <h3 class="text-3xl font-headline font-semibold text-on-surface mt-1">{{ $stats['activeProjects'] ?? 0 }}</h3>
        <p class="text-[10px] text-on-surface-variant mt-2">{{ $stats['completedProjects'] ?? 0 }} Completed</p>
    </div>

    <div class="bg-surface-container-low rounded-3xl p-6 md:p-8 relative overflow-hidden border border-white/5 hover:border-emerald-400/30 transition-all">
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-400 rounded-full"></div>
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-emerald-500/10 rounded-xl"><span class="material-symbols-outlined text-emerald-400 text-xl">payments</span></div>
        </div>
        <p class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Revenue (MTD)</p>
        <h3 class="text-3xl font-headline font-semibold text-on-surface mt-1">${{ number_format($stats['totalRevenue'] ?? 0) }}</h3>
        <p class="text-[10px] text-on-surface-variant mt-2">${{ number_format($stats['receivedThisMonth'] ?? 0) }} received</p>
    </div>

    <div class="bg-surface-container-low rounded-3xl p-6 md:p-8 relative overflow-hidden border border-white/5 hover:border-amber-400/30 transition-all">
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-400 rounded-full"></div>
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-amber-500/10 rounded-xl"><span class="material-symbols-outlined text-amber-400 text-xl">task_alt</span></div>
        </div>
        <p class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Open Tasks</p>
        <h3 class="text-3xl font-headline font-semibold text-on-surface mt-1">{{ $stats['openTasks'] ?? 0 }}</h3>
        <p class="text-[10px] text-on-surface-variant mt-2">{{ $stats['highPriorityTasks'] ?? 0 }} High Priority</p>
    </div>
</section>

<!-- Analytics & Charts -->
<section class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
    <div class="lg:col-span-8 bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
        <h3 class="text-xl font-headline font-bold text-on-surface flex items-center gap-3 mb-6">
            <span class="material-symbols-outlined text-primary text-2xl">show_chart</span>
            Revenue Analytics
        </h3>
        <div class="h-64 flex items-end gap-3 mb-4">
            <div class="flex-1 bg-primary/20 rounded-t-lg flex items-end"><div class="w-full bg-primary rounded-t-lg" style="height: 45%"></div></div>
            <div class="flex-1 bg-primary/20 rounded-t-lg flex items-end"><div class="w-full bg-primary rounded-t-lg" style="height: 62%"></div></div>
            <div class="flex-1 bg-primary/20 rounded-t-lg flex items-end"><div class="w-full bg-primary rounded-t-lg" style="height: 55%"></div></div>
            <div class="flex-1 bg-primary/20 rounded-t-lg flex items-end"><div class="w-full bg-primary rounded-t-lg" style="height: 78%"></div></div>
            <div class="flex-1 bg-primary/20 rounded-t-lg flex items-end"><div class="w-full bg-primary rounded-t-lg" style="height: 68%"></div></div>
            <div class="flex-1 bg-emerald-400/20 rounded-t-lg flex items-end"><div class="w-full bg-emerald-400 rounded-t-lg" style="height: 92%"></div></div>
        </div>
        <div class="flex justify-between text-[10px] text-on-surface-variant mb-4">
            <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span class="text-emerald-400 font-bold">Jun</span>
        </div>
        <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/5">
            <div class="text-center"><p class="text-[10px] text-on-surface-variant uppercase">Total</p><p class="text-xl font-bold text-on-surface">${{ number_format($stats['totalRevenue'] ?? 0) }}</p></div>
            <div class="text-center border-x border-white/5"><p class="text-[10px] text-on-surface-variant uppercase">This Month</p><p class="text-xl font-bold text-primary">${{ number_format($stats['receivedThisMonth'] ?? 0) }}</p></div>
            <div class="text-center"><p class="text-[10px] text-on-surface-variant uppercase">Pending</p><p class="text-xl font-bold text-amber-400">${{ number_format($stats['pendingAmount'] ?? 0) }}</p></div>
        </div>
    </div>

    <div class="lg:col-span-4 space-y-8">
        <div class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <h3 class="font-headline font-bold text-on-surface mb-4">Priority Alerts</h3>
            @forelse($alerts as $alert)
            <div class="p-3 bg-rose-500/5 rounded-xl border-l-4 border-rose-500 mb-2">
                <p class="text-xs font-bold text-on-surface">{{ $alert->event }}</p>
            </div>
            @empty
            <div class="p-3 bg-blue-500/5 rounded-xl border-l-4 border-blue-400 mb-2">
                <p class="text-xs font-bold text-on-surface">All Clear</p>
            </div>
            @endforelse
            
            @if($latestSecurityReport)
            <div class="mt-4 p-3 bg-primary/5 rounded-xl border-l-4 border-primary">
                <p class="text-xs font-bold text-primary">Security Report</p>
                <p class="text-[10px] text-on-surface-variant mt-1">{{ $latestSecurityReport->message }}</p>
                <p class="text-[9px] text-on-surface-variant mt-1">{{ $latestSecurityReport->created_at?->diffForHumans() }}</p>
            </div>
            @endif
        </div>

        <div class="bg-gradient-to-br from-primary to-purple-600 rounded-3xl p-6 md:p-8 text-white">
            <h3 class="font-headline font-bold text-lg mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-2">
                <button class="bg-white/10 hover:bg-white/20 py-2 rounded-xl text-xs font-bold">New Client</button>
                <button class="bg-white/10 hover:bg-white/20 py-2 rounded-xl text-xs font-bold">Create Task</button>
                <button class="bg-white/10 hover:bg-white/20 py-2 rounded-xl text-xs font-bold">New Invoice</button>
                <button class="bg-white/10 hover:bg-white/20 py-2 rounded-xl text-xs font-bold">Reports</button>
            </div>
        </div>
    </div>
</section>

<!-- Main Grid -->
<section class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8 space-y-8">
        <section class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <h3 class="text-xl font-headline font-bold text-on-surface flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-primary text-2xl">groups</span>
                Clients Summary
            </h3>
            @forelse($recentClients as $client)
            <div class="flex items-center gap-4 p-3 bg-surface-container rounded-xl mb-2">
                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">{{ substr($client->name, 0, 1) }}</div>
                <div><p class="text-sm font-bold text-on-surface">{{ $client->name }}</p><p class="text-xs text-on-surface-variant">{{ $client->email }}</p></div>
            </div>
            @empty
            <p class="text-on-surface-variant text-center py-4">No clients</p>
            @endforelse
        </section>

        <section class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <h3 class="text-xl font-headline font-bold text-on-surface flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-primary text-2xl">folder_open</span>
                Active Projects
            </h3>
            @forelse($recentProjects as $project)
            <div class="p-4 bg-surface-container rounded-xl mb-2">
                <div class="flex justify-between mb-2">
                    <p class="text-sm font-bold text-on-surface">{{ $project->name }}</p>
                    <span class="text-[10px] bg-primary/10 text-primary px-2 rounded">{{ $project->status }}</span>
                </div>
            </div>
            @empty
            <p class="text-on-surface-variant text-center py-4">No projects</p>
            @endforelse
        </section>

        <section class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <h3 class="text-xl font-headline font-bold text-on-surface flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-primary text-2xl">badge</span>
                Team Members
            </h3>
            @forelse($teamMembers as $member)
            <div class="flex items-center gap-4 p-3 bg-surface-container rounded-xl mb-2">
                <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary"><span class="material-symbols-outlined">badge</span></div>
                <div><p class="text-sm font-bold text-on-surface">{{ $member->name }}</p><p class="text-xs text-primary">{{ $member->role ?? 'Member' }}</p></div>
            </div>
            @empty
            <p class="text-on-surface-variant text-center py-4">No team members</p>
            @endforelse
        </section>

        <section class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <h3 class="text-xl font-headline font-bold text-on-surface flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-primary text-2xl">history</span>
                Activity Logs
            </h3>
            @forelse($recentActivity as $activity)
            <div class="flex gap-3 mb-3">
                <div class="w-6 h-6 rounded-full bg-primary flex items-center justify-center"><span class="material-symbols-outlined text-white text-sm">security</span></div>
                <div class="flex-1 bg-surface-container rounded-xl p-3">
                    <p class="text-xs font-bold text-on-surface">{{ $activity->user->name ?? 'User' }} {{ $activity->action ?? 'action' }}</p>
                </div>
            </div>
            @empty
            <p class="text-on-surface-variant text-center py-4">No activity</p>
            @endforelse
        </section>

        <!-- Latest Notifications -->
        <section class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-headline font-bold text-on-surface flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-2xl">notifications</span>
                        Latest Notifications
                    </h3>
                    <p class="text-xs text-on-surface-variant mt-1">Recent system updates</p>
                </div>
                <span class="text-[10px] bg-primary/10 text-primary px-3 py-1.5 rounded-lg font-bold border border-primary/20 whitespace-nowrap">{{ $unreadCount ?? 0 }} NEW</span>
            </div>
            <div class="space-y-4">
                @forelse($flatNotifications->take(3) as $userNote)
                @php $note = $userNote->notification ?? null; @endphp
                @if($note)
                <div class="flex gap-4 p-4 rounded-xl bg-surface-container border-l-4 border-{{ $loop->first ? 'primary' : ($loop->index === 1 ? 'rose-500' : 'emerald-400') }}">
                    <span class="material-symbols-outlined text-{{ $loop->first ? 'primary' : ($loop->index === 1 ? 'rose-400' : 'emerald-400') }} text-xl shrink-0">
                        {{ $note->type === 'security' ? 'warning' : ($note->type === 'task' ? 'assignment' : 'info') }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <div class="flex justify-between items-start">
                            <p class="text-xs font-bold text-on-surface">{{ Str::limit($note->title, 25) }}</p>
                            <span class="text-[10px] text-on-surface-variant">{{ $userNote->created_at?->diffForHumans() }}</span>
                        </div>
                        <p class="text-[10px] text-on-surface-variant mt-1">{{ Str::limit($note->message, 35) }}</p>
                    </div>
                </div>
                @endif
                @empty
                <p class="text-on-surface-variant text-center py-4">No notifications</p>
                @endforelse
            </div>
        </section>
    </div>

    <div class="lg:col-span-4 space-y-8">
        <section class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <h4 class="text-lg font-headline font-bold text-on-surface flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-primary text-2xl">task_alt</span>
                Tasks
            </h4>
            <div class="grid grid-cols-3 gap-2 mb-4">
                <div class="bg-surface-container rounded-xl p-2 text-center"><p class="text-lg font-bold text-rose-400">{{ $stats['overdueTasks'] ?? 0 }}</p><p class="text-[9px] text-on-surface-variant">Overdue</p></div>
                <div class="bg-surface-container rounded-xl p-2 text-center"><p class="text-lg font-bold text-amber-400">{{ $stats['highPriorityTasks'] ?? 0 }}</p><p class="text-[9px] text-on-surface-variant">High</p></div>
                <div class="bg-surface-container rounded-xl p-2 text-center"><p class="text-lg font-bold text-emerald-400">{{ $stats['completedTasksToday'] ?? 0 }}</p><p class="text-[9px] text-on-surface-variant">Done</p></div>
            </div>
            @forelse($tasks as $task)
            <label class="flex items-center gap-3 p-3 bg-surface-container rounded-xl mb-2 cursor-pointer">
                <input type="checkbox" class="w-4 h-4 rounded" />
                <div><p class="text-sm text-on-surface">{{ $task->title }}</p><p class="text-[9px] text-{{ $task->priority === 'high' ? 'rose-400' : 'primary' }}">{{ strtoupper($task->priority) }}</p></div>
            </label>
            @empty
            <p class="text-on-surface-variant text-center py-4">No pending tasks</p>
            @endforelse
        </section>

        <section class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <h4 class="text-lg font-headline font-bold text-on-surface flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-primary text-2xl">chat</span>
                Messages
            </h4>
            <p class="text-on-surface-variant text-center py-4">No messages</p>
        </section>

        <section class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <h4 class="text-lg font-headline font-bold text-on-surface flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-primary text-2xl">folder</span>
                Recent Files
            </h4>
            <p class="text-on-surface-variant text-center py-4">No files</p>
        </section>

        <section class="bg-surface-container-low rounded-3xl p-6 md:p-8 border border-white/5">
            <h4 class="text-lg font-headline font-bold text-on-surface flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-emerald-400 text-2xl">account_balance_wallet</span>
                Billing
            </h4>
            <p class="text-xl font-bold text-on-surface mb-4">${{ number_format($stats['receivedThisMonth'] ?? 0) }}</p>
            <div class="grid grid-cols-2 gap-2 pt-4 border-t border-white/5">
                <div class="bg-surface-container rounded-xl p-2"><p class="text-[9px] text-on-surface-variant">Received</p><p class="text-sm font-bold text-emerald-400">${{ number_format($stats['receivedThisMonth'] ?? 0) }}</p></div>
                <div class="bg-surface-container rounded-xl p-2"><p class="text-[9px] text-on-surface-variant">Pending</p><p class="text-sm font-bold text-amber-400">${{ number_format($stats['pendingAmount'] ?? 0) }}</p></div>
            </div>
        </section>
    </div>
</section>
@endsection