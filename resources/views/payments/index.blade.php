<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - XenonOS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                        'primary-container': '#4f46e5',
                        'secondary': '#a5b4fc',
                        'tertiary': '#ffb783',
                        'on-primary': '#1e1b4b',
                        'on-surface': '#dfe2f1',
                        'on-surface-variant': '#94a3b8',
                        'on-surface-muted': '#64748b',
                        'outline': '#475569',
                        'outline-variant': '#464554',
                        'error': '#f87171',
                        'emerald-400': '#34d399',
                        'amber-400': '#fbbf24',
                    },
                    fontFamily: {
                        headline: ['Syne', 'sans-serif'],
                        body: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Syne:wght@400;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/xenon.css') }}">
</head>

<body class="flex min-h-screen bg-surface font-body">
    <x-navbar />

    <main class="flex-1 md:ml-[260px] min-h-screen">
        <div class="p-6 md:p-8">
            <!-- Section 3: Branding & Global Liquidity Actions -->
            <section class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 sm:mb-8 md:mb-10">
                <div>
                    <span class="text-primary font-label text-[10px] tracking-[0.2em] uppercase font-bold">Financial Overview</span>
                    <h2 class="text-4xl sm:text-5xl font-headline font-light text-white mt-2">Payments</h2>
                    <p class="text-on-surface-variant mt-2 max-w-md">Manage client transactions, active balances, and financial health for your agency elite ecosystem.</p>
                </div>
                <button class="bg-primary text-on-primary font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-xl flex items-center gap-3 shadow-lg shadow-primary/10 hover:shadow-primary/20 transition-all active:scale-95">
                    <span class="material-symbols-outlined">add_circle</span>
                    Request Payment
                </button>
            </section>

            <!-- Section 4: KPI Monitor & Pulse Analytics -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <!-- Stat Card 1: Total Revenue -->
                <div class="bg-surface-container-low p-4 sm:p-6 rounded-xl border-l-2 border-primary-container relative overflow-hidden group">
                    <p class="text-on-surface-variant font-label text-[10px] font-bold uppercase tracking-wider">Total Revenue</p>
                    <h3 class="text-2xl sm:text-3xl font-headline font-bold text-white mt-4">${{ number_format($stats['total_revenue'], 2) }}</h3>
                    <div class="flex items-center gap-2 mt-4 text-xs font-bold text-emerald-400">
                        <span class="material-symbols-outlined text-sm">trending_up</span>
                        <span>All time</span>
                    </div>
                </div>

                <!-- Stat Card 2: Pending -->
                <div class="bg-surface-container-low p-4 sm:p-6 rounded-xl border-l-2 border-tertiary relative overflow-hidden group">
                    <p class="text-on-surface-variant font-label text-[10px] font-bold uppercase tracking-wider">Pending Payments</p>
                    <h3 class="text-2xl sm:text-3xl font-headline font-bold text-white mt-4">${{ number_format($stats['pending_amount'], 2) }}</h3>
                    <div class="flex items-center gap-2 mt-4 text-xs font-bold text-tertiary">
                        <span class="material-symbols-outlined text-sm">schedule</span>
                        <span>{{ $payments->where('status', 'pending')->count() }} invoices awaiting</span>
                    </div>
                </div>

                <!-- Stat Card 3: Completed -->
                <div class="bg-surface-container-low p-4 sm:p-6 rounded-xl border-l-2 border-secondary relative overflow-hidden group">
                    <p class="text-on-surface-variant font-label text-[10px] font-bold uppercase tracking-wider">Completed (MTD)</p>
                    <h3 class="text-2xl sm:text-3xl font-headline font-bold text-white mt-4">{{ $stats['completed_count'] ?? 0 }}</h3>
                    <div class="flex items-center gap-2 mt-4 text-xs font-bold text-secondary">
                        <span class="material-symbols-outlined text-sm">verified</span>
                        <span>Transactions</span>
                    </div>
                </div>

                <!-- Stat Card 4: Failed -->
                <div class="bg-surface-container-low p-4 sm:p-6 rounded-xl border-l-2 border-error relative overflow-hidden group">
                    <p class="text-on-surface-variant font-label text-[10px] font-bold uppercase tracking-wider">Failed Transactions</p>
                    <h3 class="text-2xl sm:text-3xl font-headline font-bold text-white mt-4">{{ $stats['failed_count'] ?? 0 }}</h3>
                    <div class="flex items-center gap-2 mt-4 text-xs font-bold text-error">
                        <span class="material-symbols-outlined text-sm">report</span>
                        <span>Action required</span>
                    </div>
                </div>
            </section>

            <!-- Section 5: Recent Transactions -->
            <div class="bg-surface-container rounded-2xl overflow-hidden shadow-2xl shadow-black/20">
                <div class="p-4 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-outline-variant/10">
                    <h4 class="text-lg font-headline font-bold text-white">Recent Transactions</h4>
                    <div class="flex items-center gap-4">
                        <button class="flex items-center gap-2 bg-surface-container-low rounded-lg px-3 py-1.5 text-xs font-bold text-on-surface-variant hover:bg-surface-container-high transition-colors">
                            <span class="material-symbols-outlined text-sm">filter_list</span>
                            Filters
                        </button>
                        <button class="text-primary text-xs font-bold flex items-center gap-1 group">
                            <div class="w-1 h-1 bg-primary rounded-full group-hover:w-3 transition-all duration-300"></div>
                            View All
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low/50">
                                <th class="px-4 sm:px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Client</th>
                                <th class="px-4 sm:px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Transaction ID</th>
                                <th class="px-4 sm:px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Amount</th>
                                <th class="px-4 sm:px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Status</th>
                                <th class="px-4 sm:px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant text-right">Method</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/5">
                            @forelse($payments as $payment)
                            <tr class="hover:bg-surface-bright/30 transition-colors">
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-primary/20 text-primary flex items-center justify-center font-bold text-xs">
                                            {{ $payment->invoice?->client?->name ? substr($payment->invoice->client->name, 0, 2) : 'N/A' }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-white">{{ $payment->invoice?->client?->name ?? 'Unknown Client' }}</p>
                                            <p class="text-[10px] text-on-surface-variant">{{ $payment->invoice?->invoice_number ?? 'No Invoice' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 font-mono text-xs text-on-surface-variant">{{ $payment->transaction_ref ?? 'N/A' }}</td>
                                <td class="px-4 sm:px-6 py-4 font-bold text-white">${{ number_format($payment->amount, 2) }}</td>
                                <td class="px-4 sm:px-6 py-4">
                                    @if($payment->status === 'completed')
                                    <span class="px-2 py-1 rounded-md bg-emerald-500/10 text-emerald-400 text-[10px] font-bold uppercase tracking-wider">Completed</span>
                                    @elseif($payment->status === 'pending')
                                    <span class="px-2 py-1 rounded-md bg-tertiary/10 text-tertiary text-[10px] font-bold uppercase tracking-wider">Pending</span>
                                    @elseif($payment->status === 'failed')
                                    <span class="px-2 py-1 rounded-md bg-error/10 text-error text-[10px] font-bold uppercase tracking-wider">Failed</span>
                                    @else
                                    <span class="px-2 py-1 rounded-md bg-secondary/10 text-secondary text-[10px] font-bold uppercase tracking-wider">{{ ucfirst($payment->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 text-on-surface-variant">
                                        @if($payment->method === 'card')
                                        <span class="material-symbols-outlined text-sm">credit_card</span>
                                        @elseif($payment->method === 'bank_transfer')
                                        <span class="material-symbols-outlined text-sm">account_balance</span>
                                        @elseif($payment->method === 'paypal')
                                        <span class="material-symbols-outlined text-sm">payments</span>
                                        @else
                                        <span class="material-symbols-outlined text-sm">payments</span>
                                        @endif
                                        <span class="text-xs font-medium">{{ ucwords(str_replace('_', ' ', $payment->method ?? 'N/A')) }}</span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <p class="text-on-surface-variant">No transactions yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

</html>