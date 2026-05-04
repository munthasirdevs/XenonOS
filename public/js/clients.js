/**
 * Clients Page JavaScript - with global fallback functions
 */

// Global function for onclick (works even if JS doesn't load properly)
function toggleClientMenu(btn, name, id) {
    // Close any existing menus first
    closeAllMenus();
    
    // Get button element if id passed
    if (typeof btn === 'number') {
        id = btn;
        btn = document.getElementById('btn-client-' + id);
    }
    if (!btn) return;
    
    // Toggle active state
    btn.classList.add('active');
    btn.style.background = '#818cf8';
    btn.style.color = '#fff';
    
    // Create menu
    const menu = document.createElement('div');
    menu.className = 'action-menu';
    menu.style.cssText = 'position:absolute;right:0;top:100%;margin-top:4px;background:#1f2937;border-radius:8px;box-shadow:0 10px 40px rgba(0,0,0,0.3);z-index:9999;min-width:140px;overflow:hidden;';
    menu.innerHTML = `
        <a href="/clients/${id}" style="display:block;padding:10px 16px;font-size:14px;color:#dfe2f1;text-decoration:none;border-bottom:1px solid #374151;">View Details</a>
        <a href="/clients/${id}/edit" style="display:block;padding:10px 16px;font-size:14px;color:#dfe2f1;text-decoration:none;border-bottom:1px solid #374151;">Edit</a>
        <button onclick="deleteClient(${id}, '${name}')" style="display:block;width:100%;padding:10px 16px;font-size:14px;color:#ef4444;background:transparent;border:none;text-align:left;cursor:pointer;">Delete</button>
    `;
    btn.parentElement.style.position = 'relative';
    btn.parentElement.appendChild(menu);
}

function deleteClient(id, name) {
    if (confirm('Delete ' + name + '?')) {
        fetch('/clients/' + id, { 
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })
        .then(r => r.json())
        .then(data => { 
            if(data.success) location.reload(); 
        });
    }
    closeAllMenus();
}

function closeAllMenus() {
    document.querySelectorAll('.action-menu').forEach(m => m.remove());
    document.querySelectorAll('.client-action-btn.active')?.forEach(b => {
        b.classList.remove('active');
        b.style.background = '';
        b.style.color = '';
    });
// Also reset any button with active class
    document.querySelectorAll('button[onclick^="toggleClientMenu"].active').forEach(btn => {
        btn.classList.remove('active');
        btn.style.background = '';
        btn.style.color = '';
    });
}
    
    closeAllMenus();
    btn.classList.add('active');
    
    // Create menu
    const menu = document.createElement('div');
    menu.className = 'action-menu';
    menu.style.cssText = 'position:absolute;right:0;top:100%;margin-top:4px;background:#161922;border-radius:8px;box-shadow:0 10px 40px rgba(0,0,0,0.3);z-index:50;min-width:140px;overflow:hidden;';
    menu.innerHTML = `
        <a href="/clients/${id}" style="display:block;padding:8px 16px;font-size:14px;color:#dfe2f1;text-decoration:none;">View Details</a>
        <a href="/clients/${id}/edit" style="display:block;padding:8px 16px;font-size:14px;color:#dfe2f1;text-decoration:none;">Edit</a>
        <button onclick="deleteClient(${id}, '${name}')" style="display:block;width:100%;padding:8px 16px;font-size:14px;color:#ff6b6b;background:transparent;border:none;text-align:left;cursor:pointer;">Delete</button>
    `;
    btn.parentElement.style.position = 'relative';
    btn.parentElement.appendChild(menu);
}

function deleteClient(id, name) {
    if (confirm('Delete ' + name + '?')) {
        fetch('/clients/' + id, { 
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })
        .then(r => r.json())
        .then(data => { 
            if(data.success) location.reload(); 
        });
    }
    closeAllMenus();
}

function closeAllMenus() {
    document.querySelectorAll('.action-menu').forEach(m => m.remove());
    document.querySelectorAll('.client-action-btn.active').forEach(b => b.classList.remove('active'));
}

// Close menus when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.action-menu')) {
        closeAllMenus();
    }
});

// ================================================================
// CLIENT FILTER FUNCTIONALITY
// ================================================================

(function() {
    "use strict";

    /**
     * Initialize client search filter
     */
    function initSearchFilter() {
        const searchInput = document.getElementById('client-search');
        if (!searchInput) return;

        let debounceTimer;
        searchInput.addEventListener('input', function(e) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const searchTerm = e.target.value.toLowerCase().trim();
                filterClients(searchTerm);
            }, 200);
        });
    }

    /**
     * Filter clients by search term
     */
    function filterClients(term) {
        const rows = document.querySelectorAll('.client-row');
        rows.forEach(row => {
            const name = row.querySelector('.client-name')?.textContent.toLowerCase() || '';
            const email = row.querySelector('.client-email')?.textContent.toLowerCase() || '';
            const company = row.querySelector('.client-company')?.textContent.toLowerCase() || '';
            
            const matches = !term || name.includes(term) || email.includes(term) || company.includes(term);
            row.style.display = matches ? '' : 'none';
        });
    }

    /**
     * Initialize status filter dropdown
     */
    function initStatusFilter() {
        const statusSelect = document.getElementById('client-status-filter');
        if (!statusSelect) return;

        statusSelect.addEventListener('change', function(e) {
            filterByStatus(e.target.value);
        });
    }

    /**
     * Filter clients by status
     */
    function filterByStatus(status) {
        const rows = document.querySelectorAll('.client-row');
        rows.forEach(row => {
            const statusBadge = row.querySelector('[class*="bg-emerald"], [class*="bg-amber"], [class*="bg-red"]');
            
            if (status === 'all' || !statusBadge) {
                row.style.display = '';
                return;
            }
            
            let rowStatus = 'unknown';
            if (statusBadge?.classList.contains('bg-emerald')) rowStatus = 'active';
            else if (statusBadge?.classList.contains('bg-amber')) rowStatus = 'inactive';
            else if (statusBadge?.classList.contains('bg-red')) rowStatus = 'blocked';
            
            row.style.display = rowStatus === status ? '' : 'none';
        });
    }

    // ================================================================
    // ROW HOVER EFFECTS
    // ================================================================

    function initRowHover() {
        const rows = document.querySelectorAll('.client-row');
        rows.forEach(row => {
            row.style.cursor = 'pointer';
        });
    }

    // ================================================================
    // INITIALIZATION
    // ================================================================

    function init() {
        initSearchFilter();
        initStatusFilter();
        initRowHover();
    }

    // Run
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(init, 100);
    });
    
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        setTimeout(init, 100);
    }

})();