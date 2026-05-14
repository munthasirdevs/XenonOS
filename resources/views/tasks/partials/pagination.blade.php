@if(isset($tasks) && $tasks->hasPages())
<div class="px-6 py-4 bg-surface-container-high/20 border-t border-outline-variant/5 flex items-center justify-between">
    <span class="text-xs text-outline font-medium">Showing {{ $tasks->firstItem() ?? 0 }} to {{ $tasks->lastItem() ?? 0 }} of {{ $tasks->total() }} tasks</span>
    <div class="flex items-center gap-1" id="pagination-links">
        @if($tasks->onFirstPage())
        <button class="p-1.5 rounded-lg text-outline disabled:opacity-30" disabled>
            <span class="material-symbols-outlined text-sm">chevron_left</span>
        </button>
        @else
        <button onclick="loadTasksPage('{{ $tasks->previousPageUrl() }}')" class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline">
            <span class="material-symbols-outlined text-sm">chevron_left</span>
        </button>
        @endif
        
        @foreach($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
        <button onclick="loadTasksPage('{{ $url }}')" class="h-8 w-8 rounded-lg {{ $page == $tasks->currentPage() ? 'bg-primary/20 text-primary font-bold' : 'hover:bg-surface-container-highest text-outline font-medium' }}">{{ $page }}</button>
        @endforeach
        
        @if($tasks->hasMorePages())
        <button onclick="loadTasksPage('{{ $tasks->nextPageUrl() }}')" class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline">
            <span class="material-symbols-outlined text-sm">chevron_right</span>
        </button>
        @else
        <button class="p-1.5 rounded-lg text-outline disabled:opacity-30" disabled>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
        </button>
        @endif
    </div>
</div>
@endif