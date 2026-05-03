<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    'surface-container-highest': '#1a1d26',
                    'surface-bright': '#1e222c',
                    'surface-container': '#12151e',
                    'surface-container-low': '#0f121a',
                    'surface-container-high': '#161922',
                    'surface-container-lowest': '#06080c',
                    'background': '#0b0e14',
                    'primary': '#818cf8',
                    'on-primary': '#1e1b4b',
                    'on-surface': '#dfe2f1',
                    'on-surface-variant': '#94a3b8',
                    'outline': '#475569',
                    'outline-variant': '#464554',
                    'error': '#ffb4ab',
                },
                fontFamily: {
                    headline: ['Syne', 'sans-serif'],
                    body: ['Outfit', 'sans-serif'],
                    label: ['Outfit', 'sans-serif'],
                }
            }
        }
    }
</script>

<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        font-size: 20px;
    }
    .active-icon {
        font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #1e222c;
        border-radius: 10px;
    }
    @media (max-width: 768px) {
        .sidebar { transform: translateX(-100%); }
        .sidebar.open { transform: translateX(0); }
    }
</style>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar fixed left-0 top-0 bottom-0 w-[260px] bg-surface-container flex flex-col z-50 py-6 border-r border-outline-variant/10 overflow-hidden transition-transform duration-300 md:translate-x-0">
    <!-- Brand Identity -->
    <div class="px-8 mb-8 flex flex-col">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold tracking-tight text-on-surface font-headline">
            Xenon<span class="text-primary">OS</span>
        </a>
        <span class="text-[9px] font-bold tracking-[0.2em] text-primary/60 uppercase font-label">Nocturnal Precision</span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 flex flex-col gap-0.5 px-4 overflow-y-auto custom-scrollbar">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined {{ request()->routeIs('dashboard') ? 'active-icon' : '' }}">dashboard</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Dashboard</span>
        </a>
        <a href="{{ route('notifications') }}" class="{{ request()->routeIs('notifications*') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined {{ request()->routeIs('notifications*') ? 'active-icon' : '' }}">notifications</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Notifications</span>
            @if(isset($unreadCount) && $unreadCount > 0)
            <span class="ml-auto bg-rose-500/20 text-rose-400 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
            @endif
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">folder</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Files</span>
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">group</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Team</span>
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">analytics</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Analytics</span>
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">history</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Activity</span>
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">verified_user</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Roles</span>
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">payments</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Billing</span>
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">person_add</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Clients</span>
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">account_tree</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Projects</span>
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">task_alt</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Tasks</span>
        </a>
        <a href="#" class="text-on-surface-variant hover:text-primary hover:bg-surface-bright px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined">assessment</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Reports</span>
        </a>

        <!-- Separator -->
        <div class="my-4 mx-4 h-px bg-outline-variant/10"></div>

        <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined {{ request()->routeIs('settings') ? 'active-icon' : '' }}">settings</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Settings</span>
        </a>
        <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'bg-primary/10 text-primary border-l-4 border-primary' : 'text-on-surface-variant hover:text-primary hover:bg-surface-bright' }} px-4 py-3 flex items-center gap-4 rounded-lg transition-all cursor-pointer group">
            <span class="material-symbols-outlined {{ request()->routeIs('profile') ? 'active-icon' : '' }}">account_circle</span>
            <span class="text-[12px] font-semibold tracking-wide font-label">Profile</span>
        </a>
    </nav>

    <!-- User Footer -->
    <div class="mt-auto px-6 py-5 border-t border-outline-variant/10 bg-surface-container-low/80 backdrop-blur-xl">
        <div class="flex items-center gap-3 mb-4">
            <img alt="User" class="w-10 h-10 rounded-full border border-primary/20 object-cover shadow-lg shadow-primary/5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAdsutWN3dSe1C9s1z1T09w2CQEGzGY7NUXrrF9vIvSiGX-qHq-1Ty8SNDz5H2f2v-KN43tKSeYY4aZ94NQ52JcxBF1cr0Lk_A1YSQjb6Wcpo7wSiYM6ahtNkO7w6R1U2XZotD17laHQjivb70K0KIV8Ve_z0ttjpIjJ3hZZIO4OsNTyj63D42_pEcORgqBAFO80KhPsOJYmMpEJeIHNpeA3UidFUmqNqNY26f6fcdEIwAnXKtKTO7SU7r3dP3QEwudGqBULNSoYc" />
            <div class="flex flex-col min-w-0">
                <span class="text-[13px] font-bold text-on-surface truncate font-headline">{{ Auth::user()->name ?? 'User' }}</span>
                <span class="text-[10px] text-on-surface-variant/70 truncate font-label">{{ Auth::user()->email ?? 'user@example.com' }}</span>
            </div>
        </div>
        <!-- Bottom Buttons -->
        <div class="flex items-center gap-2">
            <a href="{{ route('profile') }}" class="flex-1 flex items-center justify-center py-2 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-bright transition-all">
                <span class="material-symbols-outlined text-lg">person</span>
            </a>
            <a href="{{ route('settings') }}" class="flex-1 flex items-center justify-center py-2 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-bright transition-all">
                <span class="material-symbols-outlined text-lg">settings</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center py-2 rounded-lg text-rose-400 hover:bg-rose-500/10 transition-all">
                    <span class="material-symbols-outlined text-lg">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

<!-- Mobile Toggle Button -->
<button id="mobile-toggle" class="fixed top-4 left-4 z-50 p-2 rounded-lg bg-surface-container md:hidden" onclick="toggleSidebar()">
    <span class="material-symbols-outlined text-white">menu</span>
</button>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('hidden');
    }
</script>