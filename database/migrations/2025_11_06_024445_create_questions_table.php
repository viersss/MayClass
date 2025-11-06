<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->text('question_text');
            $table->string('question_type', 50); // 'multiple_choice', 'essay'
            $table->json('options')->nullable(); // For multiple_choice: {"a": "Option A", "b": "Option B"}
            $table->json('correct_answer')->nullable(); // For multiple_choice: {"answer": "a"}, For essay: {"keywords": ["key1", "key2"]}
            $table->integer('score_value')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};