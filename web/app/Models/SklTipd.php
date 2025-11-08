<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SklTipd extends Model
{
    use HasFactory;

    protected $table = 'skl_tipd';

    protected $fillable = [
        'mahasiswa_id',
        'no_sertifikat',
        'word',
        'excel',
        'power_point',
    ];

    /**
     * Mendapatkan data mahasiswa yang memiliki SKL TIPD ini.
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}