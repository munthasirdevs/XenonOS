<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->string('title')->nullable()->after('notification_id');
            $table->text('message')->nullable()->after('title');
            $table->string('type')->nullable()->after('message');
            $table->json('data')->nullable()->after('type');
            $table->foreignId('created_by')->nullable()->after('data')->constrained('users')->nullOnDelete();
            $table->foreignId('read_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->dropConstrainedForeignId('created_by');
            $table->dropColumn(['title', 'message', 'type', 'data', 'read_by']);
        });
    }
};
