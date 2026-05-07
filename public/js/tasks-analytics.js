/* Task Analytics JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initCharts();
        initFilters();
    });
    
    function initCharts() {
        // Chart.js initialization would go here
        console.log('Analytics charts initialized');
    }
    
    function initFilters() {
        var dropdowns = document.querySelectorAll('.filter-dropdown');
        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                console.log('Filter changed:', dropdown.value);
            });
        });
    }
    
})();