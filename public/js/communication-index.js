/**
 * Communication Index Page JavaScript
 * Chat Control - System Admin
 */

document.addEventListener("DOMContentLoaded", function() {
    // Toggle Checkbox Event Handlers
    const checkboxes = document.querySelectorAll('.peer');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.closest('label');
            const toggle = label.querySelector('div:last-child');
            
            if (this.checked) {
                toggle.classList.add('peer-checked:bg-primary');
            } else {
                toggle.classList.remove('peer-checked:bg-primary');
            }
            
            // Dispatch custom event for any listeners
            this.dispatchEvent(new CustomEvent('permission-change', {
                detail: {
                    checked: this.checked,
                    label: this.getAttribute('aria-label')
                }
            }));
        });
    });

    // Moderation Queue Action Handlers
    const deleteButtons = document.querySelectorAll('.group button:first-child');
    const dismissButtons = document.querySelectorAll('.group button:last-child');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const item = this.closest('.group');
            if (confirm('Are you sure you want to delete this message?')) {
                item.style.opacity = '0';
                setTimeout(() => {
                    item.remove();
                }, 300);
            }
        });
    });
    
    dismissButtons.forEach(button => {
        button.addEventListener('click', function() {
            const item = this.closest('.group');
            item.style.opacity = '0';
            setTimeout(() => {
                item.remove();
            }, 300);
        });
    });

    // Export Logs Handler
    const exportButton = document.querySelector('button span[data-icon="export_notes"]');
    if (exportButton) {
        exportButton.parentElement.addEventListener('click', function() {
            // Export functionality would go here
            console.log('Exporting chat logs...');
        });
    }

    // Add Rule Handler
    const addRuleButton = document.querySelector('button span[data-icon="add_moderator"]');
    if (addRuleButton) {
        addRuleButton.parentElement.addEventListener('click', function() {
            // Add rule functionality would go here
            console.log('Opening add rule dialog...');
        });
    }

    // Apply Changes Handler
    const applyButton = document.querySelector('.shadow-xl');
    if (applyButton) {
        applyButton.addEventListener('click', function() {
            if (confirm('Apply all pending changes?')) {
                this.textContent = 'Applied!';
                this.classList.remove('bg-primary');
                this.classList.add('bg-tertiary');
                setTimeout(() => {
                    this.textContent = 'Apply Changes';
                    this.classList.add('bg-primary');
                    this.classList.remove('bg-tertiary');
                }, 2000);
            }
        });
    }

    // Material Symbols Icon Setup
    const materialSymbols = document.querySelectorAll('.material-symbols-outlined');
    materialSymbols.forEach(icon => {
        const dataIcon = icon.getAttribute('data-icon');
        if (dataIcon) {
            icon.textContent = dataIcon.replace(/_/g, '_');
        }
    });
});