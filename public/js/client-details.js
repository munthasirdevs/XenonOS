/* Client Details Page JS */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        var tabs = document.querySelectorAll('.client-tab');
        var panels = document.querySelectorAll('.client-panel');
        
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                var targetTab = this.getAttribute('data-tab');
                
                tabs.forEach(function(t) {
                    t.classList.remove('text-primary', 'font-bold', 'border-primary');
                    t.classList.add('text-on-surface-variant', 'font-medium');
                    t.setAttribute('aria-selected', 'false');
                });
                
                this.classList.remove('text-on-surface-variant', 'font-medium');
                this.classList.add('text-primary', 'font-bold', 'border-primary');
                this.setAttribute('aria-selected', 'true');
                
                panels.forEach(function(panel) {
                    if (panel.getAttribute('data-panel') === targetTab) {
                        panel.classList.remove('d-none');
                    } else {
                        panel.classList.add('d-none');
                    }
                });
            });
        });
        
        // File Upload Handler
        window.handleFileSelect = function(input) {
            var file = input.files[0];
            if (!file) return;
            
            var clientId = window.clientId || document.querySelector('main').getAttribute('data-client-id');
            var progressDiv = document.getElementById('upload-progress');
            var progressBar = document.getElementById('progress-bar');
            var uploadStatus = document.getElementById('upload-status');
            var uploadText = document.getElementById('upload-text');
            
            progressDiv.classList.remove('hidden');
            uploadText.textContent = 'Uploading ' + file.name + '...';
            progressBar.style.width = '30%';
            
            var formData = new FormData();
            formData.append('file', file);
            formData.append('title', file.name);
            
            fetch('/clients/' + clientId + '/documents', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                progressBar.style.width = '100%';
                uploadStatus.textContent = data.success ? 'Upload complete!' : 'Upload failed: ' + (data.message || 'Unknown error');
                
                if (data.success) {
                    var grid = document.getElementById('documents-grid');
                    var emptyDiv = grid.querySelector('.col-span-full');
                    if (emptyDiv) emptyDiv.remove();
                    
                    var doc = data.document;
                    var newDoc = document.createElement('div');
                    newDoc.className = 'bg-surface-container rounded-2xl p-4 hover:bg-surface-container-high transition-colors cursor-pointer';
                    newDoc.innerHTML = '<div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-3">' +
                        '<span class="material-symbols-outlined text-primary">description</span>' +
                        '</div>' +
                        '<p class="text-sm font-medium text-on-surface truncate">' + (doc.title || 'Document') + '</p>' +
                        '<p class="text-xs text-on-surface-variant">Just now</p>';
                    grid.insertBefore(newDoc, grid.firstChild);
                    
                    input.value = '';
                    uploadText.textContent = 'File uploaded successfully!';
                }
                
                setTimeout(function() {
                    progressDiv.classList.add('hidden');
                    uploadText.textContent = 'Drag & drop files here';
                    progressBar.style.width = '0%';
                }, 2000);
            })
            .catch(function(err) {
                progressBar.style.width = '100%';
                uploadStatus.textContent = 'Upload failed: Network error';
                setTimeout(function() {
                    progressDiv.classList.add('hidden');
                    progressBar.style.width = '0%';
                }, 3000);
            });
        };
    });
    
})();