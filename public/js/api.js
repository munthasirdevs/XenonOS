const API = {
    baseUrl: '/api/v1',

    async request(endpoint, options = {}) {
        const token = document.querySelector('meta[name="csrf-token"]')?.content;

        const response = await fetch(`${this.baseUrl}${endpoint}`, {
            ...options,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token,
                ...options.headers,
            },
            credentials: 'include',
            ...options,
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Request failed');
        }

        return data;
    },

    chats: {
        getAll() { return API.request('/chats'); },
        get(id) { return API.request(`/chats/${id}`); },
        create(data) { return API.request('/chats', { method: 'POST', body: JSON.stringify(data) }); },
        getMessages(chatId, page = 1) { return API.request(`/chats/${chatId}/messages?page=${page}`); },
        sendMessage(chatId, message) {
            return API.request(`/chats/${chatId}/messages`, {
                method: 'POST',
                body: JSON.stringify({ message })
            });
        },
    },

    tasks: {
        getAll(params = {}) {
            const query = new URLSearchParams(params).toString();
            return API.request(`/tasks${query ? '?' + query : ''}`);
        },
        get(id) { return API.request(`/tasks/${id}`); },
        create(data) { return API.request('/tasks', { method: 'POST', body: JSON.stringify(data) }); },
        update(id, data) { return API.request(`/tasks/${id}`, { method: 'PUT', body: JSON.stringify(data) }); },
        delete(id) { return API.request(`/tasks/${id}`, { method: 'DELETE' }); },
        updateStatus(id, status) {
            return API.request(`/tasks/${id}/status`, {
                method: 'POST',
                body: JSON.stringify({ status })
            });
        },
        assign(id, userId) {
            return API.request(`/tasks/${id}/assign`, {
                method: 'POST',
                body: JSON.stringify({ user_id: userId })
            });
        },
        analytics(projectId) {
            const qs = projectId ? `?project_id=${projectId}` : '';
            return API.request(`/tasks/analytics${qs}`);
        },
    },

    roles: {
        getAll() { return API.request('/roles'); },
        get(id) { return API.request(`/roles/${id}`); },
        create(data) { return API.request('/roles', { method: 'POST', body: JSON.stringify(data) }); },
        update(id, data) { return API.request(`/roles/${id}`, { method: 'PUT', body: JSON.stringify(data) }); },
        delete(id) { return API.request(`/roles/${id}`, { method: 'DELETE' }); },
        getPermissions(roleId) { return API.request(`/roles/${roleId}/permissions`); },
        assignPermission(roleId, permissionId) {
            return API.request(`/roles/${roleId}/permissions`, {
                method: 'POST',
                body: JSON.stringify({ permission_id: permissionId })
            });
        },
        syncPermissions(roleId, permissionIds) {
            return API.request(`/roles/${roleId}/permissions`, {
                method: 'PUT',
                body: JSON.stringify({ permissions: permissionIds })
            });
        },
    },

    users: {
        getAll() { return API.request('/users'); },
        getRoles(userId) { return API.request(`/users/${userId}/roles`); },
        assignRole(userId, roleId) {
            return API.request(`/users/${userId}/roles`, {
                method: 'POST',
                body: JSON.stringify({ role_id: roleId })
            });
        },
    },

    permissions: {
        getAll() { return API.request('/permissions'); },
        getByModule() { return API.request('/permissions/module/list'); },
    },

    projects: {
        getAll(params = {}) {
            const query = new URLSearchParams(params).toString();
            return API.request(`/projects${query ? '?' + query : ''}`);
        },
        get(id) { return API.request(`/projects/${id}`); },
    },
};

window.API = API;