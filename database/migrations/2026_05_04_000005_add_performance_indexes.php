<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        try {
            if ($this->tableExists('projects')) {
                DB::statement('CREATE INDEX IF NOT EXISTS idx_projects_status ON projects (status)');
                DB::statement('CREATE INDEX IF NOT EXISTS idx_projects_priority ON projects (priority)');
                DB::statement('CREATE INDEX IF NOT EXISTS idx_projects_client ON projects (client_id)');
            }
        } catch (\Exception $e) {}

        try {
            if ($this->tableExists('tasks')) {
                DB::statement('CREATE INDEX IF NOT EXISTS idx_tasks_status ON tasks (status)');
                DB::statement('CREATE INDEX IF NOT EXISTS idx_tasks_priority ON tasks (priority)');
                DB::statement('CREATE INDEX IF NOT EXISTS idx_tasks_assigned ON tasks (assigned_to)');
            }
        } catch (\Exception $e) {}

        try {
            if ($this->tableExists('payments')) {
                DB::statement('CREATE INDEX IF NOT EXISTS idx_payments_status ON payments (status)');
            }
        } catch (\Exception $e) {}

        try {
            if ($this->tableExists('invoices')) {
                DB::statement('CREATE INDEX IF NOT EXISTS idx_invoices_status ON invoices (status)');
                DB::statement('CREATE INDEX IF NOT EXISTS idx_invoices_client ON invoices (client_id)');
            }
        } catch (\Exception $e) {}

        try {
            if ($this->tableExists('client_activities')) {
                DB::statement('CREATE INDEX IF NOT EXISTS idx_client_activities_client ON client_activities (client_id)');
            }
        } catch (\Exception $e) {}
    }

    public function down(): void
    {
        $indexes = [
            'idx_projects_status', 'idx_projects_priority', 'idx_projects_client',
            'idx_tasks_status', 'idx_tasks_priority', 'idx_tasks_assigned',
            'idx_payments_status',
            'idx_invoices_status', 'idx_invoices_client',
            'idx_client_activities_client',
        ];

        foreach ($indexes as $index) {
            try {
                DB::statement("DROP INDEX IF EXISTS {$index}");
            } catch (\Exception $e) {}
        }
    }

    private function tableExists(string $table): bool
    {
        return DB::getSchemaBuilder()->hasTable($table);
    }
};