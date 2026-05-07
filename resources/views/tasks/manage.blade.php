@extends("layouts.app")

<x-navbar />

@section("content")
<main class="flex-1 min-h-screen flex flex-col">
    <div class="pt-24 pb-12 px-12 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <section class="mb-12 flex flex-col md:flex-row justify-between items-end gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-[0.6875rem] font-bold uppercase tracking-[0.1em] text-primary/80">Project Alpha</span>
                        <span class="w-1 h-1 rounded-full bg-slate-600"></span>
                        <span class="text-[0.6875rem] font-bold uppercase tracking-[0.1em] text-slate-500">Task ID: OBS-204</span>
                    </div>
                    <h1 class="text-[3.5rem] font-light tracking-tight text-white leading-tight">Revamp UI/UX Design System</h1>
                    <div class="flex items-center gap-4 mt-4">
                        <div class="flex items-center gap-2 px-3 py-1 bg-primary/10 rounded-full text-primary">
                            <span class="material-symbols-outlined text-[18px]">sync</span>
                            <span class="text-xs font-bold">In Progress</span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1 bg-error-container/30 rounded-full text-error">
                            <span class="material-symbols-outlined text-[18px]">priority_high</span>
                            <span class="text-xs font-bold">High Priority</span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1 bg-surface-container rounded-full text-on-surface-variant">
                            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                            <span class="text-xs font-bold">Due: Oct 24, 2023</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button class="px-6 py-3 bg-surface-container hover:bg-surface-bright text-on-surface rounded-2xl font-semibold text-sm">Share Task</button>
                    <button class="px-6 py-3 bg-primary text-on-primary rounded-2xl font-bold text-sm shadow-xl">Complete Task</button>
                </div>
            </section>
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 lg:col-span-8 space-y-8">
                    <div class="bg-surface-container-low rounded-2xl p-8 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1 h-full bg-primary/50"></div>
                        <div class="flex justify-between items-start mb-6">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500">Task Overview</h3>
                            <button class="text-primary text-xs font-bold">Edit Details</button>
                        </div>
                        <div class="space-y-6">
                            <div class="space-y-3">
                                <h4 class="text-lg font-semibold text-white">Description</h4>
                                <p class="text-on-surface-variant leading-relaxed">
                                    Finalize the new architectural language for the Obsidian Admin suite. This includes the transition from standard layouts to high-contrast asymmetric grids.
                                </p>
                            </div>
                            <div class="grid grid-cols-2 gap-8 pt-6 border-t border-outline-variant/10">
                                <div>
                                    <h4 class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-3">Objectives</h4>
                                    <ul class="space-y-2">
                                        <li class="flex items-center gap-3 text-sm text-on-surface">
                                            <span class="material-symbols-outlined text-primary text-[16px]">check_circle</span>
                                            Establish Obsidian Glass tokens
                                        </li>
                                        <li class="flex items-center gap-3 text-sm text-on-surface">
                                            <span class="material-symbols-outlined text-primary text-[16px]">check_circle</span>
                                            Define the No-Line Rule
                                        </li>
                                        <li class="flex items-center gap-3 text-sm text-on-surface">
                                            <span class="material-symbols-outlined text-slate-600 text-[16px]">radio_button_unchecked</span>
                                            Design 12 core modules
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-3">Notes</h4>
                                    <p class="text-sm text-tertiary/80 italic">
                                        Client requested precision with premium mood.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container-low rounded-2xl overflow-hidden">
                        <div class="px-8 py-6 flex justify-between items-center border-b border-outline-variant/10">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500">Sub-Tasks (4)</h3>
                            <button class="flex items-center gap-2 text-primary text-xs font-bold px-4 py-2">
                                <span class="material-symbols-outlined text-[18px]">add</span>
                                Add
                            </button>
                        </div>
                        <div class="p-4 space-y-1">
                            <div class="flex items-center justify-between p-4 hover:bg-surface-bright rounded-2xl">
                                <div class="flex items-center gap-4">
                                    <span class="material-symbols-outlined text-primary">check_circle</span>
                                    <div>
                                        <p class="text-sm font-semibold text-white">Color Palette</p>
                                        <p class="text-[10px] text-slate-500">2 hours ago</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-8">
                                    <span class="text-xs font-medium text-slate-400">Oct 18</span>
                                    <span class="material-symbols-outlined text-slate-600">more_vert</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-4 hover:bg-surface-bright rounded-2xl">
                                <div class="flex items-center gap-4">
                                    <span class="material-symbols-outlined text-slate-600">radio_button_unchecked</span>
                                    <div>
                                        <p class="text-sm font-semibold text-white">Map IA</p>
                                        <p class="text-[10px] text-slate-500">Assigned to: Marcus</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-8">
                                    <span class="text-xs font-medium text-slate-400">Oct 20</span>
                                    <span class="material-symbols-outlined text-slate-600">more_vert</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-4 hover:bg-surface-bright rounded-2xl">
                                <div class="flex items-center gap-4">
                                    <span class="material-symbols-outlined text-slate-600">radio_button_unchecked</span>
                                    <div>
                                        <p class="text-sm font-semibold text-white">Icon Set</p>
                                        <p class="text-[10px] text-slate-500">Unassigned</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-8">
                                    <span class="text-xs font-medium text-slate-400">Oct 22</span>
                                    <span class="material-symbols-outlined text-slate-600">more_vert</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container-low rounded-2xl p-8">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-8">Communication Feed</h3>
                        <div class="space-y-8">
                            <div class="flex gap-4">
                                <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Marcus+Thornton&background=6366f1&color=fff&size=40" />
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-sm font-bold text-white">Marcus Thornton</span>
                                        <span class="text-[10px] text-slate-500 uppercase">34 MIN AGO</span>
                                    </div>
                                    <p class="text-sm text-on-surface-variant leading-relaxed mb-3">
                                        Just pushed the first draft of the Glass Effect tokens. Can you review the opacity levels?
                                    </p>
                                    <div class="flex items-center gap-4">
                                        <button class="text-xs font-bold text-slate-500 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">reply</span> Reply
                                        </button>
                                        <button class="text-xs font-bold text-slate-500 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">thumb_up</span> 2
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Alex+Rivera&background=8b5cf6&color=fff&size=40" />
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-sm font-bold text-white">Alex Rivera</span>
                                        <span class="text-[10px] text-slate-500 uppercase">12 MIN AGO</span>
                                    </div>
                                    <div class="p-4 bg-surface-container rounded-2xl border border-outline-variant/10">
                                        <p class="text-sm text-on-surface-variant">Looks great. I think we can push the blur to 24px.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-4 items-start pt-6 border-t border-outline-variant/10">
                                <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=You&background=4f46e5&color=fff&size=40" />
                                <div class="flex-1 relative">
                                    <textarea class="w-full bg-surface-container-high border-none rounded-2xl p-4 text-sm h-24 resize-none" placeholder="Write a comment..."></textarea>
                                    <div class="absolute bottom-3 right-3 flex items-center gap-3">
                                        <button class="p-2 text-slate-500 hover:text-white">
                                            <span class="material-symbols-outlined">attach_file</span>
                                        </button>
                                        <button class="bg-primary text-on-primary px-4 py-2 rounded-xl text-xs font-bold">Post</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4 space-y-8">
                    <div class="bg-surface-container rounded-2xl p-6 shadow-xl">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500">Progress</h3>
                            <span class="text-2xl font-bold text-primary">65%</span>
                        </div>
                        <div class="w-full h-2 bg-surface-container-highest rounded-full overflow-hidden mb-8">
                            <div class="h-full bg-gradient-to-r from-primary to-primary-container w-[65%]"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="w-1 h-10 bg-primary/20 rounded-full flex items-center justify-center">
                                    <div class="w-1 h-4 bg-primary rounded-full"></div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white">Milestone 2</p>
                                    <p class="text-[10px] text-slate-500">Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container rounded-2xl p-6">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-6">Team</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img class="w-10 h-10 rounded-2xl" src="https://ui-avatars.com/api/?name=Marcus+Thornton&background=6366f1&color=fff&size=40" />
                                    <div>
                                        <p class="text-sm font-bold text-white">Marcus Thornton</p>
                                        <p class="text-[10px] text-slate-500">Lead Designer</p>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-slate-600">mail</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img class="w-10 h-10 rounded-2xl" src="https://ui-avatars.com/api/?name=Sarah+Chen&background=ec4899&color=fff&size=40" />
                                    <div>
                                        <p class="text-sm font-bold text-white">Sarah Chen</p>
                                        <p class="text-[10px] text-slate-500">Motion Artist</p>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-slate-600">mail</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container rounded-2xl p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500">Files</h3>
                            <button class="material-symbols-outlined text-primary">upload_file</button>
                        </div>
                        <div class="space-y-3">
                            <div class="p-3 bg-surface-container-low rounded-xl flex items-center gap-3">
                                <div class="w-10 h-10 bg-error/10 text-error rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-white truncate">Style_Guide_v2.pdf</p>
                                    <p class="text-[10px] text-slate-500">4.2 MB</p>
                                </div>
                                <span class="material-symbols-outlined text-slate-600">download</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container-low rounded-2xl p-6">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-6">Activity</h3>
                        <div class="space-y-6">
                            <div class="relative pl-8">
                                <div class="absolute left-0 top-1 w-6 h-6 bg-primary/20 rounded-full flex items-center justify-center">
                                    <div class="w-2 h-2 bg-primary rounded-full"></div>
                                </div>
                                <p class="text-xs font-bold text-white">Project updated</p>
                                <p class="text-[10px] text-slate-500">2h ago</p>
                            </div>
                            <div class="relative pl-8">
                                <div class="absolute left-0 top-1 w-6 h-6 bg-tertiary/20 rounded-full flex items-center justify-center">
                                    <div class="w-2 h-2 bg-tertiary rounded-full"></div>
                                </div>
                                <p class="text-xs font-bold text-white">File uploaded</p>
                                <p class="text-[10px] text-slate-500">4h ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
