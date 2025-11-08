<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan oleh model ini
    protected $table = 'sertifikats';

    // Tentukan kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'mahasiswa_id',
        'no_sertifikat',
        'status_ujian_ibadah',
        'status_ujian_alquran',
        'background_image',
    ];

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
