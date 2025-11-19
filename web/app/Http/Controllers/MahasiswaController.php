<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Validator;


class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan parameter pencarian dari inputan user
        $search = $request->query('search');

        // Gunakan Mahasiswa::query() untuk memulai builder
        $query = Mahasiswa::query();

        // Jika ada pencarian, filter data mahasiswa berdasarkan nama, nim, atau email
        if ($search) {
            $mahasiswa = $query
                ->where('nama', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('program_studi', 'like', "%{$search}%")
                ->orWhere('fakultas', 'like', "%{$search}%")
                ->paginate(50);
        } else {
            // Jika tidak ada pencarian, ambil semua data mahasiswa (TANPA relasi ujian)
            $mahasiswa = $query->paginate(50);
        }

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'email' => 'required|email|unique:mahasiswas',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        // Hapus: $mahasiswa->load('ujian');
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'program_studi' => 'required',
            'fakultas' => 'required',
            'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }

    public function export()
    {
        // Ambil data mahasiswa
        $mahasiswa = Mahasiswa::all();

        // Set header untuk file CSV
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=mahasiswa.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        // Buka output stream untuk menulis file CSV
        $handle = fopen('php://output', 'w');

        // Menulis header kolom CSV
        fputcsv($handle, ['Nama', 'NIM', 'Program Studi', 'Fakultas', 'Email']);

        // Menulis data mahasiswa ke CSV
        foreach ($mahasiswa as $mhs) {
            fputcsv($handle, [$mhs->nama, $mhs->nim, $mhs->program_studi, $mhs->fakultas, $mhs->email]);
        }

        // Menutup file stream setelah response
        fclose($handle);

        // Kembalikan response untuk download file CSV
        return response()->stream(
            function () use ($handle) {
                // Hapus baris ini karena handle sudah ditutup di luar closure
                // fclose($handle);  // Pastikan handle ditutup dalam closure
            },
            200,
            $headers
        );
    }


    public function import(Request $request)
    {
        // Validasi file CSV
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil file CSV
        $file = $request->file('file');

        // Baca file CSV
        $data = array_map('str_getcsv', file($file));

        // Ambil header kolom dari baris pertama
        $header = array_shift($data);

        // Import data mahasiswa
        foreach ($data as $row) {
            try {
                // Coba untuk insert mahasiswa baru
                Mahasiswa::create([
                    'nama' => $row[0], // Nama
                    'nim' => $row[1], // NIM
                    'program_studi' => $row[2], // Program Studi
                    'fakultas' => $row[3], // Fakultas
                    'email' => $row[4], // Email
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                // Cek apakah error karena duplikasi NIM
                if ($e->getCode() == 23000) {
                    // Jika ada duplikasi, beri pesan peringatan
                    session()->flash('warning', "Data yang anda masukkan sudah diimpor sebelumnya silahkan cek data anda kembali!");
                }
            }
        }

        return back()->with('success', 'Data mahasiswa berhasil diimport!');
    }

    // Hapus fungsi addUjian karena fitur ujian telah dihapus
    /*
    public function addUjian(Mahasiswa $mahasiswa, Request $request)
    {
        // Validasi input ujian
        $request->validate([
            'ujian_id' => 'required|exists:ujians,id',
        ]);

        // Menambahkan ujian ke mahasiswa
        $mahasiswa->ujian()->attach($request->ujian_id);

        return redirect()->route('mahasiswa.show', $mahasiswa->id)->with('success', 'Ujian berhasil ditambahkan!');
    }
    */
}