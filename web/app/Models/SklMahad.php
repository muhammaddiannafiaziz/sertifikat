<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SklMahad extends Model
{
    use HasFactory;

    protected $table = 'skl_mahad';

    protected $fillable = [
        'mhsmahad_id', // <-- BERUBAH: Gunakan ID Peserta
        'no_sertifikat',
        'status_ujian_ibadah',
        'status_ujian_alquran',
    ];

    // Ganti relasi Mahasiswa() menjadi mhsMahad()

    /**
     * Mendapatkan data peserta (MhsMahad) yang menerbitkan SKL ini.
     */
    public function mhsMahad()
    {
        return $this->belongsTo(MhsMahad::class, 'mhsmahad_id');
    }
}