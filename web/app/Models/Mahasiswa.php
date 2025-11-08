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

    public function sertifikats()
    {
        return $this->hasMany(Sertifikat::class);
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
