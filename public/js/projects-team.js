/**
 * Projects Team Page - JavaScript
 * Team management and interaction handlers
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize team page functionality
    initializeTeamCards();
    initializeActionButtons();
    initializeModals();
});

/**
 * Initialize team card interactions
 */
function initializeTeamCards() {
    const cards = document.querySelectorAll('.obsidian-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('active');
        });
        
        card.addEventListener('mouseleave', function() {
            this.classList.remove('active');
        });
    });
}

/**
 * Initialize action buttons
 */
function initializeActionButtons() {
    // Add Member Button
    const addMemberBtn = document.querySelector('.indigo-glow-cta');
    if (addMemberBtn) {
        addMemberBtn.addEventListener('click', () => {
            openAddMemberModal();
        });
    }
    
    // Reassign Buttons
    document.querySelectorAll('button:contains("Reassign")').forEach(btn => {
        btn.addEventListener('click', () => {
            handleReassign(btn);
        });
    });
    
    // Assign Task Buttons
    document.querySelectorAll('button:contains("Assign Task")').forEach(btn => {
        btn.addEventListener('click', () => {
            handleAssignTask(btn);
        });
    });
    
    // Relieve Button (for overloaded team members)
    document.querySelectorAll('button:contains("Relieve")').forEach(btn => {
        btn.addEventListener('click', () => {
            handleRelieveTask(btn);
        });
    });
    
    // Team Audit Button
    const auditBtn = document.querySelector('button:contains("Team Audit")');
    if (auditBtn) {
        auditBtn.addEventListener('click', () => {
            openTeamAudit();
        });
    }
    
    // Manage Roles Button
    const manageRolesBtn = document.querySelector('button:contains("Manage Roles")');
    if (manageRolesBtn) {
        manageRolesBtn.addEventListener('click', () => {
            openManageRoles();
        });
    }
}

/**
 * Initialize modal functionality
 */
function initializeModals() {
    // Close modals on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeAllModals();
        }
    });
    
    // Close modal on backdrop click
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
        backdrop.addEventListener('click', closeAllModals);
    });
}

/**
 * Open Add Member Modal
 */
function openAddMemberModal() {
    console.log('Opening add member modal...');
    // Implementation would dispatch to a modal component
    // For now, dispatch a custom event
    window.dispatchEvent(new CustomEvent('open-modal', { 
        detail: { modal: 'add-member' } 
    }));
}

/**
 * Handle reassign action
 */
function handleReassign(button) {
    const card = button.closest('.obsidian-card');
    const memberName = card.querySelector('h3, h4')?.textContent || 'Team Member';
    
    console.log(`Reassigning: ${memberName}`);
    window.dispatchEvent(new CustomEvent('open-modal', { 
        detail: { modal: 'reassign', member: memberName } 
    }));
}

/**
 * Handle assign task action
 */
function handleAssignTask(button) {
    const card = button.closest('.obsidian-card');
    const memberName = card.querySelector('h4')?.textContent || 'Team Member';
    
    console.log(`Assigning task to: ${memberName}`);
    window.dispatchEvent(new CustomEvent('open-modal', { 
        detail: { modal: 'assign-task', member: memberName } 
    }));
}

/**
 * Handle relieve task action (for overloaded members)
 */
function handleRelieveTask(button) {
    const card = button.closest('.obsidian-card');
    const memberName = card.querySelector('h4')?.textContent || 'Team Member';
    
    console.log(`Relieving tasks for: ${memberName}`);
    
    if (confirm(`Relieve some tasks from ${memberName}?`)) {
        button.textContent = 'Processing...';
        button.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            button.textContent = 'Relieved';
            button.classList.add('bg-success/20', 'text-success');
        }, 1000);
    }
}

/**
 * Open Team Audit
 */
function openTeamAudit() {
    console.log('Opening team audit...');
    window.dispatchEvent(new CustomEvent('open-modal', { 
        detail: { modal: 'team-audit' } 
    }));
}

/**
 * Open Manage Roles
 */
function openManageRoles() {
    console.log('Opening manage roles...');
    window.dispatchEvent(new CustomEvent('open-modal', { 
        detail: { modal: 'manage-roles' } 
    }));
}

/**
 * Close all modals
 */
function closeAllModals() {
    window.dispatchEvent(new CustomEvent('close-modals'));
}

// Export functions for potential module use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initializeTeamCards,
        initializeActionButtons,
        initializeModals,
        openAddMemberModal,
        handleReassign,
        handleAssignTask,
        handleRelieveTask,
        openTeamAudit,
        openManageRoles,
        closeAllModals
    };
}
