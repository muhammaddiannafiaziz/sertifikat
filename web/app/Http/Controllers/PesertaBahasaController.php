<?php

namespace App\Http\Controllers;

use App\Models\MhsBahasa; // Model Peserta Bahasa
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PesertaBahasaController extends Controller
{
    public function index(Request $request)
    {
        $query = MhsBahasa::with('mahasiswa');

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function ($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }

        $pesertaData = $query->paginate(10);

        return view('peserta_bahasa.index', compact('pesertaData'));
    }

    public function create()
    {
        return view('peserta_bahasa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|unique:mhsbahasa,nim|exists:mahasiswas,nim',
        ]);

        MhsBahasa::create($validated);

        return redirect()->route('peserta-bahasa.index')->with('success', 'Peserta Bahasa berhasil ditambahkan.');
    }

    public function import(Request $request)
    {
        // 1. Validasi file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');
        $data = array_map('str_getcsv', file($file));
        $nimIndex = 0; 
        
        $successCount = 0; 
        $failCount = 0;
        $failedNims = []; 
        $existingNims = []; 
        
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
                    // Menggunakan Model
                    $mhsBahasa = MhsBahasa::firstOrCreate(['nim' => $nim]);
                    
                    if ($mhsBahasa->wasRecentlyCreated) {
                        $successCount++;
                    } else {
                        $existingNims[] = $nim;
                        $successCount++;
                    }
                    
                } else {
                    $failedNims[] = $nim;
                    $failCount++;
                }
            }

            DB::commit();
            
            // 3. GENERASI PESAN AKHIR
            $message = "Import SKL Bahasa berhasil! {$successCount} Peserta diproses (ditambahkan/ditemukan).";
            
            if (!empty($existingNims)) {
                $existingNimsList = implode(', ', $existingNims);
                $newCount = $successCount - count($existingNims);
                $message .= " **({$newCount} data baru, dan " . count($existingNims) . " NIM sudah ada: {$existingNimsList}.)**";
            }
            
            if ($failCount > 0) {
                $failedNimsList = implode(', ', $failedNims);
                $message .= " **({$failCount} NIM gagal karena tidak ditemukan di data master Mahasiswa: {$failedNimsList}.)**";
            }

            // Pastikan route ini benar untuk SKL Bahasa
            return redirect()->route('peserta-bahasa.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            // Pastikan route ini benar untuk SKL Bahasa
            return redirect()->route('peserta-bahasa.index')->with('error', 'Terjadi kesalahan saat import SKL Bahasa: ' . $e->getMessage());
        }
    }

    public function destroy(MhsBahasa $pesertaBahasa)
    {
        $pesertaBahasa->delete();

        return redirect()->route('peserta-bahasa.index')->with('success', 'Peserta Bahasa berhasil dihapus.');
    }
    
    // show, edit, update diabaikan
    public function show() { return redirect()->route('peserta-bahasa.index'); }
    public function edit() { return redirect()->route('peserta-bahasa.index'); }
    public function update() { return redirect()->route('peserta-bahasa.index'); }
}