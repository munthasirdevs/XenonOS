@extends('layouts.app')

@section('title', 'Team Member Assignment - XenonOS')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/team-assign.css') }}">
@endpush

@section('content')
<main class="flex-1 min-h-screen flex flex-col">
    <div class="p-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-12 flex items-end justify-between">
                <div>
                    <h1 class="font-headline text-5xl font-light tracking-tight text-on-surface">Assign Team Member</h1>
                    <p class="text-outline mt-3 flex items-center gap-2">
                        <span class="w-1 h-1 bg-primary rounded-full"></span>
                        Strategic resource allocation for upcoming sprint cycles.
                    </p>
                </div>
                <div class="hidden md:block">
                    <span class="px-4 py-1.5 bg-surface-container-high rounded-full border border-outline-variant/20 text-[10px] font-bold uppercase tracking-widest text-primary">Form Step 15 of 24</span>
                </div>
            </div>

            <div class="space-y-8">
                <section class="bg-surface-container-low p-8 rounded-2xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary-container"></div>
                    <div class="flex items-center gap-3 mb-8">
                        <span class="text-[10px] font-bold bg-primary/10 text-primary px-2 py-0.5 rounded">01</span>
                        <h2 class="font-headline text-xl font-semibold">Select Team Member</h2>
                    </div>
                    <div role="radiogroup" aria-label="Select team member" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div role="radio" aria-checked="true" tabindex="0" class="bg-surface-container p-4 rounded-xl border-2 border-primary ring-4 ring-primary/5 transition-all cursor-pointer">
                            <div class="flex items-center gap-3">
                                <img class="w-12 h-12 rounded-lg object-cover" alt="Portrait of Sarah Chen, UI Designer" src="https://ui-avatars.com/api/?name=Sarah+Chen&background=818cf8&color=fff&size=128" />
                                <div>
                                    <p class="text-sm font-bold">Sarah Chen</p>
                                    <p class="text-[10px] text-outline uppercase tracking-wider">UI Designer</p>
                                </div>
                                <span class="material-symbols-outlined ml-auto text-primary">check_circle</span>
                            </div>
                            <div class="mt-4">
                                <div class="flex justify-between text-[10px] mb-1">
                                    <span class="text-outline">Project Load</span>
                                    <span class="text-on-surface">65%</span>
                                </div>
                                <div class="w-full h-1 bg-surface-container-highest rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-primary to-primary-container w-[65%]"></div>
                                </div>
                            </div>
                        </div>
                        <div role="radio" aria-checked="false" tabindex="0" class="bg-surface-container p-4 rounded-xl border border-outline-variant/10 hover:border-primary/40 transition-all cursor-pointer">
                            <div class="flex items-center gap-3">
                                <img class="w-12 h-12 rounded-lg object-cover grayscale opacity-60" alt="Portrait of Marcus Thornton, Dev Ops" src="https://ui-avatars.com/api/?name=Marcus+Thornton&background=c084fc&color=fff&size=128" />
                                <div>
                                    <p class="text-sm font-bold">Marcus Thornton</p>
                                    <p class="text-[10px] text-outline uppercase tracking-wider">DevOps</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex justify-between text-[10px] mb-1">
                                    <span class="text-outline">Project Load</span>
                                    <span class="text-on-surface">90%</span>
                                </div>
                                <div class="w-full h-1 bg-surface-container-highest rounded-full overflow-hidden">
                                    <div class="h-full bg-tertiary w-[90%]"></div>
                                </div>
                            </div>
                        </div>
                        <div role="radio" aria-checked="false" tabindex="0" class="bg-surface-container p-4 rounded-xl border border-outline-variant/10 hover:border-primary/40 transition-all cursor-pointer">
                            <div class="flex items-center gap-3">
                                <img class="w-12 h-12 rounded-lg object-cover" alt="Portrait of Elena Rodriguez, QA Lead" src="https://ui-avatars.com/api/?name=Elena+Rodriguez&background=34d399&color=fff&size=128" />
                                <div>
                                    <p class="text-sm font-bold">Elena Rodriguez</p>
                                    <p class="text-[10px] text-outline uppercase tracking-wider">QA Lead</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex justify-between text-[10px] mb-1">
                                    <span class="text-outline">Project Load</span>
                                    <span class="text-on-surface">20%</span>
                                </div>
                                <div class="w-full h-1 bg-surface-container-highest rounded-full overflow-hidden">
                                    <div class="h-full bg-primary w-[20%]"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="mt-6 flex items-center gap-2 text-primary text-xs font-bold hover:gap-3 transition-all">
                        <span class="w-1 h-1 bg-primary rounded-full"></span>
                        VIEW ALL TEAM MEMBERS
                    </button>
                </section>

                <section class="bg-surface-container-low p-8 rounded-2xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary-container"></div>
                    <div class="flex items-center gap-3 mb-8">
                        <span class="text-[10px] font-bold bg-primary/10 text-primary px-2 py-0.5 rounded">02</span>
                        <h2 class="font-headline text-xl font-semibold">Project Assignment</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="select_project" class="text-[10px] font-bold uppercase tracking-widest text-outline pl-1">Select Project</label>
                            <div class="relative">
                                <select id="select_project" class="w-full bg-surface-container border-none rounded-xl py-3.5 pl-4 pr-10 appearance-none focus:ring-2 focus:ring-primary/20 text-sm" name="select_project">
                                    <option>Nexus Bank Mobile App</option>
                                    <option>Obsidian Design System</option>
                                    <option>CloudSync Dashboard</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="select_task" class="text-[10px] font-bold uppercase tracking-widest text-outline pl-1">Select Task (Optional)</label>
                            <div class="relative">
                                <select id="select_task" class="w-full bg-surface-container border-none rounded-xl py-3.5 pl-4 pr-10 appearance-none focus:ring-2 focus:ring-primary/20 text-sm" name="select_task">
                                    <option>UX Research Phase 2</option>
                                    <option>Design QA &amp; Audit</option>
                                    <option>Icon Library Development</option>
                                    <option>None - Project Level</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-outline pl-1">Assignment Role</label>
                            <div role="radiogroup" aria-label="Assignment role selection" class="flex flex-wrap gap-3">
                                <button role="radio" aria-checked="false" class="px-5 py-2.5 bg-surface-container rounded-xl text-sm border border-outline-variant/10 hover:border-primary transition-all">Designer</button>
                                <button role="radio" aria-checked="true" class="px-5 py-2.5 bg-primary text-on-primary-fixed font-bold rounded-xl text-sm border border-transparent">Developer</button>
                                <button role="radio" aria-checked="false" class="px-5 py-2.5 bg-surface-container rounded-xl text-sm border border-outline-variant/10 hover:border-primary transition-all">Project Manager</button>
                                <button role="radio" aria-checked="false" class="px-5 py-2.5 bg-surface-container rounded-xl text-sm border border-outline-variant/10 hover:border-primary transition-all">QA Engineer</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-surface-container-low p-8 rounded-2xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary-container"></div>
                    <div class="flex items-center gap-3 mb-8">
                        <span class="text-[10px] font-bold bg-primary/10 text-primary px-2 py-0.5 rounded">03</span>
                        <h2 class="font-headline text-xl font-semibold">Dates &amp; Alerts</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="space-y-2">
                            <label for="start_date" class="text-[10px] font-bold uppercase tracking-widest text-outline pl-1">Start Date</label>
                            <div class="relative">
                                <input id="start_date" class="w-full bg-surface-container border-none rounded-xl py-3.5 px-4 focus:ring-2 focus:ring-primary/20 text-sm color-scheme-dark" type="date" name="start_date" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="end_date" class="text-[10px] font-bold uppercase tracking-widest text-outline pl-1">End Date</label>
                            <div class="relative">
                                <input id="end_date" class="w-full bg-surface-container border-none rounded-xl py-3.5 px-4 focus:ring-2 focus:ring-primary/20 text-sm color-scheme-dark" type="date" name="end_date" />
                            </div>
                        </div>
                    </div>
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <div class="relative flex items-center">
                            <input checked class="peer hidden" type="checkbox" />
                            <div class="w-5 h-5 border-2 border-outline-variant/40 rounded-md peer-checked:bg-primary peer-checked:border-primary transition-all"></div>
                            <span class="material-symbols-outlined absolute inset-0 text-on-primary-fixed text-sm opacity-0 peer-checked:opacity-100 flex items-center justify-center pointer-events-none">check</span>
                        </div>
                        <span class="text-sm text-on-surface group-hover:text-primary transition-colors">Notify team members via Slack and Email</span>
                    </label>
                </section>

                <section class="bg-surface-container p-8 rounded-2xl border border-primary/20 relative">
                    <div class="flex items-center gap-3 mb-8">
                        <span class="text-[10px] font-bold bg-tertiary/10 text-tertiary px-2 py-0.5 rounded">04</span>
                        <h2 class="font-headline text-xl font-semibold">Review Summary</h2>
                    </div>
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="flex-1 space-y-4 w-full">
                            <div class="flex justify-between items-center p-3 rounded-xl hover:bg-surface-bright/20 transition-all group">
                                <div>
                                    <p class="text-[10px] text-outline uppercase tracking-widest font-bold">Assignee</p>
                                    <p class="text-sm font-semibold">Sarah Chen (UI Designer)</p>
                                </div>
                                <button class="text-primary text-xs opacity-0 group-hover:opacity-100 transition-opacity">Edit</button>
                            </div>
                            <div class="flex justify-between items-center p-3 rounded-xl hover:bg-surface-bright/20 transition-all group border-t border-outline-variant/10">
                                <div>
                                    <p class="text-[10px] text-outline uppercase tracking-widest font-bold">Project</p>
                                    <p class="text-sm font-semibold">Nexus Bank Mobile App</p>
                                </div>
                                <button class="text-primary text-xs opacity-0 group-hover:opacity-100 transition-opacity">Edit</button>
                            </div>
                            <div class="flex justify-between items-center p-3 rounded-xl hover:bg-surface-bright/20 transition-all group border-t border-outline-variant/10">
                                <div>
                                    <p class="text-[10px] text-outline uppercase tracking-widest font-bold">Duration</p>
                                    <p class="text-sm font-semibold">Oct 12, 2023 - Dec 24, 2023</p>
                                </div>
                                <button class="text-primary text-xs opacity-0 group-hover:opacity-100 transition-opacity">Edit</button>
                            </div>
                        </div>
                        <div class="w-full md:w-64 p-6 bg-surface-container-high rounded-2xl border border-outline-variant/15 flex flex-col items-center text-center">
                            <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-primary text-3xl">verified_user</span>
                            </div>
                            <p class="text-xs text-on-surface leading-relaxed">Sarah will have <strong>Full Developer Permissions</strong> for the selected repository.</p>
                        </div>
                    </div>
                </section>

                <div class="flex items-center justify-end gap-6 pt-6">
                    <button class="text-sm font-bold text-outline hover:text-white transition-all px-6 py-3">Cancel Assignment</button>
                    <button class="bg-primary text-on-primary-fixed px-10 py-4 rounded-xl font-headline font-bold text-base shadow-xl shadow-primary/10 hover:scale-[1.02] active:scale-[0.98] transition-all">Assign Member</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
