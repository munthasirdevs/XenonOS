<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('client_invites', function (Blueprint $table) {
            $table->boolean('is_used')->default(false)->after('expires_at');
            $table->index('is_used');
        });
    }

    public function down(): void
    {
        Schema::table('client_invites', function (Blueprint $table) {
            $table->dropIndex(['is_used']);
            $table->dropColumn('is_used');
        });
    }
};