<?php

namespace App\Http\Controllers;

use App\Models\SklBahasa; // Model baru
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
        $query = SklBahasa::with('mahasiswa');

        // Logika Pencarian
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->whereHas('mahasiswa', function ($q) use ($search) {
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
        // Ambil hanya mahasiswa yang BELUM punya data SKL Bahasa
        $mahasiswa = Mahasiswa::whereDoesntHave('sklBahasa')->get();
        
        // Arahkan ke view baru
        return view('skl_bahasa.create', compact('mahasiswa'));
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id|unique:skl_bahasa,mahasiswa_id',
            // SKL Bahasa Arab
            'istima' => 'nullable|integer|min:1|max:999',
            'kitabah' => 'nullable|integer|min:1|max:999',
            'qiraah' => 'nullable|integer|min:1|max:999',
            // SKL Bahasa Inggris
            'listening' => 'nullable|integer|min:1|max:999',
            'writing' => 'nullable|integer|min:1|max:999',
            'reading' => 'nullable|integer|min:1|max:999',
        ]);

        // 2. Cari Mahasiswa (untuk data NIM & Prodi)
        $mahasiswa = Mahasiswa::find($validated['mahasiswa_id']);

        // 3. Generate Nomor Sertifikat Unik (Sesuai permintaan Anda)
        $no_sertifikat = 'SERT-TOSA-TOSE-' . date('Y') . '-' . strtoupper(Str::substr($mahasiswa->program_studi, 0, 3)) . '-' . $mahasiswa->nim;

        // 4. Generate & Simpan QR Code
        // BARU:
        $validationUrl = route('public.validasi', $no_sertifikat);
        $qrCodeImage = QrCode::format('png')->size(200)->generate($validationUrl);
        $qrCodePath = 'qr-codes/bahasa/qrcode_' . $no_sertifikat . '.png';
        Storage::disk('public')->put($qrCodePath, $qrCodeImage);

        // 5. Simpan data ke Database
        // Gabungkan no_sertifikat ke data tervalidasi
        $validated['no_sertifikat'] = $no_sertifikat;
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
        $sklBahasa->load('mahasiswa');

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
}