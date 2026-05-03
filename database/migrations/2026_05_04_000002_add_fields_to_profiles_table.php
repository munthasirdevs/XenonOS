<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('title')->nullable()->after('bio');
            $table->string('company')->nullable()->after('title');
            $table->string('address1')->nullable()->after('company');
            $table->string('address2')->nullable()->after('address1');
            $table->string('city')->nullable()->after('address2');
            $table->string('state')->nullable()->after('city');
            $table->string('zip')->nullable()->after('state');
            $table->string('country')->nullable()->after('zip');
            $table->string('payment_method')->nullable()->after('country');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'title', 'company', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'payment_method'
            ]);
        });
    }
};