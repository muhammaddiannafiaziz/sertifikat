<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;  // Import model Mahasiswa
//use App\Models\Sertifikat;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total mahasiswa
        $totalMahasiswa = Mahasiswa::count();  // Ini akan memberikan jumlah total mahasiswa

        //$totalSertifikat = Sertifikat::count();  // Ini akan memberikan jumlah total mahasiswa
        // Mengirimkan data ke view
        return view('dashboard', compact('totalMahasiswa', 
                                         //$totalSertifikat
                                         ));
    }
}

