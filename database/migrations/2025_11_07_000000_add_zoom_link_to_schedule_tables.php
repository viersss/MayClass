<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedule_templates', function (Blueprint $table) {
            if (! Schema::hasColumn('schedule_templates', 'zoom_link')) {
                $table->string('zoom_link')->nullable()->after('location');
            }
        });

        Schema::table('schedule_sessions', function (Blueprint $table) {
            if (! Schema::hasColumn('schedule_sessions', 'zoom_link')) {
                $table->string('zoom_link')->nullable()->after('location');
            }
        });
    }

    public function down(): void
    {
        Schema::table('schedule_sessions', function (Blueprint $table) {
            if (Schema::hasColumn('schedule_sessions', 'zoom_link')) {
                $table->dropColumn('zoom_link');
            }
        });

        Schema::table('schedule_templates', function (Blueprint $table) {
            if (Schema::hasColumn('schedule_templates', 'zoom_link')) {
                $table->dropColumn('zoom_link');
            }
        });
    }
};
