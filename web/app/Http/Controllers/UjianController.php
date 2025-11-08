<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Mahasiswa;
use App\Models\Sertifikat;

class UjianController extends Controller
{
    // Menampilkan daftar ujian
    public function index()
    {
        $ujian = Ujian::all();
        return view('ujian.index', compact('ujian'));
    }

    // Menampilkan form tambah ujian
    public function create()
    {
        return view('ujian.create');
    }

    // Menyimpan ujian baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        Ujian::create([
            'nama_ujian' => $request->nama_ujian,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil ditambahkan!');
    }

    // Menampilkan form edit ujian
    public function edit($id)
    {
        $ujian = Ujian::findOrFail($id);
        return view('ujian.edit', compact('ujian'));
    }

    // Menyimpan perubahan ujian
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $ujian = Ujian::findOrFail($id);
        $ujian->update([
            'nama_ujian' => $request->nama_ujian,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil diperbarui!');
    }

    // Menghapus ujian
    public function destroy($id)
    {
        $ujian = Ujian::findOrFail($id);
        $ujian->delete();

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil dihapus!');
    }

    // Menampilkan daftar peserta ujian dan status sertifikat
    public function showPeserta($id)
    {
        $ujian = Ujian::findOrFail($id);
        $peserta = Mahasiswa::where('ujian_id', $id)->get();

        // Tambahkan informasi sertifikat setiap mahasiswa
        foreach ($peserta as $mahasiswa) {
            $sertifikat = Sertifikat::where('mahasiswa_id', $mahasiswa->id)->first();
            $mahasiswa->sertifikat = $sertifikat ? $sertifikat->nomor_sertifikat : null;
        }

        return view('ujian.peserta', compact('ujian', 'peserta'));
    }
}
