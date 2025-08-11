<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->json('data')->nullable();
            $table->enum('type', ['complaint_assigned', 'general', 'urgent', 'reminder'])->default('general');
            $table->enum('status', ['sent', 'delivered', 'failed'])->default('sent');
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('recipient_type')->nullable(); // 'agent', 'department', 'all'
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->index(['recipient_id', 'recipient_type']);
            $table->index('status');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
