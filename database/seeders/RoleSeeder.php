<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'slug' => 'super_admin'],
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Manager', 'slug' => 'manager'],
            ['name' => 'Staff', 'slug' => 'staff'],
            ['name' => 'Client', 'slug' => 'client'],
            ['name' => 'Viewer', 'slug' => 'viewer'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['slug' => $role['slug']],
                $role + ['created_at' => now(), 'updated_at' => now()]
            );
        }

        // Assign all permissions to super_admin role
        $superAdminRole = DB::table('roles')->where('slug', 'super_admin')->first();
        if ($superAdminRole) {
            $allPermissions = DB::table('permissions')->pluck('id')->toArray();
            foreach ($allPermissions as $permId) {
                DB::table('permission_role')->updateOrInsert(
                    ['role_id' => $superAdminRole->id, 'permission_id' => $permId],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }

        // Assign core permissions to admin role
        $adminRole = DB::table('roles')->where('slug', 'admin')->first();
        if ($adminRole) {
            $adminPermissions = DB::table('permissions')
                ->whereIn('slug', [
                    'client.view', 'client.create', 'client.update', 'client.delete',
                    'project.view', 'project.create', 'project.update', 'project.delete', 'project.assign',
                    'task.view', 'task.create', 'task.update', 'task.delete', 'task.assign',
                    'file.view', 'file.upload', 'file.update', 'file.delete',
                    'invoice.view', 'invoice.create', 'invoice.update', 'invoice.delete', 'invoice.send',
                    'payment.view', 'payment.create', 'payment.refund',
                    'billing.view',
                    'chat.view', 'chat.create', 'chat.send',
                    'announcement.view', 'announcement.create', 'announcement.update', 'announcement.delete',
                    'role.view', 'role.create', 'role.update', 'role.delete',
                    'report.view', 'report.create', 'report.export',
                    'setting.view', 'setting.update',
                    'subscription.view', 'subscription.create', 'subscription.manage',
                    'alert_rule.view', 'alert_rule.create', 'alert_rule.update', 'alert_rule.delete', 'alert_rule.execute',
                ])
                ->pluck('id')
                ->toArray();
            foreach ($adminPermissions as $permId) {
                DB::table('permission_role')->updateOrInsert(
                    ['role_id' => $adminRole->id, 'permission_id' => $permId],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }
}
