/*
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
    if (typeof API === 'undefined') {
        console.log('API service not loaded');
        return;
    }
    
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
    
    if (!tasks || tasks.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="px-6 py-8 text-center text-on-surface-variant">No tasks found</td></tr>';
        return;
    }
    
    tbody.innerHTML = tasks.map(task => {
        const statusClass = getStatusClass(task.status);
        const priorityClass = getPriorityClass(task.priority);
        const dueDate = task.due_date ? new Date(task.due_date).toLocaleDateString() : '-';
        
        const assigneeHtml = task.assignee ? `
            <img class="h-7 w-7 rounded-full border border-surface"
                src="https://ui-avatars.com/api/?name=${encodeURIComponent(task.assignee.name)}&background=c0c1ff&color=1a1a2e&size=28" />
        ` : '<span class="text-xs text-outline">Unassigned</span>';
        
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
                        ${assigneeHtml}
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
    const taskCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            taskCheckboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });
    }
    
    taskCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(taskCheckboxes).every(function(cb) {
                return cb.checked;
            });
            const someChecked = Array.from(taskCheckboxes).some(function(cb) {
                return cb.checked;
            });
            
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            }
        });
    });
}

async function viewTask(taskId) {
    window.location.href = '/tasks/' + taskId;
}

async function editTask(event, taskId) {
    event.stopPropagation();
    window.location.href = '/tasks/' + taskId;
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
        tbody.innerHTML = '<tr><td colspan="7" class="px-6 py-8 text-center text-error">' + message + '</td></tr>';
    }
}

function renderPagination(response) {
    const paginationContainer = document.querySelector('.flex.items-center.gap-1');
    if (!paginationContainer || !response.meta) return;
    
    const currentPage = response.meta.current_page;
    const lastPage = response.meta.last_page;
    let html = '';
    
    html += '<button class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline" ' + (currentPage === 1 ? 'disabled' : '') + ' onclick="changePage(' + (currentPage - 1) + ')">';
    html += '<span class="material-symbols-outlined text-sm">chevron_left</span></button>';
    
    for (let i = 1; i <= lastPage; i++) {
        const activeClass = i === currentPage ? 'bg-primary/20 text-primary font-bold' : 'text-outline font-medium';
        html += '<button class="h-8 w-8 rounded-lg hover:bg-surface-container-highest ' + activeClass + '" onclick="changePage(' + i + ')">' + i + '</button>';
    }
    
    html += '<button class="p-1.5 rounded-lg hover:bg-surface-container-highest text-outline" ' + (currentPage === lastPage ? 'disabled' : '') + ' onclick="changePage(' + (currentPage + 1) + ')">';
    html += '<span class="material-symbols-outlined text-sm">chevron_right</span></button>';
    
    paginationContainer.innerHTML = html;
}

async function changePage(page) {
    currentPage = page;
    await initTaskList();
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction() {
        const context = this;
        const args = arguments;
        const later = function() {
            timeout = null;
            func.apply(context, args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
