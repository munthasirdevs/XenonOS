<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tasks table composite indexes
        Schema::table('tasks', function (Blueprint $table) {
            $table->index(['status', 'due_date'], 'tasks_status_due_date_idx');
            $table->index(['project_id', 'status'], 'tasks_project_status_idx');
        });

        // Activity logs indexes
        Schema::table('activity_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('activity_logs', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            }
            $table->index('user_id', 'activity_logs_user_idx');
            $table->index('action', 'activity_logs_action_idx');
            $table->index('created_at', 'activity_logs_created_idx');
            // entity_type/entity_id columns don't exist on activity_logs — index skipped
        });

        // Client activities indexes
        Schema::table('client_activities', function (Blueprint $table) {
            $table->index('created_at', 'client_activities_created_idx');
        });

        // Files table indexes
        Schema::table('files', function (Blueprint $table) {
            $table->index('created_by', 'files_created_by_idx');
            $table->index('created_at', 'files_created_idx');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex('tasks_status_due_date_idx');
            $table->dropIndex('tasks_project_status_idx');
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropIndex('activity_logs_user_idx');
            $table->dropIndex('activity_logs_action_idx');
            $table->dropIndex('activity_logs_created_idx');
            // activity_logs_entity_idx was never created — skip
        });

        Schema::table('client_activities', function (Blueprint $table) {
            $table->dropIndex('client_activities_created_idx');
        });

        Schema::table('files', function (Blueprint $table) {
            $table->dropIndex('files_created_by_idx');
            $table->dropIndex('files_created_idx');
        });
    }
};