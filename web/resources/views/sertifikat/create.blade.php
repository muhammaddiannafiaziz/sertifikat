@extends('backend.layout.layout')

@section('title', 'Buat Sertifikat')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Buat Sertifikat</h1>

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

    <form action="{{ route('sertifikat.generate') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_id" id="mahasiswa_id" class="form-select @error('mahasiswa_id') is-invalid @enderror" required>
                <option value="">Pilih Mahasiswa</option>
                @foreach ($mahasiswa as $mhs)
                <option value="{{ $mhs->id }}" {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>
                    {{ $mhs->nama }} ({{ $mhs->nim }})
                </option>
                @endforeach
            </select>
            @error('mahasiswa_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status_ujian_ibadah" class="form-label">Status Ujian SKL Ibadah</label>
            <select name="status_ujian_ibadah" id="status_ujian_ibadah" class="form-control @error('status_ujian_ibadah') is-invalid @enderror" required>
                <option value="lulus" {{ old('status_ujian_ibadah') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak_lulus" {{ old('status_ujian_ibadah') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
            @error('status_ujian_ibadah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status_ujian_alquran" class="form-label">Status Ujian SKL Al-Qur'an</label>
            <select name="status_ujian_alquran" id="status_ujian_alquran" class="form-control @error('status_ujian_alquran') is-invalid @enderror" required>
                <option value="lulus" {{ old('status_ujian_alquran') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak_lulus" {{ old('status_ujian_alquran') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
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

        <h3 class="h5 mb-3">SKL Bahasa Inggris</h3>
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
                    <div class_ ="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4">

        <h3 class="h5 mb-3">SKL Komputer</h3>
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

        <hr class="my-4">

        <button type="submit" class="btn btn-primary w-100 btn-lg mb-5">Generate Sertifikat</button>
    </form>
</div>
@endsection