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
        Schema::table('packages', function (Blueprint $table) {
            $table->json('program_points')->nullable()->after('summary');
            $table->json('facility_points')->nullable()->after('program_points');
            $table->text('schedule_info')->nullable()->after('facility_points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['program_points', 'facility_points', 'schedule_info']);
        });
    }
};
