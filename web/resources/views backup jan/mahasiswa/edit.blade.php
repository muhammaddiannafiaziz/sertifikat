@extends('backend.layout.layout')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Mahasiswa</h1>

    <!-- Form Edit Mahasiswa -->
    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Metode PUT untuk update -->

        <!-- Input Nama -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $mahasiswa->nama) }}" required>
            @error('nama')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input NIM -->
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control" value="{{ old('nim', $mahasiswa->nim) }}" required>
            @error('nim')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input Program Studi -->
        <div class="mb-3">
            <label for="program_studi" class="form-label">Program Studi</label>
            <input type="text" name="program_studi" id="program_studi" class="form-control" value="{{ old('program_studi', $mahasiswa->program_studi) }}" required>
            @error('program_studi')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input Fakultas -->
        <div class="mb-3">
            <label for="fakultas" class="form-label">Fakultas</label>
            <input type="text" name="fakultas" id="fakultas" class="form-control" value="{{ old('fakultas', $mahasiswa->fakultas) }}" required>
            @error('fakultas')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $mahasiswa->email) }}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Update Mahasiswa</button>
    </form>

    <!-- Tombol Kembali -->
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Mahasiswa</a>
</div>
@endsection