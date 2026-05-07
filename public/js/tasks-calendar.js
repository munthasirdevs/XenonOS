/* Task Calendar JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initCalendarEvents();
        initNavigation();
    });
    
    function initCalendarEvents() {
        var events = document.querySelectorAll('.calendar-event');
        events.forEach(function(event) {
            event.style.cursor = 'grab';
            event.addEventListener('click', function() {
                console.log('View task details');
            });
        });
    }
    
    function initNavigation() {
        var navBtns = document.querySelectorAll('.calendar-nav-btn');
        navBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                console.log('Navigate calendar');
            });
        });
    }
    
})();