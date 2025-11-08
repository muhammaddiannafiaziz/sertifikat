@extends('backend.layout.layout')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="card p-4 shadow-sm">
    <h1 class="h3 mb-4">Tambah Mahasiswa</h1>
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" id="nim" name="nim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="program_studi" class="form-label">Program Studi</label>
            <input type="text" id="program_studi" name="program_studi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fakultas" class="form-label">Fakultas</label>
            <input type="text" id="fakultas" name="fakultas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection