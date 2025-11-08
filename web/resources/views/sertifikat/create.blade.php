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

        <!-- Status Ujian Ibadah -->
        <div class="mb-4">
            <label for="status_ujian_ibadah" class="form-label">Status Ujian SKL Ibadah</label>
            <select name="status_ujian_ibadah" id="status_ujian_ibadah" class="form-control" required>
                <option value="lulus">Lulus</option>
                <option value="tidak_lulus">Tidak Lulus</option>
            </select>
        </div>

        <!-- Status Ujian Al-Qur'an -->
        <div class="mb-4">
            <label for="status_ujian_alquran" class="form-label">Status Ujian SKL Al-Qur'an</label>
            <select name="status_ujian_alquran" id="status_ujian_alquran" class="form-control" required>
                <option value="lulus">Lulus</option>
                <option value="tidak_lulus">Tidak Lulus</option>
            </select>
        </div>


        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Generate Sertifikat</button>
    </form>
</div>
@endsection