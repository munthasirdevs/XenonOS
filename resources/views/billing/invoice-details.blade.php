@extends('layouts.app')

@section('content')
<x-navbar />

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/billing-invoice-details.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/billing-invoice-details.js') }}" defer></script>
@endpush

<main class="flex-1 min-h-screen flex flex-col" role="main">
    <div class="pt-24 px-8 pb-12 overflow-y-auto flex flex-col gap-8">

        <!-- Document Context & Lifecycle Actions -->
        <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <div class="space-y-1.5 sm:space-y-2">
                <div class="flex items-center gap-2 flex-wrap">
                    <a href="{{ route('billing.invoices') }}" class="text-xs sm:text-sm text-on-surface-variant hover:text-primary transition-colors inline-flex items-center gap-1 min-h-[44px]" aria-label="Back to invoices">
                        <span class="material-symbols-outlined text-sm" aria-hidden="true">chevron_left</span>
                        Invoices
                    </a>
                    <span class="text-on-surface-variant text-xs sm:text-sm" aria-hidden="true">/</span>
                    <span class="text-xs sm:text-sm text-on-surface font-semibold">#INV-2024-082</span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-light tracking-tighter text-on-surface">
                    Invoice Details
                </h1>
                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mt-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-full text-[10px] sm:text-[11px] font-bold uppercase tracking-wider bg-tertiary/10 text-tertiary border border-tertiary/20 whitespace-nowrap">
                        <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse" aria-hidden="true"></span>
                        Pending
                    </span>
                    <span class="text-on-surface-variant text-xs sm:text-sm">Due: October 26, 2024</span>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 sm:gap-3 w-full sm:w-auto">
                <button type="button" class="bg-primary hover:bg-primary/90 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-primary font-semibold px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl inline-flex items-center justify-center gap-2 transition-all duration-150 shadow-lg shadow-primary/20 w-full sm:w-auto min-h-[44px] text-sm" aria-label="Send invoice">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">send</span>
                    <span>Send Invoice</span>
                </button>
                <button type="button" class="bg-surface-container-highest hover:bg-surface-container-high active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-surface font-semibold px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl inline-flex items-center justify-center gap-2 transition-all duration-150 border border-outline-variant/10 w-full sm:w-auto min-h-[44px] text-sm" aria-label="Download PDF">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">download</span>
                    <span>PDF</span>
                </button>
                <button type="button" class="bg-surface-container-low hover:bg-surface-container-high active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-surface font-semibold px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl inline-flex items-center justify-center gap-2 transition-all duration-150 border border-outline-variant/20 w-full sm:w-auto min-h-[44px] text-sm" aria-label="Mark invoice as paid">
                    <span class="material-symbols-outlined text-sm text-primary" aria-hidden="true">check_circle</span>
                    <span>Mark as Paid</span>
                </button>
            </div>
        </header>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Invoice Details -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Fiscal Instrument Primary Workspace -->
                <div class="bg-surface-container-low rounded-3xl shadow-sm p-6 md:p-8 border border-white/5">
                    <!-- From / To / Dates -->
                    <div class="flex flex-col md:flex-row justify-between gap-6 md:gap-8 mb-8">
                        <!-- From -->
                        <div class="space-y-3">
                            <div>
                                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest mb-1">From</p>
                                <h2 class="font-headline font-bold text-base sm:text-lg text-on-surface">Xenon Systems Inc.</h2>
                                <p class="text-on-surface-variant text-xs sm:text-sm leading-relaxed">
                                    Level 42, Obsidian Tower<br />
                                    88 Cyber Way, New Tokyo<br />
                                    hello@xenonos.com
                                </p>
                            </div>
                            <div class="pt-3 border-t border-outline-variant/10">
                                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest mb-1">To</p>
                                <h2 class="font-headline font-bold text-base sm:text-lg text-on-surface">Vortex Labs GMBH</h2>
                                <p class="text-on-surface-variant text-xs sm:text-sm leading-relaxed">
                                    Alexander Smith<br />
                                    Frederick Street 19<br />
                                    10117 Berlin, Germany
                                </p>
                            </div>
                        </div>
                        <!-- Dates -->
                        <div class="text-right space-y-3 self-start">
                            <div>
                                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest mb-1">Invoice Date</p>
                                <p class="text-on-surface text-sm font-medium">October 12, 2024</p>
                            </div>
                            <div>
                                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest mb-1">Due Date</p>
                                <p class="text-on-surface text-sm font-medium text-primary">October 26, 2024</p>
                            </div>
                            <div>
                                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest mb-1">Project Ref</p>
                                <p class="text-on-surface text-sm font-medium">VX-889-CORE</p>
                            </div>
                        </div>
                    </div>

                    <!-- Itemized Digital Service Ledger -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left min-w-[500px]" role="table" aria-label="Invoice line items">
                            <thead>
                                <tr class="border-b border-white/5">
                                    <th scope="col" class="pb-3 sm:pb-4 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap">Description</th>
                                    <th scope="col" class="pb-3 sm:pb-4 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-center">Qty</th>
                                    <th scope="col" class="pb-3 sm:pb-4 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-right">Unit Price</th>
                                    <th scope="col" class="pb-3 sm:pb-4 font-label text-[10px] sm:text-xs uppercase tracking-[0.15em] text-on-surface-muted whitespace-nowrap text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                <tr>
                                    <td class="py-4 sm:py-6">
                                        <p class="font-bold text-on-surface text-sm">Cloud Infrastructure Audit</p>
                                        <p class="text-xs text-on-surface-variant mt-0.5">Deep security and performance analysis of AWS clusters</p>
                                    </td>
                                    <td class="py-4 sm:py-6 text-center font-medium text-sm">1</td>
                                    <td class="py-4 sm:py-6 text-right font-medium text-sm">$2,400.00</td>
                                    <td class="py-4 sm:py-6 text-right font-bold text-sm">$2,400.00</td>
                                </tr>
                                <tr>
                                    <td class="py-4 sm:py-6">
                                        <p class="font-bold text-on-surface text-sm">Bespoke UI Design System</p>
                                        <p class="text-xs text-on-surface-variant mt-0.5">Complete Figma tokens and React primitives library</p>
                                    </td>
                                    <td class="py-4 sm:py-6 text-center font-medium text-sm">1</td>
                                    <td class="py-4 sm:py-6 text-right font-medium text-sm">$4,500.00</td>
                                    <td class="py-4 sm:py-6 text-right font-bold text-sm">$4,500.00</td>
                                </tr>
                                <tr>
                                    <td class="py-4 sm:py-6">
                                        <p class="font-bold text-on-surface text-sm">Data Migration Support</p>
                                        <p class="text-xs text-on-surface-variant mt-0.5">PostgreSQL to MongoDB transition consultancy (Hourly)</p>
                                    </td>
                                    <td class="py-4 sm:py-6 text-center font-medium text-sm">12</td>
                                    <td class="py-4 sm:py-6 text-right font-medium text-sm">$180.00</td>
                                    <td class="py-4 sm:py-6 text-right font-bold text-sm">$2,160.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Final Fiscal Calculation & Summary -->
                <div class="bg-surface-container-low rounded-3xl shadow-sm p-6 md:p-8 border border-white/5 relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-primary/10 blur-3xl rounded-full" aria-hidden="true"></div>
                    <h3 class="font-headline font-bold text-xs uppercase tracking-widest mb-6 sm:mb-8 text-on-surface-variant relative z-10">Calculation</h3>
                    <div class="space-y-3 sm:space-y-4 relative z-10">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">Subtotal</span>
                            <span class="font-medium text-on-surface">$9,060.00</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">Tax (VAT 19%)</span>
                            <span class="font-medium text-on-surface">$1,721.40</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">Service Discount</span>
                            <span class="font-medium text-error">- $100.00</span>
                        </div>
                        <div class="pt-4 sm:pt-6 mt-4 sm:mt-6 border-t border-white/10">
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Total Due</p>
                                    <p class="text-2xl sm:text-3xl font-headline font-extrabold text-on-surface tracking-tight">$10,681.40</p>
                                </div>
                                <p class="text-[10px] text-on-surface-variant italic mb-1">USD</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Payment Notes -->
                <div class="bg-surface-container-low rounded-3xl shadow-sm p-6 border border-white/5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-primary/10 rounded-xl">
                            <span class="material-symbols-outlined text-primary" data-icon="note">note</span>
                        </div>
                        <h3 class="font-headline font-bold text-lg text-on-surface">Payment Notes</h3>
                    </div>
                    <p class="text-on-surface-variant text-xs sm:text-sm leading-relaxed">
                        Please include the invoice number <span class="text-on-surface font-bold">#INV-2024-082</span> in your bank transfer reference.
                        Payments are expected within 14 days of the invoice date. Late payments may be subject to a 2% monthly interest fee as per our service agreement.
                    </p>
                </div>

                <!-- Client Context Card -->
                <div class="bg-surface-container-low rounded-3xl shadow-sm p-6 border border-white/5">
                    <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                        <img alt="Vortex Labs GMBH logo" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl object-cover shrink-0" src="https://ui-avatars.com/api/?name=Vortex+Labs&background=6366f1&color=fff&rounded=true&size=48">
                        <div class="min-w-0">
                            <h4 class="font-bold text-on-surface text-sm">Vortex Labs GMBH</h4>
                            <p class="text-xs text-on-surface-variant">Enterprise Client since 2022</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-xs sm:text-sm text-on-surface-variant min-h-[44px]">
                            <span class="material-symbols-outlined text-sm flex-shrink-0 text-primary" aria-hidden="true">history</span>
                            <span>12 Invoices this year</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs sm:text-sm text-on-surface-variant min-h-[44px]">
                            <span class="material-symbols-outlined text-sm flex-shrink-0 text-primary" aria-hidden="true">timer</span>
                            <span>Avg. payment time: 4 days</span>
                        </div>
                    </div>
                    <button type="button" class="mt-4 sm:mt-6 w-full p-3 rounded-xl bg-surface-container-highest hover:bg-surface-container-high active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-surface text-on-surface text-xs sm:text-sm font-semibold transition-all min-h-[44px] border border-white/5">
                        View Client Portal
                    </button>
                </div>

                <!-- Document Audit Lifecycle Tracking -->
                <div class="bg-surface-container-low rounded-3xl shadow-sm p-6 border border-white/5">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-emerald-500/10 rounded-xl">
                            <span class="material-symbols-outlined text-emerald-400" data-icon="history">history</span>
                        </div>
                        <div>
                            <h3 class="font-headline font-bold text-lg text-on-surface">Activity Log</h3>
                            <p class="text-xs text-on-surface-variant">Invoice timeline</p>
                        </div>
                    </div>
                    <div class="space-y-5 sm:space-y-6">
                        <!-- Event 1 -->
                        <div class="flex gap-3 sm:gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-primary mt-1 shrink-0 shadow-lg shadow-primary/30" aria-hidden="true"></div>
                                <div class="w-0.5 h-full bg-primary/20 mt-1" aria-hidden="true"></div>
                            </div>
                            <div class="min-w-0 pb-5 flex-1 bg-surface-container rounded-xl p-3 border border-white/5">
                                <p class="text-xs sm:text-sm font-bold text-on-surface">Invoice Created</p>
                                <p class="text-[10px] sm:text-xs text-on-surface-variant mt-1">Oct 12, 09:42 AM by Sarah J.</p>
                            </div>
                        </div>
                        <!-- Event 2 -->
                        <div class="flex gap-3 sm:gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-amber-400 mt-1 shrink-0 shadow-lg shadow-amber-400/30" aria-hidden="true"></div>
                                <div class="w-0.5 h-full bg-primary/20 mt-1" aria-hidden="true"></div>
                            </div>
                            <div class="min-w-0 pb-5 flex-1 bg-surface-container rounded-xl p-3 border border-white/5">
                                <p class="text-xs sm:text-sm font-bold text-on-surface">Viewed by Client</p>
                                <p class="text-[10px] sm:text-xs text-on-surface-variant mt-1">Oct 13, 11:15 AM from Berlin, DE</p>
                            </div>
                        </div>
                        <!-- Event 3 -->
                        <div class="flex gap-3 sm:gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-emerald-400 mt-1 shrink-0 shadow-lg shadow-emerald-400/30" aria-hidden="true"></div>
                            </div>
                            <div class="min-w-0 flex-1 bg-surface-container rounded-xl p-3 border border-white/5">
                                <p class="text-xs sm:text-sm font-bold text-on-surface">Reminder Sent</p>
                                <p class="text-[10px] sm:text-xs text-on-surface-variant mt-1">Oct 14, 10:00 AM (Automated)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
