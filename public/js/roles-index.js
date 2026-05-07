/**
 * Roles Index Page JavaScript
 * Handles interactive functionality for roles and permissions management
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize components
    initPermissionToggles();
    initActionButtons();
    initUserSearch();
    initRoleActions();
});

/**
 * Initialize permission toggle switches
 */
function initPermissionToggles() {
    const toggles = document.querySelectorAll('.permission-toggle, input[type="checkbox"]');
    
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function(e) {
            const permissionName = e.target.getAttribute('aria-label') || 'Permission';
            const action = e.target.checked ? 'enabled' : 'disabled';
            
            // Show feedback (could be replaced with toast notification)
            console.log(${permissionName}: );
            
            // Add visual feedback
            const label = e.target.closest('label');
            if (label) {
                label.classList.add('transition-all');
            }
        });
    });
}

/**
 * Initialize action buttons (edit, copy, delete)
 */
function initActionButtons() {
    const editButtons = document.querySelectorAll('button:has(.material-symbols-outlined:text-lg)');
    
    editButtons.forEach(button => {
        const icon = button.querySelector('.material-symbols-outlined');
        if (!icon) return;
        
        const iconText = icon.textContent.trim();
        
        if (iconText === 'edit') {
            button.addEventListener('click', handleEdit);
        } else if (iconText === 'content_copy') {
            button.addEventListener('click', handleCopy);
        } else if (iconText === 'delete') {
            button.addEventListener('click', handleDelete);
        }
    });
}

/**
 * Handle edit action
 */
function handleEdit(e) {
    const row = e.target.closest('tr');
    const roleName = row?.querySelector('.font-semibold')?.textContent;
    console.log('Edit role:', roleName);
    // Add modal or redirect logic here
}

/**
 * Handle copy/duplicate action
 */
function handleCopy(e) {
    const row = e.target.closest('tr');
    const roleName = row?.querySelector('.font-semibold')?.textContent;
    console.log('Duplicate role:', roleName);
    // Add copy logic here
}

/**
 * Handle delete action
 */
function handleDelete(e) {
    const row = e.target.closest('tr');
    const roleName = row?.querySelector('.font-semibold')?.textContent;
    
    if (confirm(Are you sure you want to delete the "" role?)) {
        console.log('Delete role:', roleName);
        // Add delete API call here
    }
}

/**
 * Initialize user search functionality
 */
function initUserSearch() {
    const searchInput = document.querySelector('input[name="search_users"]');
    
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function(e) {
            const query = e.target.value.trim();
            if (query.length >= 2) {
                console.log('Search users:', query);
                // Add user search API call here
            }
        }, 300));
        
        // Handle Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                console.log('Add user:', e.target.value);
                // Add user addition logic here
            }
        });
    }
}

/**
 * Initialize role actions
 */
function initRoleActions() {
    // Add New Role button
    const addRoleBtn = document.querySelector('button:has(.material-symbols-outlined:text-lg)');
    if (addRoleBtn && addRoleBtn.textContent.includes('Add New Role')) {
        addRoleBtn.addEventListener('click', function() {
            console.log('Open Add New Role modal');
            // Add modal open logic here
        });
    }
    
    // Select All button
    const selectAllBtn = document.querySelector('button:has-text("SELECT ALL")');
    if (selectAllBtn) {
        selectAllBtn.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.permission-toggle, .space-y-4 input[type="checkbox"]');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            
            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
                // Trigger change event
                const event = new Event('change', { bubbles: true });
                cb.dispatchEvent(event);
            });
            
            this.textContent = allChecked ? 'SELECT ALL' : 'DESELECT ALL';
        });
    }
    
    // Remove user buttons
    const removeButtons = document.querySelectorAll('button[aria-label^="Remove"]');
    removeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const userRow = e.target.closest('.flex.items-center.justify-between');
            const userName = userRow?.querySelector('.text-xs.font-bold')?.textContent;
            
            if (userName && confirm(Remove  from this role?)) {
                console.log('Remove user:', userName);
                userRow.remove();
            }
        });
    });
}

/**
 * Debounce utility function
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Export functions for potential module use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initPermissionToggles,
        initActionButtons,
        initUserSearch,
        initRoleActions,
        debounce
    };
}
