/* Files Page JS */
(function() {
    'use strict';
    
    window.openShareModal = function(fileId) {
        currentFileId = fileId;
        document.getElementById('share-modal').classList.remove('hidden');
        document.getElementById('share-options').classList.remove('hidden');
        document.getElementById('share-result').classList.add('hidden');
    };
    
    window.closeShareModal = function() {
        document.getElementById('share-modal').classList.add('hidden');
    };
    
    window.closeShareResult = function() {
        document.getElementById('share-options').classList.remove('hidden');
        document.getElementById('share-result').classList.add('hidden');
    };
    
    window.togglePasswordField = function() {
        document.getElementById('share-password').classList.toggle('hidden', !document.getElementById('share-password-enable').checked);
    };
    
    window.setAccess = function(access) {
        currentAccess = access;
        var viewBtn = document.getElementById('access-view');
        var dlBtn = document.getElementById('access-download');
        if (viewBtn && dlBtn) {
            viewBtn.className = access === 'view' ? 'flex-1 py-2 px-3 rounded-lg bg-primary text-on-primary text-sm font-medium' : 'flex-1 py-2 px-3 rounded-lg bg-surface-container-low text-on-surface-variant text-sm font-medium';
            dlBtn.className = access === 'download' ? 'flex-1 py-2 px-3 rounded-lg bg-primary text-on-primary text-sm font-medium' : 'flex-1 py-2 px-3 rounded-lg bg-surface-container-low text-on-surface-variant text-sm font-medium';
        }
    };
    
    window.generateShareLink = function() {
        var btn = document.getElementById('generate-btn');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = 'Generating...';
        }

        var expiration = document.getElementById('share-expiration')?.value || 'never';
        var password = document.getElementById('share-password-enable')?.checked ? document.getElementById('share-password')?.value : null;
        var views = document.getElementById('share-views')?.value || 'unlimited';

        fetch('/files/' + currentFileId + '/share', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ expiration: expiration, password: password, views_limit: views, access: currentAccess })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.success) {
                document.getElementById('share-link').value = data.share_url;
                document.getElementById('share-options').classList.add('hidden');
                document.getElementById('share-result').classList.remove('hidden');
            }
        })
        .finally(function() {
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = 'Generate Link';
            }
        });
    };
    
    window.copyShareLink = function() {
        var linkInput = document.getElementById('share-link');
        if (linkInput && linkInput.value) {
            navigator.clipboard.writeText(linkInput.value);
        }
    };
    
    var currentFileId = null;
    var currentAccess = 'view';
    
})();