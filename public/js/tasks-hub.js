/* Tasks Hub JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initFilterChips();
        initTaskCards();
    });
    
    function initFilterChips() {
        var chips = document.querySelectorAll('.filter-chip');
        chips.forEach(function(chip) {
            chip.addEventListener('click', function() {
                chips.forEach(function(c) { c.classList.remove('active'); });
                chip.classList.add('active');
                console.log('Filter:', chip.textContent.trim());
            });
        });
    }
    
    function initTaskCards() {
        var cards = document.querySelectorAll('.task-card');
        cards.forEach(function(card) {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function() {
                console.log('View task');
            });
        });
    }
    
})();