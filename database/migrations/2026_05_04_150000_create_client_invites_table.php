<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_invites', function (Blueprint $table) {
            $table->id();
            $table->string('code', 6)->unique();
            $table->string('email');
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('invited_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();
            $table->unsignedTinyInteger('expires_hours')->default(24);
            $table->softDeletes();
            $table->timestamps();
            
            $table->index('code');
            $table->index('expires_at');
            $table->index(['email', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_invites');
    }
};