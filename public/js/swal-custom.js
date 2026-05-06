// SweetAlert2 Custom Alerts for XenonOS
// Dark theme configuration

const SwalCustom = {
    dark: {
        background: '#1c1c1c',
        color: '#fff',
        confirmButtonColor: '#6366f1',
        cancelButtonColor: '#4b5563',
        timerProgressBar: true,
        timerProgressBarColor: '#6366f1'
    },

    // Show success alert
    success: function(title, text, timer = 2000) {
        return Swal.fire({
            icon: 'success',
            title: title || 'Success',
            text: text || '',
            timer: timer,
            showConfirmButton: false,
            ...this.dark
        });
    },

    // Show error alert
    error: function(title, text, timer = 3000) {
        return Swal.fire({
            icon: 'error',
            title: title || 'Error',
            text: text || '',
            timer: timer,
            showConfirmButton: false,
            ...this.dark
        });
    },

    // Show warning alert
    warning: function(title, text, timer = 3000) {
        return Swal.fire({
            icon: 'warning',
            title: title || 'Warning',
            text: text || '',
            timer: timer,
            showConfirmButton: false,
            ...this.dark
        });
    },

    // Show info alert
    info: function(title, text, timer = 3000) {
        return Swal.fire({
            icon: 'info',
            title: title || 'Info',
            text: text || '',
            timer: timer,
            showConfirmButton: false,
            ...this.dark
        });
    },

    // Show confirmation dialog
    confirm: function(options) {
        return Swal.fire({
            title: options.title || 'Confirm Action',
            text: options.text || 'Are you sure?',
            icon: options.icon || 'question',
            showCancelButton: true,
            confirmButtonText: options.confirmText || 'Confirm',
            cancelButtonText: options.cancelText || 'Cancel',
            confirmButtonColor: options.danger ? '#f43f5e' : '#6366f1',
            cancelButtonColor: '#4b5563',
            ...this.dark
        }).then((result) => {
            if (result.isConfirmed && options.onConfirm) {
                options.onConfirm();
            }
        });
    },

    // Show toast notification
    toast: function(icon, title, timer = 3000) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: icon,
            title: title,
            timer: timer,
            showConfirmButton: false,
            timerProgressBar: true,
            ...this.dark
        });
        return Toast.fire();
    },

    // Copy to clipboard with notification
    copyToClipboard: function(text, successMsg = 'Copied to clipboard!') {
        return navigator.clipboard.writeText(text).then(() => {
            this.success('Copied!', successMsg);
        }).catch(() => {
            this.error('Failed', 'Could not copy to clipboard');
        });
    }
};

// Export for use in other files
window.SwalCustom = SwalCustom;