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
        return view('frontend.cek_nim');
    }

    /**
     * Memproses pencarian NIM dan menampilkan hasil gabungan.
     */
    public function checkByNim(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nim' => 'required|string|max:20' // Sesuaikan max length
        ]);

        $nim = $request->input('nim');

        // 2. Cari Mahasiswa berdasarkan NIM dengan RELASI BERTINGKAT
        // Kita perlu memuat:
        // - mhsMahad -> sklMahad
        // - mhsBahasa -> sklBahasa
        // - mhsTipd -> sklTipd
        $mahasiswa = Mahasiswa::with([
            'mhsMahad.sklMahad', 
            'mhsBahasa.sklBahasa', 
            'mhsTipd.sklTipd'
        ])->where('nim', $nim)->first();

        // 3. Jika mahasiswa tidak ditemukan di data master
        if (!$mahasiswa) {
            return redirect()->route('public.cek')
                             ->with('error', 'NIM tidak ditemukan di data master mahasiswa. Pastikan NIM Anda benar.');
        }

        // 4. Ambil data SKL dari relasi bertingkat (bisa null)
        // Gunakan optional() untuk keamanan jika peserta belum terdaftar
        $sklMahad = optional($mahasiswa->mhsMahad)->sklMahad;
        $sklBahasa = optional($mahasiswa->mhsBahasa)->sklBahasa;
        $sklTipd = optional($mahasiswa->mhsTipd)->sklTipd;

        // 5. Cek apakah ada setidaknya satu SKL
        if (!$sklMahad && !$sklBahasa && !$sklTipd) {
             return redirect()->route('public.cek')
                             ->with('error', 'Mahasiswa ditemukan, namun belum ada data SKL yang diterbitkan.');
        }

        // 6. Kirim data ke view
        return view('frontend.hasil_gabungan', [
            'mahasiswa' => $mahasiswa,
            'sklMahad' => $sklMahad,
            'sklBahasa' => $sklBahasa,
            'sklTipd' => $sklTipd,
        ]);
    }

    // ===================================
    // ==     FUNGSI BARU DIMULAI       ==
    // ===================================

    /**
     * Helper function untuk mencari sertifikat di 3 tabel.
     * Mengembalikan array [data, tipe_skl]
     */
    private function findSertifikat($no_sertifikat)
    {
        // PENTING: Gunakan relasi bertingkat (mhs...->mahasiswa)

        // 1. Cek di SKL Ma'had
        $data = SklMahad::with('mhsMahad.mahasiswa')->where('no_sertifikat', $no_sertifikat)->first();
        if ($data) {
            return [$data, 'mahad'];
        }

        // 2. Cek di SKL Bahasa
        $data = SklBahasa::with('mhsBahasa.mahasiswa')->where('no_sertifikat', $no_sertifikat)->first();
        if ($data) {
            return [$data, 'bahasa'];
        }

        // 3. Cek di SKL TIPD
        $data = SklTipd::with('mhsTipd.mahasiswa')->where('no_sertifikat', $no_sertifikat)->first();
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
            return abort(404, 'Sertifikat tidak ditemukan.');
        }
        
        // 1. Tentukan template PDF
        $viewTemplate = 'pdf.' . $type; // (pdf.mahad, pdf.bahasa, pdf.tipd)

        // 2. Generate QR Code
        $validationUrl = route('public.validasi', $no_sertifikat);
        $qrCodeImage = QrCode::format('png')->size(200)->generate($validationUrl);
        $qrCodeBase64 = base64_encode($qrCodeImage);
        
        // 3. Siapkan data untuk view
        $pdfData = [
            'data' => $data,
            'qrCodeBase64' => $qrCodeBase64,
        ];

        $pdf = PDF::loadView($viewTemplate, $pdfData)->setPaper('a4', 'landscape');
        
        // 4. Ambil NIM untuk nama file (Akses Bertingkat)
        $nim = null;
        if ($type == 'mahad') $nim = $data->mhsMahad->mahasiswa->nim;
        elseif ($type == 'bahasa') $nim = $data->mhsBahasa->mahasiswa->nim;
        elseif ($type == 'tipd') $nim = $data->mhsTipd->mahasiswa->nim;
        
        // 5. Download file
        return $pdf->download('sertifikat-' . $type . '-' . $nim . '.pdf');
    }

    /**
     * Menangani validasi QR Code generik.
     */
    public function validasi($no_sertifikat)
    {
        [$data, $type] = $this->findSertifikat($no_sertifikat);

        // Kirim data ke view validasi
        // View validasi juga perlu disesuaikan untuk akses data bertingkat
        return view('frontend.validasi', [
            'data' => $data,
            'type' => $type,
            'no_sertifikat' => $no_sertifikat,
        ]);
    }
}