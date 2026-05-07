/* Projects Index Page JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initViewToggle();
        initFilters();
        initRowActions();
        initCreateButton();
    });
    
    function initViewToggle() {
        var gridBtn = document.querySelector('button:has(.grid_view)');
        var listBtn = document.querySelector('button:has(.table_rows)');
        
        if (gridBtn && listBtn) {
            gridBtn.addEventListener('click', function() {
                gridBtn.classList.add('view-toggle-active');
                listBtn.classList.remove('view-toggle-active');
                // Toggle grid view (simplified - would show grid in full implementation)
            });
            
            listBtn.addEventListener('click', function() {
                listBtn.classList.add('view-toggle-active');
                gridBtn.classList.remove('view-toggle-active');
            });
        }
    }
    
    function initFilters() {
        var selects = document.querySelectorAll('select[aria-label*="Filter"]');
        selects.forEach(function(select) {
            select.addEventListener('change', function() {
                // In full impl, filter projects via API
                console.log('Filter changed:', select.value);
            });
        });
    }
    
    function initRowActions() {
        var rows = document.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            row.addEventListener('click', function(e) {
                if (!e.target.closest('button')) {
                    // Navigate to project details
                    console.log('Navigate to project');
                }
            });
        });
        
        var actionBtns = document.querySelectorAll('tbody button');
        actionBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                // Show dropdown menu
                console.log('Show actions');
            });
        });
    }
    
    function initCreateButton() {
        var createBtn = document.querySelector('button:has(.add_circle)');
        if (createBtn) {
            createBtn.addEventListener('click', function() {
                // Open create project modal
                console.log('Create project');
            });
        }
    }
    
})();