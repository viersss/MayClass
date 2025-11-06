<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('packages')->onDelete('restrict');
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['user_id', 'package_id', 'transaction_id']); // Unique purchase of a package
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_packages');
    }
};