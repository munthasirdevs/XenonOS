<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->string('module', 50)->nullable()->after('description');
            $table->enum('severity', ['info', 'normal', 'critical'])->nullable()->after('module');
            $table->json('metadata')->nullable()->after('severity');
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('last_activity');
            $table->json('device_info')->nullable()->after('device_type');
            $table->string('location', 100)->nullable()->after('device_info');
            $table->string('browser', 50)->nullable();
            $table->string('os', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropColumn(['module', 'severity', 'metadata']);
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->dropColumn(['expires_at', 'device_info', 'location', 'browser', 'os']);
        });
    }
};