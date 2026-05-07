/* Projects Overview JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initAIInsight();
        initProgressRings();
    });
    
    function initAIInsight() {
        var closeBtn = document.querySelector('.ai-insight .material-symbols-outlined');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                var insight = document.querySelector('.ai-insight');
                if (insight) {
                    insight.style.display = 'none';
                }
            });
        }
    }
    
    function initProgressRings() {
        var rings = document.querySelectorAll('.progress-ring');
        rings.forEach(function(ring) {
            // Animation handled by CSS
        });
    }
    
})();