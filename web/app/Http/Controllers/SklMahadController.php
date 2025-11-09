<?php

namespace App\Http\Controllers;

use App\Models\SklMahad; // Model baru
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF; // Untuk PDF nanti

class SklMahadController extends Controller
{
    /**
     * Menampilkan daftar data SKL Ma'had.
     */
    public function index(Request $request)
    {
        $query = SklMahad::with('mahasiswa');

        // Logika Pencarian
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            })->orWhere('no_sertifikat', 'like', "%{$search}%");
        }

        $sklMahadData = $query->paginate(10);

        // Arahkan ke view baru
        return view('skl_mahad.index', compact('sklMahadData'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        // Ambil hanya mahasiswa yang BELUM punya data SKL Ma'had
        $mahasiswa = Mahasiswa::whereDoesntHave('sklMahad')->get();
        
        // Arahkan ke view baru
        return view('skl_mahad.create', compact('mahasiswa'));
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id|unique:skl_mahad,mahasiswa_id',
            'status_ujian_ibadah' => 'required|in:lulus,tidak_lulus',
            'status_ujian_alquran' => 'required|in:lulus,tidak_lulus',
        ]);

        // 2. Cari Mahasiswa (untuk data NIM & Prodi)
        $mahasiswa = Mahasiswa::find($validated['mahasiswa_id']);

        // 3. Generate Nomor Sertifikat Unik (Sesuai permintaan Anda)
        $no_sertifikat = 'SERT-IBD-QRN-' . date('Y') . '-' . strtoupper(Str::substr($mahasiswa->program_studi, 0, 3)) . '-' . $mahasiswa->nim;

        // 4. Generate & Simpan QR Code
        $validationUrl = route('public.validasi', $no_sertifikat);
        $qrCodeImage = QrCode::format('png')->size(200)->generate($validationUrl);
        $qrCodePath = 'qr-codes/mahad/qrcode_' . $no_sertifikat . '.png';
        Storage::disk('public')->put($qrCodePath, $qrCodeImage);

        // 5. Simpan data ke Database
        SklMahad::create([
            'mahasiswa_id' => $validated['mahasiswa_id'],
            'no_sertifikat' => $no_sertifikat,
            'status_ujian_ibadah' => $validated['status_ujian_ibadah'],
            'status_ujian_alquran' => $validated['status_ujian_alquran'],
        ]);

        // 6. Redirect kembali ke index
        return redirect()->route('skl-mahad.index')->with('success', 'Data SKL Ma\'had berhasil dibuat.');
    }

    /**
     * Menampilkan detail satu data SKL.
     */
    public function show(SklMahad $sklMahad) // Route-Model Binding
    {
        // $sklMahad sudah otomatis diambil berdasarkan ID dari URL
        // Kita juga perlu memuat data mahasiswa terkait
        $sklMahad->load('mahasiswa');

        // Buat URL QR Code untuk ditampilkan di view
        $qrCodePath = 'qr-codes/mahad/qrcode_' . $sklMahad->no_sertifikat . '.png';
        $qrCodeUrl = Storage::disk('public')->exists($qrCodePath) 
                     ? asset('storage/' . $qrCodePath) 
                     : null; // Handle jika file QR hilang

        return view('skl_mahad.show', compact('sklMahad', 'qrCodeUrl'));
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(SklMahad $sklMahad)
    {
        // $sklMahad sudah otomatis diambil
        // Data mahasiswa bisa diakses via $sklMahad->mahasiswa
        return view('skl_mahad.edit', compact('sklMahad'));
    }

    /**
     * Memperbarui data di database.
     */
    public function update(Request $request, SklMahad $sklMahad)
    {
        // 1. Validasi (mahasiswa_id tidak perlu divalidasi/diubah)
        $validated = $request->validate([
            'status_ujian_ibadah' => 'required|in:lulus,tidak_lulus',
            'status_ujian_alquran' => 'required|in:lulus,tidak_lulus',
        ]);
        
        // 2. Update data
        $sklMahad->update($validated);

        // 3. Redirect kembali
        return redirect()->route('skl-mahad.index')->with('success', 'Data SKL Ma\'had berhasil diperbarui.');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(SklMahad $sklMahad)
    {
        // 1. Hapus file QR Code terkait
        $qrCodePath = 'qr-codes/mahad/qrcode_' . $sklMahad->no_sertifikat . '.png';
        if (Storage::disk('public')->exists($qrCodePath)) {
            Storage::disk('public')->delete($qrCodePath);
        }

        // 2. Hapus data dari database
        $sklMahad->delete();

        // 3. Redirect kembali
        return redirect()->route('skl-mahad.index')->with('success', 'Data SKL Ma\'had berhasil dihapus.');
    }

    // Kita akan tambahkan fungsi 'export' dan 'download' nanti
}