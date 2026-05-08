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
    if (typeof API === 'undefined') {
        console.log('API service not loaded');
        return;
    }
    
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
    
    if (!roles || roles.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="px-8 py-8 text-center text-on-surface-variant">No roles found</td></tr>';
        return;
    }
    
    tbody.innerHTML = roles.map(role => {
        const isSelected = role.id === currentRoleId;
        const userCount = role.users?.length || 0;
        
        const userAvatars = role.users?.slice(0, 3).map(u => `
            <img class="w-8 h-8 rounded-full border-2 border-surface-container-low"
                src="https://ui-avatars.com/api/?name=${encodeURIComponent(u.name)}&background=random&size=32" />
        `).join('') || '';
        
        const moreUsers = userCount > 3 ? `
            <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface-container-low flex items-center justify-center text-[10px] font-bold">
                +${userCount - 3}
            </div>
        ` : '';
        
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
                        ${userAvatars}
                        ${moreUsers}
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
    window.location.href = '/roles/' + roleId;
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
            
            API.roles.create({ name: name, slug: slug })
                .then(() => initRolesList())
                .catch(error => alert('Failed to create role: ' + error.message));
        });
    }
    
    const selectAllBtn = document.querySelector('button:text("SELECT ALL")');
    if (selectAllBtn) {
        selectAllBtn.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.permission-toggle');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            
            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
                const event = new Event('change', { bubbles: true });
                cb.dispatchEvent(event);
            });
            
            this.textContent = allChecked ? 'SELECT ALL' : 'DESELECT ALL';
        });
    }
    
    const removeButtons = document.querySelectorAll('button[aria-label^="Remove"]');
    removeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const userRow = e.target.closest('.flex.items-center.justify-between');
            const userName = userRow?.querySelector('.text-xs.font-bold')?.textContent;
            
            if (userName && confirm('Remove ' + userName + ' from this role?')) {
                console.log('Remove user:', userName);
                userRow.remove();
            }
        });
    });
}