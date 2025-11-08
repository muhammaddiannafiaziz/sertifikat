@extends('backend.layout.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Ujian</h1>

    <!-- Form Tambah Ujian -->
    <form action="{{ route('ujian.store') }}" method="POST">
        @csrf

        <!-- Input Nama Ujian -->
        <div class="mb-3">
            <label for="nama_ujian" class="form-label">Nama Ujian</label>
            <input type="text" name="nama_ujian" class="form-control" required>
        </div>

        <!-- Input Deskripsi Ujian -->
        <div class="mb-3">
            <label for="deskripsi_ujian" class="form-label">Deskripsi Ujian</label>
            <textarea name="deskripsi_ujian" class="form-control" required></textarea>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection