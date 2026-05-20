@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects-index.css') }}">
@endpush

@section('title', 'Create Project - XenonOS')

@section('content')
<x-navbar />

<main>
    <div class="pt-2 px-6 md:px-8 pb-12 overflow-y-auto flex flex-col gap-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <h1 class="text-4xl md:text-5xl font-headline font-light text-white tracking-tight">Create Project</h1>
                    <span id="draft-indicator" class="hidden px-3 py-1 rounded-full text-xs font-bold bg-tertiary/20 text-tertiary flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">drafts</span>
                        Draft Saved
                    </span>
                </div>
                <p class="text-on-surface-variant font-body">Add a new client project.</p>
            </div>
            <a href="{{ route('projects.index') }}"
                class="bg-surface-container text-on-surface px-5 py-2.5 rounded-2xl font-bold flex items-center gap-2 hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
                Back
            </a>
        </div>

        <div class="bg-surface-container-low rounded-3xl p-6 md:p-8 max-w-7xl">
            <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-label text-on-surface-variant uppercase tracking-wider mb-2">Project Name</label>
                        <input type="text" name="name" required
                            class="w-full bg-surface-container border-none rounded-2xl py-3 px-4 text-white placeholder-slate-500 focus:ring-1 focus:ring-primary/40"
                            placeholder="Enter project name">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-label text-on-surface-variant uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full bg-surface-container border-none rounded-2xl py-3 px-4 text-white placeholder-slate-500 focus:ring-1 focus:ring-primary/40 resize-none"
                            placeholder="Describe the project"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-label text-on-surface-variant uppercase tracking-wider mb-2">Client</label>
                        <select name="client_id" required
                            class="w-full bg-surface-container border-none rounded-2xl py-3 px-4 text-white focus:ring-1 focus:ring-primary/40">
                            <option value="">Select a client</option>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-label text-on-surface-variant uppercase tracking-wider mb-2">Status</label>
                        <select name="status" required
                            class="w-full bg-surface-container border-none rounded-2xl py-3 px-4 text-white focus:ring-1 focus:ring-primary/40">
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="on_hold">On Hold</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-label text-on-surface-variant uppercase tracking-wider mb-2">Start Date</label>
                        <input type="date" name="start_date"
                            class="w-full bg-surface-container border-none rounded-2xl py-3 px-4 text-white focus:ring-1 focus:ring-primary/40">
                    </div>

                    <div>
                        <label class="block text-xs font-label text-on-surface-variant uppercase tracking-wider mb-2">End Date</label>
                        <input type="date" name="end_date"
                            class="w-full bg-surface-container border-none rounded-2xl py-3 px-4 text-white focus:ring-1 focus:ring-primary/40">
                    </div>

                    <div>
                        <label class="block text-xs font-label text-on-surface-variant uppercase tracking-wider mb-2">Priority</label>
                        <select name="priority" required
                            class="w-full bg-surface-container border-none rounded-2xl py-3 px-4 text-white focus:ring-1 focus:ring-primary/40">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-label text-on-surface-variant uppercase tracking-wider mb-2">Budget ($)</label>
                        <input type="number" name="budget" step="0.01"
                            class="w-full bg-surface-container border-none rounded-2xl py-3 px-4 text-white placeholder-slate-500 focus:ring-1 focus:ring-primary/40"
                            placeholder="0.00">
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-white/10">
                    <div class="flex gap-2">
                        <button type="button" onclick="loadDraft()" class="flex items-center gap-2 px-4 py-2 rounded-2xl text-sm font-bold bg-surface-container text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-sm">drafts</span>
                            Load Draft
                        </button>
                        <button type="button" onclick="deleteDraft()" class="flex items-center gap-2 px-4 py-2 rounded-2xl text-sm font-bold bg-surface-container text-on-surface-variant hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-sm">delete</span>
                            Delete Draft
                        </button>
                    </div>
                    <div class="flex gap-4">
                        <button type="button" onclick="clearFormData()" class="px-6 py-3 rounded-2xl font-bold text-on-surface-variant hover:text-white transition-colors">
                            Clear
                        </button>
                        <button type="button" onclick="saveDraft()" class="px-5 py-3 rounded-2xl font-bold flex items-center gap-2 bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors">
                            <span class="material-symbols-outlined">save</span>
                            Save Draft
                        </button>
                        <a href="{{ route('projects.index') }}" class="px-6 py-3 rounded-2xl font-bold text-on-surface-variant hover:text-white transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="bg-primary text-on-primary-container px-8 py-3 rounded-2xl font-bold flex items-center gap-2 hover:bg-primary-container transition-colors shadow-lg shadow-primary/10">
                            <span class="material-symbols-outlined">add_circle</span>
                            Create Project
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
(function() {
    const STORAGE_KEY = 'project_create_form';
    const form = document.querySelector('form[action*="projects/store"]');
    
    // Load saved data on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check for draft
        const draft = localStorage.getItem('project_draft');
        const indicator = document.getElementById('draft-indicator');
        if (draft && indicator) {
            indicator.classList.remove('hidden');
        }
        
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved) {
            try {
                const data = JSON.parse(saved);
                Object.keys(data).forEach(function(key) {
                    const input = form.querySelector('[name="' + key + '"]');
                    if (input) {
                        input.value = data[key];
                    }
                });
            } catch (e) {
                console.error('Error loading form data:', e);
            }
        }
    });
    
    // Save data on input change
    if (form) {
        form.addEventListener('input', function() {
            const data = {};
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(function(input) {
                if (input.name && input.value) {
                    data[input.name] = input.value;
                }
            });
            localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        });
        
        // Clear saved data on submit
        form.addEventListener('submit', function() {
            localStorage.removeItem(STORAGE_KEY);
        });
    }
    
    window.clearFormData = function() {
        localStorage.removeItem(STORAGE_KEY);
        form.reset();
    };
    
    window.saveDraft = function() {
        const data = {};
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(function(input) {
            if (input.name && input.value) {
                data[input.name] = input.value;
            }
        });
        data._savedAt = new Date().toISOString();
        localStorage.setItem('project_draft', JSON.stringify(data));
        
        const indicator = document.getElementById('draft-indicator');
        if (indicator) indicator.classList.remove('hidden');
        
        if (typeof SwalCustom !== 'undefined') {
            SwalCustom.success('Draft Saved', 'Your project draft has been saved.', 2000);
        } else {
            alert('Draft saved!');
        }
    };
    
    window.loadDraft = function() {
        const saved = localStorage.getItem('project_draft');
        if (!saved) {
            if (typeof SwalCustom !== 'undefined') {
                SwalCustom.warning('No Draft', 'No saved draft found.', 2000);
            } else {
                alert('No saved draft found.');
            }
            return;
        }
        
        try {
            const data = JSON.parse(saved);
            Object.keys(data).forEach(function(key) {
                if (key === '_savedAt') return;
                const input = form.querySelector('[name="' + key + '"]');
                if (input) {
                    input.value = data[key];
                }
            });
            
            if (typeof SwalCustom !== 'undefined') {
                SwalCustom.success('Draft Loaded', 'Your draft has been loaded.', 2000);
            } else {
                alert('Draft loaded!');
            }
        } catch (e) {
            console.error('Error loading draft:', e);
        }
    };
    
    window.deleteDraft = function() {
        localStorage.removeItem('project_draft');
        const indicator = document.getElementById('draft-indicator');
        if (indicator) indicator.classList.add('hidden');
        
        if (typeof SwalCustom !== 'undefined') {
            SwalCustom.success('Draft Deleted', 'Your draft has been deleted.', 2000);
        } else {
            alert('Draft deleted!');
        }
    };
})();
</script>
@endpush