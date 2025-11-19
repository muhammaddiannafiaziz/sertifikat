<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsMahad extends Model
{
    use HasFactory;

    protected $table = 'mhsmahad';
    protected $fillable = ['nim'];

    /**
     * Relasi One-to-One: Mendapatkan data Mahasiswa master (nama, prodi, dll.)
     */
    public function mahasiswa()
    {
        // Relasi ke Mahasiswa (melalui kolom 'nim')
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    /**
     * Relasi One-to-One: Mendapatkan data SKL Ma'had yang dibuat dari peserta ini.
     */
    public function sklMahad()
    {
        // Relasi ke SklMahad (melalui kolom 'mhsmahad_id')
        return $this->hasOne(SklMahad::class, 'mhsmahad_id');
    }
}