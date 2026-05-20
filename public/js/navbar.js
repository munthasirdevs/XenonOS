/* XenonOS Navbar JS - Sidebar and section toggle functionality */
(function() {
    'use strict';
    
    const SIDEBAR_STORAGE_KEY = 'xenonos_sidebar_state';
    const SIDEBAR_WIDTH = 260;
    
    document.addEventListener('DOMContentLoaded', function() {
        initSidebar();
        initSectionToggles();
    });
    
    function initSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (!sidebar) return;
        
        const savedState = localStorage.getItem(SIDEBAR_STORAGE_KEY);
        const isMobile = window.innerWidth < 768;
        
        // Apply initial state
        if (isMobile) {
            if (savedState === 'open') {
                openSidebar(sidebar, overlay);
            } else {
                closeSidebar(sidebar, overlay);
            }
        } else {
            if (savedState === 'closed') {
                closeSidebar(sidebar, overlay);
            } else {
                openSidebar(sidebar, overlay);
            }
        }
        
        // Handle resize
        window.addEventListener('resize', function() {
            const nowMobile = window.innerWidth < 768;
            
            if (nowMobile) {
                // On mobile, close sidebar
                closeSidebar(sidebar, overlay);
            } else {
                // On desktop, restore saved state or open
                if (savedState === 'closed') {
                    closeSidebar(sidebar, overlay);
                } else {
                    openSidebar(sidebar, overlay);
                }
            }
        });
        
        // Close on overlay click
        if (overlay) {
            overlay.addEventListener('click', function() {
                closeSidebar(sidebar, overlay);
            });
        }
    }
    
    function openSidebar(sidebar, overlay) {
        sidebar.classList.add('open');
        document.body.classList.add('sidebar-open');
        updateMainContentMargin(true);
        if (overlay) overlay.classList.remove('hidden');
    }
    
    function closeSidebar(sidebar, overlay) {
        sidebar.classList.remove('open');
        document.body.classList.remove('sidebar-open');
        updateMainContentMargin(false);
        if (overlay) overlay.classList.add('hidden');
    }
    
    function updateMainContentMargin(isOpen) {
        const main = document.getElementById('main-content');
        if (main) {
            if (isOpen && window.innerWidth >= 768) {
                main.style.marginLeft = SIDEBAR_WIDTH + 'px';
            } else {
                main.style.marginLeft = '0';
            }
        }
    }
    
    function initSectionToggles() {
        const toggles = document.querySelectorAll('.sidebar-section-toggle');
        
        toggles.forEach(function(toggle) {
            const sectionId = toggle.dataset.section;
            const content = document.getElementById('section-content-' + sectionId);
            
            if (!content) return;
            
            toggle.addEventListener('click', function() {
                const isOpen = content.classList.contains('open');
                
                if (isOpen) {
                    content.classList.remove('open');
                    toggle.classList.remove('open');
                } else {
                    content.classList.add('open');
                    toggle.classList.add('open');
                }
            });
        });
    }
    
    // Global functions for onclick handlers
    window.toggleSidebar = function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (!sidebar) return;
        
        const isOpen = sidebar.classList.contains('open');
        
        if (isOpen) {
            closeSidebar(sidebar, overlay);
            localStorage.setItem(SIDEBAR_STORAGE_KEY, 'closed');
        } else {
            openSidebar(sidebar, overlay);
            localStorage.setItem(SIDEBAR_STORAGE_KEY, 'open');
        }
    };
    
    window.toggleSection = function(sectionId) {
        const content = document.getElementById('section-content-' + sectionId);
        const toggle = document.querySelector(`[data-section="${sectionId}"]`);
        
        if (!content) return;
        
        const isOpen = content.classList.contains('open');
        
        if (isOpen) {
            content.classList.remove('open');
            if (toggle) toggle.classList.remove('open');
        } else {
            content.classList.add('open');
            if (toggle) toggle.classList.add('open');
        }
    };
    
})();