@extends('backend.layout.layout')

@section('title', 'Tambah Peserta Ma\'had Manual')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Peserta SKL Ma'had</h1>
    <p class="text-center text-muted mb-4">Masukkan NIM Mahasiswa yang ingin didaftarkan sebagai Peserta SKL.</p>

    @if ($errors->any())
        <div class="alert alert-danger" style="max-width: 500px; margin: auto; margin-bottom: 20px;">
            <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peserta-mahad.store') }}" method="POST" class="card shadow-sm p-4" style="max-width: 500px; margin: auto;">
        @csrf

        <div class="mb-4">
            <label for="nim" class="form-label">NIM Mahasiswa</label>
            <input type="text" 
                   name="nim" 
                   id="nim" 
                   class="form-control @error('nim') is-invalid @enderror" 
                   value="{{ old('nim') }}" 
                   placeholder="Contoh: 21314151" 
                   required>
            
            @error('nim')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">NIM harus terdaftar di data master Mahasiswa.</div>
        </div>

        <hr class="my-3">

        <div class="d-flex justify-content-between">
            <a href="{{ route('peserta-mahad.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary w-50">
                <i class="bi bi-person-plus"></i> Daftarkan Peserta
            </button>
        </div>
    </form>
</div>
@endsection