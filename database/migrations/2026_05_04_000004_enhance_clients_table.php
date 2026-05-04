<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('company');
            $table->text('address')->nullable()->after('company_name');
            $table->string('website')->nullable()->after('address');
            $table->string('tier')->nullable()->after('website'); // premium, standard, basic
            $table->decimal('total_revenue', 15, 2)->nullable()->after('tier');
            $table->string('location')->nullable()->after('total_revenue');
            $table->string('avatar_url', 500)->nullable()->after('location');
        });

        Schema::table('client_activities', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('created_by');
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'address', 'website', 'tier', 'total_revenue', 'location', 'avatar_url']);
        });

        Schema::table('client_activities', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
        });
    }
};