<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'program_studi',
        'fakultas',
        'email',
    ];

    // Relasi ke Tabel Peserta (melalui kolom 'nim')

    /**
     * Mendapatkan data peserta SKL Ma'had (jika ada).
     */
    public function mhsMahad()
    {
        return $this->hasOne(MhsMahad::class, 'nim', 'nim');
    }

    /**
     * Mendapatkan data peserta SKL Bahasa (jika ada).
     */
    public function mhsBahasa()
    {
        return $this->hasOne(MhsBahasa::class, 'nim', 'nim');
    }

    /**
     * Mendapatkan data peserta SKL TIPD (jika ada).
     */
    public function mhsTipd()
    {
        return $this->hasOne(MhsTipd::class, 'nim', 'nim');
    }
}