<?php

namespace App\Http\Controllers;

use App\Models\MhsTipd; // Model Peserta TIPD
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PesertaTipdController extends Controller
{
    public function index(Request $request)
    {
        $query = MhsTipd::with('mahasiswa');

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function ($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }

        $pesertaData = $query->paginate(10);

        return view('peserta_tipd.index', compact('pesertaData'));
    }

    public function create()
    {
        return view('peserta_tipd.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|unique:mhstipd,nim|exists:mahasiswas,nim',
        ]);

        MhsTipd::create($validated);

        return redirect()->route('peserta-tipd.index')->with('success', 'Peserta Komputer berhasil ditambahkan.');
    }

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
                    $mhsTipd = MhsTipd::firstOrCreate(['nim' => $nim]);
                    
                    // CEK DUPLIKASI/SUDAH ADA
                    if ($mhsTipd->wasRecentlyCreated) {
                        // Data baru berhasil dibuat
                        $successCount++;
                    } else {
                        // Data sudah ada di MhsTipd, ini yang dianggap "terduplikasi"
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

            return redirect()->route('peserta-tipd.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peserta-tipd.index')->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    public function destroy(MhsTipd $pesertaTipd)
    {
        $pesertaTipd->delete();

        return redirect()->route('peserta-tipd.index')->with('success', 'Peserta Komputer berhasil dihapus.');
    }
    
    // show, edit, update diabaikan
    public function show() { return redirect()->route('peserta-tipd.index'); }
    public function edit() { return redirect()->route('peserta-tipd.index'); }
    public function update() { return redirect()->route('peserta-tipd.index'); }
}