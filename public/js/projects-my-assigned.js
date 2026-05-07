/* Projects My Assigned JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initCards();
        initCheckboxes();
    });
    
    function initCards() {
        var cards = document.querySelectorAll('.assigned-card');
        cards.forEach(function(card) {
            card.style.cursor = 'pointer';
        });
    }
    
    function initCheckboxes() {
        var checkboxes = document.querySelectorAll('.task-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                console.log('Task toggled:', checkbox.checked);
            });
        });
    }
    
})();