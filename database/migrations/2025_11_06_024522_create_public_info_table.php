<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('public_info', function (Blueprint $table) {
            $table->id();
            $table->string('info_key')->unique(); // e.g., 'about_us_text', 'visi', 'misi', 'contact_email'
            $table->text('info_value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('public_info');
    }
};