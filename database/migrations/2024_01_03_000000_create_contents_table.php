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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['article', 'video', 'quiz']);
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_thumbnail')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('quiz_data')->nullable(); // For interactive quizzes
            $table->string('category')->nullable();
            $table->json('tags')->nullable();
            $table->integer('reading_time')->nullable(); // in minutes
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->boolean('featured')->default(false);
            $table->boolean('published')->default(false);
            $table->json('seo_meta')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};