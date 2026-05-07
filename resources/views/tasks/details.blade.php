@extends('layouts.app')

@section('title', 'Task Details - XenonOS')

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="p-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-12">
            <nav class="flex items-center gap-2 text-sm text-on-surface-variant mb-4">
                <span>Tasks</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-primary">TSK-4829</span>
            </nav>
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase bg-primary/10 text-primary border border-primary/20">In Progress</span>
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase bg-red-500/10 text-red-400 border border-red-500/20 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">priority_high</span> High Priority
                        </span>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-headline font-extrabold tracking-tight text-on-surface">Architectural System Redesign</h1>
                    <div class="flex flex-wrap items-center gap-6 text-on-surface-variant">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined">calendar_today</span>
                            <span class="font-medium text-on-surface">Oct 24, 2024</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <img alt="Assignee Avatar" class="w-8 h-8 rounded-full ring-2 ring-surface-container" src="https://ui-avatars.com/api/?name=Marcus+Thornton&background=818cf8&color=fff&size=32" />
                            <span class="font-medium text-on-surface">Marcus Thornton</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button class="flex items-center gap-2 px-5 py-3 rounded-xl bg-surface-container-highest hover:bg-surface-bright transition-all duration-300 font-medium">
                        <span class="material-symbols-outlined">edit</span> Edit
                    </button>
                    <button class="flex items-center gap-2 px-5 py-3 rounded-xl bg-surface-container-highest hover:bg-surface-bright transition-all duration-300 font-medium">
                        <span class="material-symbols-outlined">person_pin</span> Reassign
                    </button>
                    <button class="bg-gradient-to-br from-primary to-primary/70 text-on-primary font-bold px-8 py-3 rounded-xl shadow-[0_0_20px_rgba(192,193,255,0.3)] hover:scale-105 transition-transform duration-300">
                        Complete Task
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8 space-y-6">
                <section class="bg-surface-container rounded-2xl p-8">
                    <h3 class="font-headline text-xl mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">subject</span> Task Description
                    </h3>
                    <div class="text-on-surface-variant leading-relaxed space-y-4">
                        <p>The core objective of this task is to overhaul the existing microservices architecture to improve horizontal scalability and reduce latency in cross-service communication. This involves implementing a gRPC-based communication layer and migrating legacy REST endpoints.</p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Conduct initial audit of existing bottlenecks in Service A and B.</li>
                            <li>Draft technical specification for the new message schema.</li>
                            <li>Implement circuit breaker patterns to prevent cascading failures.</li>
                            <li>Load test the new infrastructure against peak traffic simulations.</li>
                        </ul>
                    </div>
                </section>

                <section class="bg-surface-container rounded-2xl p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-headline text-xl flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">attachment</span> Attachments
                        </h3>
                        <button class="text-primary text-sm font-medium hover:underline">Upload New</button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="group relative bg-surface-container-low rounded-xl p-4 border border-outline-variant/5 hover:border-primary/30 transition-all cursor-pointer">
                            <div class="w-full aspect-video rounded-lg mb-3 bg-surface-container-highest flex items-center justify-center overflow-hidden">
                                <img alt="Schema Diagram" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://ui-avatars.com/api/?name=Schema&background=818cf8&color=fff&size=200" />
                            </div>
                            <p class="text-sm font-medium truncate">system-arch-v2.png</p>
                            <p class="text-xs text-on-surface-variant">2.4 MB - Oct 12</p>
                        </div>
                        <div class="group relative bg-surface-container-low rounded-xl p-4 border border-outline-variant/5 hover:border-primary/30 transition-all cursor-pointer">
                            <div class="w-full aspect-video rounded-lg mb-3 bg-surface-container-highest flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-on-surface-variant">description</span>
                            </div>
                            <p class="text-sm font-medium truncate">technical-specs.pdf</p>
                            <p class="text-xs text-on-surface-variant">1.1 MB - Oct 14</p>
                        </div>
                        <div class="group relative bg-surface-container-low rounded-xl p-4 border border-outline-variant/5 hover:border-primary/30 transition-all cursor-pointer">
                            <div class="w-full aspect-video rounded-lg mb-3 bg-surface-container-highest flex items-center justify-center overflow-hidden">
                                <img alt="Load Test Graph" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://ui-avatars.com/api/?name=Load+Test&background=c084fc&color=fff&size=200" />
                            </div>
                            <p class="text-sm font-medium truncate">load-test-results.csv</p>
                            <p class="text-xs text-on-surface-variant">450 KB - Oct 18</p>
                        </div>
                    </div>
                </section>

                <section class="bg-surface-container rounded-2xl p-8">
                    <h3 class="font-headline text-xl mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">chat_bubble</span> Discussion
                    </h3>
                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <img alt="User" class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Elena+Rodriguez&background=34d399&color=fff&size=40" />
                            <div class="flex-grow space-y-2">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-on-surface">Elena Rodriguez</span>
                                    <span class="text-xs text-on-surface-variant">2 hours ago</span>
                                </div>
                                <p class="text-on-surface-variant bg-surface-container-low p-4 rounded-xl rounded-tl-none">
                                    The gRPC prototypes are looking solid. I've uploaded the initial benchmarks for the service-to-service calls. Let me know if you want to review the protobuf definitions tomorrow.</p>
                                <div class="flex items-center gap-4 text-xs text-on-surface-variant">
                                    <button class="hover:text-primary transition-colors flex items-center gap-1"><span class="material-symbols-outlined text-sm">thumb_up</span> 4</button>
                                    <button class="hover:text-primary transition-colors">Reply</button>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start pt-4 border-t border-outline-variant/10">
                            <img alt="My User" class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Current+User&background=818cf8&color=fff&size=40" />
                            <div class="flex-grow">
                                <textarea class="w-full bg-gray-800 border border-outline-variant/20 rounded-xl p-4 focus:ring-primary/40 focus:border-primary text-on-surface h-24 transition-all outline-none resize-none" placeholder="Write a comment..."></textarea>
                                <div class="flex justify-end mt-2">
                                    <button class="bg-gradient-to-br from-primary to-primary/70 px-6 py-2 rounded-lg text-on-primary font-bold text-sm">Post Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-4 space-y-6">
                <section class="bg-surface-container rounded-2xl p-6">
                    <h4 class="font-headline text-sm uppercase tracking-widest text-on-surface-variant mb-6">Task Details</h4>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center py-3 border-b border-outline-variant/10">
                            <span class="text-on-surface-variant text-sm">Created</span>
                            <span class="text-on-surface font-medium">Oct 10, 2024</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-outline-variant/10">
                            <span class="text-on-surface-variant text-sm">Estimated Time</span>
                            <span class="text-on-surface font-medium">40 Hours</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-outline-variant/10">
                            <span class="text-on-surface-variant text-sm">Total Logged</span>
                            <span class="text-on-surface font-medium">18.5 Hours</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-outline-variant/10">
                            <span class="text-on-surface-variant text-sm">Related Projects</span>
                            <span class="text-primary font-medium">Core Ops v2</span>
                        </div>
                        <div class="pt-2">
                            <div class="flex justify-between text-xs text-on-surface-variant mb-2">
                                <span>Progress</span>
                                <span>45%</span>
                            </div>
                            <div class="w-full h-2 bg-surface-container-low rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-br from-primary to-primary/70 w-[45%] rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-surface-container rounded-2xl p-6">
                    <h4 class="font-headline text-sm uppercase tracking-widest text-on-surface-variant mb-6">Activity Log</h4>
                    <div class="space-y-6 relative before:absolute before:left-3 before:top-2 before:bottom-2 before:w-[1px] before:bg-outline-variant/20">
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-primary/20 border-2 border-primary flex items-center justify-center z-10">
                                <span class="material-symbols-outlined text-[14px] text-primary">check</span>
                            </div>
                            <p class="text-sm font-medium">Phase 1 Audit Completed</p>
                            <p class="text-xs text-on-surface-variant">Today, 10:45 AM by Marcus</p>
                        </div>
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-surface-container-highest border border-outline-variant/30 flex items-center justify-center z-10">
                                <span class="material-symbols-outlined text-[14px] text-on-surface-variant">upload_file</span>
                            </div>
                            <p class="text-sm font-medium">Updated Attachments</p>
                            <p class="text-xs text-on-surface-variant">Yesterday, 4:20 PM by Elena</p>
                        </div>
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-surface-container-highest border border-outline-variant/30 flex items-center justify-center z-10">
                                <span class="material-symbols-outlined text-[14px] text-on-surface-variant">person_add</span>
                            </div>
                            <p class="text-sm font-medium">Elena Rodriguez added</p>
                            <p class="text-xs text-on-surface-variant">Oct 12, 11:00 AM</p>
                        </div>
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-surface-container-highest border border-outline-variant/30 flex items-center justify-center z-10">
                                <span class="material-symbols-outlined text-[14px] text-on-surface-variant">flag</span>
                            </div>
                            <p class="text-sm font-medium">Task Created</p>
                            <p class="text-xs text-on-surface-variant">Oct 10, 9:00 AM</p>
                        </div>
                    </div>
                    <button class="w-full mt-6 py-2 text-sm font-medium text-on-surface-variant hover:text-primary transition-colors rounded-lg">View Full History</button>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script></script>
@endpush
