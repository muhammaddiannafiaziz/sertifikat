<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsBahasa extends Model
{
    use HasFactory;

    protected $table = 'mhsbahasa';
    protected $fillable = ['nim'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function sklBahasa()
    {
        return $this->hasOne(SklBahasa::class, 'mhsbahasa_id');
    }
}