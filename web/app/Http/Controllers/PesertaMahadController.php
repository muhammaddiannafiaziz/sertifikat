<?php

namespace App\Http\Controllers;

use App\Models\MhsMahad;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; // Untuk transaksi database

class PesertaMahadController extends Controller
{
    /**
     * Menampilkan daftar data Peserta SKL Ma'had.
     */
    public function index(Request $request)
    {
        // Muat relasi ke data master Mahasiswa
        $query = MhsMahad::with('mahasiswa');

        // Logika Pencarian berdasarkan NIM atau Nama Mahasiswa
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function ($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }

        $pesertaData = $query->paginate(10);

        return view('peserta_mahad.index', compact('pesertaData'));
    }

    /**
     * Menampilkan form untuk import data (akan kita gunakan untuk file CSV).
     */
    public function create()
    {
        return view('peserta_mahad.create');
    }

    /**
     * Menyimpan data Peserta baru (jika diinput manual).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|unique:mhsmahad,nim|exists:mahasiswas,nim', // WAJIB ada di Mahasiswas
        ]);

        MhsMahad::create($validated);

        return redirect()->route('peserta-mahad.index')->with('success', 'Peserta Ma\'had berhasil ditambahkan.');
    }

    /**
     * Fungsionalitas Import Data dari CSV/Excel.
     */
    public function import(Request $request)
    {
        // 1. Validasi file (tetap sama)
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');
        $data = array_map('str_getcsv', file($file));
        $nimIndex = 0; 
        
        $successCount = 0; // Jumlah NIM yang berhasil diproses
        $failCount = 0;    // Jumlah NIM yang gagal (tidak ada di Mahasiswa master)
        
        $failedNims = []; // NIM yang tidak ada di Mahasiswa master
        // DEKLARASI: Array baru untuk menyimpan NIM yang sudah ada (terduplikasi)
        $existingNims = []; 
        
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            foreach ($data as $row) {
                if (!isset($row[$nimIndex]) || empty($row[$nimIndex])) {
                    continue;
                }

                $nim = trim($row[$nimIndex]);

                // Cek apakah NIM ada di tabel Mahasiswa master
                $mahasiswaMaster = Mahasiswa::where('nim', $nim)->exists();
                
                if ($mahasiswaMaster) {
                    // Gunakan firstOrCreate
                    $mhsMahad = MhsMahad::firstOrCreate(['nim' => $nim]);
                    
                    // CEK DUPLIKASI/SUDAH ADA
                    if ($mhsMahad->wasRecentlyCreated) {
                        // Data baru berhasil dibuat
                        $successCount++;
                    } else {
                        // Data sudah ada di MhsMahad, ini yang dianggap "terduplikasi"
                        $existingNims[] = $nim;
                        // Kita tetap hitung sebagai successCount karena berhasil diproses (diperbarui/ditemukan)
                        $successCount++; 
                    }
                    
                } else {
                    // NIM tidak ditemukan di Mahasiswa Master
                    $failedNims[] = $nim;
                    $failCount++;
                }
            }

            DB::commit();
            
            // 3. GENERASI PESAN AKHIR
            $message = "Import berhasil! {$successCount} Peserta Ma'had diproses (ditambahkan/ditemukan).";
            
            // Pesan untuk NIM yang sudah ada
            if (!empty($existingNims)) {
                $existingNimsList = implode(', ', $existingNims);
                // Jumlah data yang benar-benar baru
                $newCount = $successCount - count($existingNims);
                $message .= " **({$newCount} data baru, dan " . count($existingNims) . " NIM sudah ada: {$existingNimsList}.)**";
            }
            
            // Pesan untuk NIM yang gagal (tidak ditemukan di data master)
            if ($failCount > 0) {
                $failedNimsList = implode(', ', $failedNims);
                $message .= " **({$failCount} NIM gagal karena tidak ditemukan di data master Mahasiswa: {$failedNimsList}.)**";
            }

            return redirect()->route('peserta-mahad.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peserta-mahad.index')->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }


    /**
     * Menghapus data dari database.
     */
    public function destroy(MhsMahad $pesertaMahad)
    {
        // Hapus data, relasi SKL terkait akan ikut terhapus (cascade)
        $pesertaMahad->delete();

        return redirect()->route('peserta-mahad.index')->with('success', 'Peserta Ma\'had berhasil dihapus.');
    }

    // Fungsi show, edit, update diabaikan karena peserta hanya berupa NIM
    public function show() { return redirect()->route('peserta-mahad.index'); }
    public function edit() { return redirect()->route('peserta-mahad.index'); }
    public function update() { return redirect()->route('peserta-mahad.index'); }
}