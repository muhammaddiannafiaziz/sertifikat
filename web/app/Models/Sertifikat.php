<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikats';

    // TAMBAHKAN 9 KOLOM BARU DI BAWAH INI
    protected $fillable = [
        'mahasiswa_id',
        'no_sertifikat',
        'status_ujian_ibadah',
        'status_ujian_alquran',
        'background_image',

        // SKL Bahasa Arab
        'istima',
        'kitabah',
        'qiraah',

        // SKL Bahasa Inggris
        'listening',
        'writing',
        'reading',

        // SKL Komputer
        'word',
        'excel',
        'power_point',
    ];

    // ... (Relasi mahasiswa() Anda tetap di sini)
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}