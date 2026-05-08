@extends('layouts.app')

@section('title', 'Roles & Permissions - System Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/roles-index.css') }}">
@endpush

@section('content')
<x-navbar />

<div class="p-8">
    <section class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-5xl font-light font-headline tracking-tight text-on-surface">Roles &amp; Permissions</h2>
            <p class="text-on-surface-variant mt-2 max-w-lg">Manage organizational hierarchies and granular access control for your workspace modules.</p>
        </div>
        <button onclick="openAddRoleModal()" class="bg-primary text-on-primary font-bold px-6 py-3 rounded-xl flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-lg">add</span>
            Add New Role
        </button>
    </section>

    <section class="grid grid-cols-1 gap-8 mb-12">
        <div class="bg-surface-container-low rounded-2xl overflow-hidden shadow-xl group transition-all duration-300 hover:-translate-y-1">
            <div class="p-6 border-b border-outline-variant/10 flex justify-between items-center">
                <h3 class="text-lg font-semibold font-headline">Active Directory</h3>
                <span class="text-xs text-on-surface-variant font-medium">{{ $roles->count() ?? 0 }} Total Roles</span>
            </div>
            <div class="overflow-x-auto">
                <table id="roles-table" class="w-full text-left">
                    <thead class="bg-surface-container/50 text-on-surface-variant text-[11px] uppercase tracking-widest font-bold">
                        <tr>
                            <th class="px-8 py-4">Role Name</th>
                            <th class="px-8 py-4">Users Assigned</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        @forelse($roles ?? [] as $role)
                        <tr class="hover:bg-surface-bright/20 transition-colors" onclick="selectRole({{ $role->id }})" style="cursor:pointer">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-8 bg-primary rounded-full"></div>
                                    <div>
                                        <p class="font-semibold text-on-surface">{{ $role->name }}</p>
                                        <p class="text-xs text-on-surface-variant">{{ $role->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex -space-x-2">
                                    @forelse($role->users->take(3) as $user)
                                    <img class="w-8 h-8 rounded-full border-2 border-surface-container-low" alt="Team member {{ $user->name }}" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=32" />
                                    @empty
                                    <span class="text-xs text-on-surface-variant">No users</span>
                                    @endforelse
                                    @if($role->users->count() > 3)
                                    <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface-container-low flex items-center justify-center text-[10px] font-bold">+{{ $role->users->count() - 3 }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase tracking-tighter">Active</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <button onclick="event.stopPropagation(); editRole({{ $role->id }})" class="p-2 hover:bg-surface-container rounded-lg text-slate-400 hover:text-primary transition-all">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                    <button onclick="event.stopPropagation(); deleteRole({{ $role->id }})" class="p-2 hover:bg-surface-container rounded-lg text-slate-400 hover:text-error transition-all">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-8 text-center text-on-surface-variant">No roles found. Create your first role to get started.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <section class="lg:col-span-2 space-y-6">
            <div class="bg-surface-container rounded-2xl p-8 shadow-lg relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-transparent"></div>
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="text-xl font-headline font-semibold">Permission Matrix</h3>
                        <p class="text-sm text-on-surface-variant">Select a role above to configure permissions</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="toggleAllPermissions()" class="text-xs font-bold text-primary px-4 py-2 bg-primary/5 rounded-lg border border-primary/10">SELECT ALL</button>
                    </div>
                </div>
                
                @if($permissions->count() > 0)
                <div class="space-y-4">
                    @foreach($permissions as $module => $perms)
                    <div class="permission-module mb-6">
                        <h4 class="text-sm font-bold uppercase text-on-surface-variant mb-3">{{ $module }}</h4>
                        <div class="space-y-2">
                            @foreach($perms as $perm)
                            <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-xl group hover:bg-surface-bright/10 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined">{{ getModuleIcon($module) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm">{{ $perm->name }}</p>
                                        <p class="text-xs text-on-surface-variant">{{ $perm->slug }}</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="permission-toggle sr-only peer" data-permission-id="{{ $perm->id }}" />
                                    <div class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-on-surface-variant">No permissions found. Run the permission seeder to create default permissions.</p>
                @endif
            </div>
        </section>

        <section class="space-y-8">
            <div class="bg-surface-container-low rounded-2xl p-6">
                <h3 class="font-headline font-semibold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">person_add</span>
                    Assign Users
                </h3>
                <div class="space-y-3 mb-6">
                    @if(isset($selectedRole) && $selectedRole->users->count() > 0)
                        @foreach($selectedRole->users as $user)
                        <div class="flex items-center justify-between p-3 bg-surface-container rounded-xl">
                            <div class="flex items-center gap-3">
                                <img class="w-8 h-8 rounded-full object-cover" alt="Team member {{ $user->name }}" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=32" />
                                <div>
                                    <p class="text-xs font-bold">{{ $user->name }}</p>
                                    <p class="text-[10px] text-on-surface-variant">{{ $user->email }}</p>
                                </div>
                            </div>
                            <button onclick="removeUserFromRole({{ $user->id }})" class="text-error hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-sm">close</span>
                            </button>
                        </div>
                        @endforeach
                    @else
                    <p class="text-xs text-on-surface-variant">Select a role to see assigned users</p>
                    @endif
                </div>
                <div class="relative">
                    <input id="user-search-input" class="w-full bg-surface-container border-none rounded-xl pl-4 pr-10 py-3 text-sm focus:ring-1 focus:ring-primary/50 placeholder:text-slate-500" placeholder="Search users to add..." type="text" />
                    <span class="material-symbols-outlined absolute right-3 top-3 text-slate-500">search</span>
                </div>
            </div>

            <div class="bg-surface-container-low rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline font-semibold flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary">history</span>
                        Security Log
                    </h3>
                    <a class="text-[10px] font-bold text-primary uppercase tracking-widest hover:underline" href="#">View All</a>
                </div>
                <div class="space-y-4">
                    <div class="flex gap-3 relative pb-4 after:absolute after:left-[7px] after:top-5 after:bottom-0 after:w-px after:bg-outline-variant/20">
                        <div class="w-4 h-4 rounded-full bg-primary mt-1 z-10 shadow-[0_0_8px_rgba(192,193,255,0.4)]"></div>
                        <div>
                            <p class="text-xs font-bold leading-tight">System initialized</p>
                            <p class="text-[10px] text-on-surface-variant mt-1">Role permissions loaded</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Add Role Modal -->
<div id="add-role-modal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center">
    <div class="bg-surface-container-low rounded-2xl p-8 w-full max-w-md">
        <h3 class="text-xl font-headline font-semibold mb-6">Add New Role</h3>
        <form onsubmit="createRole(event)">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Role Name</label>
                <input type="text" id="role-name-input" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50" required />
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Slug</label>
                <input type="text" id="role-slug-input" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/50" required />
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeAddRoleModal()" class="flex-1 py-3 bg-surface-container rounded-xl font-bold">Cancel</button>
                <button type="submit" class="flex-1 py-3 bg-primary text-on-primary-container rounded-xl font-bold">Create Role</button>
            </div>
        </form>
    </div>
</div>

@php
function getModuleIcon($module) {
    $icons = [
        'user' => 'person',
        'role' => 'groups',
        'client' => 'business',
        'project' => 'folder',
        'task' => 'task_alt',
        'file' => 'insert_drive_file',
        'billing' => 'payments',
        'chat' => 'chat',
        'announcement' => 'campaign',
        'report' => 'assessment',
        'settings' => 'settings',
    ];
    return $icons[$module] ?? 'extension';
}
@endphp

@push('scripts')
<script src="{{ asset('js/roles-index.js') }}"></script>
<script>
let selectedRoleId = null;

function selectRole(roleId) {
    selectedRoleId = roleId;
    document.querySelectorAll('tbody tr').forEach(row => {
        row.classList.remove('bg-primary/10');
    });
    event.target.closest('tr').classList.add('bg-primary/10');
}

function openAddRoleModal() {
    document.getElementById('add-role-modal').classList.remove('hidden');
}

function closeAddRoleModal() {
    document.getElementById('add-role-modal').classList.add('hidden');
    document.getElementById('role-name-input').value = '';
    document.getElementById('role-slug-input').value = '';
}

async function createRole(event) {
    event.preventDefault();
    const name = document.getElementById('role-name-input').value;
    const slug = document.getElementById('role-slug-input').value;
    
    try {
        await API.roles.create({ name, slug });
        closeAddRoleModal();
        window.location.reload();
    } catch (error) {
        alert('Failed to create role: ' + error.message);
    }
}

async function editRole(roleId) {
    window.location.href = '/roles/' + roleId;
}

async function deleteRole(roleId) {
    if (!confirm('Are you sure you want to delete this role?')) return;
    
    try {
        await API.roles.delete(roleId);
        window.location.reload();
    } catch (error) {
        alert(error.message);
    }
}

function toggleAllPermissions() {
    const checkboxes = document.querySelectorAll('.permission-toggle');
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    
    checkboxes.forEach(cb => {
        cb.checked = !allChecked;
        if (selectedRoleId) {
            API.roles.assignPermission(selectedRoleId, cb.dataset.permissionId);
        }
    });
}

async function removeUserFromRole(userId) {
    if (!selectedRoleId) {
        alert('Please select a role first');
        return;
    }
    alert('User removal not implemented yet');
}
</script>
@endpush
@endsection