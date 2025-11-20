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
        Schema::table('users', function (Blueprint $table) {
            // 1. Tambah kolom google_id setelah email
            //hanya menambahkan kolom jika kolom tersebut belum ada
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->after('email');
            }

            // 2. Ubah password jadi boleh kosong (nullable)
            // Penting: karena user login Google tidak input password
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom google_id
             if (Schema::hasColumn('users', 'google_id')) {
                $table->dropColumn('google_id');
            }

            // Kembalikan password jadi wajib diisi (tidak boleh null)
            $table->string('password')->nullable(false)->change();
        });
    }
};