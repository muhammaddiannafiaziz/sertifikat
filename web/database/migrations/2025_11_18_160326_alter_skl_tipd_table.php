<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- TAMBAHKAN INI

return new class extends Migration
{
    public function up(): void
    {
        DB::table('skl_tipd')->truncate();

        Schema::table('skl_tipd', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
            $table->dropUnique(['mahasiswa_id']);
            $table->dropColumn('mahasiswa_id');

            $table->foreignId('mhstipd_id')
                  ->after('id')
                  ->unique()
                  ->constrained('mhstipd') // Relasi ke tabel mhstipd
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        DB::table('skl_tipd')->truncate();

        Schema::table('skl_tipd', function (Blueprint $table) {
            $table->dropForeign(['mhstipd_id']);
            $table->dropUnique(['mhstipd_id']);
            $table->dropColumn('mhstipd_id');

            $table->foreignId('mahasiswa_id')
                  ->after('id')
                  ->unique()
                  ->constrained('mahasiswas')
                  ->onDelete('cascade');
        });
    }
};