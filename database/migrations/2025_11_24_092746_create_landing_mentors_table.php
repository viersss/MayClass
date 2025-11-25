<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('landing_mentors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable(); // e.g. "Mentor Bahasa Indonesia"
            $table->string('quote')->nullable();
            $table->string('avatar')->nullable();
            $table->string('experience')->nullable(); // e.g. "8+ tahun mengajar"
            $table->string('students_count')->nullable(); // e.g. "700+ siswa"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_mentors');
    }
};
