/**
 * Real-time AJAX Filter & Search System
 * Provides instant search results without page reloads
 */

class AjaxFilter {
    constructor(options) {
        this.endpoint = options.endpoint || '';
        this.containerSelector = options.containerSelector || 'tbody';
        this.searchInput = options.searchInput || null;
        this.filterSelects = options.filterSelects || [];
        this.debounceMs = options.debounceMs || 150;
        this.renderCallback = options.renderCallback || null;
        this.onLoad = options.onLoad || null;
        
        this.currentParams = new URLSearchParams();
        this.searchTimeout = null;
        
        this.init();
    }
    
    init() {
        // Initialize search input
        if (this.searchInput) {
            this.searchInput.addEventListener('input', (e) => this.handleSearch(e.target.value));
        }
        
        // Initialize filter selects
        this.filterSelects.forEach(select => {
            if (select.element) {
                select.element.addEventListener('change', (e) => this.handleFilter(select.param, e.target.value));
            }
        });
        
        // Load initial data
        this.fetchResults();
    }
    
    handleSearch(value) {
        // Instant search - minimal or no debounce
        if (this.searchTimeout) clearTimeout(this.searchTimeout);
        
        this.searchTimeout = setTimeout(() => {
            this.currentParams.set('q', value);
            this.updateUrl();
            this.fetchResults();
        }, this.debounceMs);
    }
    
    handleFilter(param, value) {
        if (value && value !== '') {
            this.currentParams.set(param, value);
        } else {
            this.currentParams.delete(param);
        }
        this.updateUrl();
        this.fetchResults();
    }
    
    updateUrl() {
        const url = new URL(window.location.href);
        url.search = this.currentParams.toString();
        window.history.pushState({}, '', url);
    }
    
    async fetchResults() {
        const container = document.querySelector(this.containerSelector);
        if (!container) return;
        
        // Show loading state
        container.innerHTML = this.getLoadingHtml();
        
        // Add loading indicator to page
        this.showGlobalLoading();
        
        try {
            const queryString = this.currentParams.toString();
            const url = `${this.endpoint}?${queryString}`;
            
            const response = await fetch(url, {
                headers: {
                    'Accept': 'HTML',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (!response.ok) throw new Error('Network error');
            
            const html = await response.text();
            
            // Extract just the table body or relevant content
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.querySelector(this.containerSelector);
            
            if (newContent) {
                container.innerHTML = newContent.innerHTML;
            }
            
            // Run callback if provided
            if (this.renderCallback) {
                this.renderCallback(doc);
            }
            
            // Update pagination if exists
            this.updatePagination(doc);
            
        } catch (error) {
            console.error('Filter error:', error);
            container.innerHTML = this.getErrorHtml(error.message);
        } finally {
            this.hideGlobalLoading();
        }
    }
    
    showGlobalLoading() {
        const loader = document.createElement('div');
        loader.id = 'filter-loader';
        loader.className = 'fixed top-4 right-4 z-50 bg-primary text-white px-4 py-2 rounded-lg shadow-lg flex items-center gap-2';
        loader.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Loading...';
        document.body.appendChild(loader);
    }
    
    hideGlobalLoading() {
        const loader = document.getElementById('filter-loader');
        if (loader) loader.remove();
    }
    
    updatePagination(doc) {
        const newPagination = doc.querySelector('.pagination-container');
        const currentPagination = document.querySelector('.pagination-container');
        
        if (newPagination && currentPagination) {
            currentPagination.innerHTML = newPagination.innerHTML;
        }
    }
    
    getLoadingHtml() {
        return `<tr><td colspan="100" class="text-center py-8"><div class="flex items-center justify-center gap-2"><span class="material-symbols-outlined animate-spin">sync</span> Loading...</div></td></tr>`;
    }
    
    getErrorHtml(message) {
        return `<tr><td colspan="100" class="text-center py-8 text-error">Error: ${message}</td></tr>`;
    }
}

// Auto-initialize from data attributes
document.addEventListener('DOMContentLoaded', function() {
    const autoInit = document.querySelector('[data-ajax-filter]');
    if (autoInit) {
        const config = JSON.parse(autoInit.dataset.ajaxFilter);
        window.ajaxFilter = new AjaxFilter(config);
    }
});