<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            if (!Schema::hasColumn('sessions', 'payload')) {
                $table->text('payload')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('sessions', 'id')) {
                $table->string('id', 255)->primary()->change();
            }
            if (!Schema::hasColumn('sessions', 'last_activity')) {
                $table->integer('last_activity')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        // no rollback needed
    }
};