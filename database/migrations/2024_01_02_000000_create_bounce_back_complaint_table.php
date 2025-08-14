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
        Schema::create('bounce_back_complaint', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('complaint_id');
            $table->enum('type', ['department', 'agent']);
            $table->unsignedBigInteger('agent_id'); // mobile_agent id or department user_id
            $table->enum('status', ['active', 'resolved'])->default('active');
            $table->text('reason')->nullable();
            $table->unsignedBigInteger('bounced_by'); // user_id who bounced back
            $table->timestamp('bounced_at')->useCurrent();
            $table->timestamps();

            // Add indexes for better performance
            $table->index(['complaint_id', 'type']);
            $table->index(['agent_id', 'type']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bounce_back_complaint');
    }
};
