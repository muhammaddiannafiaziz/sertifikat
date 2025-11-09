@extends('backend.layout.layout')

@section('title', 'Buat Data SKL Komputer')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Buat Data SKL Komputer</h1>
    <p class="text-center text-muted mb-4">Pilih mahasiswa dan masukkan nilai untuk SKL Komputer.</p>

    @if ($errors->any())
        <div class="alert alert-danger" style="max-width: 700px; margin: auto; margin-bottom: 20px;">
            <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('skl-tipd.store') }}" method="POST" class="card shadow-sm p-4" style="max-width: 700px; margin: auto;">
        @csrf

        <div class="mb-4">
            <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_id" id="mahasiswa_id" class="form-select @error('mahasiswa_id') is-invalid @enderror" required>
                <option value="">Pilih Mahasiswa</option>
                @forelse ($mahasiswa as $mhs)
                <option value="{{ $mhs->id }}" {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>
                    {{ $mhs->nama }} ({{ $mhs->nim }})
                </option>
                @empty
                <option value="" disabled>Semua mahasiswa sudah memiliki data SKL Komputer.</option>
                @endforelse
            </select>
            @error('mahasiswa_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Hanya menampilkan mahasiswa yang belum memiliki data SKL Komputer.</div>
        </div>

        <hr class="my-4">

        <h3 class="h5 mb-3">SKL Komputer (Opsional)</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="word" class="form-label">Nilai Word</label>
                <input type="number" name="word" id="word" value="{{ old('word') }}" min="1" max="999" class="form-control @error('word') is-invalid @enderror">
                @error('word')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="excel" class="form-label">Nilai Excel</label>
                <input type="number" name="excel" id="excel" value="{{ old('excel') }}" min="1" max="999" class="form-control @error('excel') is-invalid @enderror">
                @error('excel')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="power_point" class="form-label">Nilai Power Point</label>
                <input type="number" name="power_point" id="power_point" value="{{ old('power_point') }}" min="1" max="999" class="form-control @error('power_point') is-invalid @enderror">
                @error('power_point')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-3">

        <div class="d-flex justify-content-between">
            <a href="{{ route('skl-tipd.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary w-50">
                <i class="bi bi-save"></i> Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection