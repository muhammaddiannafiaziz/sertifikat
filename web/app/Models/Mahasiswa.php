<?php

namespace App\Models;
use App\Models\MhsMahad;    // Model Perantara Mahad (Asumsi: dari konteks sebelumnya)
use App\Models\SklMahad;    // Model Final SKL Mahad (Asumsi)

use App\Models\MhsBahasa;   // Model Perantara Bahasa (Dikonfirmasi)
use App\Models\SklBahasa;   // Model Final SKL Bahasa (Dikonfirmasi)

use App\Models\MhsTipd;     // Model Perantara TIPD (Asumsi: Mengikuti Pola)
use App\Models\SklTipd;     // Model Final SKL TIPD (Asumsi)

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'program_studi',
        'fakultas',
        'email',
    ];

    // Relasi ke Tabel Peserta (melalui kolom 'nim')

    /**
     * Mendapatkan data peserta SKL Ma'had (jika ada).
     */
    public function mhsMahad()
    {
        return $this->hasOne(MhsMahad::class, 'nim', 'nim');
    }

    /**
     * Mendapatkan data peserta SKL Bahasa (jika ada).
     */
    public function mhsBahasa()
    {
        return $this->hasOne(MhsBahasa::class, 'nim', 'nim');
    }

    /**
     * Mendapatkan data peserta SKL TIPD (jika ada).
     */
    public function mhsTipd()
    {
        return $this->hasOne(MhsTipd::class, 'nim', 'nim');
    }
    public function sklMahad()
    {
        return $this->hasOneThrough(
            SklMahad::class,  // 1. Model Tujuan Akhir
            MhsMahad::class,  // 2. Model Perantara
            'nim',            // 3. Foreign Key di MhsMahad yang menunjuk ke Mahasiswa
            'mhsmahad_id',    // 4. Foreign Key di SklMahad yang menunjuk ke MhsMahad
            'nim',            // 5. Local Key di Mahasiswa (Kolom yang digunakan untuk link)
            'id'              // 6. Local Key di MhsMahad (Primary key MhsMahad)
        );
    }

    public function sklBahasa()
    {
        return $this->hasOneThrough(
            SklBahasa::class,  // 1. Model Tujuan Akhir
            MhsBahasa::class,  // 2. Model Perantara
            'nim',             // 3. Foreign Key di MhsBahasa yang menunjuk ke Mahasiswa
            'mhsbahasa_id',    // 4. Foreign Key di SklBahasa yang menunjuk ke MhsBahasa
            'nim',             // 5. Local Key di Mahasiswa (Kolom yang digunakan untuk link)
            'id'               // 6. Local Key di MhsBahasa (Primary key MhsBahasa)
        );
    }
    
    public function sklTipd()
    {
        return $this->hasOneThrough(
            SklTipd::class,   // 1. Model Tujuan Akhir
            MhsTipd::class,   // 2. Model Perantara
            'nim',            // 3. Foreign Key di MhsTipd yang menunjuk ke Mahasiswa
            'mhstipd_id',     // 4. Foreign Key di SklTipd yang menunjuk ke MhsTipd
            'nim',            // 5. Local Key di Mahasiswa (Kolom yang digunakan untuk link)
            'id'              // 6. Local Key di MhsTipd (Primary key MhsTipd)
        );
    }
}