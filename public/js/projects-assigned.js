/* Projects Assigned Page JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initFilters();
        initProjectRows();
        initAssignButton();
    });
    
    function initFilters() {
        var chips = document.querySelectorAll('.filter-chip');
        chips.forEach(function(chip) {
            chip.addEventListener('click', function() {
                console.log('Filter clicked:', chip.textContent.trim());
            });
        });
    }
    
    function initProjectRows() {
        var rows = document.querySelectorAll('.project-row');
        rows.forEach(function(row) {
            row.style.cursor = 'pointer';
            row.addEventListener('click', function() {
                console.log('View project');
            });
        });
    }
    
    function initAssignButton() {
        var btn = document.querySelector('button:has(.add)');
        if (btn) {
            btn.addEventListener('click', function() {
                console.log('Assign new project');
            });
        }
    }
    
})();