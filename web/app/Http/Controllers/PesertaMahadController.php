<?php

namespace App\Http\Controllers;

use App\Models\MhsMahad;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
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
        // 1. Validasi file
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Batasi hanya CSV/TXT
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        
        // Ambil header, asumsikan baris pertama adalah header dan berisi 'nim'
        $header = array_shift($data);
        $nimIndex = array_search('nim', array_map('strtolower', $header));

        if ($nimIndex === false) {
             return redirect()->route('peserta-mahad.index')->with('error', 'File import gagal. Pastikan header kolom pertama adalah "nim".');
        }

        $successCount = 0;
        $failCount = 0;
        
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            foreach ($data as $row) {
                if (!isset($row[$nimIndex]) || empty($row[$nimIndex])) {
                    continue; // Skip jika kolom NIM kosong
                }

                $nim = trim($row[$nimIndex]);

                // Cek apakah NIM ada di tabel Mahasiswa master
                $mahasiswaMaster = Mahasiswa::where('nim', $nim)->exists();
                
                if ($mahasiswaMaster) {
                    // Gunakan firstOrCreate untuk menghindari duplikasi jika nim sudah ada di mhsmahad
                    MhsMahad::firstOrCreate(['nim' => $nim]);
                    $successCount++;
                } else {
                    $failCount++;
                }
            }

            DB::commit();
            
            $message = "Import berhasil! {$successCount} Peserta Ma'had ditambahkan/diperbarui.";
            if ($failCount > 0) {
                 $message .= " ({$failCount} NIM gagal karena tidak ditemukan di data master Mahasiswa.)";
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