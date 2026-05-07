@extends('layouts.app')

@section('title', 'Assign Task - XenonOS')

@push('styles')
<style>
    .step-indicator.active {
        background: linear-gradient(135deg, #818cf8, #6366f1);
    }
    .step-progress {
        width: 33%;
    }
</style>
@endpush

@section('content')
<div class="p-8 lg:p-12">
    <div class="mb-10 flex justify-between items-end">
        <div>
            <nav class="flex items-center gap-2 text-[10px] text-on-surface-variant uppercase tracking-[0.15em] font-bold mb-3">
                <span>Dashboard</span>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span>Tasks</span>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary">Assign New Task</span>
            </nav>
            <h2 class="text-3xl lg:text-4xl font-light font-headline tracking-tight text-on-surface">Assign New Task</h2>
        </div>
        <div class="flex items-center gap-4 text-sm">
            <div class="flex flex-col items-end">
                <span class="text-[10px] text-on-surface-variant font-bold tracking-widest uppercase">Auto-Save</span>
                <span class="text-primary font-medium">Enabled</span>
            </div>
        </div>
    </div>

    <div class="mb-12">
        <div class="flex items-center justify-between relative max-w-4xl">
            <div class="absolute top-5 left-0 w-full h-[2px] bg-surface-container-highest z-0"></div>
            <div class="absolute top-5 left-0 w-[33%] h-[2px] bg-primary z-0 step-progress"></div>
            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold ring-4 ring-background step-indicator active">1</div>
                <span class="text-xs font-bold uppercase tracking-wider text-primary">Task Info</span>
            </div>
            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center font-bold ring-4 ring-background step-indicator">2</div>
                <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Team</span>
            </div>
            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center font-bold ring-4 ring-background step-indicator">3</div>
                <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Sub-Tasks</span>
            </div>
            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center font-bold ring-4 ring-background step-indicator">4</div>
                <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Review</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10 items-start">
        <div class="col-span-12 lg:col-span-8 space-y-8">
            <section class="bg-surface-container-low rounded-3xl p-8 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-[2px] h-full bg-primary/40 group-hover:bg-primary transition-colors"></div>
                <div class="flex items-center gap-3 mb-8">
                    <span class="material-symbols-outlined text-primary">description</span>
                    <h3 class="text-xl font-semibold font-headline">Task Information</h3>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label for="task_name" class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Task Name</label>
                        <input id="task_name" class="w-full bg-surface-container rounded-xl border border-outline-variant/15 py-3 px-4 focus:ring-1 focus:ring-primary focus:border-primary" placeholder="e.g., Q3 Financial Audit Review" type="text" />
                    </div>
                    <div>
                        <label for="project_selection" class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Project Selection</label>
                        <div class="relative">
                            <select id="project_selection" aria-label="Select project for task" class="w-full appearance-none bg-surface-container rounded-xl border border-outline-variant/15 py-3 px-4 focus:ring-1 focus:ring-primary">
                                <option>Select Project</option>
                                <option>Obsidian Arch Redesign</option>
                                <option>Cloud Infrastructure Migration</option>
                                <option>Client Portal Beta</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                        </div>
                    </div>
                    <div>
                        <label for="due_date" class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Due Date</label>
                        <div class="relative">
                            <input id="due_date" class="w-full bg-surface-container rounded-xl border border-outline-variant/15 py-3 px-4 focus:ring-1 focus:ring-primary" type="date" />
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">calendar_today</span>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="task_description" class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Short Description</label>
                        <textarea id="task_description" class="w-full bg-surface-container rounded-xl border border-outline-variant/15 py-3 px-4 focus:ring-1 focus:ring-primary" placeholder="Briefly describe the task objectives..." rows="4"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Priority</label>
                        <div class="flex gap-2">
                            <button class="flex-1 py-2 rounded-lg border border-red-500/20 text-red-400 bg-red-500/5 text-xs font-bold uppercase tracking-wider hover:bg-red-500/10 transition-colors">High</button>
                            <button class="flex-1 py-2 rounded-lg border border-primary/20 text-primary bg-primary/5 text-xs font-bold uppercase tracking-wider ring-1 ring-primary/40">Medium</button>
                            <button class="flex-1 py-2 rounded-lg border border-on-surface-variant/20 text-on-surface-variant bg-on-surface-variant/5 text-xs font-bold uppercase tracking-wider hover:bg-on-surface-variant/10 transition-colors">Low</button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Initial Status</label>
                        <div class="relative">
                            <select aria-label="Select initial task status" class="w-full appearance-none bg-surface-container rounded-xl border border-outline-variant/15 py-3 px-4 focus:ring-1 focus:ring-primary">
                                <option>To Do</option>
                                <option>In Progress</option>
                                <option>On Hold</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">unfold_more</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-surface-container-low rounded-3xl p-8 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-[2px] h-full bg-primary/40 group-hover:bg-primary transition-colors"></div>
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">group</span>
                        <h3 class="text-xl font-semibold font-headline">Assign Team</h3>
                    </div>
                    <button class="text-primary text-xs font-bold uppercase tracking-widest flex items-center gap-2 hover:opacity-80 transition-opacity">
                        <span class="material-symbols-outlined text-sm">person_add</span>
                        Invite Member
                    </button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl border border-outline-variant/5">
                        <div class="flex items-center gap-4">
                            <img alt="Sarah Chen" class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Sarah+Chen&background=c084fc&color=fff&size=40" />
                            <div>
                                <p class="text-sm font-semibold">Sarah Chen</p>
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Lead Designer</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-8">
                            <div class="w-40">
                                <select aria-label="Select role for team member" class="w-full bg-surface-container-low border-none text-xs font-medium rounded-lg focus:ring-1 focus:ring-primary">
                                    <option>Approver</option>
                                    <option selected>Assignee</option>
                                    <option>Observer</option>
                                </select>
                            </div>
                            <button class="text-on-surface-variant hover:text-red-400 transition-colors" aria-label="Remove team member">
                                <span class="material-symbols-outlined text-lg">close</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-surface-container rounded-2xl border border-outline-variant/5">
                        <div class="flex items-center gap-4">
                            <img alt="Marcus Wright" class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Marcus+Wright&background=34d399&color=fff&size=40" />
                            <div>
                                <p class="text-sm font-semibold">Marcus Wright</p>
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">QA Engineer</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-8">
                            <div class="w-40">
                                <select aria-label="Select role for team member" class="w-full bg-surface-container-low border-none text-xs font-medium rounded-lg focus:ring-1 focus:ring-primary">
                                    <option>Approver</option>
                                    <option>Assignee</option>
                                    <option selected>Observer</option>
                                </select>
                            </div>
                            <button class="text-on-surface-variant hover:text-red-400 transition-colors" aria-label="Remove team member">
                                <span class="material-symbols-outlined text-lg">close</span>
                            </button>
                        </div>
                    </div>

                    <div class="p-4 border-2 border-dashed border-outline-variant/20 rounded-2xl flex items-center justify-center gap-2 text-on-surface-variant hover:border-primary/40 hover:text-primary transition-all cursor-pointer">
                        <span class="material-symbols-outlined">add_circle</span>
                        <span class="text-sm font-medium">Add another team member</span>
                    </div>
                </div>
            </section>

            <section class="bg-surface-container-low rounded-3xl p-8 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-[2px] h-full bg-primary/40 group-hover:bg-primary transition-colors"></div>
                <div class="flex items-center gap-3 mb-8">
                    <span class="material-symbols-outlined text-primary">checklist</span>
                    <h3 class="text-xl font-semibold font-headline">Sub-Tasks</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-4 p-4 bg-surface-container rounded-2xl group/item">
                        <div class="w-5 h-5 rounded border-2 border-primary/40 flex items-center justify-center"></div>
                        <input class="flex-1 bg-transparent border-none text-sm p-0 focus:ring-0" type="text" value="Draft project requirements document" aria-label="Sub-task: Draft project requirements document" />
                        <button class="opacity-0 group-hover/item:opacity-100 transition-opacity text-on-surface-variant" aria-label="Drag to reorder">
                            <span class="material-symbols-outlined text-lg">drag_indicator</span>
                        </button>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-surface-container rounded-2xl group/item">
                        <div class="w-5 h-5 rounded border-2 border-primary/40 flex items-center justify-center"></div>
                        <input class="flex-1 bg-transparent border-none text-sm p-0 focus:ring-0" type="text" value="Identify key stakeholders for approval" aria-label="Sub-task: Identify key stakeholders for approval" />
                        <button class="opacity-0 group-hover/item:opacity-100 transition-opacity text-on-surface-variant" aria-label="Drag to reorder">
                            <span class="material-symbols-outlined text-lg">drag_indicator</span>
                        </button>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-surface-container rounded-2xl group/item">
                        <div class="w-5 h-5 rounded border-2 border-primary/40 flex items-center justify-center"></div>
                        <input class="flex-1 bg-transparent border-none text-sm p-0 focus:ring-0 placeholder:text-on-surface-variant/50" placeholder="Add new sub-task..." type="text" aria-label="Add new sub-task" />
                        <button class="text-primary" aria-label="Add sub-task">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>
                </div>
            </section>

            <section class="bg-surface-container-low rounded-3xl p-8 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-[2px] h-full bg-primary/40 group-hover:bg-primary transition-colors"></div>
                <div class="flex items-center gap-3 mb-8">
                    <span class="material-symbols-outlined text-primary">upload_file</span>
                    <h3 class="text-xl font-semibold font-headline">Files and References</h3>
                </div>
                <div class="border-2 border-dashed border-outline-variant/20 rounded-3xl p-12 text-center bg-surface-container/50 hover:bg-surface-container/80 transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-5xl text-on-surface-variant/50 mb-4 block">cloud_upload</span>
                    <h4 class="text-sm font-semibold mb-1">Drag and drop files here</h4>
                    <p class="text-xs text-on-surface-variant mb-6 uppercase tracking-widest font-bold">OR</p>
                    <button class="px-6 py-2 bg-surface-container-highest text-primary rounded-full text-xs font-bold uppercase tracking-widest hover:bg-primary hover:text-on-primary transition-all">Browse Files</button>
                    <p class="mt-8 text-[10px] text-on-surface-variant/60 font-medium">MAX FILE SIZE 50MB. SUPPORTED: PDF, ZIP, PNG, JPG, FIG</p>
                </div>
            </section>

            <section class="bg-surface-container-low rounded-3xl p-8 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-[2px] h-full bg-primary/40 group-hover:bg-primary transition-colors"></div>
                <div class="flex items-center gap-3 mb-8">
                    <span class="material-symbols-outlined text-primary">notifications_active</span>
                    <h3 class="text-xl font-semibold font-headline">Notification Preferences</h3>
                </div>
                <div class="space-y-6">
                    <label for="notify_team" class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">group</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Notify internal team</p>
                                <p class="text-xs text-on-surface-variant">Send instant Slack and Email notification to assignees</p>
                            </div>
                        </div>
                        <input id="notify_team" checked class="w-6 h-6 rounded-md bg-surface-container-low border-outline-variant/30 text-primary focus:ring-primary/20" type="checkbox" />
                    </label>
                    <label for="notify_client" class="flex items-center justify-between p-4 bg-surface-container rounded-2xl cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-purple-500/10 rounded-xl flex items-center justify-center text-purple-400">
                                <span class="material-symbols-outlined">person_outline</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Notify client contact</p>
                                <p class="text-xs text-on-surface-variant">Email task creation summary to project stakeholders</p>
                            </div>
                        </div>
                        <input id="notify_client" class="w-6 h-6 rounded-md bg-surface-container-low border-outline-variant/30 text-primary focus:ring-primary/20" type="checkbox" />
                    </label>
                </div>
            </section>
        </div>

        <div class="col-span-12 lg:col-span-4 sticky top-24">
            <div class="bg-surface-container-highest rounded-3xl overflow-hidden shadow-2xl shadow-black/40 border border-outline-variant/5">
                <div class="p-6 bg-primary/5 border-b border-outline-variant/10">
                    <h3 class="text-sm font-bold uppercase tracking-[0.2em] text-primary">Live Summary</h3>
                </div>
                <div class="p-8 space-y-8">
                    <div>
                        <span class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest block mb-2">Task Context</span>
                        <div class="space-y-1">
                            <p class="text-lg font-headline font-semibold text-on-surface leading-tight">Q3 Financial Audit Review</p>
                            <p class="text-xs text-primary flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">folder_zip</span>
                                Obsidian Arch Redesign
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <span class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest block mb-1">Due Date</span>
                            <p class="text-sm font-medium">Oct 24, 2023</p>
                        </div>
                        <div>
                            <span class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest block mb-1">Priority</span>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-primary/20 text-primary uppercase">Medium</span>
                        </div>
                    </div>
                    <div>
                        <span class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest block mb-3">Assigned (2)</span>
                        <div class="flex -space-x-3">
                            <img alt="Assignee" class="w-10 h-10 rounded-full border-4 border-surface-container-highest" src="https://ui-avatars.com/api/?name=Sarah+Chen&background=c084fc&color=fff&size=40" />
                            <img alt="Assignee" class="w-10 h-10 rounded-full border-4 border-surface-container-highest" src="https://ui-avatars.com/api/?name=Marcus+Wright&background=34d399&color=fff&size=40" />
                        </div>
                    </div>
                    <div class="pt-6 border-t border-outline-variant/10">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs text-on-surface-variant">Sub-tasks completed</span>
                            <span class="text-xs font-bold">0 / 2</span>
                        </div>
                        <div class="h-1.5 w-full bg-surface-container-low rounded-full overflow-hidden">
                            <div class="h-full bg-primary/20 w-0"></div>
                        </div>
                    </div>
                    <div class="p-4 bg-purple-500/5 rounded-2xl border border-purple-500/10">
                        <div class="flex gap-3">
                            <span class="material-symbols-outlined text-purple-400">info</span>
                            <p class="text-xs text-purple-400/80 leading-relaxed">Notifications will be sent immediately upon confirmation.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-6 bg-surface-container-low rounded-3xl flex items-center gap-4">
                <div class="w-12 h-12 bg-surface-container rounded-2xl flex items-center justify-center text-primary border border-outline-variant/10">
                    <span class="material-symbols-outlined text-3xl">timer</span>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Estimated Effort</p>
                    <p class="text-lg font-headline font-semibold">12 - 16 Hours</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script></script>
@endpush
