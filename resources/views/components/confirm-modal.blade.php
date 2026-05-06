<style>
    #confirm-modal.hidden {
        display: none !important;
    }
</style>

<div id="confirm-modal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4">
    <div class="bg-surface-container border border-white/10 rounded-3xl p-6 sm:p-8 max-w-md w-full">
        <div class="flex items-center gap-4 mb-4">
            <div id="confirm-icon" class="w-12 h-12 rounded-2xl bg-surface-container-high flex items-center justify-center">
                <span id="confirm-icon-content" class="material-symbols-outlined text-primary text-2xl">help</span>
            </div>
            <div>
                <h3 id="confirm-title" class="text-xl font-bold text-on-surface">Confirm Action</h3>
                <p id="confirm-subtitle" class="text-sm text-on-surface-variant">Are you sure?</p>
            </div>
        </div>
        <p id="confirm-message" class="text-sm text-on-surface-variant mb-6">This action cannot be undone.</p>
        <div class="flex gap-3">
            <button type="button" onclick="closeConfirmModal()" class="flex-1 p-3 bg-surface-container text-on-surface rounded-xl font-bold text-sm hover:bg-surface-container-high">Cancel</button>
            <button type="button" id="confirm-action-btn" class="flex-1 p-3 bg-primary text-on-primary rounded-xl font-bold text-sm hover:opacity-90">Confirm</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/swal-custom.js') }}"></script>

<script>
    let confirmCallback = null;

    function showConfirm(options) {
        const modal = document.getElementById('confirm-modal');
        const title = document.getElementById('confirm-title');
        const subtitle = document.getElementById('confirm-subtitle');
        const message = document.getElementById('confirm-message');
        const icon = document.getElementById('confirm-icon-content');
        const iconContainer = document.getElementById('confirm-icon');
        const actionBtn = document.getElementById('confirm-action-btn');

        title.textContent = options.title || 'Confirm Action';
        subtitle.textContent = options.subtitle || '';
        message.textContent = options.message || 'This action cannot be undone.';
        confirmCallback = options.onConfirm;

        const icons = {
            danger: { icon: 'warning', color: 'text-rose-400', bg: 'bg-rose-400/10' },
            warning: { icon: 'warning', color: 'text-amber-400', bg: 'bg-amber-400/10' },
            info: { icon: 'info', color: 'text-primary', bg: 'bg-primary/10' },
            success: { icon: 'check_circle', color: 'text-emerald-400', bg: 'bg-emerald-400/10' },
            link: { icon: 'link', color: 'text-primary', bg: 'bg-primary/10' },
            copy: { icon: 'content_copy', color: 'text-blue-400', bg: 'bg-blue-400/10' },
            delete: { icon: 'delete', color: 'text-rose-400', bg: 'bg-rose-400/10' },
        };

        const style = icons[options.type] || icons.info;
        icon.textContent = style.icon;
        iconContainer.className = `w-12 h-12 rounded-2xl ${style.bg} flex items-center justify-center`;
        iconContainer.querySelector('span').className = `material-symbols-outlined ${style.color} text-2xl`;

        actionBtn.className = options.danger 
            ? 'flex-1 p-3 bg-rose-500 text-white rounded-xl font-bold text-sm hover:bg-rose-600'
            : 'flex-1 p-3 bg-primary text-on-primary rounded-xl font-bold text-sm hover:opacity-90';

        actionBtn.textContent = options.confirmText || 'Confirm';
        modal.classList.remove('hidden');

        actionBtn.onclick = function() {
            if (confirmCallback) confirmCallback();
            closeConfirmModal();
        };
    }

    function closeConfirmModal() {
        document.getElementById('confirm-modal').classList.add('hidden');
        confirmCallback = null;
    }
</script>