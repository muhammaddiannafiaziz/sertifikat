<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        // Validasi input dari request
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'status_ujian_ibadah' => 'required|in:lulus,tidak_lulus', // Validasi status ujian ibadah
            'status_ujian_alquran' => 'required|in:lulus,tidak_lulus', // Validasi status ujian al-Qur'an
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cek apakah mahasiswa sudah memiliki sertifikat
        $existingSertifikat = Sertifikat::where('mahasiswa_id', $validated['mahasiswa_id'])->first();
        if ($existingSertifikat) {
            // Jika sudah memiliki sertifikat, kembalikan pesan error
            return redirect()->route('sertifikat.index')->with('error', 'Mahasiswa ini sudah memiliki sertifikat.');
        }

        // Ambil data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::find($validated['mahasiswa_id']);

        // Kustomisasi nomor sertifikat
        $no_sertifikat = 'SERT-IBD-QRN-' . date('Y') . '-' . strtoupper(Str::substr($mahasiswa->program_studi, 0, 3)) . '-' . $mahasiswa->nim;

        // Upload background image jika ada
        $backgroundPath = null;
        if ($request->hasFile('background_image')) {
            $backgroundPath = $request->file('background_image')->store('backgrounds', 'public');
        }

        // Simpan data sertifikat ke database
        $sertifikat = Sertifikat::create([
            'mahasiswa_id' => $validated['mahasiswa_id'],
            'no_sertifikat' => $no_sertifikat,
            'status_ujian_ibadah' => $validated['status_ujian_ibadah'], // Simpan status ujian ibadah
            'status_ujian_alquran' => $validated['status_ujian_alquran'], // Simpan status ujian al-Qur'an
            'background_image' => $backgroundPath,
        ]);

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

    // Mengunduh sertifikat dalam format PDF
    // public function downloadSertifikat($no_sertifikat)
    // {

    //     $sertifikat = Sertifikat::where('no_sertifikat', $no_sertifikat)->first();

    //     if (!$sertifikat) {
    //         return redirect()->route('home')->with('error', 'Sertifikat tidak ditemukan.');
    //     }

    //     $validationUrl = url("/sertifikat/validasi/{$no_sertifikat}");
    //     $qrCodeImage = QrCode::format('png')->size(200)->generate($validationUrl);


    //     $qrCodeBase64 = base64_encode($qrCodeImage);


    //     $data = [
    //         'sertifikat' => $sertifikat,
    //         'qrCodeBase64' => $qrCodeBase64,
    //     ];


    //     $html = view('sertifikat.pdf', $data)->render();


    //     $pdf = \PDF::loadHTML($html)->setPaper('a4', 'landscape');

    //     return $pdf->download('sertifikat-' . $sertifikat->no_sertifikat . '.pdf');
    // }

    public function show($id)
    {
        // Ambil sertifikat berdasarkan ID
        $sertifikat = Sertifikat::with('mahasiswa')->findOrFail($id);

        // URL QR Code (ganti dengan logika generate QR code sesuai kebutuhan Anda)
        $qrCodeUrl = asset('storage/' . $sertifikat->no_sertifikat . '.png');

        return view('backend.sertifikat.show', compact('sertifikat', 'qrCodeUrl'));
    }

    public function destroy($id)
    {
        // Cari sertifikat berdasarkan ID
        $sertifikat = Sertifikat::findOrFail($id);

        // Hapus QR Code terkait (jika ada)
        $qrCodePath = public_path('qr-codes/' . $sertifikat->no_sertifikat . '.png');
        if (file_exists($qrCodePath)) {
            unlink($qrCodePath); // Menghapus file QR Code
        }

        // Hapus data sertifikat
        $sertifikat->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('sertifikat.index')->with('success', 'Sertifikat berhasil dihapus.');
    }

    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        return view('sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_ujian_ibadah' => 'required|in:lulus,tidak_lulus',
            'status_ujian_alquran' => 'required|in:lulus,tidak_lulus',
        ]);

        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->update([
            'status_ujian_ibadah' => $validated['status_ujian_ibadah'],
            'status_ujian_alquran' => $validated['status_ujian_alquran'],
        ]);

        return redirect()->route('sertifikat.index')->with('success', 'Status sertifikat berhasil diperbarui.');
    }

    // public function edit($id)
    // {
    //     // Cari sertifikat berdasarkan ID
    //     $sertifikat = Sertifikat::findOrFail($id);

    //     // Data tambahan jika diperlukan (misalnya, data mahasiswa untuk dropdown)
    //     $mahasiswa = Mahasiswa::all();

    //     // Tampilkan halaman edit dengan data sertifikat
    //     return view('backend.sertifikat.edit', compact('sertifikat', 'mahasiswa'));
    // }

    public function download($id)
    {
        // Find the certificate by its ID
        $sertifikat = Sertifikat::find($id);

        if (!$sertifikat) {
            return response()->json(['message' => 'Certificate not found.'], 404);
        }

        // Assuming you store certificates in the storage directory and have a file path in your database
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

        $sertifikat = Sertifikat::where('nim', $request->nim)->first();

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
        $html = view('sertifikat.pdf', $data)->render();
        $pdf = \PDF::loadHTML($html)->setPaper('a4', 'landscape');

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

            // Menulis header kolom CSV
            fputcsv($handle, ['Nama', 'NIM', 'Program Studi', 'Fakultas', 'No Sertifikat', 'Status Ujian Ibadah', 'Status Ujian Al-Quran']);

            // Mengambil data sertifikat dengan relasi mahasiswa
            Sertifikat::with('mahasiswa')->chunk(200, function ($sertifikats) use ($handle) {
                foreach ($sertifikats as $sertifikat) {
                    if ($sertifikat->mahasiswa) {
                        fputcsv($handle, [
                            $sertifikat->mahasiswa->nama,
                            $sertifikat->mahasiswa->nim,
                            $sertifikat->mahasiswa->program_studi,
                            $sertifikat->mahasiswa->fakultas,
                            $sertifikat->no_sertifikat,
                            $sertifikat->status_ujian_ibadah,
                            $sertifikat->status_ujian_alquran,
                        ]);
                    }
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
