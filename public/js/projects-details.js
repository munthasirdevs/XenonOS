/* Projects Details Page JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initTasks();
        initAssets();
        initEditButton();
    });
    
    function initTasks() {
        var taskItems = document.querySelectorAll('.task-item');
        taskItems.forEach(function(task) {
            task.style.cursor = 'pointer';
            task.addEventListener('click', function() {
                console.log('View task details');
            });
        });
        
        var addTaskBtn = document.querySelector('button:has(.add_circle)');
        if (addTaskBtn) {
            addTaskBtn.addEventListener('click', function() {
                console.log('Add new task');
            });
        }
    }
    
    function initAssets() {
        var assetItems = document.querySelectorAll('.asset-item');
        assetItems.forEach(function(item) {
            item.addEventListener('click', function(e) {
                if (!e.target.closest('button')) {
                    console.log('View asset');
                }
            });
        });
        
        var downloadBtns = document.querySelectorAll('.asset-item button');
        downloadBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                console.log('Download asset');
            });
        });
        
        var uploadBtn = document.querySelector('button:has(.upload)');
        if (uploadBtn) {
            uploadBtn.addEventListener('click', function() {
                console.log('Upload files');
            });
        }
    }
    
    function initEditButton() {
        var editBtn = document.querySelector('button:has(.edit)');
        if (editBtn) {
            editBtn.addEventListener('click', function() {
                console.log('Edit project');
            });
        }
        
        var moreBtn = document.querySelector('.fa-more_vert');
        if (moreBtn) {
            moreBtn.addEventListener('click', function() {
                console.log('Show more options');
            });
        }
    }
    
})();