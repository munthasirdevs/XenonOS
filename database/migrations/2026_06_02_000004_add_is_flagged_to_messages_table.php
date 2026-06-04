<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            if (!Schema::hasColumn('messages', 'is_flagged')) {
                $table->boolean('is_flagged')->default(false)->after('file_id');
                $table->index('is_flagged');
            }
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'is_flagged')) {
                $table->dropIndex(['is_flagged']);
                $table->dropColumn('is_flagged');
            }
        });
    }
};
