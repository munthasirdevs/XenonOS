<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['private', 'group', 'project'])->default('private');
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('type');
            $table->index('project_id');
            $table->index('created_by');
        });

        Schema::create('chat_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained('chats')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('role')->nullable(); // admin, member
            $table->timestamp('last_read_at')->nullable();
            $table->timestamps();
            
            $table->unique(['chat_id', 'user_id']);
            $table->index('chat_id');
            $table->index('user_id');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained('chats')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->enum('type', ['text', 'file', 'image'])->default('text');
            $table->unsignedBigInteger('file_id')->nullable();
            $table->timestamps();
            
            $table->index('chat_id');
            $table->index('sender_id');
            $table->index('created_at');
        });

        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('created_by');
            $table->index('created_at');
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('related_type')->nullable(); // client, project, task
            $table->unsignedBigInteger('related_id')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('related_type', 'notes_related_type_index');
            $table->index('related_id');
            $table->index('created_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('chat_users');
        Schema::dropIfExists('chats');
    }
};