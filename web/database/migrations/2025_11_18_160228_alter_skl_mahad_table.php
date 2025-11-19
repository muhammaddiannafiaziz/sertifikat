<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- TAMBAHKAN INI

return new class extends Migration
{
    public function up(): void
    {
        // PERINGATAN: Menghapus semua data SKL Ma'had yang ada
        DB::table('skl_mahad')->truncate();

        Schema::table('skl_mahad', function (Blueprint $table) {
            // Hapus relasi lama ke mahasiswa_id
            $table->dropForeign(['mahasiswa_id']);
            $table->dropUnique(['mahasiswa_id']); // Hapus unique index juga
            $table->dropColumn('mahasiswa_id');

            // Tambah relasi baru ke mhsmahad_id
            $table->foreignId('mhsmahad_id')
                  ->after('id')
                  ->unique() // 1 peserta hanya punya 1 record SKL
                  ->constrained('mhsmahad') // Relasi ke tabel mhsmahad
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Hapus data lagi untuk rollback
        DB::table('skl_mahad')->truncate();
        
        Schema::table('skl_mahad', function (Blueprint $table) {
            // Hapus relasi baru
            $table->dropForeign(['mhsmahad_id']);
            $table->dropUnique(['mhsmahad_id']);
            $table->dropColumn('mhsmahad_id');

            // Kembalikan relasi lama
            $table->foreignId('mahasiswa_id')
                  ->after('id')
                  ->unique()
                  ->constrained('mahasiswas')
                  ->onDelete('cascade');
        });
    }
};