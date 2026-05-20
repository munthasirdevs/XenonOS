/* XenonOS Global JS - Common functionality */
(function() {
    'use strict';
    
    const SIDEBAR_WIDTH = 260;
    const SIDEBAR_STORAGE_KEY = 'xenonos_sidebar_state';
    
    document.addEventListener('DOMContentLoaded', function() {
        initSidebarState();
        initAlerts();
        initFlashMessages();
    });
    
    function initSidebarState() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');
        if (!sidebar || !main) return;
        
        const savedState = localStorage.getItem(SIDEBAR_STORAGE_KEY);
        const isMobile = window.innerWidth < 768;
        
        // Apply initial state
        if (isMobile) {
            if (savedState === 'open') {
                sidebar.classList.add('open');
                document.body.classList.add('sidebar-open');
                main.style.marginLeft = '0';
            } else {
                sidebar.classList.remove('open');
                document.body.classList.remove('sidebar-open');
                main.style.marginLeft = '0';
            }
        } else {
            // Desktop
            if (savedState === 'closed') {
                sidebar.classList.remove('open');
                document.body.classList.remove('sidebar-open');
                main.style.marginLeft = '0';
            } else {
                // Default open on desktop
                sidebar.classList.add('open');
                document.body.classList.add('sidebar-open');
                main.style.marginLeft = SIDEBAR_WIDTH + 'px';
            }
        }
        
        // Listen for sidebar toggle
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'class') {
                    const isOpen = sidebar.classList.contains('open');
                    if (isOpen && window.innerWidth >= 768) {
                        main.style.marginLeft = SIDEBAR_WIDTH + 'px';
                    } else {
                        main.style.marginLeft = '0';
                    }
                }
            });
        });
        
        observer.observe(sidebar, { attributes: true });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                const isOpen = sidebar.classList.contains('open');
                main.style.marginLeft = isOpen ? SIDEBAR_WIDTH + 'px' : '0';
            } else {
                main.style.marginLeft = '0';
            }
        });
    }
    
    function initAlerts() {
        setTimeout(function() {
            var alerts = document.querySelectorAll('[class*="alert-"]');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(function() { alert.remove(); }, 300);
            });
        }, 5000);
    }
    
    function initFlashMessages() {
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
    }
    
})();