/* Projects Hub Page JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initViewToggle();
        initFilters();
        initProjectCards();
        initAddCard();
    });
    
    function initViewToggle() {
        var gridBtn = document.querySelector('button:has(.grid_view)');
        var listBtn = document.querySelector('button:has(.view_list)');
        
        if (gridBtn && listBtn) {
            gridBtn.addEventListener('click', function() {
                gridBtn.classList.add('bg-surface-container-high', 'text-primary');
                listBtn.classList.remove('bg-surface-container-high', 'text-primary');
            });
            
            listBtn.addEventListener('click', function() {
                listBtn.classList.add('bg-surface-container-high', 'text-primary');
                gridBtn.classList.remove('bg-surface-container-high', 'text-primary');
            });
        }
    }
    
    function initFilters() {
        var buttons = document.querySelectorAll('.filter-button, button:has(.filter_list)');
        buttons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                console.log('Filter clicked:', btn.textContent.trim());
            });
        });
    }
    
    function initProjectCards() {
        var cards = document.querySelectorAll('.project-card');
        cards.forEach(function(card) {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('button')) {
                    console.log('Navigate to project details');
                }
            });
        });
        
        var actionBtns = document.querySelectorAll('.project-card button');
        actionBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                console.log('Show project menu');
            });
        });
    }
    
    function initAddCard() {
        var addCard = document.querySelector('.add-card');
        if (addCard) {
            addCard.addEventListener('click', function() {
                console.log('Create new project');
            });
        }
    }
    
})();