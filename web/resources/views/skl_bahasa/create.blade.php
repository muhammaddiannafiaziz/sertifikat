@extends('backend.layout.layout')

@section('title', 'Buat Data SKL Bahasa')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Buat Data SKL Bahasa</h1>
    <p class="text-center text-muted mb-4">Pilih peserta yang sudah terdaftar untuk penerbitan SKL Bahasa Arab & Inggris.</p>

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

    <form action="{{ route('skl-bahasa.store') }}" method="POST" class="card shadow-sm p-4" style="max-width: 700px; margin: auto;">
        @csrf

        <div class="mb-4">
            <label for="mhsbahasa_id" class="form-label">Peserta SKL</label>
            <select name="mhsbahasa_id" id="mhsbahasa_id" class="form-select @error('mhsbahasa_id') is-invalid @enderror" required>
                <option value="">Pilih Peserta</option>
                @forelse ($peserta as $pst) 
                <option value="{{ $pst->id }}" {{ old('mhsbahasa_id') == $pst->id ? 'selected' : '' }}>
                    {{ $pst->mahasiswa->nama }} ({{ $pst->nim }})
                </option>
                @empty
                <option value="" disabled>Semua peserta sudah memiliki SKL atau belum ada peserta yang didaftarkan.</option>
                @endforelse
            </select>
            @error('mhsbahasa_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Hanya menampilkan Peserta yang sudah terdaftar dan belum memiliki SKL Bahasa.</div>
        </div>

        <hr class="my-4">

        <h3 class="h5 mb-3">SKL Bahasa Arab (Opsional)</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="istima" class="form-label">Nilai Istima'</label>
                <input type="number" name="istima" id="istima" value="{{ old('istima') }}" min="1" max="999" class="form-control @error('istima') is-invalid @enderror">
                @error('istima')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="kitabah" class="form-label">Nilai Kitabah</label>
                <input type="number" name="kitabah" id="kitabah" value="{{ old('kitabah') }}" min="1" max="999" class="form-control @error('kitabah') is-invalid @enderror">
                @error('kitabah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="qiraah" class="form-label">Nilai Qira'ah</label>
                <input type="number" name="qiraah" id="qiraah" value="{{ old('qiraah') }}" min="1" max="999" class="form-control @error('qiraah') is-invalid @enderror">
                @error('qiraah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4">

        <h3 class="h5 mb-3">SKL Bahasa Inggris (Opsional)</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="listening" class="form-label">Nilai Listening</label>
                <input type="number" name="listening" id="listening" value="{{ old('listening') }}" min="1" max="999" class="form-control @error('listening') is-invalid @enderror">
                @error('listening')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="writing" class="form-label">Nilai Writing</label>
                <input type="number" name="writing" id="writing" value="{{ old('writing') }}" min="1" max="999" class="form-control @error('writing') is-invalid @enderror">
                @error('writing')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="reading" class="form-label">Nilai Reading</label>
                <input type="number" name="reading" id="reading" value="{{ old('reading') }}" min="1" max="999" class="form-control @error('reading') is-invalid @enderror">
                @error('reading')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-3">

        <div class="d-flex justify-content-between">
            <a href="{{ route('skl-bahasa.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary w-50">
                <i class="bi bi-save"></i> Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection