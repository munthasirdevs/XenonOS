<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create missing indexes using Schema builder (cross-DB compatible)
        Schema::table('projects', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableIndexes('projects');
            if (!isset($indexes['idx_projects_status'])) { $table->index('status', 'idx_projects_status'); }
            if (!isset($indexes['idx_projects_priority'])) { $table->index('priority', 'idx_projects_priority'); }
            if (!isset($indexes['idx_projects_client'])) { $table->index('client_id', 'idx_projects_client'); }
        });

        Schema::table('tasks', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableIndexes('tasks');
            if (!isset($indexes['idx_tasks_status'])) { $table->index('status', 'idx_tasks_status'); }
            if (!isset($indexes['idx_tasks_priority'])) { $table->index('priority', 'idx_tasks_priority'); }
            if (!isset($indexes['idx_tasks_assigned'])) { $table->index('assigned_to', 'idx_tasks_assigned'); }
        });

        Schema::table('payments', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableIndexes('payments');
            if (!isset($indexes['idx_payments_status'])) { $table->index('status', 'idx_payments_status'); }
        });

        Schema::table('invoices', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableIndexes('invoices');
            if (!isset($indexes['idx_invoices_status'])) { $table->index('status', 'idx_invoices_status'); }
            if (!isset($indexes['idx_invoices_client'])) { $table->index('client_id', 'idx_invoices_client'); }
        });

        Schema::table('client_activities', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableIndexes('client_activities');
            if (!isset($indexes['idx_client_activities_client'])) { $table->index('client_id', 'idx_client_activities_client'); }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex('idx_projects_status');
            $table->dropIndex('idx_projects_priority');
            $table->dropIndex('idx_projects_client');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex('idx_tasks_status');
            $table->dropIndex('idx_tasks_priority');
            $table->dropIndex('idx_tasks_assigned');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex('idx_payments_status');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropIndex('idx_invoices_status');
            $table->dropIndex('idx_invoices_client');
        });

        Schema::table('client_activities', function (Blueprint $table) {
            $table->dropIndex('idx_client_activities_client');
        });
    }
};