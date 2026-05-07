@extends('layouts.app')

@push('styles')
<style>
    .font-syne { font-family: 'Syne', sans-serif; }
    .font-outfit { font-family: 'Outfit', sans-serif; }
</style>
@endpush

@section('title', 'XenonOS | Files Workspace')

@section('content')
<main class="min-h-screen flex flex-col">
    <div class="p-4 md:p-8">
        <div class="grid grid-cols-12 gap-4 md:gap-6">
            <div class="col-span-12 lg:col-span-4 bg-surface-container rounded-2xl p-6 border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center text-center gap-4 group hover:border-primary/50 transition-all duration-400 bg-gradient-to-br from-surface-container to-surface-container-low min-h-[200px]">
                <div class="w-16 h-16 rounded-full bg-surface-container-highest flex items-center justify-center group-hover:scale-110 transition-transform duration-500"><span class="material-symbols-outlined text-3xl text-primary">cloud_upload</span></div>
                <div><p class="font-syne font-bold text-lg text-on-surface">Drop files here</p><p class="text-sm text-on-surface-variant font-outfit">or click to browse from device</p></div>
                <div class="flex gap-2 mt-2">
                    <span class="px-2 py-1 rounded-md bg-surface-container-lowest text-[10px] text-outline font-medium uppercase tracking-wider">PDF</span>
                    <span class="px-2 py-1 rounded-md bg-surface-container-lowest text-[10px] text-outline font-medium uppercase tracking-wider">PNG</span>
                    <span class="px-2 py-1 rounded-md bg-surface-container-lowest text-[10px] text-outline font-medium uppercase tracking-wider">FIG</span>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8 bg-surface-container rounded-2xl p-6 flex flex-col justify-between">
                <div class="flex justify-between items-start flex-wrap gap-4">
                    <div><h3 class="font-syne font-bold text-xl text-on-surface">Workspace Storage</h3><p class="text-sm text-on-surface-variant">42.8 GB used of 100 GB</p></div>
                    <div class="flex gap-2">
                        <button class="w-8 h-8 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary"><span class="material-symbols-outlined text-sm">grid_view</span></button>
                        <button class="w-8 h-8 rounded-lg bg-surface-container-lowest flex items-center justify-center text-on-surface-variant"><span class="material-symbols-outlined text-sm">list</span></button>
                    </div>
                </div>
                <div class="mt-6 md:mt-8">
                    <div class="w-full h-2 bg-surface-container-lowest rounded-full overflow-hidden flex">
                        <div class="h-full bg-primary w-[42%]"></div>
                        <div class="h-full bg-tertiary w-[15%]"></div>
                    </div>
                    <div class="flex gap-4 md:gap-6 mt-4 flex-wrap">
                        <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div><span class="text-xs text-on-surface-variant">Documents (22.1 GB)</span></div>
                        <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-tertiary"></div><span class="text-xs text-on-surface-variant">Media (10.4 GB)</span></div>
                        <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-outline"></div><span class="text-xs text-on-surface-variant">Other (10.3 GB)</span></div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 flex justify-between items-center py-2 flex-wrap gap-4">
                <div class="flex gap-4 flex-wrap">
                    <button class="text-primary font-bold border-b-2 border-primary pb-1 text-sm">All Files</button>
                    <button class="text-on-surface-variant hover:text-on-surface transition-colors text-sm">Recent</button>
                    <button class="text-on-surface-variant hover:text-on-surface transition-colors text-sm">Favorites</button>
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="text-xs font-medium">Sort by:</span>
                    <select aria-label="Sort files by criteria" class="bg-transparent border-none text-xs text-on-surface focus:ring-0 cursor-pointer">
                        <option>Date Modified</option><option>Name</option><option>Size</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-3 bg-surface-container rounded-2xl overflow-hidden group hover:scale-[1.02] transition-all duration-400">
                <div class="h-48 relative bg-surface-container-lowest overflow-hidden">
                    <img alt="Marketing brand visuals" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://ui-avatars.com/api/?name=Marketing+Brand&background=818cf8&color=fff&size=400" />
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-container to-transparent opacity-60"></div>
                    <div class="absolute top-3 right-3 flex gap-2">
                        <button class="w-8 h-8 rounded-full bg-surface-container/80 backdrop-blur-md flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all"><span class="material-symbols-outlined text-lg">share</span></button>
                    </div>
                    <div class="absolute bottom-3 left-3 flex gap-1 items-center bg-primary/20 backdrop-blur-sm border border-primary/20 px-2 py-0.5 rounded-full">
                        <span class="material-symbols-outlined text-[10px] text-primary">history</span>
                        <span class="text-[10px] text-primary font-bold uppercase tracking-wider">v2.4</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="font-bold text-on-surface">Marketing_Brand_Visuals.fig</h4>
                        <span class="material-symbols-outlined text-outline cursor-pointer hover:text-primary transition-colors">more_vert</span>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <div class="flex items-center gap-2 text-xs text-on-surface-variant"><span class="material-symbols-outlined text-sm">schedule</span><span>2h ago</span></div>
                        <span class="text-xs text-on-surface-variant font-medium">124.5 MB</span>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-3 bg-surface-container rounded-2xl p-5 flex flex-col justify-between hover:scale-[1.02] transition-all duration-400">
                <div class="flex justify-between items-start">
                    <div class="w-12 h-12 rounded-xl bg-error/10 flex items-center justify-center"><span class="material-symbols-outlined text-error text-2xl">picture_as_pdf</span></div>
                    <button class="text-outline hover:text-primary transition-colors"><span class="material-symbols-outlined">star</span></button>
                </div>
                <div class="mt-8"><h4 class="font-bold text-on-surface truncate">Q4_Project_Roadmap_Final.pdf</h4><p class="text-xs text-on-surface-variant mt-1">Edited by Sarah Chen</p></div>
                <div class="mt-6 flex gap-2">
                    <button class="flex-1 bg-surface-container-highest text-on-surface text-xs font-bold py-2 rounded-lg hover:bg-primary hover:text-on-primary transition-all flex items-center justify-center gap-2"><span class="material-symbols-outlined text-sm">download</span> Download</button>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6 bg-surface-container rounded-2xl p-6 hover:scale-[1.01] transition-all duration-400 group">
                <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-3xl text-primary">folder</span>
                        <div><h4 class="font-bold text-lg text-on-surface">Client_Briefings_Archive</h4><p class="text-xs text-on-surface-variant">248 items - 1.2 GB total</p></div>
                    </div>
                    <button class="text-outline group-hover:text-primary transition-colors"><span class="material-symbols-outlined">arrow_forward_ios</span></button>
                </div>
                <div class="grid grid-cols-4 gap-3">
                    <div class="aspect-square rounded-xl bg-surface-container-highest flex items-center justify-center hover:bg-surface-container-lowest transition-colors cursor-pointer border border-outline-variant/10"><span class="material-symbols-outlined text-outline">description</span></div>
                    <div class="aspect-square rounded-xl bg-surface-container-highest flex items-center justify-center hover:bg-surface-container-lowest transition-colors cursor-pointer border border-outline-variant/10"><span class="material-symbols-outlined text-outline">movie</span></div>
                    <div class="aspect-square rounded-xl bg-surface-container-highest flex items-center justify-center hover:bg-surface-container-lowest transition-colors cursor-pointer border border-outline-variant/10"><span class="material-symbols-outlined text-outline">image</span></div>
                    <div class="aspect-square rounded-xl bg-surface-container-highest flex items-center justify-center hover:bg-surface-container-lowest transition-colors cursor-pointer border border-outline-variant/10"><span class="material-symbols-outlined text-outline">add</span></div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
