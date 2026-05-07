/*
 * Tasks Index Page JavaScript
 * Interactive functionality for the tasks index page
 */

document.addEventListener('DOMContentLoaded', function() {
    // ========================================
    // Select All Functionality
    // ========================================
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

    // Update select all when individual checkboxes change
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

    // ========================================
    // Search Functionality
    // ========================================
    const searchInput = document.getElementById('task-search');
    const taskRows = document.querySelectorAll('tbody tr');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();

            taskRows.forEach(function(row) {
                const taskName = row.querySelector('.text-on-surface.font-semibold');
                const projectName = row.querySelector('.text-outline.cursor-pointer');

                const taskText = taskName ? taskName.textContent.toLowerCase() : '';
                const projectText = projectName ? projectName.textContent.toLowerCase() : '';

                if (searchTerm === '' || taskText.includes(searchTerm) || projectText.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // ========================================
    // Filter Functionality
    // ========================================
    const filterProject = document.getElementById('filter-project');
    const filterStatus = document.getElementById('filter-status');
    const filterPriority = document.getElementById('filter-priority');

    function applyFilters() {
        const projectValue = filterProject ? filterProject.value.toLowerCase() : '';
        const statusValue = filterStatus ? filterStatus.value.toLowerCase() : '';
        const priorityValue = filterPriority ? filterPriority.value.toLowerCase() : '';

        taskRows.forEach(function(row) {
            let showRow = true;

            // Filter by project
            const projectCell = row.querySelector('.text-outline.cursor-pointer');
            if (projectCell && projectValue !== '' && projectValue !== 'all projects') {
                if (!projectCell.textContent.toLowerCase().includes(projectValue)) {
                    showRow = false;
                }
            }

            // Filter by status
            const statusCell = row.querySelector('[class*="bg-"][class*="container"]');
            if (statusCell && showRow && statusValue !== '' && statusValue !== 'any status') {
                const statusText = statusCell.textContent.toLowerCase().trim();
                if (!statusText.includes(statusValue)) {
                    showRow = false;
                }
            }

            // Filter by priority
            const cells = row.querySelectorAll('td');
            cells.forEach(function(cell) {
                const prioritySpan = cell.querySelector('[class*="bg-error"], [class*="bg-tertiary"], [class*="bg-surface"]');
                if (prioritySpan && showRow && priorityValue !== '' && priorityValue !== 'priority') {
                    const priorityText = prioritySpan.textContent.toLowerCase().trim();
                    if (!priorityText.includes(priorityValue)) {
                        showRow = false;
                    }
                }
            });

            row.style.display = showRow ? '' : 'none';
        });
    }

    if (filterProject) {
        filterProject.addEventListener('change', applyFilters);
    }
    if (filterStatus) {
        filterStatus.addEventListener('change', applyFilters);
    }
    if (filterPriority) {
        filterPriority.addEventListener('change', applyFilters);
    }

    // ========================================
    // Bulk Actions
    // ========================================
    const bulkArchiveBtn = document.querySelector('button:contains("Bulk Archive")');
    const bulkDeleteBtn = document.querySelector('button:contains("Bulk Delete")');

    function handleBulkAction(action) {
        const selectedTasks = Array.from(taskCheckboxes).filter(function(cb) {
            return cb.checked;
        });

        if (selectedTasks.length === 0) {
            alert('Please select at least one task to ' + action.toLowerCase() + '.');
            return;
        }

        // In a real application, this would make an AJAX request
        console.log(action + ' ' + selectedTasks.length + ' task(s)');

        if (action === 'Delete') {
            if (confirm('Are you sure you want to delete the selected task(s)?')) {
                selectedTasks.forEach(function(checkbox) {
                    const row = checkbox.closest('tr');
                    if (row) {
                        row.remove();
                    }
                });
            }
        }
    }

    // Note: These would need proper event listeners in production
    // bulkArchiveBtn.addEventListener('click', handleBulkAction.bind(null, 'Archive'));
    // bulkDeleteBtn.addEventListener('click', handleBulkAction.bind(null, 'Delete'));

    // ========================================
    // Pagination
    // ========================================
    const paginationButtons = document.querySelectorAll('.flex.items-center.gap-1 button:not([disabled])');

    paginationButtons.forEach(function(button) {
        if (!button.querySelector('span')) {
            button.addEventListener('click', function() {
                // Remove active state from all number buttons
                document.querySelectorAll('.flex.items-center.gap-1 button.h-8').forEach(function(btn) {
                    btn.classList.remove('bg-primary/20', 'text-primary', 'font-bold');
                    btn.classList.add('text-outline', 'font-medium');
                });

                // Add active state to clicked button
                if (this.classList.contains('h-8')) {
                    this.classList.remove('text-outline', 'font-medium');
                    this.classList.add('bg-primary/20', 'text-primary', 'font-bold');
                }

                // In production, this would load the appropriate page
                console.log('Loading page...');
            });
        }
    });

    // ========================================
    // Row Actions (Edit/Delete)
    // ========================================
    const editButtons = document.querySelectorAll('button span + .material-symbols-outlined');
    const moreButtons = document.querySelectorAll('button span + .material-symbols-outlined');

    // Note: In production, these would open modals or navigate to edit pages
    console.log('Tasks index page initialized');
});
