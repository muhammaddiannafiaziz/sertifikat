<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SklMahadController;
use App\Http\Controllers\SklBahasaController;
use App\Http\Controllers\SklTipdController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicSertifikatController;
// use App\Http\Controllers\SertifikatController; // Dikomentari untuk refaktor


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/haha', function () {
    return view('ujian.haha');
})->name('ujian.haha');

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK SERTIFIKAT LAMA (DIKOMENTARI)
|--------------------------------------------------------------------------
| Rute ini akan kita ganti dengan logika Cek NIM yang baru
|
*/
// Route::match(['get', 'post'], '/cek-sertifikat', [SertifikatController::class, 'cekSertifikat'])->name('cek-sertifikat');
// // Route::get('/cek-sertifikat', [SertifikatController::class, 'cekSertifikat'])->name('cek-sertifikat');
// Route::post('/unduh-sertifikat', [SertifikatController::class, 'unduhSertifikat'])->name('unduh-sertifikat');
// Route::get('/download-sertifikat/{no_sertifikat}', [SertifikatController::class, 'downloadSertifikat'])
//     ->name('download-sertifikat');
//
// Route::get('/sertifikat/validasi/{no_sertifikat}', [SertifikatController::class, 'validasiSertifikat'])->name('sertifikat.validasi');

// ===================================
// ==     RUTE PUBLIK SKL BARU        ==
// ===================================
// Menampilkan halaman form Cek NIM
Route::get('/cek-sertifikat', [PublicSertifikatController::class, 'showCheckForm'])->name('public.cek');
// Memproses data dari form Cek NIM
Route::post('/cek-sertifikat-hasil', [PublicSertifikatController::class, 'checkByNim'])->name('public.cek.hasil');

// --- RUTE GENERIK BARU (Download & Validasi) ---
// Rute ini menggantikan 6 rute yang kita buat sebelumnya.

// 1. Rute Download (Generik)
Route::get('/download/{no_sertifikat}', [PublicSertifikatController::class, 'download'])
    ->name('public.download');

// 2. Rute Validasi QR Code (Generik)
Route::get('/validasi/{no_sertifikat}', [PublicSertifikatController::class, 'validasi'])
    ->name('public.validasi');

// ===================================
// ==  AKHIR RUTE PUBLIK SKL BARU   ==
// ===================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// =======================================================
// ==             GRUP RUTE UNTUK ADMIN                 ==
// =======================================================
Route::middleware('auth')->group(function () {

    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::post('/account/update', [AccountController::class, 'update'])->name('account.update');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Ujian (Tetap ada)
    Route::resource('ujian', UjianController::class);
    Route::get('ujian/{id}/peserta', [UjianController::class, 'showPeserta'])->name('ujian.peserta');

    // Rute Mahasiswa (Tetap ada)
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('mahasiswa/export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');
    Route::post('mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');

    // Rute Admin (Tetap ada)
    Route::resource('admin', AdminController::class);
    

    /*
    |--------------------------------------------------------------------------
    | RUTE ADMIN SERTIFIKAT LAMA (DIKOMENTARI)
    |--------------------------------------------------------------------------
    | Rute ini digantikan oleh 3 resource route SKL di bawah
    |
    */
    // // Sertifikat Routes
    // Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertifikat.index');
    // Route::get('/sertifikat/create', [SertifikatController::class, 'create'])->name('sertifikat.create');
    // Route::get('/sertifikat/export', [SertifikatController::class, 'export'])->name('sertifikat.export');
    // Route::post('/sertifikat/generate', [SertifikatController::class, 'generateSertifikat'])->name('sertifikat.generate');
    // // Route::post('/sertifikat', [SertifikatController::class, 'store'])->name('sertifikat.store'); // store method does not exist in controller
    // Route::get('/sertifikat/{id}', [SertifikatController::class, 'show'])->name('sertifikat.show');
    // Route::get('/sertifikat/{id}/edit', [SertifikatController::class, 'edit'])->name('sertifikat.edit');
    // Route::put('/sertifikat/{id}', [SertifikatController::class, 'update'])->name('sertifikat.update');
    // Route::delete('/sertifikat/{id}', [SertifikatController::class, 'destroy'])->name('sertifikat.destroy');
    // Route::get('/sertifikat/download/{no_sertifikat}', [SertifikatController::class, 'downloadSertifikat'])->name('sertifikat.download');


    
    // ===================================
    // ==     RUTE SKL BARU (DENGAN ROLE) ==
    // ===================================

    // Rute SKL Ma'had (Hanya bisa diakses oleh 'adminmahad' & 'superadmin')
    Route::resource('skl-mahad', SklMahadController::class)
         ->middleware('can:manage-mahad');

    // Rute SKL Bahasa (Hanya bisa diakses oleh 'adminbahasa' & 'superadmin')
    Route::resource('skl-bahasa', SklBahasaController::class)
         ->middleware('can:manage-bahasa');

    // Rute SKL TIPD (Hanya bisa diakses oleh 'admintipd' & 'superadmin')
    Route::resource('skl-tipd', SklTipdController::class)
         ->middleware('can:manage-tipd');

});
// =======================================================
// ==             AKHIR GRUP RUTE ADMIN                 ==
// =======================================================

require __DIR__ . '/auth.php';