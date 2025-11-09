<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\SklMahad; 
use App\Models\SklBahasa; 
use App\Models\SklTipd;    
use Illuminate\Support\Facades\App; 
use SimpleSoftwareIO\QrCode\Facades\QrCode; 
use PDF; 

class PublicSertifikatController extends Controller
{
    /**
     * Menampilkan halaman form untuk cek NIM.
     */
    public function showCheckForm()
    {
        // Arahkan ke view baru yang akan kita buat
        return view('frontend.cek_nim');
    }

    /**
     * Memproses pencarian NIM dan menampilkan hasil gabungan.
     */
    public function checkByNim(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nim' => 'required|string|max:9' // Sesuaikan max jika perlu
        ]);

        $nim = $request->input('nim');

        // 2. Cari Mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::with(['sklMahad', 'sklBahasa', 'sklTipd'])
                              ->where('nim', $nim)
                              ->first();

        // 3. Jika mahasiswa tidak ditemukan
        if (!$mahasiswa) {
            return redirect()->route('public.cek')
                             ->with('error', 'NIM tidak ditemukan. Pastikan NIM Anda benar.');
        }

        // 4. Jika mahasiswa ditemukan, tapi tidak punya data SKL sama sekali
        if (!$mahasiswa->sklMahad && !$mahasiswa->sklBahasa && !$mahasiswa->sklTipd) {
             return redirect()->route('public.cek')
                             ->with('error', 'Mahasiswa ditemukan, namun belum ada data SKL yang diterbitkan.');
        }

        // 5. Jika berhasil, kirim semua data ke view 'hasil_gabungan'
        return view('frontend.hasil_gabungan', [
            'mahasiswa' => $mahasiswa,
            'sklMahad' => $mahasiswa->sklMahad,
            'sklBahasa' => $mahasiswa->sklBahasa,
            'sklTipd' => $mahasiswa->sklTipd,
        ]);
    }

    // ===================================
    // ==     FUNGSI BARU DIMULAI         ==
    // ===================================

    /**
     * Helper function untuk mencari sertifikat di 3 tabel.
     * Mengembalikan array [data, tipe_skl]
     */
    private function findSertifikat($no_sertifikat)
    {
        // Muat relasi mahasiswa agar data nama, nim, dll selalu ada
        $data = SklMahad::with('mahasiswa')->where('no_sertifikat', $no_sertifikat)->first();
        if ($data) {
            return [$data, 'mahad'];
        }

        $data = SklBahasa::with('mahasiswa')->where('no_sertifikat', $no_sertifikat)->first();
        if ($data) {
            return [$data, 'bahasa'];
        }

        $data = SklTipd::with('mahasiswa')->where('no_sertifikat', $no_sertifikat)->first();
        if ($data) {
            return [$data, 'tipd'];
        }

        return [null, null]; // Tidak ditemukan
    }

    /**
     * Menangani download PDF generik.
     */
    public function download($no_sertifikat)
    {
        [$data, $type] = $this->findSertifikat($no_sertifikat);

        // Jika tidak ditemukan
        if (!$data) {
            // Jika Anda punya halaman error 404 kustom, gunakan itu
            return abort(404, 'Sertifikat tidak ditemukan.');
        }
        
        // 1. Tentukan template PDF mana yang akan digunakan
        $viewTemplate = 'pdf.' . $type; // (pdf.mahad, pdf.bahasa, pdf.tipd)

        // 2. Generate QR Code (Base64) untuk disematkan di PDF
        $validationUrl = route('public.validasi', $no_sertifikat);
        $qrCodeImage = QrCode::format('png')->size(200)->generate($validationUrl);
        $qrCodeBase64 = base64_encode($qrCodeImage);
        
        // 3. Siapkan data untuk dikirim ke view PDF
        $pdfData = [
            'data' => $data, // $data berisi $sklMahad, $sklBahasa, atau $sklTipd
            'qrCodeBase64' => $qrCodeBase64,
        ];

        // 4. Load PDF
        // Pastikan App::environment() tidak 'local' jika background image bermasalah
        // if (App::environment('local')) {
        //     // Workaround untuk base64 di local
        // }
        
        $pdf = PDF::loadView($viewTemplate, $pdfData)->setPaper('a4', 'landscape');
        
        // 5. Download file
        return $pdf->download('sertifikat-' . $type . '-' . $data->mahasiswa->nim . '.pdf');
    }

    /**
     * Menangani validasi QR Code generik.
     */
    public function validasi($no_sertifikat)
    {
        [$data, $type] = $this->findSertifikat($no_sertifikat);

        // Kirim data ke view validasi (yang akan kita buat)
        // View ini akan menampilkan "Ditemukan" atau "Tidak Ditemukan"
        return view('frontend.validasi', [
            'data' => $data,
            'type' => $type, // 'mahad', 'bahasa', 'tipd', atau null
            'no_sertifikat' => $no_sertifikat,
        ]);
    }
}