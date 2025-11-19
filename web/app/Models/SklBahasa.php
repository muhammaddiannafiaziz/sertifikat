<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SklBahasa extends Model
{
    use HasFactory;

    protected $table = 'skl_bahasa';

    protected $fillable = [
        'mhsbahasa_id', // <-- BERUBAH
        'no_sertifikat',
        'istima', 'kitabah', 'qiraah',
        'listening', 'writing', 'reading',
    ];

    public function mhsBahasa()
    {
        return $this->belongsTo(MhsBahasa::class, 'mhsbahasa_id');
    }
}