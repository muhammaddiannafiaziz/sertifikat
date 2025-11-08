<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Tampilkan data admin
        return view('admin.index');
    }

    public function create()
    {
        // Tampilkan form untuk membuat admin baru
        return view('admin.create');
    }

    public function store(Request $request)
    {
        // Simpan admin baru ke database
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
        ]);

        // Menyimpan data ke database (contoh)
        // Admin::create($validated);

        return redirect()->route('admin.index');
    }

    public function show($id)
    {
        // Tampilkan detail admin berdasarkan ID
        return view('admin.show', compact('id'));
    }

    public function edit($id)
    {
        // Tampilkan form untuk mengedit admin
        return view('admin.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Validasi dan perbarui data admin
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
        ]);

        // Update data admin di database (contoh)
        // Admin::find($id)->update($validated);

        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        // Hapus admin berdasarkan ID
        // Admin::find($id)->delete();

        return redirect()->route('admin.index');
    }
}
