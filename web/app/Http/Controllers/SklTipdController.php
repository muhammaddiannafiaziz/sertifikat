<?php

namespace App\Http\Controllers;

use App\Models\SklTipd;
use App\Models\MhsTipd;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF; // Untuk PDF nanti

class SklTipdController extends Controller
{
    /**
     * Menampilkan daftar data SKL TIPD.
     */
    public function index(Request $request)
    {
        $query = SklTipd::with('mhsTipd.mahasiswa');

        // Logika Pencarian
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            })->orWhere('no_sertifikat', 'like', "%{$search}%");
        }

        $sklTipdData = $query->paginate(10);

        // Arahkan ke view baru
        return view('skl_tipd.index', compact('sklTipdData'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        // 1. Ganti: Ambil dari MhsTipd, bukan Mahasiswa
        $peserta = MhsTipd::whereDoesntHave('sklTipd')->with('mahasiswa')->get();
        
        return view('skl_tipd.create', compact('peserta')); // Mengirimkan $peserta
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Ganti: Validasi mhstipd_id)
        $validated = $request->validate([
            'mhstipd_id' => 'required|exists:mhstipd,id|unique:skl_tipd,mhstipd_id',
            'word' => 'nullable|integer|min:1|max:999',
            'excel' => 'nullable|integer|min:1|max:999',
            'power_point' => 'nullable|integer|min:1|max:999',
        ]);

        // 2. Cari Data Peserta (MhsTipd)
        $peserta = MhsTipd::with('mahasiswa')->find($validated['mhstipd_id']);

        // 3. Generate Nomor Sertifikat Unik
        $nim = $peserta->mahasiswa->nim;
        $prodi = $peserta->mahasiswa->program_studi;
        $no_sertifikat = 'SERT-KOMP-' . date('Y') . '-' . strtoupper(Str::substr($prodi, 0, 3)) . '-' . $nim;

        // 4. Generate & Simpan QR Code (Gunakan rute generik)
        $validationUrl = route('public.validasi', $no_sertifikat); 
        $qrCodeImage = QrCode::format('png')->size(200)->generate($validationUrl);
        $qrCodePath = 'qr-codes/tipd/qrcode_' . $no_sertifikat . '.png';
        Storage::disk('public')->put($qrCodePath, $qrCodeImage);

        // 5. Simpan data ke Database (menggunakan ID Peserta)
        $validated['no_sertifikat'] = $no_sertifikat;
        $validated['mhstipd_id'] = $validated['mhstipd_id']; // Pastikan ID Peserta masuk
        
        SklTipd::create($validated);

        // 6. Redirect kembali ke index
        return redirect()->route('skl-tipd.index')->with('success', 'Data SKL Komputer berhasil dibuat.');
    }

    /**
     * Menampilkan detail satu data SKL.
     */
    public function show(SklTipd $sklTipd) // Route-Model Binding
    {
        // $sklTipd sudah otomatis diambil
        $sklTipd->load('mahasiswa');

        // Buat URL QR Code untuk ditampilkan di view
        $qrCodePath = 'qr-codes/tipd/qrcode_' . $sklTipd->no_sertifikat . '.png';
        $qrCodeUrl = Storage::disk('public')->exists($qrCodePath) 
                     ? asset('storage/' . $qrCodePath) 
                     : null;

        return view('skl_tipd.show', compact('sklTipd', 'qrCodeUrl'));
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(SklTipd $sklTipd)
    {
        // $sklTipd sudah otomatis diambil
        return view('skl_tipd.edit', compact('sklTipd'));
    }

    /**
     * Memperbarui data di database.
     */
    public function update(Request $request, SklTipd $sklTipd)
    {
        // 1. Validasi
        $validated = $request->validate([
            'word' => 'nullable|integer|min:1|max:999',
            'excel' => 'nullable|integer|min:1|max:999',
            'power_point' => 'nullable|integer|min:1|max:999',
        ]);
        
        // 2. Update data
        $sklTipd->update($validated);

        // 3. Redirect kembali
        return redirect()->route('skl-tipd.index')->with('success', 'Data SKL Komputer berhasil diperbarui.');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(SklTipd $sklTipd)
    {
        // 1. Hapus file QR Code terkait
        $qrCodePath = 'qr-codes/tipd/qrcode_' . $sklTipd->no_sertifikat . '.png';
        if (Storage::disk('public')->exists($qrCodePath)) {
            Storage::disk('public')->delete($qrCodePath);
        }

        // 2. Hapus data dari database
        $sklTipd->delete();

        // 3. Redirect kembali
        return redirect()->route('skl-tipd.index')->with('success', 'Data SKL Komputer berhasil dihapus.');
    }
}