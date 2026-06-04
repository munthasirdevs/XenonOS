/* Settings JS */
(function() {
    'use strict';
    
    window.switchTab = function(tabId) {
        document.querySelectorAll('.settings-content').forEach(function(p) {
            p.classList.add('hidden');
        });
        document.querySelectorAll('.settings-tab-btn').forEach(function(b) {
            b.classList.remove('active');
        });
        document.getElementById('panel-' + tabId).classList.remove('hidden');
        document.getElementById('panel-' + tabId).setAttribute('aria-selected', 'true');
        document.getElementById('tab-' + tabId).classList.add('active');
        document.getElementById('tab-' + tabId).setAttribute('aria-selected', 'true');
    };
    
    window.checkPasswordStrength = function(password) {
        var strength = 0;
        var text = 'Weak';
        var colorClass = 'text-rose-400';
        var barColor = 'bg-rose-400';
        
        if (password.length >= 8) strength += 25;
        if (password.length >= 12) strength += 10;
        if (/[a-z]/.test(password)) strength += 15;
        if (/[A-Z]/.test(password)) strength += 15;
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^a-zA-Z0-9]/.test(password)) strength += 20;
        
        if (strength >= 80) { text = 'Very Strong'; colorClass = 'text-emerald-400'; barColor = 'bg-emerald-400'; }
        else if (strength >= 60) { text = 'Strong'; colorClass = 'text-emerald-400'; barColor = 'bg-emerald-400'; }
        else if (strength >= 40) { text = 'Medium'; colorClass = 'text-amber-400'; barColor = 'bg-amber-400'; }
        else if (strength >= 20) { text = 'Weak'; colorClass = 'text-rose-400'; barColor = 'bg-rose-400'; }
        
        var container = document.getElementById('password-strength-container');
        var bar = document.getElementById('password-strength-bar');
        var textEl = document.getElementById('password-strength-text');
        var percentEl = document.getElementById('password-strength-percent');
        
        if (password.length > 0) {
            container.style.display = 'block';
            bar.style.width = strength + '%';
            bar.className = 'h-full transition-all duration-300 shadow-[0_0_8px_rgba(192,193,255,0.4)] ' + barColor;
            textEl.className = colorClass + ' text-[11px]';
            textEl.textContent = text;
            percentEl.textContent = strength + '%';
        } else {
            container.style.display = 'none';
        }
    };
    
    document.addEventListener('DOMContentLoaded', function() {
        var csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        
        document.querySelectorAll('.toggle-channel-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                fetch(this.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                });
            });
        });

        document.querySelectorAll('.notification-toggle').forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                var setting = this.dataset.setting;
                var value = this.checked ? 1 : 0;
                fetch(this.dataset.url || '/api/v1/settings/notification', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
                    body: JSON.stringify({ setting: setting, value: value })
                });
            });
        });

        var quietHoursForm = document.getElementById('quiet-hours-form');
        if (quietHoursForm) {
            quietHoursForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                fetch(this.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                }).then(function() { window.location.reload(); });
            });
        }

        var exportJsonBtn = document.getElementById('export-json');
        if (exportJsonBtn) {
            exportJsonBtn.addEventListener('click', function() {
                window.location.href = this.dataset.url || '/settings/export';
            });
        }

        var deleteAccountBtn = document.getElementById('delete-account-btn');
        var deleteAccountModal = document.getElementById('delete-account-modal');
        if (deleteAccountBtn && deleteAccountModal) {
            deleteAccountBtn.addEventListener('click', function() { 
                deleteAccountModal.classList.remove('hidden'); 
            });
            document.getElementById('cancel-delete').addEventListener('click', function() { 
                deleteAccountModal.classList.add('hidden'); 
            });
        }
    });
    
})();
