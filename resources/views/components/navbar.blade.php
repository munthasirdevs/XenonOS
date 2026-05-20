@php
    $currentRoute = request()->route()->getName();
    $currentPath = request()->path();
@endphp

<!-- Sidebar -->
<aside id="sidebar"
    class="sidebar fixed left-0 top-0 bottom-0 w-[260px] bg-surface-container flex flex-col z-50 pt-6 border-r border-outline-variant/10 overflow-hidden transition-transform duration-300 -translate-x-full md:translate-x-0 open:-translate-x-0">
    <!-- Brand Identity -->
    <div class="px-8 mb-6 flex flex-col">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold tracking-tight text-on-surface font-headline">
            Xenon<span class="text-primary">OS</span>
        </a>
        <span class="text-[9px] font-bold tracking-[0.2em] text-primary/60 uppercase font-label">Nocturnal
            Precision</span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 flex flex-col gap-1 px-3 overflow-y-auto custom-scrollbar">

        <!-- Dashboard - Top Link -->
        <a href="{{ route('dashboard') }}"
            class="{{ str_starts_with($currentPath, 'dashboard') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} mx-2 mb-3 px-4 py-3 flex items-center gap-3 rounded-lg text-[13px] transition-all font-semibold">
            <span
                class="material-symbols-outlined {{ str_starts_with($currentPath, 'dashboard') ? 'active-icon' : '' }}">dashboard</span>
            <span>Dashboard</span>
        </a>

        <!-- Separator -->
        <div class="mx-4 mb-2 h-px bg-outline-variant/20"></div>

        <!-- WORKSPACE Section -->
        <div class="sidebar-section">
            <div class="section-header" data-section="workspace">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary/70">grid_view</span>
                    <span
                        class="text-[10px] font-bold tracking-[0.15em] text-primary/50 uppercase font-label">Workspace</span>
                </div>
                <span class="material-symbols-outlined text-[14px] text-on-surface-variant/50 chevron-icon"
                    id="chevron-workspace">expand_more</span>
            </div>
            <div class="section-content" id="section-content-workspace">
                <!-- Projects -->
                <div class="ml-3 my-1">
                    <div
                        class="text-[10px] font-semibold text-on-surface-variant/40 uppercase tracking-wider px-4 py-1">
                        Projects</div>
                    <a href="{{ route('projects.index') }}"
                        class="{{ str_starts_with($currentPath, 'projects') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">account_tree</span>
                        <span>All Projects</span>
                    </a>
                    <a href="{{ route('projects.hub') }}"
                        class="{{ $currentPath === 'projects/hub' ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">hub</span>
                        <span>Project Hub</span>
                    </a>
                    <a href="{{ route('projects.assigned') }}"
                        class="{{ $currentPath === 'projects/assigned' || $currentPath === 'projects/my-assigned' ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">assignment_ind</span>
                        <span>My Projects</span>
                    </a>
                    <a href="{{ route('projects.team') }}"
                        class="{{ str_starts_with($currentPath, 'projects/team') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">groups</span>
                        <span>Team View</span>
                    </a>
                </div>
                <!-- Tasks -->
                <div class="ml-3 my-1">
                    <div
                        class="text-[10px] font-semibold text-on-surface-variant/40 uppercase tracking-wider px-4 py-1">
                        Tasks</div>
                    <a href="{{ route('tasks') }}"
                        class="{{ str_starts_with($currentPath, 'tasks') && !in_array($currentPath, ['tasks/calendar', 'tasks/analytics', 'tasks/assign', 'tasks/manage']) ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">task_alt</span>
                        <span>All Tasks</span>
                    </a>
                    <a href="{{ route('tasks.hub') }}"
                        class="{{ $currentPath === 'tasks/hub' ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">hub</span>
                        <span>Task Hub</span>
                    </a>
                    <a href="{{ route('tasks.calendar') }}"
                        class="{{ $currentPath === 'tasks/calendar' ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">calendar_month</span>
                        <span>Calendar</span>
                    </a>
                    <a href="{{ route('tasks.analytics') }}"
                        class="{{ $currentPath === 'tasks/analytics' ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">analytics</span>
                        <span>Analytics</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- MANAGEMENT Section -->
        <div class="sidebar-section">
            <div class="section-header" data-section="management">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary/70">folder_shared</span>
                    <span
                        class="text-[10px] font-bold tracking-[0.15em] text-primary/50 uppercase font-label">Management</span>
                </div>
                <span class="material-symbols-outlined text-[14px] text-on-surface-variant/50 chevron-icon"
                    id="chevron-management">expand_more</span>
            </div>
            <div class="section-content" id="section-content-management">
                <a href="{{ route('clients') }}"
                    class="{{ str_starts_with($currentPath, 'clients') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-2.5 flex items-center gap-3 rounded-lg text-[12px] transition-all">
                    <span
                        class="material-symbols-outlined {{ str_starts_with($currentPath, 'clients') ? 'active-icon' : '' }}">person_add</span>
                    <span>Clients</span>
                </a>
                <a href="{{ route('team') }}"
                    class="{{ str_starts_with($currentPath, 'team') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-2.5 flex items-center gap-3 rounded-lg text-[12px] transition-all">
                    <span
                        class="material-symbols-outlined {{ str_starts_with($currentPath, 'team') ? 'active-icon' : '' }}">group</span>
                    <span>Team</span>
                </a>
                <a href="{{ route('roles') }}"
                    class="{{ str_starts_with($currentPath, 'roles') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-2.5 flex items-center gap-3 rounded-lg text-[12px] transition-all">
                    <span
                        class="material-symbols-outlined {{ str_starts_with($currentPath, 'roles') ? 'active-icon' : '' }}">verified_user</span>
                    <span>Roles</span>
                </a>
            </div>
        </div>

        <!-- FINANCE Section -->
        <div class="sidebar-section">
            <div class="section-header" data-section="finance">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary/70">payments</span>
                    <span
                        class="text-[10px] font-bold tracking-[0.15em] text-primary/50 uppercase font-label">Finance</span>
                </div>
                <span class="material-symbols-outlined text-[14px] text-on-surface-variant/50 chevron-icon"
                    id="chevron-finance">expand_more</span>
            </div>
            <div class="section-content" id="section-content-finance">
                <a href="{{ route('billing') }}"
                    class="{{ str_starts_with($currentPath, 'billing') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-2.5 flex items-center gap-3 rounded-lg text-[12px] transition-all">
                    <span
                        class="material-symbols-outlined {{ str_starts_with($currentPath, 'billing') ? 'active-icon' : '' }}">receipt_long</span>
                    <span>Billing</span>
                </a>
                <a href="{{ route('payments') }}"
                    class="{{ str_starts_with($currentPath, 'payments') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-2.5 flex items-center gap-3 rounded-lg text-[12px] transition-all">
                    <span
                        class="material-symbols-outlined {{ str_starts_with($currentPath, 'payments') ? 'active-icon' : '' }}">payments</span>
                    <span>Payments</span>
                </a>
            </div>
        </div>

        <!-- INSIGHTS Section -->
        <div class="sidebar-section">
            <div class="section-header" data-section="insights">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary/70">insights</span>
                    <span
                        class="text-[10px] font-bold tracking-[0.15em] text-primary/50 uppercase font-label">Insights</span>
                </div>
                <span class="material-symbols-outlined text-[14px] text-on-surface-variant/50 chevron-icon"
                    id="chevron-insights">expand_more</span>
            </div>
            <div class="section-content" id="section-content-insights">
                <div class="ml-3 my-1">
                    <div
                        class="text-[10px] font-semibold text-on-surface-variant/40 uppercase tracking-wider px-4 py-1">
                        Analytics</div>
                    <a href="{{ route('analytics.executive') }}"
                        class="{{ str_starts_with($currentPath, 'analytics') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">speed</span>
                        <span>Executive</span>
                    </a>
                    <a href="{{ route('analytics.marketing') }}"
                        class="{{ $currentPath === 'analytics/marketing' ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">campaign</span>
                        <span>Marketing</span>
                    </a>
                    <a href="{{ route('analytics.operations') }}"
                        class="{{ $currentPath === 'analytics/operations' ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">settings</span>
                        <span>Operations</span>
                    </a>
                </div>
                <div class="ml-3 my-1">
                    <div
                        class="text-[10px] font-semibold text-on-surface-variant/40 uppercase tracking-wider px-4 py-1">
                        Reports</div>
                    <a href="{{ route('reports.insights') }}"
                        class="{{ str_starts_with($currentPath, 'reports') && $currentPath !== 'reports/builder' ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">insights</span>
                        <span>Insights</span>
                    </a>
                    <a href="{{ route('reports.builder') }}"
                        class="{{ $currentPath === 'reports/builder' ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-primary' }} pl-8 pr-4 py-2 flex items-center gap-3 rounded-lg text-[11px] transition-all">
                        <span class="material-symbols-outlined text-base">construction</span>
                        <span>Report Builder</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- SYSTEM Section -->
        <div class="sidebar-section">
            <div class="section-header" data-section="system">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary/70">monitor_heart</span>
                    <span
                        class="text-[10px] font-bold tracking-[0.15em] text-primary/50 uppercase font-label">System</span>
                </div>
                <span class="material-symbols-outlined text-[14px] text-on-surface-variant/50 chevron-icon"
                    id="chevron-system">expand_more</span>
            </div>
            <div class="section-content" id="section-content-system">
                <a href="{{ route('files') }}"
                    class="{{ str_starts_with($currentPath, 'files') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-2.5 flex items-center gap-3 rounded-lg text-[12px] transition-all">
                    <span
                        class="material-symbols-outlined {{ str_starts_with($currentPath, 'files') ? 'active-icon' : '' }}">folder</span>
                    <span>Files</span>
                </a>
                <a href="{{ route('activity') }}"
                    class="{{ str_starts_with($currentPath, 'activity') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-2.5 flex items-center gap-3 rounded-lg text-[12px] transition-all">
                    <span
                        class="material-symbols-outlined {{ str_starts_with($currentPath, 'activity') ? 'active-icon' : '' }}">history</span>
                    <span>Activity</span>
                </a>
                <a href="{{ route('communication') }}"
                    class="{{ str_starts_with($currentPath, 'communication') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-2.5 flex items-center gap-3 rounded-lg text-[12px] transition-all">
                    <span
                        class="material-symbols-outlined {{ str_starts_with($currentPath, 'communication') ? 'active-icon' : '' }}">chat</span>
                    <span>Communication</span>
                </a>
                <a href="{{ route('notifications') }}"
                    class="{{ str_starts_with($currentPath, 'notifications') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-2.5 flex items-center gap-3 rounded-lg text-[12px] transition-all">
                    <span
                        class="material-symbols-outlined {{ str_starts_with($currentPath, 'notifications') ? 'active-icon' : '' }}">notifications</span>
                    <span>Notifications</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- User Footer -->
    <div class="mt-auto px-4 pt-4 border-t border-outline-variant/10 bg-surface-container-low/80 backdrop-blur-xl">
        <div class="flex items-center gap-3 mb-3">
            <img alt="User"
                class="w-10 h-10 rounded-full border border-primary/20 object-cover shadow-lg shadow-primary/5"
                src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=818cf8&color=fff&size=128' }}">
            <div class="flex flex-col min-w-0">
                <span
                    class="text-[13px] font-bold text-on-surface truncate font-headline">{{ Auth::user()->name ?? 'User' }}</span>
                <span class="text-[10px] text-on-surface-variant/70 truncate font-label">{{ Auth::user()->email ??
                    'user@example.com' }}</span>
            </div>
        </div>
        <!-- Bottom Buttons -->
        <div class="flex items-center gap-2">
            <a href="{{ route('profile') }}"
                class="flex-1 flex items-center justify-center py-2 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-bright transition-all">
                <span class="material-symbols-outlined text-lg">person</span>
            </a>
            <a href="{{ route('settings') }}"
                class="flex-1 flex items-center justify-center py-2 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-bright transition-all">
                <span class="material-symbols-outlined text-lg">settings</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center py-2 rounded-lg text-rose-400 hover:bg-rose-500/10 transition-all">
                    <span class="material-symbols-outlined text-lg">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

<!-- Mobile Toggle Button -->
<button id="mobile-toggle" class="fixed top-4 left-4 z-50 p-2 rounded-lg bg-surface-container md:hidden">
    <span class="material-symbols-outlined text-white">menu</span>
</button>

<!-- Load Navbar CSS -->
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<!-- Load Navbar JS -->
<script src="{{ asset('js/navbar.js') }}"></script>