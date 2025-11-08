@extends('backend.layout.layout')

@section('title', 'Detail Sertifikat')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Detail Sertifikat</h3>
        </div>
        <div class="card-body">
            <!-- Informasi Mahasiswa -->
            <h5 class="card-title mb-4">Informasi Mahasiswa</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Nama:</strong>
                    <p>{{ $sertifikat->mahasiswa->nama }}</p>
                </div>
                <div class="col-md-6">
                    <strong>NIM:</strong>
                    <p>{{ $sertifikat->mahasiswa->nim }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Program Studi:</strong>
                    <p>{{ $sertifikat->mahasiswa->program_studi }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Fakultas:</strong>
                    <p>{{ $sertifikat->mahasiswa->fakultas }}</p>
                </div>
            </div>

            <!-- Informasi Sertifikat -->
            <h5 class="card-title mb-4">Informasi Sertifikat</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>No Sertifikat:</strong>
                    <p>{{ $sertifikat->no_sertifikat }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Nilai Ujian SKL Ibadah:</strong>
                    <p>{{ $sertifikat->nilai_ujian_ibadah }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Nilai Ujian SKL Al-Qur'an:</strong>
                    <p>{{ $sertifikat->nilai_ujian_alquran }}</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('sertifikat.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('sertifikat.download', $sertifikat->no_sertifikat) }}" class="btn btn-primary">
                    <i class="bi bi-download"></i> Download Sertifikat (PDF)
                </a>
            </div>
        </div>
    </div>
</div>
@endsection