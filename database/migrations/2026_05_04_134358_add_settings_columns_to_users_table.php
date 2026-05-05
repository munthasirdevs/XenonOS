<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'two_factor_secret')) {
                $table->string('two_factor_secret')->nullable()->after('quiet_hours_end');
            }
            if (!Schema::hasColumn('users', 'security_score')) {
                $table->integer('security_score')->nullable()->default(98)->after('two_factor_secret');
            }
            if (!Schema::hasColumn('users', 'chat_channels')) {
                $table->json('chat_channels')->nullable()->after('security_score');
            }
            if (!Schema::hasColumn('users', 'notification_matrix')) {
                $table->json('notification_matrix')->nullable()->after('chat_channels');
            }
            if (!Schema::hasColumn('users', 'last_export_at')) {
                $table->timestamp('last_export_at')->nullable()->after('notification_matrix');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['two_factor_secret', 'security_score', 'chat_channels', 'notification_matrix', 'last_export_at']);
        });
    }
};