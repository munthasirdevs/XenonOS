// Clients Page JavaScript
// Requires: SweetAlert2 and swal-custom.js

(function() {
    "use strict";

    // Close menus when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.action-menu')) {
            closeAllMenus();
        }
    });

    // Toggle client action menu
    window.toggleClientMenu = function(btn, name, id) {
        closeAllMenus();
        
        if (typeof btn === 'number') {
            id = btn;
            btn = document.getElementById('btn-client-' + id);
        }
        if (!btn) return;
        
        btn.classList.add('active');
        btn.style.background = '#818cf8';
        btn.style.color = '#fff';
        
        const menu = document.createElement('div');
        menu.className = 'action-menu';
        menu.style.cssText = 'position:absolute;right:0;top:100%;margin-top:4px;background:#1f2937;border-radius:8px;box-shadow:0 10px 40px rgba(0,0,0,0.3);z-index:9999;min-width:140px;overflow:hidden;';
        menu.innerHTML = `
            <a href="/clients/${id}" style="display:block;padding:10px 16px;font-size:14px;color:#dfe2f1;text-decoration:none;border-bottom:1px solid #374151;">View Details</a>
            <a href="/clients/${id}/edit" style="display:block;padding:10px 16px;font-size:14px;color:#dfe2f1;text-decoration:none;border-bottom:1px solid #374151;">Edit</a>
            <button onclick="deleteClient('${name}', ${id})" style="display:block;width:100%;padding:10px 16px;font-size:14px;color:#ef4444;background:transparent;border:none;text-align:left;cursor:pointer;">Delete</button>
        `;
        btn.parentElement.style.position = 'relative';
        btn.parentElement.appendChild(menu);
    };

    window.closeAllMenus = function() {
        document.querySelectorAll('.action-menu').forEach(m => m.remove());
        document.querySelectorAll('.client-action-btn.active, button.active').forEach(b => {
            b.classList.remove('active');
            b.style.background = '';
            b.style.color = '';
        });
    };

    window.deleteClient = function(name, id) {
        SwalCustom.confirm({
            title: 'Delete Client?',
            text: `Are you sure you want to delete "${name}"? This action cannot be undone.`,
            icon: 'warning',
            danger: true,
            confirmText: 'Delete',
            onConfirm: function() {
                fetch('/clients/' + id, { 
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                })
                .then(r => r.json())
                .then(data => { 
                    if (data.success) {
                        SwalCustom.success('Deleted!', 'Client has been deleted.');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        SwalCustom.error('Error', data.message || 'Failed to delete client');
                    }
                });
            }
        });
    };

    // Client filter search
    window.filterClients = function(term) {
        const rows = document.querySelectorAll('.client-row');
        rows.forEach(row => {
            const name = row.querySelector('.client-name')?.textContent.toLowerCase() || '';
            const email = row.querySelector('.client-email')?.textContent.toLowerCase() || '';
            const company = row.querySelector('.client-company')?.textContent.toLowerCase() || '';
            
            const matches = !term || name.includes(term) || email.includes(term) || company.includes(term);
            row.style.display = matches ? '' : 'none';
        });
    };

    window.filterByStatus = function(status) {
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
    };

    // Initialize on load
    function init() {
        const searchInput = document.getElementById('client-search');
        if (searchInput) {
            let debounceTimer;
            searchInput.addEventListener('input', function(e) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    window.filterClients(e.target.value.toLowerCase().trim());
                }, 200);
            });
        }

        const statusSelect = document.getElementById('client-status-filter');
        if (statusSelect) {
            statusSelect.addEventListener('change', function(e) {
                window.filterByStatus(e.target.value);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', init);
})();