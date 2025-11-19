@extends('backend.layout.layout')

@section('title', 'Edit Data SKL Bahasa')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Data SKL Bahasa</h1>

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

    <form action="{{ route('skl-bahasa.update', $sklBahasa->id) }}" method="POST" class="card shadow-sm p-4" style="max-width: 700px; margin: auto;">
        @csrf
        @method('PUT') <div class="mb-4">
            <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
            <input type="text" 
                   class="form-control" 
                   value="{{ $sklBahasa->mhsBahasa->mahasiswa->nama }} ({{ $sklBahasa->mhsBahasa->mahasiswa->nim }})" 
                   disabled readonly>
            <div class="form-text">Data mahasiswa tidak dapat diubah.</div>
        </div>

        <hr class="my-4">

        <h3 class="h5 mb-3">SKL Bahasa Arab</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="istima" class="form-label">Nilai Istima'</label>
                <input type="number" name="istima" id="istima" 
                       value="{{ old('istima', $sklBahasa->istima) }}" 
                       min="1" max="999" class="form-control @error('istima') is-invalid @enderror">
                @error('istima')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="kitabah" class="form-label">Nilai Kitabah</label>
                <input type="number" name="kitabah" id="kitabah" 
                       value="{{ old('kitabah', $sklBahasa->kitabah) }}" 
                       min="1" max="999" class="form-control @error('kitabah') is-invalid @enderror">
                @error('kitabah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="qiraah" class="form-label">Nilai Qira'ah</label>
                <input type="number" name="qiraah" id="qiraah" 
                       value="{{ old('qiraah', $sklBahasa->qiraah) }}" 
                       min="1" max="999" class="form-control @error('qiraah') is-invalid @enderror">
                @error('qiraah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4">

        <h3 class="h5 mb-3">SKL Bahasa Inggris</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="listening" class="form-label">Nilai Listening</label>
                <input type="number" name="listening" id="listening" 
                       value="{{ old('listening', $sklBahasa->listening) }}" 
                       min="1" max="999" class="form-control @error('listening') is-invalid @enderror">
                @error('listening')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="writing" class="form-label">Nilai Writing</label>
                <input type="number" name="writing" id="writing" 
                       value="{{ old('writing', $sklBahasa->writing) }}" 
                       min="1" max="999" class="form-control @error('writing') is-invalid @enderror">
                @error('writing')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="reading" class="form-label">Nilai Reading</label>
                <input type="number" name="reading" id="reading" 
                       value="{{ old('reading', $sklBahasa->reading) }}" 
                       min="1" max="999" class="form-control @error('reading') is-invalid @enderror">
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
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection