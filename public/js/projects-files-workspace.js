/* Project Files Workspace JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        initFiles();
        initUpload();
    });
    
    function initFiles() {
        var files = document.querySelectorAll('.file-item');
        files.forEach(function(file) {
            file.style.cursor = 'pointer';
            file.addEventListener('click', function() {
                console.log('View file');
            });
        });
        
        var folders = document.querySelectorAll('.folder-item');
        folders.forEach(function(folder) {
            folder.style.cursor = 'pointer';
            folder.addEventListener('click', function() {
                console.log('Open folder');
            });
        });
    }
    
    function initUpload() {
        var dropZone = document.querySelector('.file-drop-zone');
        if (dropZone) {
            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropZone.classList.add('drag-over');
            });
            
            dropZone.addEventListener('dragleave', function() {
                dropZone.classList.remove('drag-over');
            });
            
            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
                console.log('Files dropped');
            });
        }
    }
    
})();