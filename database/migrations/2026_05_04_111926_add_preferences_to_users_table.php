<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('timezone')->nullable()->default('London')->after('last_login_at');
            $table->string('date_format')->nullable()->default('dd-mm-yyyy')->after('timezone');
            $table->boolean('email_notifications')->nullable()->default(true)->after('date_format');
            $table->boolean('push_notifications')->nullable()->default(true)->after('email_notifications');
            $table->boolean('marketing_emails')->nullable()->default(true)->after('push_notifications');
            $table->boolean('survey_invites')->nullable()->default(false)->after('marketing_emails');
            $table->string('quiet_hours_start')->nullable()->default('22:00')->after('survey_invites');
            $table->string('quiet_hours_end')->nullable()->default('08:00')->after('quiet_hours_start');
            $table->string('two_factor_secret')->nullable()->after('quiet_hours_end');
            $table->integer('security_score')->nullable()->default(98)->after('two_factor_secret');
            $table->json('chat_channels')->nullable()->after('security_score');
            $table->json('notification_matrix')->nullable()->after('chat_channels');
            $table->timestamp('last_export_at')->nullable()->after('notification_matrix');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'timezone', 
                'date_format', 
                'email_notifications', 
                'push_notifications', 
                'marketing_emails', 
                'survey_invites', 
                'quiet_hours_start', 
                'quiet_hours_end',
                'two_factor_secret',
                'security_score',
                'chat_channels',
                'notification_matrix',
                'last_export_at'
            ]);
        });
    }
};