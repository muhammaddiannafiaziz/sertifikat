<?php

namespace App\Http\Controllers;

use App\Models\MhsTipd; // Model Peserta TIPD
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
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
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        
        $header = array_shift($data);
        $nimIndex = array_search('nim', array_map('strtolower', $header));

        if ($nimIndex === false) {
             return redirect()->route('peserta-tipd.index')->with('error', 'File import gagal. Pastikan header kolom pertama adalah "nim".');
        }

        $successCount = 0;
        $failCount = 0;
        
        DB::beginTransaction();

        try {
            foreach ($data as $row) {
                if (!isset($row[$nimIndex]) || empty($row[$nimIndex])) {
                    continue;
                }

                $nim = trim($row[$nimIndex]);

                $mahasiswaMaster = Mahasiswa::where('nim', $nim)->exists();
                
                if ($mahasiswaMaster) {
                    MhsTipd::firstOrCreate(['nim' => $nim]);
                    $successCount++;
                } else {
                    $failCount++;
                }
            }

            DB::commit();
            
            $message = "Import berhasil! {$successCount} Peserta Komputer ditambahkan/diperbarui.";
            if ($failCount > 0) {
                 $message .= " ({$failCount} NIM gagal karena tidak ditemukan di data master Mahasiswa.)";
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