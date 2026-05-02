<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_snapshots', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // daily, weekly, monthly
            $table->json('data')->nullable();
            $table->date('snapshot_date');
            $table->timestamps();
            
            $table->index('type');
            $table->index('snapshot_date');
        });

        Schema::create('metrics_cache', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->json('value')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            
            $table->index('key');
            $table->index('expires_at');
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // executive, marketing, operations, financial, sales, support
            $table->json('config')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('type');
            $table->index('created_by');
        });

        Schema::create('report_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
            $table->json('filters')->nullable();
            $table->timestamps();
            
            $table->index('report_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_filters');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('metrics_cache');
        Schema::dropIfExists('analytics_snapshots');
    }
};