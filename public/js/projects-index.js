/* Projects Index Page JS - Live Filtering */
(function() {
    'use strict';
    
    let searchTimeout = null;
    let isLoading = false;
    const STORAGE_KEY = 'projects_filter_state';
    
    document.addEventListener('DOMContentLoaded', function() {
        loadFilterState();
        initLiveFilters();
    });
    
    function saveFilterState() {
        const state = {
            search: document.querySelector('input[name="search"]')?.value || '',
            status: document.querySelector('select[name="status"]')?.value || '',
            client: document.querySelector('select[name="client"]')?.value || '',
            sort: document.querySelector('select[name="sort"]')?.value || 'newest'
        };
        localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
    }
    
    function loadFilterState() {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (!saved) return;
        
        try {
            const state = JSON.parse(saved);
            
            const searchInput = document.querySelector('input[name="search"]');
            const statusSelect = document.querySelector('select[name="status"]');
            const clientSelect = document.querySelector('select[name="client"]');
            const sortSelect = document.querySelector('select[name="sort"]');
            
            if (searchInput) searchInput.value = state.search || '';
            if (statusSelect) statusSelect.value = state.status || '';
            if (clientSelect) clientSelect.value = state.client || '';
            if (sortSelect) sortSelect.value = state.sort || 'newest';
            
            if (state.search || state.status || state.client) {
                fetchProjects();
            }
        } catch (e) {
            console.error('Error loading filter state:', e);
        }
    }
    
    function initLiveFilters() {
        const searchInput = document.querySelector('input[name="search"]');
        const statusSelect = document.querySelector('select[name="status"]');
        const clientSelect = document.querySelector('select[name="client"]');
        const sortSelect = document.querySelector('select[name="sort"]');
        const clearBtn = document.querySelector('[data-clear-filters]');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                handleSearchInput();
                saveFilterState();
            });
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    fetchProjects();
                }
            });
        }
        
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                fetchProjects();
                saveFilterState();
            });
        }
        
        if (clientSelect) {
            clientSelect.addEventListener('change', function() {
                fetchProjects();
                saveFilterState();
            });
        }
        
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                fetchProjects();
                saveFilterState();
            });
        }
        
        if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
                e.preventDefault();
                clearFilters();
            });
        }
    }
    
    function handleSearchInput() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            fetchProjects();
            saveFilterState();
        }, 300);
    }
    
    function getFilterParams() {
        const params = new URLSearchParams();
        
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput && searchInput.value) {
            params.set('search', searchInput.value);
        }
        
        const statusSelect = document.querySelector('select[name="status"]');
        if (statusSelect && statusSelect.value) {
            params.set('status', statusSelect.value);
        }
        
        const clientSelect = document.querySelector('select[name="client"]');
        if (clientSelect && clientSelect.value) {
            params.set('client', clientSelect.value);
        }
        
        const sortSelect = document.querySelector('select[name="sort"]');
        if (sortSelect && sortSelect.value) {
            params.set('sort', sortSelect.value);
        }
        
        return params.toString();
    }
    
    function fetchProjects() {
        if (isLoading) return;
        
        isLoading = true;
        showLoading();
        
        const url = `/projects/filter?${getFilterParams()}`;
        
        fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderProjects(data.data);
                updatePagination(data.data);
                updateClearButton();
            }
        })
        .catch(error => {
            console.error('Error fetching projects:', error);
            showError('Failed to fetch projects');
        })
        .finally(() => {
            isLoading = false;
            hideLoading();
        });
    }
    
    function renderProjects(projects) {
        const tbody = document.querySelector('tbody');
        if (!tbody) return;
        
        if (!projects.data || projects.data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">
                        No projects found. Create your first project to get started.
                    </td>
                </tr>
            `;
            return;
        }
        
        let html = '';
        projects.data.forEach(project => {
            const progress = calculateProgress(project);
            const statusClass = getStatusClass(project.status);
            const statusLabel = getStatusLabel(project.status);
            const teamHtml = renderTeam(project.team);
            
            html += `
                <tr class="group hover:bg-surface-container transition-all duration-200 cursor-pointer" onclick="window.location='/projects/${project.id}'">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary text-sm">folder</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">${escapeHtml(project.name)}</p>
                                <p class="text-xs text-on-surface-variant">${project.client ? escapeHtml(project.client.name) : 'No client'}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="text-sm text-on-surface">${project.client ? escapeHtml(project.client.name) : '-'}</span>
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1.5 rounded-full text-xs font-medium ${statusClass}">${statusLabel}</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col gap-1 w-24">
                            <div class="h-1.5 bg-surface-container rounded-full overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: ${progress}%"></div>
                            </div>
                            <span class="text-[10px] text-on-surface-variant font-medium">${progress}% Complete</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex -space-x-2">
                            ${teamHtml}
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <button class="p-2 text-on-surface-variant hover:text-white">
                            <span class="material-symbols-outlined">more_horiz</span>
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tbody.innerHTML = html;
    }
    
    function renderTeam(team) {
        if (!team || team.length === 0) {
            return '<span class="text-xs text-on-surface-variant">No team</span>';
        }
        
        let html = '';
        const displayMembers = team.slice(0, 3);
        
        displayMembers.forEach(member => {
            const name = member.name || 'U';
            const initial = name.charAt(0).toUpperCase();
            html += `
                <img class="w-8 h-8 rounded-full border-2 border-surface-container-low object-cover"
                    alt="Team" src="https://ui-avatars.com/api/?name=${encodeURIComponent(initial)}&background=818cf8&color=fff" />
            `;
        });
        
        if (team.length > 3) {
            const moreCount = team.length - 3;
            html += `
                <div class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center text-[10px] font-bold border-2 border-surface-container-low">+${moreCount}</div>
            `;
        }
        
        return html;
    }
    
    function calculateProgress(project) {
        if (!project.tasks || project.tasks.length === 0) return 0;
        
        const total = project.tasks.length;
        const completed = project.tasks.filter(t => t.status === 'completed' || t.status === 'done').length;
        
        return total > 0 ? Math.round((completed / total) * 100) : 0;
    }
    
    function getStatusClass(status) {
        const classes = {
            'active': 'bg-primary/10 text-primary',
            'completed': 'bg-success/10 text-success',
            'pending': 'bg-tertiary/20 text-tertiary',
            'on_hold': 'bg-outline/20 text-outline',
            'paused': 'bg-outline/20 text-outline',
            'cancelled': 'bg-error/10 text-error'
        };
        return classes[status] || 'bg-primary/10 text-primary';
    }
    
    function getStatusLabel(status) {
        const labels = {
            'active': 'Active',
            'completed': 'Completed',
            'pending': 'Pending',
            'on_hold': 'On Hold',
            'paused': 'Paused',
            'cancelled': 'Cancelled'
        };
        return labels[status] || 'Active';
    }
    
    function updatePagination(projects) {
        const paginationContainer = document.querySelector('.pagination');
        if (!paginationContainer) return;
        
        if (!projects.last_page || projects.last_page <= 1) {
            paginationContainer.innerHTML = '';
            return;
        }
        
        let html = '';
        
        if (projects.prev_page_url) {
            html += `<a href="${projects.prev_page_url}" class="px-3 py-1 rounded bg-surface-container text-on-surface-variant hover:bg-surface-container-high">Prev</a>`;
        }
        
        for (let i = 1; i <= projects.last_page; i++) {
            const isActive = projects.current_page === i;
            html += `<a href="${projects.path}?page=${i}" class="px-3 py-1 rounded ${isActive ? 'bg-primary text-on-primary-container' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high'}">${i}</a>`;
        }
        
        if (projects.next_page_url) {
            html += `<a href="${projects.next_page_url}" class="px-3 py-1 rounded bg-surface-container text-on-surface-variant hover:bg-surface-container-high">Next</a>`;
        }
        
        paginationContainer.innerHTML = html;
    }
    
    function updateClearButton() {
        const searchInput = document.querySelector('input[name="search"]');
        const statusSelect = document.querySelector('select[name="status"]');
        const clientSelect = document.querySelector('select[name="client"]');
        
        let hasFilters = false;
        
        if (searchInput && searchInput.value) hasFilters = true;
        if (statusSelect && statusSelect.value) hasFilters = true;
        if (clientSelect && clientSelect.value) hasFilters = true;
        
        const clearBtn = document.querySelector('[data-clear-filters]');
        if (clearBtn) {
            clearBtn.style.display = hasFilters ? 'flex' : 'none';
        }
    }
    
    function clearFilters() {
        const searchInput = document.querySelector('input[name="search"]');
        const statusSelect = document.querySelector('select[name="status"]');
        const clientSelect = document.querySelector('select[name="client"]');
        const sortSelect = document.querySelector('select[name="sort"]');
        
        if (searchInput) searchInput.value = '';
        if (statusSelect) statusSelect.value = '';
        if (clientSelect) clientSelect.value = '';
        if (sortSelect) sortSelect.value = 'newest';
        
        localStorage.removeItem(STORAGE_KEY);
        fetchProjects();
    }
    
    function showLoading() {
        const tbody = document.querySelector('tbody');
        if (tbody) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-primary animate-spin">sync</span>
                            <span class="text-on-surface-variant">Loading projects...</span>
                        </div>
                    </td>
                </tr>
            `;
        }
    }
    
    function hideLoading() {
        // Loading state removed after render
    }
    
    function showError(message) {
        const tbody = document.querySelector('tbody');
        if (tbody) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-error">
                        ${escapeHtml(message)}
                    </td>
                </tr>
            `;
        }
    }
    
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
})();