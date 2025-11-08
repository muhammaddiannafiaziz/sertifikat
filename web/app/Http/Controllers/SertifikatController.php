<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
// Pastikan Anda mengimpor \PDF jika belum
use PDF; // atau use Barryvdh\DomPDF\Facade\Pdf;

class SertifikatController extends Controller
{
    public function index(Request $request)
    {
        $query = Sertifikat::with('mahasiswa');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })->orWhere('no_sertifikat', 'like', "%{$search}%");
        }

        $sertifikats = $query->paginate(10);

        return view('sertifikat.index', compact('sertifikats'));
    }
    // Menampilkan form untuk membuat sertifikat
    public function create()
    {
        // Mengambil data mahasiswa yang belum memiliki sertifikat
        $mahasiswa = Mahasiswa::whereDoesntHave('sertifikats')->get();

        // Menampilkan view form pembuatan sertifikat
        return view('sertifikat.create', compact('mahasiswa'));
    }

    public function generateSertifikat(Request $request)
    {
        // --- AWAL PERUBAHAN ---
        // Validasi input dari request
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'status_ujian_ibadah' => 'required|in:lulus,tidak_lulus', // Validasi status ujian ibadah
            'status_ujian_alquran' => 'required|in:lulus,tidak_lulus', // Validasi status ujian al-Qur'an
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // SKL Bahasa Arab
            'istima' => 'nullable|integer|min:1|max:999',
            'kitabah' => 'nullable|integer|min:1|max:999',
            'qiraah' => 'nullable|integer|min:1|max:999',

            // SKL Bahasa Inggris
            'listening' => 'nullable|integer|min:1|max:999',
            'writing' => 'nullable|integer|min:1|max:999',
            'reading' => 'nullable|integer|min:1|max:999',

            // SKL Komputer
            'word' => 'nullable|integer|min:1|max:999',
            'excel' => 'nullable|integer|min:1|max:999',
            'power_point' => 'nullable|integer|min:1|max:999',
        ]);
        // --- AKHIR PERUBAHAN ---

        // Cek apakah mahasiswa sudah memiliki sertifikat
        $existingSertifikat = Sertifikat::where('mahasiswa_id', $validated['mahasiswa_id'])->first();
        if ($existingSertifikat) {
            // Jika sudah memiliki sertifikat, kembalikan pesan error
            return redirect()->route('sertifikat.index')->with('error', 'Mahasiswa ini sudah memiliki sertifikat.');
        }

        // Ambil data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::find($validated['mahasiswa_id']);

        // Kustomisasi nomor sertifikat
        $no_sertifikat = 'SERT-SKL-' . date('Y') . '-' . strtoupper(Str::substr($mahasiswa->program_studi, 0, 3)) . '-' . $mahasiswa->nim;

        // Upload background image jika ada
        $backgroundPath = null;
        if ($request->hasFile('background_image')) {
            $backgroundPath = $request->file('background_image')->store('backgrounds', 'public');
        }

        // --- AWAL PERUBAHAN ---
        // Simpan data sertifikat ke database
        // Kita gunakan $validated agar semua data tervalidasi masuk
        $sertifikatData = $validated;
        $sertifikatData['no_sertifikat'] = $no_sertifikat;
        $sertifikatData['background_image'] = $backgroundPath;

        $sertifikat = Sertifikat::create($sertifikatData);
        // --- AKHIR PERUBAHAN ---

        // Generate QR code untuk validasi sertifikat
        $validationUrl = url("/sertifikat/validasi/{$no_sertifikat}");
        $qrCodeImage = QrCode::format('png')->size(200)->generate($validationUrl);

        // Simpan gambar QR code ke folder public/storage
        $fileName = 'qrcode_' . $no_sertifikat . '.png';
        Storage::disk('public')->put($fileName, $qrCodeImage);

        // URL untuk QR Code
        $qrCodeUrl = asset('storage/' . $fileName);

        // Kembali ke halaman sertifikat setelah sukses
        return view('sertifikat.show', compact('sertifikat', 'qrCodeUrl'));
    }

    // Menampilkan halaman validasi sertifikat
    public function validasiSertifikat($no_sertifikat)
    {
        // Cari sertifikat berdasarkan nomor sertifikat
        $sertifikat = Sertifikat::where('no_sertifikat', $no_sertifikat)->first();

        if (!$sertifikat) {
            return redirect()->route('home')->with('error', 'Sertifikat tidak ditemukan.');
        }

        return view('sertifikat.validasi', compact('sertifikat'));
    }

    // (Saya biarkan fungsi downloadSertifikat lama Anda yang di-comment)
    // public function downloadSertifikat($no_sertifikat)
    // { ... }

    public function show($id)
    {
        // Ambil sertifikat berdasarkan ID
        $sertifikat = Sertifikat::with('mahasiswa')->findOrFail($id);

        // URL QR Code (ganti dengan logika generate QR code sesuai kebutuhan Anda)
        // Perbaiki logika path QR code agar konsisten dengan saat generate
        $qrCodeName = 'qrcode_' . $sertifikat->no_sertifikat . '.png';
        $qrCodeUrl = asset('storage/' . $qrCodeName);

        return view('backend.sertifikat.show', compact('sertifikat', 'qrCodeUrl'));
    }

    public function destroy($id)
    {
        // Cari sertifikat berdasarkan ID
        $sertifikat = Sertifikat::findOrFail($id);

        // Hapus QR Code terkait (jika ada)
        // Perbaiki path storage agar konsisten
        $qrCodePath = 'qrcode_' . $sertifikat->no_sertifikat . '.png';
        if (Storage::disk('public')->exists($qrCodePath)) {
            Storage::disk('public')->delete($qrCodePath); // Menghapus file QR Code
        }
        
        // Hapus Background Image (jika ada)
        if ($sertifikat->background_image && Storage::disk('public')->exists($sertifikat->background_image)) {
            Storage::disk('public')->delete($sertifikat->background_image);
        }

        // Hapus data sertifikat
        $sertifikat->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('sertifikat.index')->with('success', 'Sertifikat berhasil dihapus.');
    }

    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        // Anda mungkin perlu mengirim data mahasiswa jika form edit Anda mengizinkan mengubah mahasiswa
        // $mahasiswa = Mahasiswa::all(); 
        return view('sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        // --- AWAL PERUBAHAN ---
        $validated = $request->validate([
            'status_ujian_ibadah' => 'required|in:lulus,tidak_lulus',
            'status_ujian_alquran' => 'required|in:lulus,tidak_lulus',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Tambahkan validasi background
            
            // SKL Bahasa Arab
            'istima' => 'nullable|integer|min:1|max:999',
            'kitabah' => 'nullable|integer|min:1|max:999',
            'qiraah' => 'nullable|integer|min:1|max:999',

            // SKL Bahasa Inggris
            'listening' => 'nullable|integer|min:1|max:999',
            'writing' => 'nullable|integer|min:1|max:999',
            'reading' => 'nullable|integer|min:1|max:999',

            // SKL Komputer
            'word' => 'nullable|integer|min:1|max:999',
            'excel' => 'nullable|integer|min:1|max:999',
            'power_point' => 'nullable|integer|min:1|max:999',
        ]);
        // --- AKHIR PERUBAHAN ---

        $sertifikat = Sertifikat::findOrFail($id);
        
        $updateData = $validated;

        // Logika untuk handle upload background image saat update
        if ($request->hasFile('background_image')) {
            // Hapus gambar lama jika ada
            if ($sertifikat->background_image && Storage::disk('public')->exists($sertifikat->background_image)) {
                Storage::disk('public')->delete($sertifikat->background_image);
            }
            // Simpan gambar baru
            $updateData['background_image'] = $request->file('background_image')->store('backgrounds', 'public');
        }

        // --- AWAL PERUBAHAN ---
        // Update sertifikat dengan semua data tervalidasi
        $sertifikat->update($updateData);
        // --- AKHIR PERUBAHAN ---

        return redirect()->route('sertifikat.index')->with('success', 'Status sertifikat berhasil diperbarui.');
    }

    // (Saya biarkan fungsi edit lama Anda yang di-comment)
    // public function edit($id)
    // { ... }

    public function download($id)
    {
        // Find the certificate by its ID
        $sertifikat = Sertifikat::find($id);

        if (!$sertifikat) {
            return response()->json(['message' => 'Certificate not found.'], 404);
        }

        // Assuming you store certificates in the storage directory and have a file path in your database
        // PERHATIAN: Logika ini sepertinya untuk file yg diupload manual, BUKAN generate PDF.
        // Pastikan $sertifikat->file_name ada di database Anda atau logika ini akan error.
        // $filePath = storage_path('app/public/certificates/' . $sertifikat->file_name);
        
        // JIKA ANDA INGIN MENGGUNAKAN FUNGSI PDF, panggil fungsi downloadSertifikat($no_sertifikat)
        // Contoh: return $this->downloadSertifikat($sertifikat->no_sertifikat);

        // Kode di bawah ini saya biarkan sesuai aslinya
        if (empty($sertifikat->file_name)) {
             return response()->json(['message' => 'File name not specified.'], 404);
        }

        $filePath = storage_path('app/public/certificates/' . $sertifikat->file_name);

        if (!file_exists($filePath)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        // Return the file for download
        return response()->download($filePath);
    }

    public function cekSertifikat(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nim' => 'required|string'
            ]);

            $sertifikat = Sertifikat::whereHas('mahasiswa', function ($query) use ($request) {
                $query->where('nim', $request->nim);
            })->first();

            if (!$sertifikat) {
                return redirect()->route('cek-sertifikat')->with('error', 'Sertifikat tidak ditemukan!');
            }

            return view('sertifikat.hasil', compact('sertifikat'));
        }

        return view('sertifikat.cek');
    }

    public function cariSertifikat(Request $request)
    {
        $request->validate([
            'nim' => 'required|string'
        ]);
        
        // Ini seharusnya mencari di relasi mahasiswa, bukan di tabel sertifikat
        // $sertifikat = Sertifikat::where('nim', $request->nim)->first(); 
        // Seharusnya seperti ini:
         $sertifikat = Sertifikat::whereHas('mahasiswa', function ($query) use ($request) {
            $query->where('nim', $request->nim);
        })->first();


        if (!$sertifikat) {
            return redirect()->back()->with('error', 'Sertifikat tidak ditemukan!');
        }

        return view('frontend.sertifikat', compact('sertifikat'));
    }

    public function unduhSertifikat(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|exists:mahasiswas,nim',
        ]);

        // Cari mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (!$mahasiswa) {
            return redirect()->route('cek-sertifikat')->with('error', 'Mahasiswa tidak ditemukan.');
        }

        // Cek apakah mahasiswa memiliki sertifikat dan apakah lulus
        // Logika ini mungkin perlu diubah jika 5 SKL baru juga menentukan kelulusan
        $sertifikat = Sertifikat::where('mahasiswa_id', $mahasiswa->id)
            ->where('status_ujian_ibadah', 'lulus')
            ->where('status_ujian_alquran', 'lulus')
            ->first();

        if (!$sertifikat) {
            return redirect()->route('cek-sertifikat')->with('error', 'Anda belum lulus, silakan mengulang ujian.');
        }

        // Jika lulus, tampilkan tombol unduh sertifikat
        return view('sertifikat.hasil', compact('sertifikat'));
    }

    public function downloadSertifikat($no_sertifikat)
    {
        $sertifikat = Sertifikat::where('no_sertifikat', $no_sertifikat)->first();

        if (!$sertifikat) {
            return redirect()->route('cek-sertifikat')->with('error', 'Sertifikat tidak ditemukan.');
        }

        // Generate QR code untuk sertifikat
        $validationUrl = url("/sertifikat/validasi/{$no_sertifikat}");
        $qrCodeImage = QrCode::format('png')->size(200)->generate($validationUrl);

        // Konversi QR Code ke Base64
        $qrCodeBase64 = base64_encode($qrCodeImage);

        // Data untuk sertifikat PDF
        $data = [
            'sertifikat' => $sertifikat,
            'qrCodeBase64' => $qrCodeBase64,
        ];

        // Buat PDF dari tampilan sertifikat
        // Pastikan view 'sertifikat.pdf' sudah diupdate untuk 9 SKL baru
        $html = view('sertifikat.pdf', $data)->render();
        // $pdf = \PDF::loadHTML($html)->setPaper('a4', 'landscape');
        // Gunakan variabel $pdf yang diimpor di atas
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        // Download sertifikat PDF
        return $pdf->download('sertifikat-' . $sertifikat->no_sertifikat . '.pdf');
    }

    public function export()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=sertifikat.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');

            // --- AWAL PERUBAHAN ---
            // Menulis header kolom CSV
            fputcsv($handle, [
                'Nama', 'NIM', 'Program Studi', 'Fakultas', 'No Sertifikat', 
                'Status Ujian Ibadah', 'Status Ujian Al-Quran',
                // SKL Baru
                'Istima', 'Kitabah', 'Qiraah',
                'Listening', 'Writing', 'Reading',
                'Word', 'Excel', 'Power Point'
            ]);
            // --- AKHIR PERUBAHAN ---

            // Mengambil data sertifikat dengan relasi mahasiswa
            Sertifikat::with('mahasiswa')->chunk(200, function ($sertifikats) use ($handle) {
                foreach ($sertifikats as $sertifikat) {
                    if ($sertifikat->mahasiswa) {
                        // --- AWAL PERUBAHAN ---
                        fputcsv($handle, [
                            $sertifikat->mahasiswa->nama,
                            $sertifikat->mahasiswa->nim,
                            $sertifikat->mahasiswa->program_studi,
                            $sertifikat->mahasiswa->fakultas,
                            $sertifikat->no_sertifikat,
                            $sertifikat->status_ujian_ibadah,
                            $sertifikat->status_ujian_alquran,
                            // SKL Baru
                            $sertifikat->istima,
                            $sertifikat->kitabah,
                            $sertifikat->qiraah,
                            $sertifikat->listening,
                            $sertifikat->writing,
                            $sertifikat->reading,
                            $sertifikat->word,
                            $sertifikat->excel,
                            $sertifikat->power_point,
                        ]);
                        // --- AKHIR PERUBAHAN ---
                    }
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}