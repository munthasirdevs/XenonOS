@extends('layouts.app')

@section('title', 'Saved Reports - XenonOS')

@push('styles')
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }
    .indigo-gradient {
        background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
    }
</style>
@endpush

@section('content')
<main class="p-8 min-h-[calc(100vh-4rem)] flex flex-col">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div>
            <h2 class="font-syne font-extrabold text-4xl text-on-surface tracking-tighter mb-2">Saved Reports</h2>
            <p class="text-on-surface-variant text-sm max-w-md">Manage and analyze your historical data architectures and generated insights.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-5 py-3 rounded-xl bg-surface-container-high text-on-surface text-sm font-semibold hover:bg-surface-variant transition-colors border border-outline-variant/10">
                <span class="material-symbols-outlined text-sm">filter_list</span>
                Advanced Filters
            </button>
            <button class="flex items-center gap-2 px-6 py-3 rounded-xl indigo-gradient text-on-primary font-bold shadow-[0_8px_16px_-4px_rgba(99,102,241,0.4)] hover:scale-105 transition-transform">
                <span class="material-symbols-outlined">add_circle</span>
                Create New Report
            </button>
        </div>
    </section>

    <div class="flex items-center gap-2 mb-8 bg-surface-container-lowest p-1.5 rounded-2xl w-fit">
        <button class="px-6 py-2.5 rounded-xl bg-surface-container text-primary font-bold shadow-sm text-sm">All Reports</button>
        <button class="px-6 py-2.5 rounded-xl text-on-surface-variant hover:text-on-surface font-medium text-sm transition-colors">Financial</button>
        <button class="px-6 py-2.5 rounded-xl text-on-surface-variant hover:text-on-surface font-medium text-sm transition-colors">Performance</button>
        <button class="px-6 py-2.5 rounded-xl text-on-surface-variant hover:text-on-surface font-medium text-sm transition-colors">Operational</button>
    </div>

    <div class="bg-surface-container rounded-2xl overflow-hidden shadow-2xl ring-1 ring-outline-variant/10">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Report Name</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Type</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Last Updated</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Created By</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/5">
                <tr class="group hover:bg-surface-container-high transition-all duration-300">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">description</span>
                            <span class="font-semibold text-on-surface">Q4 Revenue Synthesis</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-2.5 py-1 rounded-md bg-secondary-container/30 text-secondary text-[11px] font-bold uppercase">Financial</span>
                    </td>
                    <td class="px-6 py-5 text-sm text-on-surface-variant">Oct 24, 2023 - 14:20</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=818cf8&color=fff&size=64" class="w-6 h-6 rounded-full" alt="J. Doe" />
                            <span class="text-sm text-on-surface">J. Doe</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-1.5 text-emerald-400">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-400"></div>
                            <span class="text-[11px] font-bold uppercase">Live</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="View"><span class="material-symbols-outlined text-[20px]">visibility</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Edit"><span class="material-symbols-outlined text-[20px]">edit</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Duplicate"><span class="material-symbols-outlined text-[20px]">content_copy</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Export"><span class="material-symbols-outlined text-[20px]">ios_share</span></button>
                            <button class="p-2 rounded-lg hover:bg-error/10 hover:text-error transition-colors text-on-surface-variant" title="Delete"><span class="material-symbols-outlined text-[20px]">delete</span></button>
                        </div>
                    </td>
                </tr>

                <tr class="group hover:bg-surface-container-high transition-all duration-300">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">speed</span>
                            <span class="font-semibold text-on-surface">System Latency Audit</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-2.5 py-1 rounded-md bg-tertiary-container/30 text-tertiary text-[11px] font-bold uppercase">Performance</span>
                    </td>
                    <td class="px-6 py-5 text-sm text-on-surface-variant">Oct 23, 2023 - 09:15</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name=Anna+Chen&background=c084fc&color=fff&size=64" class="w-6 h-6 rounded-full" alt="A. Chen" />
                            <span class="text-sm text-on-surface">A. Chen</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-1.5 text-on-surface-variant">
                            <div class="w-1.5 h-1.5 rounded-full bg-on-surface-variant"></div>
                            <span class="text-[11px] font-bold uppercase">Archived</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="View"><span class="material-symbols-outlined text-[20px]">visibility</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Edit"><span class="material-symbols-outlined text-[20px]">edit</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Duplicate"><span class="material-symbols-outlined text-[20px]">content_copy</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Export"><span class="material-symbols-outlined text-[20px]">ios_share</span></button>
                            <button class="p-2 rounded-lg hover:bg-error/10 hover:text-error transition-colors text-on-surface-variant" title="Delete"><span class="material-symbols-outlined text-[20px]">delete</span></button>
                        </div>
                    </td>
                </tr>

                <tr class="group hover:bg-surface-container-high transition-all duration-300">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">hub</span>
                            <span class="font-semibold text-on-surface">Node Distribution Chart</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-2.5 py-1 rounded-md bg-surface-variant text-on-surface text-[11px] font-bold uppercase">Operational</span>
                    </td>
                    <td class="px-6 py-5 text-sm text-on-surface-variant">Oct 21, 2023 - 18:45</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name=Mike+Klaus&background=34d399&color=fff&size=64" class="w-6 h-6 rounded-full" alt="M. Klaus" />
                            <span class="text-sm text-on-surface">M. Klaus</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-1.5 text-primary">
                            <div class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></div>
                            <span class="text-[11px] font-bold uppercase">Processing</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="View"><span class="material-symbols-outlined text-[20px]">visibility</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Edit"><span class="material-symbols-outlined text-[20px]">edit</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Duplicate"><span class="material-symbols-outlined text-[20px]">content_copy</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Export"><span class="material-symbols-outlined text-[20px]">ios_share</span></button>
                            <button class="p-2 rounded-lg hover:bg-error/10 hover:text-error transition-colors text-on-surface-variant" title="Delete"><span class="material-symbols-outlined text-[20px]">delete</span></button>
                        </div>
                    </td>
                </tr>

                <tr class="group hover:bg-surface-container-high transition-all duration-300">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">database</span>
                            <span class="font-semibold text-on-surface">Cluster Health Matrix</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-2.5 py-1 rounded-md bg-tertiary-container/30 text-tertiary text-[11px] font-bold uppercase">Performance</span>
                    </td>
                    <td class="px-6 py-5 text-sm text-on-surface-variant">Oct 19, 2023 - 11:30</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name=Anna+Chen&background=c084fc&color=fff&size=64" class="w-6 h-6 rounded-full" alt="A. Chen" />
                            <span class="text-sm text-on-surface">A. Chen</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-1.5 text-emerald-400">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-400"></div>
                            <span class="text-[11px] font-bold uppercase">Live</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="View"><span class="material-symbols-outlined text-[20px]">visibility</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Edit"><span class="material-symbols-outlined text-[20px]">edit</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Duplicate"><span class="material-symbols-outlined text-[20px]">content_copy</span></button>
                            <button class="p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors text-on-surface-variant" title="Export"><span class="material-symbols-outlined text-[20px]">ios_share</span></button>
                            <button class="p-2 rounded-lg hover:bg-error/10 hover:text-error transition-colors text-on-surface-variant" title="Delete"><span class="material-symbols-outlined text-[20px]">delete</span></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="px-6 py-5 bg-surface-container-low/30 flex items-center justify-between border-t border-outline-variant/5">
            <span class="text-xs text-on-surface-variant font-medium">Showing <span class="text-on-surface">1-4</span> of <span class="text-on-surface">32</span> reports</span>
            <div class="flex items-center gap-2">
                <button class="p-2 rounded-lg bg-surface-container-high text-on-surface-variant opacity-50 cursor-not-allowed border border-outline-variant/10">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <div class="flex items-center gap-1">
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary/20 text-primary font-bold text-xs">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-high text-on-surface-variant text-xs transition-colors">2</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-high text-on-surface-variant text-xs transition-colors">3</button>
                    <span class="text-on-surface-variant text-xs mx-1">...</span>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-high text-on-surface-variant text-xs transition-colors">8</button>
                </div>
                <button class="p-2 rounded-lg bg-surface-container-high text-on-surface-variant hover:text-on-surface border border-outline-variant/10 transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="md:col-span-2 bg-surface-container rounded-2xl p-6 relative overflow-hidden group border border-outline-variant/5">
            <div class="relative z-10">
                <h3 class="font-syne font-bold text-xl text-on-surface mb-2">Automated Insights Ready</h3>
                <p class="text-on-surface-variant text-sm mb-4 max-w-sm">We've identified 3 new patterns in your Financial reports. Sync now to update your dashboard metrics.</p>
                <button class="text-primary text-sm font-bold flex items-center gap-1 hover:gap-2 transition-all">
                    Sync Intelligence <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
            <div class="absolute -right-8 -bottom-8 opacity-10 group-hover:opacity-20 transition-opacity duration-700">
                <span class="material-symbols-outlined text-[180px]">bolt</span>
            </div>
        </div>

        <div class="bg-primary/5 rounded-2xl p-6 border border-primary/20 flex flex-col justify-between">
            <div>
                <span class="material-symbols-outlined text-primary mb-4">workspace_premium</span>
                <h3 class="font-syne font-bold text-lg text-on-surface mb-1">Storage Usage</h3>
                <p class="text-on-surface-variant text-[11px] uppercase tracking-wider mb-4">Plan: Enterprise Ultra</p>
            </div>
            <div class="space-y-2">
                <div class="w-full h-1.5 bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="w-3/4 h-full indigo-gradient"></div>
                </div>
                <p class="text-xs text-on-surface-variant flex justify-between">
                    <span>1.2GB / 2GB</span>
                    <span class="text-primary font-bold">75%</span>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
