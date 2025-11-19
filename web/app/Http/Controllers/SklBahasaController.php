<?php

namespace App\Http\Controllers;

use App\Models\SklBahasa;
use App\Models\MhsBahasa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF; // Untuk PDF nanti

class SklBahasaController extends Controller
{
    /**
     * Menampilkan daftar data SKL Bahasa.
     */
    public function index(Request $request)
    {
        $query = SklBahasa::with('mhsBahasa.mahasiswa');

        // Logika Pencarian
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->whereHas('mhsBahasa.mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            })->orWhere('no_sertifikat', 'like', "%{$search}%");
        }

        $sklBahasaData = $query->paginate(10);

        // Arahkan ke view baru
        return view('skl_bahasa.index', compact('sklBahasaData'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        // 1. Ganti: Ambil dari MhsBahasa, bukan Mahasiswa
        $peserta = MhsBahasa::whereDoesntHave('sklBahasa')->with('mahasiswa')->get();
        
        return view('skl_bahasa.create', compact('peserta')); // Mengirimkan $peserta
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Ganti: Validasi mhsbahasa_id)
        $validated = $request->validate([
            'mhsbahasa_id' => 'required|exists:mhsbahasa,id|unique:skl_bahasa,mhsbahasa_id',
            'istima' => 'nullable|integer|min:1|max:999',
            'kitabah' => 'nullable|integer|min:1|max:999',
            'qiraah' => 'nullable|integer|min:1|max:999',
            'listening' => 'nullable|integer|min:1|max:999',
            'writing' => 'nullable|integer|min:1|max:999',
            'reading' => 'nullable|integer|min:1|max:999',
        ]);

        // 2. Cari Data Peserta (MhsBahasa)
        $peserta = MhsBahasa::with('mahasiswa')->find($validated['mhsbahasa_id']);

        // 3. Generate Nomor Sertifikat Unik
        $nim = $peserta->mahasiswa->nim;
        $prodi = $peserta->mahasiswa->program_studi;
        $no_sertifikat = 'SERT-TOSA-TOSE-' . date('Y') . '-' . strtoupper(Str::substr($prodi, 0, 3)) . '-' . $nim;

        // 4. Generate & Simpan QR Code (Gunakan rute generik)
        $validationUrl = route('public.validasi', $no_sertifikat); 
        $qrCodeImage = QrCode::format('png')->size(200)->generate($validationUrl);
        $qrCodePath = 'qr-codes/bahasa/qrcode_' . $no_sertifikat . '.png';
        Storage::disk('public')->put($qrCodePath, $qrCodeImage);

        // 5. Simpan data ke Database (menggunakan ID Peserta)
        $validated['no_sertifikat'] = $no_sertifikat;
        $validated['mhsbahasa_id'] = $validated['mhsbahasa_id']; // Pastikan ID Peserta masuk
        
        SklBahasa::create($validated);

        // 6. Redirect kembali ke index
        return redirect()->route('skl-bahasa.index')->with('success', 'Data SKL Bahasa berhasil dibuat.');
    }

    /**
     * Menampilkan detail satu data SKL.
     */
    public function show(SklBahasa $sklBahasa) // Route-Model Binding
    {
        // $sklBahasa sudah otomatis diambil
        $sklBahasa->load('mhsBahasa.mahasiswa');

        // Buat URL QR Code untuk ditampilkan di view
        $qrCodePath = 'qr-codes/bahasa/qrcode_' . $sklBahasa->no_sertifikat . '.png';
        $qrCodeUrl = Storage::disk('public')->exists($qrCodePath) 
                     ? asset('storage/' . $qrCodePath) 
                     : null;

        return view('skl_bahasa.show', compact('sklBahasa', 'qrCodeUrl'));
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(SklBahasa $sklBahasa)
    {
        // $sklBahasa sudah otomatis diambil
        return view('skl_bahasa.edit', compact('sklBahasa'));
    }

    /**
     * Memperbarui data di database.
     */
    public function update(Request $request, SklBahasa $sklBahasa)
    {
        // 1. Validasi
        $validated = $request->validate([
            // SKL Bahasa Arab
            'istima' => 'nullable|integer|min:1|max:999',
            'kitabah' => 'nullable|integer|min:1|max:999',
            'qiraah' => 'nullable|integer|min:1|max:999',
            // SKL Bahasa Inggris
            'listening' => 'nullable|integer|min:1|max:999',
            'writing' => 'nullable|integer|min:1|max:999',
            'reading' => 'nullable|integer|min:1|max:999',
        ]);
        
        // 2. Update data
        $sklBahasa->update($validated);

        // 3. Redirect kembali
        return redirect()->route('skl-bahasa.index')->with('success', 'Data SKL Bahasa berhasil diperbarui.');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(SklBahasa $sklBahasa)
    {
        // 1. Hapus file QR Code terkait
        $qrCodePath = 'qr-codes/bahasa/qrcode_' . $sklBahasa->no_sertifikat . '.png';
        if (Storage::disk('public')->exists($qrCodePath)) {
            Storage::disk('public')->delete($qrCodePath);
        }

        // 2. Hapus data dari database
        $sklBahasa->delete();

        // 3. Redirect kembali
        return redirect()->route('skl-bahasa.index')->with('success', 'Data SKL Bahasa berhasil dihapus.');
    }

    public function export()
    {
        $fileName = 'skl_bahasa_' . date('Y-m-d_H-i') . '.csv';
        
        $data = SklBahasa::with('mhsBahasa.mahasiswa')->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Header Kolom Excel (9 Kolom)
            fputcsv($file, [
                'Nama Mahasiswa', 'NIM', 'Program Studi', 'No Sertifikat',
                'Istima\'', 'Kitabah', 'Qira\'ah', // Arab
                'Listening', 'Writing', 'Reading'   // Inggris
            ]);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->mhsBahasa->mahasiswa->nama,
                    $row->mhsBahasa->mahasiswa->nim,
                    $row->mhsBahasa->mahasiswa->program_studi,
                    $row->no_sertifikat,
                    $row->istima,
                    $row->kitabah,
                    $row->qiraah,
                    $row->listening,
                    $row->writing,
                    $row->reading
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}