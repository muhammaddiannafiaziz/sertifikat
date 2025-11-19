<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsTipd extends Model
{
    use HasFactory;

    protected $table = 'mhstipd';
    protected $fillable = ['nim'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function sklTipd()
    {
        return $this->hasOne(SklTipd::class, 'mhstipd_id');
    }
}