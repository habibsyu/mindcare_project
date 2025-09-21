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
        Schema::create('counseling_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('staff_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('session_id')->unique();
            $table->json('messages'); // Encrypted chat messages
            $table->enum('status', ['active', 'completed', 'transferred', 'cancelled'])->default('active');
            $table->enum('mode', ['ai_bot', 'human_staff'])->default('ai_bot');
            $table->timestamp('transferred_at')->nullable();
            $table->text('transfer_reason')->nullable();
            $table->text('session_summary')->nullable();
            $table->integer('rating')->nullable(); // 1-5 stars
            $table->text('feedback')->nullable();
            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_sessions');
    }
};