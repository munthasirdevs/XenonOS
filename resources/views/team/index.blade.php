@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/team-index.css') }}">
@endpush

@section('title', 'Team Members - System Admin')

@section('content')
<!-- ==================== MAIN CONTENT ==================== -->
<div class="pt-16 sm:pt-20 md:pt-24 pb-8 sm:pb-10 md:pb-12">
    <!-- Section 3: Branding & Strategic Resource Deployment -->
    <section
        class="mb-6 sm:mb-8 md:mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4 md:gap-6">
        <div>
            <h1
                class="font-headline text-2xl sm:text-3xl md:text-4xl font-light tracking-tight text-on-surface mb-2">
                Team Members</h1>
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-primary shadow-[0_0_8px_rgba(192,193,255,0.6)]"></span>
                <p class="text-xs sm:text-sm text-on-surface-variant">Active workforce of 12 specialists across
                    4 departments</p>
            </div>
        </div>
        <button
            class="inline-flex items-center justify-center gap-2 bg-primary px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl text-on-primary font-semibold text-xs sm:text-sm hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-primary/10 w-full md:w-auto min-h-[44px]">
            <span class="material-symbols-outlined text-base sm:text-lg">person_add</span>
            <span>Add New Team Member</span>
        </button>
    </section>

    <!-- Section 4: Performance Insights Strategy -->
    <section class="mb-6 sm:mb-8 flex flex-wrap items-center gap-3 sm:gap-4">
        <div
            class="flex items-center gap-1 sm:gap-2 bg-surface-container p-1 rounded-xl overflow-x-auto no-scrollbar">
            <button
                class="px-3 sm:px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest text-primary bg-surface-container-high shadow-sm whitespace-nowrap min-h-[44px]">All</button>
            <button
                class="px-3 sm:px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest text-outline hover:text-on-surface transition-colors whitespace-nowrap min-h-[44px]">Designers</button>
            <button
                class="px-3 sm:px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest text-outline hover:text-on-surface transition-colors whitespace-nowrap min-h-[44px]">Developers</button>
            <button
                class="px-3 sm:px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest text-outline hover:text-on-surface transition-colors whitespace-nowrap min-h-[44px]">PMs</button>
            <button
                class="px-3 sm:px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest text-outline hover:text-on-surface transition-colors whitespace-nowrap min-h-[44px]">QA</button>
        </div>
        <div class="h-8 w-[1px] bg-outline-variant/20 mx-2 hidden sm:block"></div>
        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
            <div class="relative group">
                <select id="filter_status" aria-label="Filter by status"
                    class="appearance-none bg-surface-container-low border border-outline-variant/10 rounded-lg sm:rounded-xl pl-3 sm:pl-4 pr-8 sm:pr-10 py-2 sm:py-2.5 text-xs font-medium text-on-surface-variant focus:ring-1 focus:ring-primary/30 min-h-[44px]">
                    <option>Status: All</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
                <span
                    class="material-symbols-outlined absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 text-xs pointer-events-none">expand_more</span>
            </div>
            <div class="relative group">
                <select id="filter_project" aria-label="Filter by project"
                    class="appearance-none bg-surface-container-low border border-outline-variant/10 rounded-lg sm:rounded-xl pl-3 sm:pl-4 pr-8 sm:pr-10 py-2 sm:py-2.5 text-xs font-medium text-on-surface-variant focus:ring-1 focus:ring-primary/30 min-h-[44px]">
                    <option>Project: All</option>
                    <option>Obsidian AI</option>
                    <option>Nexus Mobile</option>
                    <option>Vault ERP</option>
                </select>
                <span
                    class="material-symbols-outlined absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 text-xs pointer-events-none">expand_more</span>
            </div>
        </div>
        <div class="ml-auto flex items-center gap-3 sm:gap-4">
            <p class="text-xs text-outline font-medium whitespace-nowrap">Selected: <span id="selected-count">0</span></p>
            <button id="delete-selected" aria-label="Delete selected team members"
                class="text-outline hover:text-error/80 transition-colors p-2 rounded-lg hover:bg-error/10 min-h-[44px] min-w-[44px]">
                <span class="material-symbols-outlined text-xl">delete</span>
            </button>
        </div>
    </section>

    <!-- Section 5: Operational Data Lattice -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
        <!-- Member Card 1 - Jordan Smith -->
        <div
            class="group relative bg-surface-container rounded-xl p-4 sm:p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-black/40">
            <div class="absolute top-3 sm:top-4 left-3 sm:left-4 z-10">
                <input aria-label="Select Jordan Smith"
                    class="team-member-checkbox w-4 h-4 rounded border-outline-variant/30 bg-transparent text-primary focus:ring-offset-0 focus:ring-primary/30"
                    type="checkbox" name="select_member_1" data-member-id="1" />
            </div>
            <div class="absolute top-3 sm:top-4 right-3 sm:right-4 flex gap-1">
                <button
                    class="p-1.5 text-outline hover:text-white hover:bg-surface-bright rounded-lg transition-all min-h-[44px] min-w-[44px]">
                    <span class="material-symbols-outlined text-lg">edit</span>
                </button>
                <button
                    class="p-1.5 text-outline hover:text-white hover:bg-surface-bright rounded-lg transition-all min-h-[44px] min-w-[44px]">
                    <span class="material-symbols-outlined text-lg">more_vert</span>
                </button>
            </div>
            <div class="flex flex-col items-center text-center">
                <div class="relative mb-3 sm:mb-4">
                    <img class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl sm:rounded-2xl object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
                        alt="Avatar of Jordan Smith, Senior Designer"
                        src="https://ui-avatars.com/api/?name=Jordan+Smith&background=818cf8&color=fff&size=128" />
                    <span
                        class="absolute -bottom-1 -right-1 w-4 h-4 sm:w-5 sm:h-5 bg-emerald-500 border-2 sm:border-4 border-surface-container rounded-full"></span>
                </div>
                <h3 class="font-headline text-lg sm:text-xl font-bold text-on-surface mb-1">Jordan Smith</h3>
                <p class="text-xs font-bold uppercase tracking-widest text-outline mb-4 sm:mb-6">Senior Designer
                </p>
                <div
                    class="w-full flex items-center justify-between py-3 border-y border-outline-variant/5 mb-4 sm:mb-6">
                    <div class="text-left">
                        <p class="text-[10px] text-outline font-bold uppercase tracking-tighter mb-1">Projects
                        </p>
                        <div class="flex -space-x-2">
                            <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-secondary-container border-2 border-surface-container flex items-center justify-center text-[6px] sm:text-[8px] font-bold"
                                title="Project Obsidian">O</div>
                            <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-tertiary-container border-2 border-surface-container flex items-center justify-center text-[6px] sm:text-[8px] font-bold"
                                title="Nexus App">N</div>
                            <div
                                class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-surface-container-highest border-2 border-surface-container flex items-center justify-center text-[6px] sm:text-[8px] font-bold text-outline">
                                +2</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-outline font-bold uppercase tracking-tighter mb-1">Status</p>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide bg-primary/10 text-primary">Active</span>
                    </div>
                </div>
                <div class="w-full flex flex-col sm:flex-row items-center justify-between text-xs gap-2">
                    <span class="text-outline">Last seen: 2m ago</span>
                    <button
                        class="text-primary font-bold hover:underline min-h-[44px] min-w-[44px] flex items-center justify-center">View
                        Profile</button>
                </div>
            </div>
        </div>

        <!-- Member Card 2 - Sarah Chen -->
        <div
            class="group relative bg-surface-container rounded-xl p-4 sm:p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-black/40">
            <div class="absolute top-3 sm:top-4 left-3 sm:left-4 z-10">
                <input aria-label="Select Sarah Chen"
                    class="team-member-checkbox w-4 h-4 rounded border-outline-variant/30 bg-transparent text-primary focus:ring-offset-0 focus:ring-primary/30"
                    type="checkbox" name="select_member_2" data-member-id="2" />
            </div>
            <div class="absolute top-3 sm:top-4 right-3 sm:right-4 flex gap-1">
                <button
                    class="p-1.5 text-outline hover:text-white hover:bg-surface-bright rounded-lg transition-all min-h-[44px] min-w-[44px]">
                    <span class="material-symbols-outlined text-lg">edit</span>
                </button>
                <button
                    class="p-1.5 text-outline hover:text-white hover:bg-surface-bright rounded-lg transition-all min-h-[44px] min-w-[44px]">
                    <span class="material-symbols-outlined text-lg">more_vert</span>
                </button>
            </div>
            <div class="flex flex-col items-center text-center">
                <div class="relative mb-3 sm:mb-4">
                    <img class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl sm:rounded-2xl object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
                        alt="Avatar of Sarah Chen, Lead Developer"
                        src="https://ui-avatars.com/api/?name=Sarah+Chen&background=34d399&color=fff&size=128" />
                    <span
                        class="absolute -bottom-1 -right-1 w-4 h-4 sm:w-5 sm:h-5 bg-emerald-500 border-2 sm:border-4 border-surface-container rounded-full"></span>
                </div>
                <h3 class="font-headline text-lg sm:text-xl font-bold text-on-surface mb-1">Sarah Chen</h3>
                <p class="text-xs font-bold uppercase tracking-widest text-outline mb-4 sm:mb-6">Lead Developer
                </p>
                <div
                    class="w-full flex items-center justify-between py-3 border-y border-outline-variant/5 mb-4 sm:mb-6">
                    <div class="text-left">
                        <p class="text-[10px] text-outline font-bold uppercase tracking-tighter mb-1">Projects
                        </p>
                        <div class="flex -space-x-2">
                            <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-primary-container border-2 border-surface-container flex items-center justify-center text-[6px] sm:text-[8px] font-bold"
                                title="Vault ERP">V</div>
                            <div
                                class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-surface-container-highest border-2 border-surface-container flex items-center justify-center text-[6px] sm:text-[8px] font-bold text-outline">
                                +1</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-outline font-bold uppercase tracking-tighter mb-1">Status</p>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide bg-primary/10 text-primary">Active</span>
                    </div>
                </div>
                <div class="w-full flex flex-col sm:flex-row items-center justify-between text-xs gap-2">
                    <span class="text-outline">Last seen: 1h ago</span>
                    <button
                        class="text-primary font-bold hover:underline min-h-[44px] min-w-[44px] flex items-center justify-center">View
                        Profile</button>
                </div>
            </div>
        </div>

        <!-- Member Card 3 - Marcus Aurelius -->
        <div
            class="group relative bg-surface-container rounded-xl p-4 sm:p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-black/40">
            <div class="absolute top-3 sm:top-4 left-3 sm:left-4 z-10">
                <input aria-label="Select Marcus Aurelius"
                    class="team-member-checkbox w-4 h-4 rounded border-outline-variant/30 bg-transparent text-primary focus:ring-offset-0 focus:ring-primary/30"
                    type="checkbox" name="select_member_3" data-member-id="3" />
            </div>
            <div class="absolute top-3 sm:top-4 right-3 sm:right-4 flex gap-1">
                <button
                    class="p-1.5 text-outline hover:text-white hover:bg-surface-bright rounded-lg transition-all min-h-[44px] min-w-[44px]">
                    <span class="material-symbols-outlined text-lg">edit</span>
                </button>
                <button
                    class="p-1.5 text-outline hover:text-white hover:bg-surface-bright rounded-lg transition-all min-h-[44px] min-w-[44px]">
                    <span class="material-symbols-outlined text-lg">more_vert</span>
                </button>
            </div>
            <div class="flex flex-col items-center text-center">
                <div class="relative mb-3 sm:mb-4">
                    <img class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl sm:rounded-2xl object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
                        alt="Avatar of Marcus Aurelius, Product Manager"
                        src="https://ui-avatars.com/api/?name=Marcus+Aurelius&background=c084fc&color=fff&size=128" />
                    <span
                        class="absolute -bottom-1 -right-1 w-4 h-4 sm:w-5 sm:h-5 bg-outline-variant border-2 sm:border-4 border-surface-container rounded-full"></span>
                </div>
                <h3 class="font-headline text-lg sm:text-xl font-bold text-on-surface mb-1">Marcus Aurelius</h3>
                <p class="text-xs font-bold uppercase tracking-widest text-outline mb-4 sm:mb-6">Product Manager
                </p>
                <div
                    class="w-full flex items-center justify-between py-3 border-y border-outline-variant/5 mb-4 sm:mb-6">
                    <div class="text-left">
                        <p class="text-[10px] text-outline font-bold uppercase tracking-tighter mb-1">Projects
                        </p>
                        <div class="flex -space-x-2">
                            <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-tertiary-container border-2 border-surface-container flex items-center justify-center text-[6px] sm:text-[8px] font-bold"
                                title="Nexus App">N</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-outline font-bold uppercase tracking-tighter mb-1">Status</p>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide bg-surface-variant text-outline">Inactive</span>
                    </div>
                </div>
                <div class="w-full flex flex-col sm:flex-row items-center justify-between text-xs gap-2">
                    <span class="text-outline">Last seen: 3d ago</span>
                    <button
                        class="text-primary font-bold hover:underline min-h-[44px] min-w-[44px] flex items-center justify-center">View
                        Profile</button>
                </div>
            </div>
        </div>

        <!-- Add Member Placeholder Card -->
        <button id="add-member-card"
            class="group border-2 border-dashed border-outline-variant/20 rounded-xl p-4 sm:p-6 flex flex-col items-center justify-center text-center hover:border-primary/40 hover:bg-surface-container-low transition-all duration-300 min-h-[300px]">
            <div
                class="w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-surface-container-high flex items-center justify-center mb-3 sm:mb-4 group-hover:bg-primary/10 group-hover:scale-110 transition-all">
                <span
                    class="material-symbols-outlined text-2xl sm:text-3xl text-outline group-hover:text-primary">add</span>
            </div>
            <p class="text-sm font-bold text-on-surface-variant">Add new team member</p>
            <p class="text-[10px] text-outline uppercase tracking-widest mt-1">4 available slots</p>
        </button>
    </div>

    <!-- Section 7: Mission Command Registry -->
    <section class="mt-8 sm:mt-10 md:mt-12 grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
        <div class="bg-surface-container-low p-4 sm:p-6 rounded-xl border-l-2 border-primary-container">
            <p class="text-[10px] font-bold uppercase tracking-widest text-outline mb-1">Retention</p>
            <p class="text-xl sm:text-2xl font-light text-on-surface">98.4%</p>
        </div>
        <div class="bg-surface-container-low p-4 sm:p-6 rounded-xl border-l-2 border-primary-container">
            <p class="text-[10px] font-bold uppercase tracking-widest text-outline mb-1">Availability</p>
            <p class="text-xl sm:text-2xl font-light text-on-surface">82%</p>
        </div>
        <div class="bg-surface-container-low p-4 sm:p-6 rounded-xl border-l-2 border-primary-container">
            <p class="text-[10px] font-bold uppercase tracking-widest text-outline mb-1">Avg Project Load</p>
            <p class="text-xl sm:text-2xl font-light text-on-surface">2.4</p>
        </div>
        <div
            class="bg-surface-container-low p-4 sm:p-6 rounded-xl border-l-2 border-primary-container flex items-center justify-between cursor-pointer hover:bg-surface-container-low/80 transition-colors">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-outline mb-1">Quick Report</p>
                <p class="text-xs sm:text-sm font-bold text-primary">Download PDF</p>
            </div>
            <span class="material-symbols-outlined text-outline text-sm sm:text-lg">description</span>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/team-index.js') }}"></script>
@endpush
