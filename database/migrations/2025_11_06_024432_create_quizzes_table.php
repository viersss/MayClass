<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict'); // Creator (tentor or admin)
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('restrict');
            $table->foreignId('level_id')->constrained('levels')->onDelete('restrict');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('duration_minutes')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};