<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SklTipd extends Model
{
    use HasFactory;

    protected $table = 'skl_tipd';

    protected $fillable = [
        'mhstipd_id', // <-- BERUBAH
        'no_sertifikat',
        'word', 'excel', 'power_point',
    ];

    public function mhsTipd()
    {
        return $this->belongsTo(MhsTipd::class, 'mhstipd_id');
    }
}