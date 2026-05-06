<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients List - XenonOS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/xenon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
</head>

<body class="flex min-h-screen bg-surface">
    <x-navbar />

    <main class="flex-1 md:ml-[260px] min-h-screen">
        <div class="p-6 md:p-8">
            <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8">
                <div class="space-y-1.5">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-headline font-light tracking-tighter text-on-surface">
                        Clients
                    </h1>
                    <p class="text-on-surface-variant text-xs sm:text-sm max-w-lg">
                        Manage and monitor your global agency clients, project health, and financial cycles from one central dashboard.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <button type="button" onclick="openInviteModal()" class="bg-surface-container-high hover:bg-surface-container-high/80 text-on-surface font-semibold px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl sm:rounded-2xl inline-flex items-center justify-center gap-2 transition-all duration-150 hover:shadow-lg w-full sm:w-auto min-h-[44px] text-sm sm:text-base">
                        <span class="material-symbols-outlined text-lg sm:text-xl">mail</span>
                        <span>Invite Client</span>
                    </button>
                    <button type="button" onclick="document.getElementById('add-client-modal').classList.remove('hidden')" class="bg-primary hover:bg-primary/90 active:scale-[0.98] text-on-primary font-semibold px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl sm:rounded-2xl inline-flex items-center justify-center gap-2 transition-all duration-150 shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 w-full sm:w-auto min-h-[44px] text-sm sm:text-base">
                        <span class="material-symbols-outlined text-lg sm:text-xl">add</span>
                        <span>Add New Client</span>
                    </button>
                </div>
            </header>

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 md:gap-8">
                <div class="xl:col-span-9 space-y-5 sm:space-y-6">
                    <section class="bg-surface-container-low p-3 sm:p-4 md:p-5 rounded-2xl sm:rounded-3xl shadow-sm"
                        aria-label="Client filters">
                        <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                            <div class="w-full sm:flex-1 sm:min-w-[220px] relative">
                                <span class="material-symbols-outlined absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 text-on-surface-muted text-sm sm:text-base pointer-events-none" aria-hidden="true">search</span>
                                <input id="client-search" name="search" type="search" placeholder="Filter by Name, Email, or Company" value="{{ request('search') }}"
                                    class="filter-input w-full bg-surface-container text-on-surface placeholder-on-surface-muted text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 pl-10 sm:pl-12 pr-4 border-0 focus:ring-2 focus:ring-primary transition-all min-h-[44px]" aria-label="Search clients by name, email, or company" />
                            </div>

                            <label for="client-status-filter" class="sr-only">Filter clients by status</label>
                            <select id="client-status-filter" name="status" class="bg-surface-container text-on-surface text-sm rounded-xl sm:rounded-2xl py-2.5 sm:py-3 pl-4 pr-8 border-0 focus:ring-2 focus:ring-primary appearance-none cursor-pointer min-h-[44px] min-w-[130px]" aria-label="Filter clients by status">
                                <option value="all">Status: All</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="blocked">Blocked</option>
                            </select>

                            <!-- Date Filter Button -->
                            <button type="button" class="bg-surface-container hover:bg-surface-container-high p-2.5 sm:p-3 rounded-xl sm:rounded-2xl transition-all duration-150 min-h-[44px] min-w-[44px] flex items-center justify-center" aria-label="Filter by date range">
                                <span class="material-symbols-outlined text-sm sm:text-base">calendar_today</span>
                            </button>

                            <!-- Advanced Filter Button -->
                            <button type="button" class="bg-surface-container hover:bg-surface-container-high p-2.5 sm:p-3 rounded-xl sm:rounded-2xl transition-all duration-150 min-h-[44px] min-w-[44px] flex items-center justify-center" aria-label="Open advanced filters">
                                <span class="material-symbols-outlined text-sm sm:text-base">filter_list</span>
                            </button>
                        </div>
                    </section>

                    <div class="table-card bg-surface-container-low rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden">
                        <div class="table-scroll-wrapper">
                            <table class="w-full text-left border-collapse" role="table"
                                aria-label="Clients list">
                                <thead>
                                    <tr class="border-b border-outline-variant/10">
                                        <th scope="col"
                                            class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">
                                            Client
                                        </th>
                                        <th scope="col"
                                            class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap hidden md:table-cell">
                                            Company
                                        </th>
                                        <th scope="col"
                                            class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap hidden md:table-cell">
                                            Projects
                                        </th>
                                        <th scope="col"
                                            class="px-4 sm:px-6 py-4 sm:py-5 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-right">
                                            Revenue
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-outline-variant/5">
                                    @forelse($clients as $client)
                                    <tr class="client-row group hover:bg-surface-container/60 cursor-pointer transition-colors"
                                        onclick="window.location='/clients/{{ $client->id }}'"
                                        tabindex="0" role="row" aria-label="{{ $client->name }}, {{ $client->company }}, {{ $client->status }}" data-id="{{ $client->id }}">
                                        <td class="px-4 sm:px-6 py-4 sm:py-5">
                                            <div class="flex items-center gap-3 sm:gap-4">
                                                <img class="client-avatar w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl object-cover shrink-0"
                                                    src="{{ $client->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($client->name) . '&background=818cf8&color=fff&size=128' }}"
                                                    alt="Avatar of {{ $client->name }}" loading="lazy" />
                                                <div class="min-w-0">
                                                    <p
                                                        class="client-name font-bold text-on-surface group-hover:text-primary transition-colors text-sm sm:text-base truncate">
                                                        {{ $client->name }}
                                                    </p>
                                                    <p class="client-email text-xs text-on-surface-muted truncate">
                                                        {{ $client->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="client-company px-4 sm:px-6 py-4 sm:py-5 text-on-surface-variant font-medium text-sm sm:text-base whitespace-nowrap hidden md:table-cell">
                                            {{ $client->company }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 sm:py-5">
                                            @if($client->status === 'active')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                                Active
                                            </span>
                                            @elseif($client->status === 'inactive')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-wider bg-amber-500/10 text-amber-400 border border-amber-500/20 whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                                Inactive
                                            </span>
                                            @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-wider bg-red-500/10 text-red-400 border border-red-500/20 whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                                Blocked
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 sm:py-5 hidden md:table-cell">
                                            <div class="flex -space-x-2">
                                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border-2 border-surface-container-low bg-tertiary/20 flex items-center justify-center text-[9px] sm:text-[10px] font-bold text-tertiary shrink-0">
                                                    {{ $client->projects_count ?? 0 }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 sm:py-5 text-right font-headline font-semibold text-on-surface whitespace-nowrap text-sm sm:text-base">
                                            ${{ number_format($client->total_revenue ?? 0, 0) }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-4 sm:px-6 py-12 text-center">
                                            <p class="text-on-surface-variant text-lg">No Client Available</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <nav class="px-4 sm:px-6 py-4 sm:py-5 bg-surface-container-low/50 flex flex-col sm:flex-row justify-between items-center gap-3">
                            <p class="text-xs text-on-surface-muted">Showing <span id="results-count" class="text-on-surface-variant font-medium">{{ $clients->count() }}</span> of <span id="total-count" class="text-on-surface-variant font-medium">{{ $totalClients }}</span> clients</p>
                            <div class="flex items-center gap-2">
                                {{ $clients->links() }}
                            </div>
                        </nav>
                    </div>
                </div>

                <aside class="xl:col-span-3 space-y-5 sm:space-y-6" aria-label="Client statistics">
                    <div class="sidebar-sticky space-y-5 sm:space-y-6">
                        <div class="stat-card bg-surface-container-low p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl relative overflow-hidden group hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                            <div class="pl-2">
                                <p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant font-bold mb-1.5">Total Clients</p>
                                <div class="flex items-end justify-between">
                                    <h3 class="text-3xl sm:text-4xl font-headline font-semibold text-on-surface leading-none">{{ number_format($totalClients) }}</h3>
                                    <div class="flex items-center text-emerald-400 text-xs font-bold gap-1 mb-1">
                                        <span class="material-symbols-outlined text-sm">trending_up</span>
                                        <span>12%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-surface-container-low p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl relative overflow-hidden group hover:shadow-lg hover:shadow-tertiary/5 transition-all duration-200">
                            <div class="absolute top-0 left-0 w-1 h-full bg-tertiary"></div>
                            <div class="pl-2">
                                <p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant font-bold mb-1.5">Active Now</p>
                                <div class="flex items-end justify-between">
                                    <h3 class="text-4xl font-headline font-semibold text-on-surface leading-none">{{ number_format($activeClients) }}</h3>
                                    <div class="flex items-center text-on-surface-muted text-xs font-bold gap-1 mb-1">
                                        <span class="material-symbols-outlined text-sm">horizontal_rule</span>
                                        <span>0%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-surface-container-low p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl relative overflow-hidden group hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                            <div class="pl-2">
                                <p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant font-bold mb-1.5">New This Month</p>
                                <div class="flex items-end justify-between">
                                    <h3 class="text-4xl font-headline font-semibold text-on-surface leading-none">{{ number_format($newThisMonth) }}</h3>
                                    <div class="flex items-center text-emerald-400 text-xs font-bold gap-1 mb-1">
                                        <span class="material-symbols-outlined text-sm">trending_up</span>
                                        <span>5%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-surface-container-low p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl">
                            <p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant font-bold mb-3">Invite Stats (30 Days)</p>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="text-center">
                                    <p class="text-2xl sm:text-3xl font-headline font-semibold text-on-surface">{{ $inviteStats['created'] ?? 0 }}</p>
                                    <p class="text-[10px] text-on-surface-muted">Created</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl sm:text-3xl font-headline font-semibold text-emerald-400">{{ $inviteStats['signed_up'] ?? 0 }}</p>
                                    <p class="text-[10px] text-on-surface-muted">Signed Up</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl sm:text-3xl font-headline font-semibold text-amber-400">{{ $inviteStats['expired'] ?? 0 }}</p>
                                    <p class="text-[10px] text-on-surface-muted">Expired</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-surface-container-low p-6 rounded-3xl">
                            <div class="flex justify-between items-center mb-5">
                                <h3 class="text-sm font-bold uppercase tracking-widest text-on-surface-variant">Recent Events</h3>
                                <button type="button" class="text-xs text-primary font-bold flex items-center gap-1.5 hover:text-primary/80 transition-colors">View All</button>
                            </div>
                            <ul class="space-y-5">
                                @foreach($recentActivities as $activity)
                                <li class="flex gap-3 sm:gap-4 group">
                                    <div class="activity-icon-container w-8 h-8 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl bg-surface-container-high flex items-center justify-center shrink-0 group-hover:bg-surface-container-high/80 transition-colors">
                                        <span class="material-symbols-outlined text-primary text-base sm:text-lg">description</span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm text-on-surface leading-snug">
                                            <strong class="font-semibold text-on-surface">{{ $activity->client->name ?? 'Client' }}</strong> {{ $activity->description }}
                                        </p>
                                        <time class="block text-xs text-on-surface-muted mt-1.5">{{ $activity->created_at ? user_time_ago($activity->created_at) : 'Recently' }}</time>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </aside>
</div>
        </div>
    </main>

    @include('components.confirm-modal')

    <!-- Add Client Modal -->
    <div id="add-client-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="document.getElementById('add-client-modal').classList.add('hidden')"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-surface-container rounded-3xl shadow-2xl p-6">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-bold text-on-surface">Add New Client</h3>
                <button type="button" onclick="document.getElementById('add-client-modal').classList.add('hidden')" class="p-2 hover:bg-surface-container-high rounded-xl transition-colors">
                    <span class="material-symbols-outlined text-on-surface">close</span>
                </button>
            </div>

            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-on-surface mb-2">Name *</label>
                        <input type="text" id="name" name="name" required class="w-full bg-surface-container-high text-on-surface text-sm rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-on-surface mb-2">Email *</label>
                        <input type="email" id="email" name="email" required class="w-full bg-surface-container-high text-on-surface text-sm rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label for="company" class="block text-sm font-medium text-on-surface mb-2">Company</label>
                        <input type="text" id="company" name="company" class="w-full bg-surface-container-high text-on-surface text-sm rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-on-surface mb-2">Phone</label>
                        <input type="text" id="phone" name="phone" class="w-full bg-surface-container-high text-on-surface text-sm rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-on-surface mb-2">Address</label>
                        <textarea id="address" name="address" rows="2" class="w-full bg-surface-container-high text-on-surface text-sm rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-on-primary font-semibold py-3 rounded-xl">
                        Create Client
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Invite Modal -->
    <div id="invite-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeInviteModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-surface-container rounded-3xl shadow-2xl p-6">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-bold text-on-surface">Generate Invite Link</h3>
                <button type="button" onclick="closeInviteModal()" class="p-2 hover:bg-surface-container-high rounded-xl transition-colors">
                    <span class="material-symbols-outlined text-on-surface">close</span>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label for="expires-hours" class="block text-sm font-medium text-on-surface mb-2">Link Expiry</label>
                    <select id="expires-hours" class="w-full bg-surface-container-high text-on-surface text-sm rounded-xl py-3 px-4 border-0 focus:ring-2 focus:ring-primary appearance-none cursor-pointer">
                        <option value="8">8 Hours</option>
                        <option value="12">12 Hours</option>
                        <option value="24" selected>24 Hours</option>
                        <option value="48">48 Hours</option>
                    </select>
                </div>

                <button type="button" onclick="generateInviteLink()" id="generate-btn" class="w-full bg-primary hover:bg-primary/90 active:scale-[0.98] text-on-primary font-semibold py-3 rounded-xl inline-flex items-center justify-center gap-2 transition-all duration-150 shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined">link</span>
                    <span>Generate Link</span>
                </button>

                <div id="invite-result" class="hidden space-y-3 pt-2">
                    <div class="p-3 bg-surface-container-high rounded-xl">
                        <p class="text-xs text-on-surface-muted mb-1">Invite Link</p>
                        <div class="flex items-center gap-2">
                            <input type="text" id="invite-link" readonly class="flex-1 bg-transparent text-on-surface text-sm font-mono truncate">
                            <button type="button" onclick="copyInviteLink()" class="p-2 hover:bg-surface-container rounded-lg transition-colors" title="Copy link">
                                <span class="material-symbols-outlined text-primary">content_copy</span>
                            </button>
                        </div>
                    </div>
                    <p id="invite-expiry" class="text-xs text-on-surface-muted text-center"></p>
                </div>

                <div id="invite-error" class="hidden p-3 bg-red-500/10 border border-red-500/20 rounded-xl">
                    <p id="invite-error-msg" class="text-sm text-red-400"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openInviteModal() {
            document.getElementById('invite-modal').classList.remove('hidden');
            document.getElementById('invite-result').classList.add('hidden');
            document.getElementById('invite-error').classList.add('hidden');
        }

        function closeInviteModal() {
            document.getElementById('invite-modal').classList.add('hidden');
        }

        function generateInviteLink() {
            const btn = document.getElementById('generate-btn');
            const hours = document.getElementById('expires-hours').value;
            btn.disabled = true;
            btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Generating...';

            fetch('/clients/invite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ expires_hours: parseInt(hours) })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('invite-link').value = data.link;
                    document.getElementById('invite-expiry').textContent = 'Expires: ' + data.expires_at;
                    document.getElementById('invite-result').classList.remove('hidden');
                    document.getElementById('invite-error').classList.add('hidden');
                } else {
                    document.getElementById('invite-error-msg').textContent = data.message || 'Failed to generate link';
                    document.getElementById('invite-error').classList.remove('hidden');
                    document.getElementById('invite-result').classList.add('hidden');
                }
            })
            .catch(err => {
                document.getElementById('invite-error-msg').textContent = 'An error occurred';
                document.getElementById('invite-error').classList.remove('hidden');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<span class="material-symbols-outlined">link</span> Generate Link';
            });
        }

        function copyInviteLink() {
            const link = document.getElementById('invite-link').value;
            navigator.clipboard.writeText(link).then(() => {
                const btn = event.target.closest('button');
                btn.innerHTML = '<span class="material-symbols-outlined text-emerald-400">check</span>';
                setTimeout(() => {
                    btn.innerHTML = '<span class="material-symbols-outlined text-primary">content_copy</span>';
                }, 2000);
            });
        }

        window.openInviteModal = openInviteModal;
        window.closeInviteModal = closeInviteModal;
    </script>
</body>

</html>
