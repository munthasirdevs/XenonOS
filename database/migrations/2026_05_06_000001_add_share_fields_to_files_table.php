<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->string('share_hash', 32)->nullable()->unique()->after('mime_type');
            $table->timestamp('share_expires_at')->nullable()->after('share_hash');
            $table->string('share_password_hash')->nullable()->after('share_expires_at');
            $table->integer('share_views_used')->default(0)->after('share_password_hash');
            $table->integer('share_views_limit')->nullable()->after('share_views_used');
            $table->enum('share_access', ['view', 'download'])->default('view')->after('share_views_limit');
            $table->boolean('share_enabled')->default(false)->after('share_access');
            $table->timestamp('share_created_at')->nullable()->after('share_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn([
                'share_hash',
                'share_expires_at',
                'share_password_hash',
                'share_views_used',
                'share_views_limit',
                'share_access',
                'share_enabled',
                'share_created_at',
            ]);
        });
    }
};
