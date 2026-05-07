@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/clients.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/swal-custom.js') }}"></script>
@endpush

@section('title', 'Clients List - XenonOS')

@section('content')
<header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8">
    <div class="space-y-1.5">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-headline font-light tracking-tighter text-on-surface">Clients</h1>
        <p class="text-on-surface-variant text-xs sm:text-sm max-w-lg">Manage and monitor your global agency clients, project health, and financial cycles from one central dashboard.</p>
    </div>
    <button type="button" onclick="openInviteModal()" class="bg-primary hover:bg-primary/90 active:scale-[0.98] text-on-primary font-semibold px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl sm:rounded-2xl inline-flex items-center justify-center gap-2 transition-all duration-150 shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 w-full sm:w-auto min-h-[44px] text-sm sm:text-base">
        <span class="material-symbols-outlined text-lg sm:text-xl">mail</span>
        <span>Invite Client</span>
    </button>
</header>

<div class="grid grid-cols-1 xl:grid-cols-12 gap-6 md:gap-8">
    <div class="xl:col-span-9 space-y-5 sm:space-y-6">
        <!-- Filters -->
        <section class="bg-surface-container-low p-3 sm:p-4 md:p-5 rounded-2xl sm:rounded-3xl shadow-sm">
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <div class="w-full sm:flex-1 sm:min-w-[220px] relative">
                    <span class="material-symbols-outlined absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 text-on-surface-muted text-sm sm:text-base pointer-events-none">search</span>
                    <input id="client-search" name="search" type="search" placeholder="Filter by Name, Email, or Company" value="{{ request('search') }}" class="filter-input w-full bg-surface-container text-on-surface placeholder-on-surface-muted text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 pl-10 sm:pl-12 pr-4 border-0 focus:ring-2 focus:ring-primary transition-all min-h-[44px]" />
                </div>
                <select id="client-status-filter" name="status" class="bg-surface-container text-on-surface text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 pl-4 pr-8 border-0 focus:ring-2 focus:ring-primary appearance-none cursor-pointer min-h-[44px] min-w-[130px]">
                    <option value="all">Status: All</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit" class="bg-primary hover:bg-primary/90 text-on-primary px-4 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl inline-flex items-center gap-2 transition-all min-h-[44px] text-sm font-bold">Filter</button>
            </div>
        </section>

        <!-- Client Stats -->
        <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-5">
            <div class="stat-card stat-accent-primary bg-surface-container-low">
                <div class="flex items-start justify-between">
                    <div class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Total Clients</div>
                </div>
                <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ $stats['total'] }}</div>
            </div>
            <div class="stat-card">
                <div class="flex items-start justify-between">
                    <div class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Active</div>
                    <span class="w-2 h-2 rounded-full bg-success status-active-dot"></span>
                </div>
                <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ $stats['active'] }}</div>
            </div>
            <div class="stat-card">
                <div class="flex items-start justify-between">
                    <div class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Projects</div>
                    <span class="material-symbols-outlined text-primary">folder</span>
                </div>
                <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ $projectsCount }}</div>
            </div>
            <div class="stat-card stat-accent-tertiary">
                <div class="flex items-start justify-between">
                    <div class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Revenue</div>
                    <span class="material-symbols-outlined text-tertiary">payments</span>
                </div>
                <div class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">${{ number_format($revenue) }}</div>
            </div>
        </section>

        <!-- Clients Table -->
        <section class="bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-outline/10">
                            <th class="px-4 sm:px-6 py-3 sm:py-4 text-[10px] sm:text-xs font-bold uppercase tracking-widest text-on-surface-muted">Client</th>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 text-[10px] sm:text-xs font-bold uppercase tracking-widest text-on-surface-muted">Status</th>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 text-[10px] sm:text-xs font-bold uppercase tracking-widest text-on-surface-muted">Projects</th>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 text-[10px] sm:text-xs font-bold uppercase tracking-widest text-on-surface-muted">Revenue</th>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 text-[10px] sm:text-xs font-bold uppercase tracking-widest text-on-surface-muted text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline/5">
                        @forelse($clients as $client)
                        <tr class="client-row hover:bg-surface-container-high/60">
                            <td class="px-4 sm:px-6 py-3 sm:py-4">
                                <a href="{{ route('clients.show', $client->id) }}" class="flex items-center gap-3 sm:gap-4">
                                    <div class="activity-icon-container w-10 h-10 sm:w-12 sm:h-12 rounded-xl">
                                        <img alt="{{ $client->name }}" class="w-full h-full object-cover rounded-xl" src="{{ $client->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name) . '&background=818cf8&color=fff&size=128' }}" />
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-xs sm:text-sm font-semibold text-on-surface truncate">{{ $client->name }}</div>
                                        <div class="text-[10px] sm:text-xs text-on-surface-variant truncate">{{ $client->email }}</div>
                                    </div>
                                </a>
                            </td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4">
                                <span class="inline-flex items-center gap-1.5 px-2 sm:px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-success/10 text-success">
                                    <span class="w-1.5 h-1.5 rounded-full bg-success"></span>
                                    {{ $client->status }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-on-surface-variant">{{ $client->projects_count }}</td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-on-surface font-medium">${{ number_format($client->revenue) }}</td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-right">
                                <button type="button" class="client-action-btn p-2 rounded-lg hover:bg-surface-container-high" onclick="toggleActionMenu(this)">
                                    <span class="material-symbols-outlined text-on-surface-variant">more_vert</span>
                                </button>
                                <div class="action-menu hidden">
                                    <a href="{{ route('clients.show', $client->id) }}">View Details</a>
                                    <button type="button">Archive</button>
                                    <button type="button" class="text-red-400">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-on-surface-variant">No clients found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-bar">{{ $clients->links() }}</div>
        </section>
    </div>

    <!-- Sidebar -->
    <div class="xl:col-span-3 space-y-5 sm:space-y-6">
        <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6">
            <h3 class="text-xs sm:text-sm font-bold text-on-surface uppercase tracking-widest mb-4">Quick Stats</h3>
            <div class="space-y-4">
                <div class="flex justify-between text-xs"><span class="text-on-surface-variant">Total Revenue</span><span class="text-on-surface font-semibold">${{ number_format($revenue) }}</span></div>
                <div class="flex justify-between text-xs"><span class="text-on-surface-variant">Active Projects</span><span class="text-on-surface font-semibold">{{ $projectsCount }}</span></div>
            </div>
        </div>
    </div>
</div>

<!-- Invite Modal -->
<div id="invite-modal" class="hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeInviteModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-surface-container rounded-3xl shadow-2xl p-6">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-bold text-on-surface">Invite Client</h3>
            <button type="button" onclick="closeInviteModal()" class="p-2 hover:bg-surface-container-high rounded-xl"><span class="material-symbols-outlined text-on-surface">close</span></button>
        </div>
        <button type="button" id="generate-btn" onclick="generateInviteLink()" class="w-full bg-primary hover:bg-primary/90 text-on-primary font-semibold py-3 rounded-xl transition-all">Generate Invite Link</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openInviteModal() {
        document.getElementById('invite-modal').classList.remove('hidden');
    }

    function closeInviteModal() {
        document.getElementById('invite-modal').classList.add('hidden');
    }

    function toggleActionMenu(btn) {
        var menu = btn.nextElementSibling;
        menu.classList.toggle('hidden');
    }

    function generateInviteLink() {
        var btn = document.getElementById('generate-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Generating...';
        fetch('/clients/invite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(function(res) {
                return res.json();
            })
            .then(function(data) {
                if (data.success) {
                    document.getElementById('invite-link').value = data.link;
                    document.getElementById('invite-expiry').textContent = 'Expires: ' + data.expires_at;
                    SwalCustom.success('Link Generated!', 'Your invite link is ready.');
                }
            })
            .finally(function() {
                btn.disabled = false;
                btn.innerHTML = 'Generate Invite Link';
            });
    }
</script>
@endpush
