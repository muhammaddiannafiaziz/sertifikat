<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- TAMBAHKAN INI

return new class extends Migration
{
    public function up(): void
    {
        DB::table('skl_bahasa')->truncate();

        Schema::table('skl_bahasa', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
            $table->dropUnique(['mahasiswa_id']);
            $table->dropColumn('mahasiswa_id');

            $table->foreignId('mhsbahasa_id')
                  ->after('id')
                  ->unique()
                  ->constrained('mhsbahasa') // Relasi ke tabel mhsbahasa
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        DB::table('skl_bahasa')->truncate();
        
        Schema::table('skl_bahasa', function (Blueprint $table) {
            $table->dropForeign(['mhsbahasa_id']);
            $table->dropUnique(['mhsbahasa_id']);
            $table->dropColumn('mhsbahasa_id');

            $table->foreignId('mahasiswa_id')
                  ->after('id')
                  ->unique()
                  ->constrained('mahasiswas')
                  ->onDelete('cascade');
        });
    }
};