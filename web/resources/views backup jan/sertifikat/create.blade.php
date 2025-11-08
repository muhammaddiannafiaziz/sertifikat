@extends('backend.layout.layout')

@section('title', 'Buat Sertifikat')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Buat Sertifikat</h1>

    <form action="{{ route('sertifikat.generate') }}" method="POST">
        @csrf

        <!-- Pilih Mahasiswa -->
        <div class="mb-4">
            <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_id" id="mahasiswa_id" class="form-select" required>
                <option value="">Pilih Mahasiswa</option>
                @foreach ($mahasiswa as $mhs)
                <option value="{{ $mhs->id }}">{{ $mhs->nama }} ({{ $mhs->nim }})</option>
                @endforeach
            </select>
        </div>

        <!-- Nilai Ujian Ibadah -->
        <div class="mb-4">
            <label for="nilai_ujian_ibadah" class="form-label">Nilai Ujian SKL Ibadah</label>
            <input type="number" name="nilai_ujian_ibadah" id="nilai_ujian_ibadah" class="form-control" required>
        </div>

        <!-- Nilai Ujian Al-Qur'an -->
        <div class="mb-4">
            <label for="nilai_ujian_alquran" class="form-label">Nilai Ujian SKL Al-Qur'an</label>
            <input type="number" name="nilai_ujian_alquran" id="nilai_ujian_alquran" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Generate Sertifikat</button>
    </form>
</div>
@endsection