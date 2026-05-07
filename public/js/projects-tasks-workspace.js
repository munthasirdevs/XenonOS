/* Project Tasks Workspace JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initTaskItems();
        initInsights();
    });
    
    function initTaskItems() {
        var items = document.querySelectorAll('.task-list-item');
        items.forEach(function(item) {
            item.style.cursor = 'pointer';
            item.addEventListener('click', function() {
                console.log('View task details');
            });
        });
    }
    
    function initInsights() {
        var btn = document.querySelector('.insight-card button');
        if (btn) {
            btn.addEventListener('click', function() {
                console.log('View detailed report');
            });
        }
    }
    
})();