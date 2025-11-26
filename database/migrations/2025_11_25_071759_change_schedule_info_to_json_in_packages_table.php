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
        Schema::table('packages', function (Blueprint $table) {
            // First drop the text column then add json column to avoid casting issues if data exists
            // Or use change() if doctrine/dbal is installed and data preservation is needed.
            // Since this is dev, dropping and re-adding is safer/easier.
            $table->dropColumn('schedule_info');
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->json('schedule_info')->nullable()->after('facility_points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('schedule_info');
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->text('schedule_info')->nullable()->after('facility_points');
        });
    }
};
