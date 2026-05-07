document.addEventListener('DOMContentLoaded', function() {
    // Timeline view switcher functionality
    const viewButtons = document.querySelectorAll('.flex.bg-surface-container-lowest button');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active state from all buttons
            viewButtons.forEach(btn => {
                btn.classList.remove('bg-surface-container-high', 'text-on-surface');
                btn.classList.add('text-on-surface-variant', 'hover:text-on-surface');
            });
            
            // Add active state to clicked button
            this.classList.remove('text-on-surface-variant', 'hover:text-on-surface');
            this.classList.add('bg-surface-container-high', 'text-on-surface');
            
            const viewType = this.textContent.trim();
            console.log('Switched to ' + viewType + ' view');
            // Add your view switching logic here
        });
    });

    // Milestone cards hover effect
    const milestoneCards = document.querySelectorAll('.bg-surface-container.rounded-2xl');
    
    milestoneCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Add milestone button click handler
    const addMilestoneBtn = document.querySelector('.border-dashed');
    
    if (addMilestoneBtn) {
        addMilestoneBtn.addEventListener('click', function() {
            console.log('Add milestone clicked');
            // Add your modal or redirect logic here
        });
        
        addMilestoneBtn.style.cursor = 'pointer';
    }

    // Export PDF button handler
    const exportBtn = document.querySelector('button:has(.material-symbols-outlined[data-icon="ios_share"])');
    
    if (exportBtn) {
        exportBtn.addEventListener('click', function() {
            console.log('Export PDF clicked');
            // Add your PDF export logic here
        });
    }

    // Edit Roadmap button handler
    const editBtn = document.querySelector('button:has(.material-symbols-outlined[data-icon="edit"])');
    
    if (editBtn) {
        editBtn.addEventListener('click', function() {
            console.log('Edit Roadmap clicked');
            // Add your edit redirect logic here
        });
    }

    // Material Symbols handling
    const symbolElements = document.querySelectorAll('.material-symbols-outlined');
    
    symbolElements.forEach(element => {
        const iconName = element.getAttribute('data-icon');
        if (iconName) {
            element.textContent = iconName;
        }
    });

    // Animate progress bars on load
    const progressBars = document.querySelectorAll('.w-\\[64\\%\\], .w-\\[42\\%\\]');
    
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        
        setTimeout(() => {
            bar.style.width = width;
        }, 300);
    });

    console.log('Projects Timeline initialized');
});
