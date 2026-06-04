/**
 * Communication Index Page JavaScript
 * Real-time chat with API integration
 */

let currentPage = 1;
let chatPollInterval = null;

document.addEventListener('DOMContentLoaded', function() {
    initChatList();
    initModerationActions();
    startChatPolling();
});

async function initChatList() {
    if (typeof API === 'undefined') {
        console.log('API service not loaded');
        return;
    }
    
    try {
        const response = await API.chats.getAll();
        renderChatList(response.data || response);
    } catch (error) {
        console.error('Failed to load chats:', error);
    }
}

function renderChatList(chats) {
    const tbody = document.querySelector('#chats-table tbody');
    if (!tbody) {
        renderInlineChats(chats);
        return;
    }
    
    tbody.innerHTML = chats.map(chat => {
        const lastMessage = chat.messages?.[0]?.message || 'No messages yet';
        const participantHtml = chat.users?.slice(0, 3).map(u => `
            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low"
                src="https://ui-avatars.com/api/?name=${encodeURIComponent(u.name)}&background=c0c1ff&color=1a1a2e&size=32" />
        `).join('') || '';
        
        const moreUsers = chat.users?.length > 3 ? `
            <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">
                +${chat.users.length - 3}
            </div>
        ` : '';
        
        return `
            <tr class="group hover:bg-surface-bright/30 transition-colors cursor-pointer" 
                onclick="window.location.href=window.chatRouteTemplate ? window.chatRouteTemplate.replace('__ID__', chat.id) : '/communication/' + chat.id">
                <td class="px-8 py-5">
                    <div class="flex -space-x-2">
                        ${participantHtml}
                        ${moreUsers}
                    </div>
                </td>
                <td class="px-4 py-5 text-sm font-medium">${chat.project?.name || 'No Project'}</td>
                <td class="px-4 py-5">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary uppercase">
                        ${chat.type}
                    </span>
                </td>
                <td class="px-8 py-5 text-right text-xs text-on-surface-variant italic">
                    "${lastMessage.substring(0, 50)}${lastMessage.length > 50 ? '...' : ''}"
                </td>
            </tr>
        `;
    }).join('');
}

function renderInlineChats(chats) {
    const container = document.querySelector('.divide-y');
    if (!container) return;
    
    const existingRows = container.querySelectorAll('tr');
    if (existingRows.length === 0) return;
    
    chats.forEach((chat, index) => {
        if (existingRows[index]) {
            const lastMessage = chat.messages?.[0]?.message || 'No messages yet';
            const lastCell = existingRows[index].querySelector('td:last-child');
            if (lastCell) {
                lastCell.innerHTML = `"${lastMessage.substring(0, 50)}..."`;
            }
        }
    });
}

function initModerationActions() {
    const deleteButtons = document.querySelectorAll('.group button:first-child');
    const dismissButtons = document.querySelectorAll('.group button:last-child');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            if (confirm('Are you sure you want to delete this message?')) {
                const item = this.closest('.group');
                item.style.opacity = '0';
                setTimeout(() => item.remove(), 300);
            }
        });
    });
    
    dismissButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const item = this.closest('.group');
            item.style.opacity = '0';
            setTimeout(() => item.remove(), 300);
        });
    });
}

function startChatPolling() {
    chatPollInterval = setInterval(async () => {
        try {
            const response = await API.chats.getAll();
            renderChatList(response.data || response);
        } catch (error) {
            console.error('Chat polling error:', error);
        }
    }, 30000);
}

window.addEventListener('beforeunload', function() {
    if (chatPollInterval) {
        clearInterval(chatPollInterval);
    }
});

// Export Logs Handler
const exportButton = document.querySelector('button span[data-icon="export_notes"]');
if (exportButton) {
    exportButton.parentElement.addEventListener('click', function() {
        console.log('Exporting chat logs...');
    });
}

// Add Rule Handler
const addRuleButton = document.querySelector('button span[data-icon="add_moderator"]');
if (addRuleButton) {
    addRuleButton.parentElement.addEventListener('click', function() {
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
        icon.textContent = dataIcon.replace(/_/g, ' ');
    }
});