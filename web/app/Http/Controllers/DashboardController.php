<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\SklMahad;    // <-- TAMBAHKAN
use App\Models\SklBahasa;  // <-- TAMBAHKAN
use App\Models\SklTipd;    // <-- TAMBAHKAN
use App\Models\MhsMahad;  // <-- TAMBAHKAN
use App\Models\MhsBahasa; // <-- TAMBAHKAN
use App\Models\MhsTipd;   // <-- TAMBAHKAN
use Illuminate\Support\Facades\Auth; // Untuk cek role

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $stats = [];
        
        // --- Statistik Master ---
        $stats['total_mahasiswa'] = Mahasiswa::count();
        
        // --- Statistik Peserta ---
        $stats['peserta_mahad_count'] = MhsMahad::count();
        $stats['peserta_bahasa_count'] = MhsBahasa::count();
        $stats['peserta_tipd_count'] = MhsTipd::count();

        // --- Statistik SKL Terbit ---
        $stats['skl_mahad_count'] = SklMahad::count();
        $stats['skl_bahasa_count'] = SklBahasa::count();
        $stats['skl_tipd_count'] = SklTipd::count();
        
        // Kita juga bisa membuat statistik yang spesifik untuk role yang login
        $stats['role_specific_skl'] = 0;
        $stats['role_specific_peserta'] = 0;

        if ($role == 'adminmahad') {
             $stats['role_specific_skl'] = $stats['skl_mahad_count'];
             $stats['role_specific_peserta'] = $stats['peserta_mahad_count'];
        } elseif ($role == 'adminbahasa') {
             $stats['role_specific_skl'] = $stats['skl_bahasa_count'];
             $stats['role_specific_peserta'] = $stats['peserta_bahasa_count'];
        } elseif ($role == 'admintipd') {
             $stats['role_specific_skl'] = $stats['skl_tipd_count'];
             $stats['role_specific_peserta'] = $stats['peserta_tipd_count'];
        }

        return view('dashboard', compact('stats', 'role'));
    }
}