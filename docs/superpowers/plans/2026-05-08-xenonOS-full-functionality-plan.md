# XenonOS Full Functionality Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Make Chat, Tasks, and Roles systems fully functional with real API data binding, CRUD operations, and proper dynamic functionality

**Architecture:** JavaScript API service fetches data from existing API endpoints, controllers pass data to Blade views, real-time events for chat

**Tech Stack:** Laravel 12.x, PHP 8.2, JavaScript (vanilla), MySQL

---

## File Structure Summary

| File | Action |
|------|--------|
| `routes/web.php` | Already updated - has routes |
| `app/Http/Controllers/Web/*.php` | Already created |
| `public/js/api.js` | Already created |
| `public/js/communication-index.js` | Needs update for API calls |
| `public/js/tasks-index.js` | Needs update for API calls |
| `public/js/roles-index.js` | Needs update for API calls |
| `app/Events/ChatMessageSent.php` | Already created |
| `app/Http/Controllers/Api/ChatController.php` | Already updated |

**Already Complete:**
- ✅ Web Routes for /communication, /tasks, /roles, /projects
- ✅ Web Controllers (CommunicationController, TaskController, RoleController, ProjectController)
- ✅ JavaScript API service (api.js)
- ✅ ChatMessageSent event for broadcasting
- ✅ Navbar links updated
- ✅ ChatController updated to fire event

---

## Task 1: Update Communication Index with Real API Data

**Files:**
- Modify: `public/js/communication-index.js:1-100`

- [ ] **Step 1: Replace communication-index.js with API-enabled version**

```javascript
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
        console.log('Chat table not found, rendering inline');
        renderInlineChats(chats);
        return;
    }
    
    tbody.innerHTML = chats.map(chat => {
        const lastMessage = chat.messages?.[0]?.message || 'No messages yet';
        const participants = chat.users?.map(u => u.name).join(', ') || 'No participants';
        
        return `
            <tr class="group hover:bg-surface-bright/30 transition-colors cursor-pointer" 
                onclick="window.location.href='/communication/${chat.id}'">
                <td class="px-8 py-5">
                    <div class="flex -space-x-2">
                        ${chat.users?.slice(0, 3).map(u => `
                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low"
                                src="https://ui-avatars.com/api/?name=${encodeURIComponent(u.name)}&background=c0c1ff&color=1a1a2e&size=32" />
                        `).join('')}
                        ${chat.users?.length > 3 ? `
                            <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">
                                +${chat.users.length - 3}
                            </div>
                        ` : ''}
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
        button.addEventListener('click', async function(e) {
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

const API = window.API;
```

- [ ] **Step 2: Test PHP syntax**

Run: `php -l "C:\xampp\htdocs\xenonOS\public\js\communication-index.js"`
Expected: No output (JS files don't need PHP syntax check)

---

## Task 2: Update Tasks Index with Real API Data

**Files:**
- Modify: `public/js/tasks-index.js:1-192`

- [ ] **Step 1: Replace tasks-index.js with API-enabled version**

```javascript
/**
 * Tasks Index Page JavaScript
 * Full API integration with CRUD operations
 */

let currentPage = 1;
let taskFilters = {
    status: '',
    priority: '',
    project_id: '',
    q: ''
};

document.addEventListener('DOMContentLoaded', function() {
    initTaskList();
    initFilters();
    initBulkActions();
});

async function initTaskList() {
    try {
        showLoadingState();
        const response = await API.tasks.getAll(taskFilters);
        renderTasks(response.data || response);
        renderPagination(response);
    } catch (error) {
        console.error('Failed to load tasks:', error);
        showErrorState(error.message);
    }
}

function renderTasks(tasks) {
    const tbody = document.querySelector('#tasks-table tbody');
    if (!tbody) {
        renderInlineTasks(tasks);
        return;
    }
    
    tbody.innerHTML = tasks.map(task => {
        const statusClass = getStatusClass(task.status);
        const priorityClass = getPriorityClass(task.priority);
        const dueDate = task.due_date ? new Date(task.due_date).toLocaleDateString() : '-';
        
        return `
            <tr class="group hover:bg-surface-bright/30 transition-colors" data-task-id="${task.id}">
                <td class="px-6 py-5">
                    <input type="checkbox" class="task-checkbox rounded bg-surface-container border-outline-variant/30 text-primary focus:ring-primary h-4 w-4" 
                        data-id="${task.id}" />
                </td>
                <td class="px-6 py-5 cursor-pointer" onclick="viewTask(${task.id})">
                    <div class="flex flex-col">
                        <span class="text-on-surface font-semibold text-sm group-hover:text-primary transition-colors">
                            ${task.title}
                        </span>
                        <span class="text-xs text-outline cursor-pointer hover:underline">
                            ${task.project?.name || 'No Project'}
                        </span>
                    </div>
                </td>
                <td class="px-6 py-5">
                    <div class="flex -space-x-2">
                        ${task.assignee ? `
                            <img class="h-7 w-7 rounded-full border border-surface"
                                src="https://ui-avatars.com/api/?name=${encodeURIComponent(task.assignee.name)}&background=c0c1ff&color=1a1a2e&size=28" />
                        ` : '<span class="text-xs text-outline">Unassigned</span>'}
                    </div>
                </td>
                <td class="px-6 py-5">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider ${statusClass}">
                        ${task.status.replace('_', ' ')}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider ${priorityClass}">
                        ${task.priority}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <span class="text-sm text-on-surface-variant">${dueDate}</span>
                </td>
                <td class="px-6 py-5 text-right">
                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="p-2 text-outline hover:text-primary transition-colors" onclick="editTask(event, ${task.id})">
                            <span class="material-symbols-outlined text-lg">edit</span>
                        </button>
                        <button class="p-2 text-outline hover:text-error transition-colors" onclick="deleteTask(event, ${task.id})">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    }).join('');
}

function renderInlineTasks(tasks) {
    const rows = document.querySelectorAll('tbody tr');
    if (rows.length === 0) return;
    
    tasks.forEach((task, index) => {
        if (rows[index]) {
            const titleCell = rows[index].querySelector('.text-on-surface.font-semibold');
            if (titleCell) titleCell.textContent = task.title;
        }
    });
}

function getStatusClass(status) {
    const classes = {
        'done': 'bg-tertiary-container/20 text-tertiary',
        'in_progress': 'bg-secondary-container/30 text-secondary',
        'review': 'bg-tertiary-container/20 text-tertiary',
        'todo': 'bg-surface-container-highest text-outline'
    };
    return classes[status] || classes['todo'];
}

function getPriorityClass(priority) {
    const classes = {
        'high': 'bg-error-container/20 text-error',
        'medium': 'bg-tertiary-container/20 text-tertiary',
        'low': 'bg-surface-container-highest text-outline'
    };
    return classes[priority] || classes['medium'];
}

function initFilters() {
    const searchInput = document.getElementById('task-search');
    const filterProject = document.getElementById('filter-project');
    const filterStatus = document.getElementById('filter-status');
    const filterPriority = document.getElementById('filter-priority');
    
    const debouncedSearch = debounce(async (value) => {
        taskFilters.q = value;
        await initTaskList();
    }, 300);
    
    if (searchInput) {
        searchInput.addEventListener('input', (e) => debouncedSearch(e.target.value));
    }
    
    if (filterProject) {
        filterProject.addEventListener('change', async (e) => {
            taskFilters.project_id = e.target.value;
            await initTaskList();
        });
    }
    
    if (filterStatus) {
        filterStatus.addEventListener('change', async (e) => {
            taskFilters.status = e.target.value;
            await initTaskList();
        });
    }
    
    if (filterPriority) {
        filterPriority.addEventListener('change', async (e) => {
            taskFilters.priority = e.target.value;
            await initTaskList();
        });
    }
}

function initBulkActions() {
    const selectAllCheckbox = document.getElementById('select-all-tasks');
    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', (e) => {
            const checkboxes = document.querySelectorAll('.task-checkbox');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });
    }
}

async function viewTask(taskId) {
    window.location.href = `/tasks/${taskId}`;
}

async function editTask(event, taskId) {
    event.stopPropagation();
    window.location.href = `/tasks/${taskId}`;
}

async function deleteTask(event, taskId) {
    event.stopPropagation();
    if (!confirm('Are you sure you want to delete this task?')) return;
    
    try {
        await API.tasks.delete(taskId);
        await initTaskList();
    } catch (error) {
        alert('Failed to delete task: ' + error.message);
    }
}

function showLoadingState() {
    const tbody = document.querySelector('#tasks-table tbody');
    if (tbody) {
        tbody.innerHTML = '<tr><td colspan="7" class="px-6 py-8 text-center">Loading...</td></tr>';
    }
}

function showErrorState(message) {
    const tbody = document.querySelector('#tasks-table tbody');
    if (tbody) {
        tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-8 text-center text-error">${message}</td></tr>`;
    }
}

function renderPagination(response) {
    const paginationContainer = document.querySelector('.flex.items-center.gap-1');
    if (!paginationContainer || !response.meta) return;
    
    const { current_page, last_page } = response.meta;
    let html = '';
    
    html += `<button class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline" ${current_page === 1 ? 'disabled' : ''} onclick="changePage(${current_page - 1})">
        <span class="material-symbols-outlined text-sm">chevron_left</span>
    </button>`;
    
    for (let i = 1; i <= last_page; i++) {
        const activeClass = i === current_page ? 'bg-primary/20 text-primary font-bold' : 'text-outline font-medium';
        html += `<button class="h-8 w-8 rounded-lg hover:bg-surface-container-highest ${activeClass}" onclick="changePage(${i})">${i}</button>`;
    }
    
    html += `<button class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline" ${current_page === last_page ? 'disabled' : ''} onclick="changePage(${current_page + 1})">
        <span class="material-symbols-outlined text-sm">chevron_right</span>
    </button>`;
    
    paginationContainer.innerHTML = html;
}

async function changePage(page) {
    currentPage = page;
    await initTaskList();
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

const API = window.API;
```

---

## Task 3: Update Roles Index with Real API Data

**Files:**
- Modify: `public/js/roles-index.js:1-188`

- [ ] **Step 1: Replace roles-index.js with API-enabled version**

```javascript
/**
 * Roles Index Page JavaScript
 * Full API integration for roles and permissions management
 */

let currentRoleId = null;
let currentPermissions = [];

document.addEventListener('DOMContentLoaded', function() {
    initRolesList();
    initPermissionMatrix();
    initRoleActions();
});

async function initRolesList() {
    try {
        const response = await API.roles.getAll();
        renderRoles(response.data || response);
        loadPermissionModules();
    } catch (error) {
        console.error('Failed to load roles:', error);
    }
}

function renderRoles(roles) {
    const tbody = document.querySelector('#roles-table tbody');
    if (!tbody) {
        renderInlineRoles(roles);
        return;
    }
    
    tbody.innerHTML = roles.map(role => {
        const isSelected = role.id === currentRoleId;
        const userCount = role.users?.length || 0;
        
        return `
            <tr class="hover:bg-surface-bright/20 transition-colors ${isSelected ? 'bg-primary/10' : ''}" 
                onclick="selectRole(${role.id})" style="cursor:pointer">
                <td class="px-8 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-8 ${isSelected ? 'bg-primary' : 'bg-tertiary'} rounded-full"></div>
                        <div>
                            <p class="font-semibold text-on-surface">${role.name}</p>
                            <p class="text-xs text-on-surface-variant">${role.slug}</p>
                        </div>
                    </div>
                </td>
                <td class="px-8 py-5">
                    <div class="flex -space-x-2">
                        ${role.users?.slice(0, 3).map(u => `
                            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low"
                                src="https://ui-avatars.com/api/?name=${encodeURIComponent(u.name)}&background=random&size=32" />
                        `).join('')}
                        ${userCount > 3 ? `
                            <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface-container-low flex items-center justify-center text-[10px] font-bold">
                                +${userCount - 3}
                            </div>
                        ` : ''}
                    </div>
                </td>
                <td class="px-8 py-5">
                    <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase">
                        Active
                    </span>
                </td>
                <td class="px-8 py-5 text-right">
                    <div class="flex justify-end gap-2">
                        <button class="p-2 hover:bg-surface-container rounded-lg" onclick="event.stopPropagation(); editRole(${role.id})">
                            <span class="material-symbols-outlined text-lg">edit</span>
                        </button>
                        <button class="p-2 hover:bg-surface-container rounded-lg text-error" onclick="event.stopPropagation(); deleteRole(${role.id})">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    }).join('');
}

function renderInlineRoles(roles) {
    const rows = document.querySelectorAll('tbody tr');
    if (rows.length === 0) return;
    
    roles.forEach((role, index) => {
        if (rows[index]) {
            const nameCell = rows[index].querySelector('.font-semibold');
            if (nameCell) nameCell.textContent = role.name;
        }
    });
}

async function loadPermissionModules() {
    try {
        const response = await API.permissions.getByModule();
        renderPermissionMatrix(response);
    } catch (error) {
        console.error('Failed to load permissions:', error);
    }
}

function renderPermissionMatrix(permissionsByModule) {
    const container = document.querySelector('.space-y-4');
    if (!container) return;
    
    let html = '';
    
    Object.entries(permissionsByModule).forEach(([module, permissions]) => {
        html += `
            <div class="permission-module mb-6">
                <h4 class="text-sm font-bold uppercase text-on-surface-variant mb-3">${module}</h4>
                <div class="space-y-2">
                    ${permissions.map(perm => `
                        <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-xl">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center">
                                    <span class="material-symbols-outlined">${getModuleIcon(module)}</span>
                                </div>
                                <div>
                                    <p class="font-bold text-sm">${perm.name}</p>
                                    <p class="text-xs text-on-surface-variant">${perm.slug}</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="permission-toggle sr-only peer" 
                                    data-permission-id="${perm.id}" />
                                <div class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full 
                                    peer-checked:after:translate-x-full peer-checked:after:border-white 
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                    after:bg-white after:border-gray-300 after:border after:rounded-full 
                                    after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
    initPermissionToggles();
}

function getModuleIcon(module) {
    const icons = {
        user: 'person',
        role: 'groups',
        client: 'business',
        project: 'folder',
        task: 'task_alt',
        file: 'insert_drive_file',
        billing: 'payments',
        chat: 'chat',
        announcement: 'campaign',
        report: 'assessment',
        settings: 'settings'
    };
    return icons[module] || 'extension';
}

async function selectRole(roleId) {
    currentRoleId = roleId;
    
    try {
        const response = await API.roles.getPermissions(roleId);
        currentPermissions = response.data || response;
        
        document.querySelectorAll('.permission-toggle').forEach(toggle => {
            const permId = parseInt(toggle.dataset.permissionId);
            toggle.checked = currentPermissions.some(p => p.id === permId);
        });
        
        await initRolesList();
    } catch (error) {
        console.error('Failed to load role permissions:', error);
    }
}

function initPermissionToggles() {
    const toggles = document.querySelectorAll('.permission-toggle');
    
    toggles.forEach(toggle => {
        toggle.addEventListener('change', async () => {
            if (!currentRoleId) {
                alert('Please select a role first');
                toggle.checked = !toggle.checked;
                return;
            }
            
            const permissionId = toggle.dataset.permissionId;
            
            try {
                if (toggle.checked) {
                    await API.roles.assignPermission(currentRoleId, permissionId);
                } else {
                    await API.roles.syncPermissions(currentRoleId, 
                        currentPermissions.map(p => p.id).filter(id => id != permissionId)
                    );
                }
                console.log('Permission updated');
            } catch (error) {
                console.error('Failed to update permission:', error);
                toggle.checked = !toggle.checked;
            }
        });
    });
}

async function editRole(roleId) {
    window.location.href = `/roles/${roleId}`;
}

async function deleteRole(roleId) {
    if (!confirm('Are you sure you want to delete this role?')) return;
    
    try {
        await API.roles.delete(roleId);
        await initRolesList();
    } catch (error) {
        alert(error.message);
    }
}

function initRoleActions() {
    const addButton = document.querySelector('button:has(.material-symbols-outlined)');
    if (addButton && addButton.textContent.includes('Add New Role')) {
        addButton.addEventListener('click', () => {
            const name = prompt('Enter role name:');
            if (!name) return;
            
            const slug = name.toLowerCase().replace(/\s+/g, '_');
            
            API.roles.create({ name, slug })
                .then(() => initRolesList())
                .catch(error => alert('Failed to create role: ' + error.message));
        });
    }
}

const API = window.API;
```

---

## Task 4: Update Layout for API Service

**Files:**
- Modify: `resources/views/layouts/app.blade.php`

- [ ] **Step 1: Add CSRF meta tag and load API service**

```php
<head>
    <!-- Existing meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
```

- [ ] **Step 2: Add API.js script before other scripts**

```php
@push('scripts')
<script src="{{ asset('js/api.js') }}"></script>
@endpush
```

---

## Task 5: Verify All Components Work Together

**Files:**
- Test all routes are accessible

- [ ] **Step 1: Verify communication route**

Test: Visit `/communication` in browser
Expected: Shows chat list from database

- [ ] **Step 2: Verify tasks route**

Test: Visit `/tasks` in browser
Expected: Shows tasks list from database

- [ ] **Step 3: Verify roles route**

Test: Visit `/roles` in browser
Expected: Shows roles and permissions from database

- [ ] **Step 4: Test API endpoints**

Run in browser console: `await API.tasks.getAll()`
Expected: Returns task data

---

## Execution Order

1. Task 1: Update communication-index.js with API
2. Task 2: Update tasks-index.js with API  
3. Task 3: Update roles-index.js with API
4. Task 4: Update layout for API service
5. Task 5: Verify all components work

---

## Notes

- API service (api.js) is already loaded globally
- Controllers pass data to views, JavaScript can also refresh data
- Real-time chat needs Laravel Reverb installation
- All existing API endpoints are already functional