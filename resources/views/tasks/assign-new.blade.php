@extends("layouts.app")

<x-navbar />

@section("content")
<main class="min-h-screen pb-12 px-8 bg-surface text-on-surface font-body">
    <div class="max-w-7xl mx-auto pt-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="space-y-2">
                <span class="text-primary tracking-widest text-xs font-bold uppercase">Deployment Phase II</span>
                <h1 class="text-5xl font-extrabold tracking-tighter text-on-surface">Assign New Task</h1>
                <p class="text-on-surface-variant max-w-lg">Distribute workloads across the neural grid.</p>
            </div>
            <div class="flex gap-4">
                <button class="px-6 py-2.5 rounded-xl bg-surface-container border border-outline-variant/20 text-on-surface hover:bg-surface-container-high flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">save</span>
                    Draft
                </button>
                <button class="px-8 py-2.5 rounded-xl bg-indigo-gradient font-bold hover:scale-105 transition-transform">
                    Assign Task
                </button>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <div class="bg-surface-container p-8 rounded-[1.5rem]">
                    <div class="space-y-6">
                        <div class="group">
                            <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2 ml-1">Task Title</label>
                            <input class="w-full bg-gray-800 border-none rounded-xl p-4 text-xl font-semibold text-on-surface focus:ring-2 focus:ring-primary/40" placeholder="e.g., Optimize Kernel" type="text" name="task_title" />
                        </div>
                        <div class="group">
                            <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2 ml-1">Description</label>
                            <div class="bg-surface-container-lowest rounded-xl border-none overflow-hidden">
                                <div class="flex items-center gap-1 p-2 border-b border-outline-variant/10 bg-surface-container-low/50">
                                    <button class="p-2 hover:bg-surface-container-highest rounded-lg text-on-surface-variant material-symbols-outlined text-lg">format_bold</button>
                                    <button class="p-2 hover:bg-surface-container-highest rounded-lg text-on-surface-variant material-symbols-outlined text-lg">format_italic</button>
                                    <button class="p-2 hover:bg-surface-container-highest rounded-lg text-on-surface-variant material-symbols-outlined text-lg">format_list_bulleted</button>
                                </div>
                                <textarea class="w-full bg-transparent border-none focus:ring-0 p-4 text-on-surface-variant resize-none" placeholder="Define scope..." rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-surface-container p-6 rounded-[1.5rem]">
                        <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-4 ml-1">Project</label>
                        <div class="relative group">
                            <div class="w-full bg-surface-container-lowest p-4 rounded-xl flex items-center justify-between cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full bg-tertiary"></span>
                                    <span class="text-on-surface">Stellar Dawn</span>
                                </div>
                                <span class="material-symbols-outlined text-on-surface-variant">expand_more</span>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-surface-container-highest rounded-full text-[10px] font-bold text-on-surface-variant">Phase 1</span>
                            <span class="px-3 py-1 bg-surface-container-highest rounded-full text-[10px] font-bold text-on-surface-variant">Security</span>
                        </div>
                    </div>
                    <div class="bg-surface-container p-6 rounded-[1.5rem]">
                        <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-4 ml-1">Priority</label>
                        <div class="flex gap-2">
                            <button class="flex-1 py-3 px-2 rounded-xl border border-outline-variant/20 text-[10px] font-bold uppercase text-on-surface-variant">Low</button>
                            <button class="flex-1 py-3 px-2 rounded-xl border border-outline-variant/20 text-[10px] font-bold uppercase text-on-surface-variant">Medium</button>
                            <button class="flex-1 py-3 px-2 rounded-xl bg-primary/10 border border-primary/40 text-[10px] font-bold uppercase text-primary">Critical</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <div class="bg-surface-container p-6 rounded-[1.5rem]">
                    <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-4 ml-1">Assign To</label>
                    <div class="relative mb-4">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">search</span>
                        <input class="w-full bg-gray-800 border-none rounded-xl py-3 pl-12 pr-4 text-sm text-on-surface focus:ring-2 focus:ring-primary/40" placeholder="Search agents..." type="text" />
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 p-2 rounded-xl bg-surface-container-highest/50 border border-primary/20">
                            <img class="w-10 h-10 rounded-lg" src="https://ui-avatars.com/api/?name=Marcus+Vane&background=6366f1&color=fff&size=40" />
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-on-surface">Marcus Vane</p>
                                <p class="text-[10px] text-primary">Lead Architect</p>
                            </div>
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                        </div>
                        <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-surface-container-low cursor-pointer group">
                            <img class="w-10 h-10 rounded-lg grayscale" src="https://ui-avatars.com/api/?name=Elena+Ross&background=ec4899&color=fff&size=40" />
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-on-surface-variant">Elena Ross</p>
                                <p class="text-[10px] text-outline">Frontend</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-surface-container p-6 rounded-[1.5rem]">
                    <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-4 ml-1">Deadline</label>
                    <div class="bg-surface-container-lowest rounded-xl p-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">calendar_today</span>
                            <span class="text-sm font-semibold text-on-surface">October 24, 2024</span>
                        </div>
                        <button class="material-symbols-outlined text-on-surface-variant hover:text-primary">edit_calendar</button>
                    </div>
                    <div class="mt-4 p-4 rounded-xl bg-error-container/10 border border-error/20">
                        <div class="flex items-center gap-2 text-error mb-1">
                            <span class="material-symbols-outlined text-sm">schedule</span>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Urgent</span>
                        </div>
                        <p class="text-[11px] text-on-surface-variant">Expires in 48 hours.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
