<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Izinkan atribut berikut untuk mass assignment
    protected $fillable = [
        'nama',
        'nim',
        'program_studi',
        'fakultas',
        'email'
    ];

    /**
     * Mendapatkan data SKL Ma'had yang dimiliki oleh mahasiswa.
     */
    public function sklMahad()
    {
        return $this->hasOne(SklMahad::class);
    }

    /**
     * Mendapatkan data SKL Bahasa yang dimiliki oleh mahasiswa.
     */
    public function sklBahasa()
    {
        return $this->hasOne(SklBahasa::class);
    }

    /**
     * Mendapatkan data SKL TIPD yang dimiliki oleh mahasiswa.
     */
    public function sklTipd()
    {
        return $this->hasOne(SklTipd::class);
    }

    // Relasi Many-to-Many dengan Ujian
    public function ujian()
    {
        return $this->belongsToMany(Ujian::class, 'mahasiswa_ujian');
    }

    public function index()
    {
        // Mengambil total mahasiswa
        $totalMahasiswa = Mahasiswa::totalMahasiswa();

        // Mengirimkan data ke view
        return view('dashboard', compact('totalMahasiswa'));
    }
}
