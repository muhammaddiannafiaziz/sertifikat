<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSertifikatTable extends Migration
{
    public function up()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            // Mengganti kolom nilai ujian menjadi status ujian
            $table->dropColumn('nilai_ujian_ibadah');
            $table->dropColumn('nilai_ujian_alquran');

            // Menambahkan kolom status ujian
            $table->enum('status_ujian_ibadah', ['lulus', 'tidak_lulus'])->after('mahasiswa_id');
            $table->enum('status_ujian_alquran', ['lulus', 'tidak_lulus'])->after('status_ujian_ibadah');
        });
    }

    public function down()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            // Mengembalikan perubahan saat rollback migrasi
            $table->dropColumn('status_ujian_ibadah');
            $table->dropColumn('status_ujian_alquran');

            $table->integer('nilai_ujian_ibadah')->after('mahasiswa_id');
            $table->integer('nilai_ujian_alquran')->after('nilai_ujian_ibadah');
        });
    }
}
