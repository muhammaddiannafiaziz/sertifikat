@extends('backend.layout.layout')

@section('title', 'Edit Sertifikat')

@section('content')
<div class="container mt-5">
    <h2>Edit Sertifikat untuk: {{ $sertifikat->mahasiswa->nama }}</h2>
    <p class="lead">NIM: {{ $sertifikat->mahasiswa->nim }}</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sertifikat.update', $sertifikat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status_ujian_ibadah" class="form-label">Status Ujian Ibadah</label>
            <select name="status_ujian_ibadah" id="status_ujian_ibadah" class="form-control @error('status_ujian_ibadah') is-invalid @enderror">
                <option value="lulus" {{ old('status_ujian_ibadah', $sertifikat->status_ujian_ibadah) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak_lulus" {{ old('status_ujian_ibadah', $sertifikat->status_ujian_ibadah) == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
            @error('status_ujian_ibadah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status_ujian_alquran" class="form-label">Status Ujian Al-Qur'an</label>
            <select name="status_ujian_alquran" id="status_ujian_alquran" class="form-control @error('status_ujian_alquran') is-invalid @enderror">
                <option value="lulus" {{ old('status_ujian_alquran', $sertifikat->status_ujian_alquran) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak_lulus" {{ old('status_ujian_alquran', $sertifikat->status_ujian_alquran) == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
            @error('status_ujian_alquran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr class="my-4">

        <h3 class="h5 mb-3">SKL Bahasa Arab</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="istima" class="form-label">Nilai Istima'</label>
                <input type="number" name="istima" id="istima" 
                       value="{{ old('istima', $sertifikat->istima) }}" 
                       min="1" max="999" class="form-control @error('istima') is-invalid @enderror">
                @error('istima')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="kitabah" class="form-label">Nilai Kitabah</label>
                <input type="number" name="kitabah" id="kitabah" 
                       value="{{ old('kitabah', $sertifikat->kitabah) }}" 
                       min="1" max="999" class="form-control @error('kitabah') is-invalid @enderror">
                @error('kitabah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="qiraah" class="form-label">Nilai Qira'ah</label>
                <input type="number" name="qiraah" id="qiraah" 
                       value="{{ old('qiraah', $sertifikat->qiraah) }}" 
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
                       value="{{ old('listening', $sertifikat->listening) }}" 
                       min="1" max="999" class="form-control @error('listening') is-invalid @enderror">
                @error('listening')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="writing" class="form-label">Nilai Writing</label>
                <input type="number" name="writing" id="writing" 
                       value="{{ old('writing', $sertifikat->writing) }}" 
                       min="1" max="999" class="form-control @error('writing') is-invalid @enderror">
                @error('writing')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="reading" class="form-label">Nilai Reading</label>
                <input type="number" name="reading" id="reading" 
                       value="{{ old('reading', $sertifikat->reading) }}" 
                       min="1" max="999" class="form-control @error('reading') is-invalid @enderror">
                @error('reading')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4">

        <h3 class="h5 mb-3">SKL Komputer</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="word" class="form-label">Nilai Word</label>
                <input type="number" name="word" id="word" 
                       value="{{ old('word', $sertifikat->word) }}" 
                       min="1" max="999" class="form-control @error('word') is-invalid @enderror">
                @error('word')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="excel" class="form-label">Nilai Excel</label>
                <input type="number" name="excel" id="excel" 
                       value="{{ old('excel', $sertifikat->excel) }}" 
                       min="1" max="999" class="form-control @error('excel') is-invalid @enderror">
                @error('excel')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="power_point" class="form-label">Nilai Power Point</label>
                <input type="number" name="power_point" id="power_point" 
                       value="{{ old('power_point', $sertifikat->power_point) }}" 
                       min="1" max="999" class="form-control @error('power_point') is-invalid @enderror">
                @error('power_point')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4">

        <button type="submit" class="btn btn-primary w-100 btn-lg mb-5">Simpan Perubahan</button>
    </form>
</div>
@endsection