<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $table = 'ujians'; // Nama tabel yang benar
    protected $fillable = ['nama_ujian', 'deskripsi_ujian'];

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_ujian');
    }
}
