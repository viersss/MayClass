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
        // 1. Remove subject_id from materials
        if (Schema::hasColumn('materials', 'subject_id')) {
            Schema::table('materials', function (Blueprint $table) {
                // Try to drop foreign key first. 
                // Default index name is materials_subject_id_foreign
                $table->dropForeign(['subject_id']);
                $table->dropColumn('subject_id');
            });
        }

        // 2. Remove subject_id from quizzes
        if (Schema::hasColumn('quizzes', 'subject_id')) {
            Schema::table('quizzes', function (Blueprint $table) {
                $table->dropForeign(['subject_id']);
                $table->dropColumn('subject_id');
            });
        }

        // 3. Remove subject_id from schedule_templates
        if (Schema::hasColumn('schedule_templates', 'subject_id')) {
            Schema::table('schedule_templates', function (Blueprint $table) {
                $table->dropForeign(['subject_id']);
                $table->dropColumn('subject_id');
            });
        }

        // 4. Drop subject_user pivot table
        Schema::dropIfExists('subject_user');

        // 5. Drop package_subject pivot table
        Schema::dropIfExists('package_subject');

        // 6. Drop subjects table
        Schema::dropIfExists('subjects');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is destructive. 
        // We won't implement full restoration logic here as the feature is being removed.
    }
};
