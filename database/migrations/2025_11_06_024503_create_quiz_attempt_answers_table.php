<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempt_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_attempt_id')->constrained('quiz_attempts')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->text('answer_text')->nullable(); // For essay answers
            $table->string('selected_option', 10)->nullable(); // For multiple choice (e.g., 'a', 'b')
            $table->boolean('is_correct')->nullable(); // NULL if essay, TRUE/FALSE for multiple choice
            $table->text('grade_feedback')->nullable(); // Feedback from tentor for this specific answer
            $table->integer('grade_score')->nullable(); // Score for this specific question
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempt_answers');
    }
};