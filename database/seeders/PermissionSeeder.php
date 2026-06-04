<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // User Management
            ['name' => 'View Users', 'slug' => 'user.view'],
            ['name' => 'Create Users', 'slug' => 'user.create'],
            ['name' => 'Update Users', 'slug' => 'user.update'],
            ['name' => 'Delete Users', 'slug' => 'user.delete'],
            
            // Role Management
            ['name' => 'View Roles', 'slug' => 'role.view'],
            ['name' => 'Create Roles', 'slug' => 'role.create'],
            ['name' => 'Update Roles', 'slug' => 'role.update'],
            ['name' => 'Delete Roles', 'slug' => 'role.delete'],
            
            // Client Management
            ['name' => 'View Clients', 'slug' => 'client.view'],
            ['name' => 'Create Clients', 'slug' => 'client.create'],
            ['name' => 'Update Clients', 'slug' => 'client.update'],
            ['name' => 'Delete Clients', 'slug' => 'client.delete'],
            
            // Project Management
            ['name' => 'View Projects', 'slug' => 'project.view'],
            ['name' => 'Create Projects', 'slug' => 'project.create'],
            ['name' => 'Update Projects', 'slug' => 'project.update'],
            ['name' => 'Delete Projects', 'slug' => 'project.delete'],
            ['name' => 'Assign Projects', 'slug' => 'project.assign'],
            
            // Task Management
            ['name' => 'View Tasks', 'slug' => 'task.view'],
            ['name' => 'Create Tasks', 'slug' => 'task.create'],
            ['name' => 'Update Tasks', 'slug' => 'task.update'],
            ['name' => 'Delete Tasks', 'slug' => 'task.delete'],
            ['name' => 'Assign Tasks', 'slug' => 'task.assign'],
            
            // File Management
            ['name' => 'View Files', 'slug' => 'file.view'],
            ['name' => 'Upload Files', 'slug' => 'file.upload'],
            ['name' => 'Update Files', 'slug' => 'file.update'],
            ['name' => 'Delete Files', 'slug' => 'file.delete'],
            
            // Billing
            ['name' => 'View Billing', 'slug' => 'billing.view'],
            ['name' => 'Create Invoices', 'slug' => 'invoice.create'],
            ['name' => 'Update Invoices', 'slug' => 'invoice.update'],
            ['name' => 'Delete Invoices', 'slug' => 'invoice.delete'],
            ['name' => 'Send Invoices', 'slug' => 'invoice.send'],
            ['name' => 'View Payments', 'slug' => 'payment.view'],
            ['name' => 'Create Payments', 'slug' => 'payment.create'],
            ['name' => 'Refund Payments', 'slug' => 'payment.refund'],
            
            // Communication
            ['name' => 'View Chat', 'slug' => 'chat.view'],
            ['name' => 'Create Chat', 'slug' => 'chat.create'],
            ['name' => 'Send Messages', 'slug' => 'chat.send'],
            ['name' => 'View Announcements', 'slug' => 'announcement.view'],
            ['name' => 'Create Announcements', 'slug' => 'announcement.create'],
            ['name' => 'Update Announcements', 'slug' => 'announcement.update'],
            ['name' => 'Delete Announcements', 'slug' => 'announcement.delete'],
            
            // Reports
            ['name' => 'View Reports', 'slug' => 'report.view'],
            ['name' => 'Create Reports', 'slug' => 'report.create'],
            ['name' => 'Export Reports', 'slug' => 'report.export'],

            // Subscriptions
            ['name' => 'View Subscriptions', 'slug' => 'subscription.view'],
            ['name' => 'Create Subscriptions', 'slug' => 'subscription.create'],
            ['name' => 'Manage Subscriptions', 'slug' => 'subscription.manage'],

            // API Keys
            ['name' => 'View API Keys', 'slug' => 'api_key.view'],
            ['name' => 'Create API Keys', 'slug' => 'api_key.create'],

            // Alert Rules
            ['name' => 'View Alert Rules', 'slug' => 'alert_rule.view'],
            ['name' => 'Create Alert Rules', 'slug' => 'alert_rule.create'],
            ['name' => 'Update Alert Rules', 'slug' => 'alert_rule.update'],
            ['name' => 'Delete Alert Rules', 'slug' => 'alert_rule.delete'],
            ['name' => 'Execute Alert Rules', 'slug' => 'alert_rule.execute'],
            
            // Settings
            ['name' => 'View Settings', 'slug' => 'setting.view'],
            ['name' => 'Create Settings', 'slug' => 'setting.create'],
            ['name' => 'Update Settings', 'slug' => 'setting.update'],
            ['name' => 'Delete Settings', 'slug' => 'setting.delete'],
            ['name' => 'System Settings', 'slug' => 'setting.system'],
        ];

        foreach ($permissions as $perm) {
            DB::table('permissions')->updateOrInsert(
                ['slug' => $perm['slug']],
                $perm + ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}