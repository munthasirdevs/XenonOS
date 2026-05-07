/* Task Details JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initAttachments();
        initComments();
    });
    
    function initAttachments() {
        var items = document.querySelectorAll('.attachment-item');
        items.forEach(function(item) {
            item.style.cursor = 'pointer';
            item.addEventListener('click', function() {
                console.log('View attachment');
            });
        });
    }
    
    function initComments() {
        var inputs = document.querySelectorAll('.comment-input');
        inputs.forEach(function(input) {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    console.log('Submit comment');
                }
            });
        });
    }
    
})();