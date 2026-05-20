/* XenonOS Global JS - Common functionality */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar toggle
        var sidebarToggle = document.getElementById('sidebar-toggle');
        var sidebar = document.querySelector('.sidebar');
        var overlay = document.getElementById('sidebar-overlay');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
                if (overlay) overlay.classList.toggle('hidden');
            });
        }
        
        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                overlay.classList.add('hidden');
            });
        }
        
        // Auto-hide alerts
        setTimeout(function() {
            var alerts = document.querySelectorAll('[class*="alert-"]');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(function() { alert.remove(); }, 300);
            });
        }, 5000);
        
        // Flash messages (show on page load after redirect)
        if (typeof Swal !== 'undefined' && typeof SwalCustom !== 'undefined') {
            var flashSuccess = document.querySelector('[data-flash-success]');
            var flashError = document.querySelector('[data-flash-error]');
            var flashWarning = document.querySelector('[data-flash-warning]');
            
            if (flashSuccess) {
                SwalCustom.toast('success', flashSuccess.dataset.flashSuccess, 3000);
            }
            if (flashError) {
                SwalCustom.toast('error', flashError.dataset.flashError, 4000);
            }
            if (flashWarning) {
                SwalCustom.toast('warning', flashWarning.dataset.flashWarning, 3500);
            }
        }
    });
    
})();