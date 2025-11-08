<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SklBahasa extends Model
{
    use HasFactory;

    protected $table = 'skl_bahasa';

    protected $fillable = [
        'mahasiswa_id',
        'no_sertifikat',
        'istima',
        'kitabah',
        'qiraah',
        'listening',
        'writing',
        'reading',
    ];

    /**
     * Mendapatkan data mahasiswa yang memiliki SKL Bahasa ini.
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}