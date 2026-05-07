/* Tasks Assign JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initStepIndicator();
        initPriorityButtons();
    });
    
    function initStepIndicator() {
        console.log('Step indicator initialized');
    }
    
    function initPriorityButtons() {
        var buttons = document.querySelectorAll('.priority-btn');
        buttons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                buttons.forEach(function(b) {
                    b.classList.remove('ring-1', 'ring-primary/40');
                });
                this.classList.add('ring-1', 'ring-primary/40');
            });
        });
    }
    
})();