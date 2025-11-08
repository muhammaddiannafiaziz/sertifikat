@extends('backend.layout.layout')

@section('title', 'Detail Sertifikat')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm max-w-4xl mx-auto">
        <div class="card-body">
            <h1 class="text-center mb-4">Detail Sertifikat</h1>

            <!-- Mahasiswa Information -->
            <div class="mb-4">
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Nama:</strong></div>
                    <div class="col-md-8">{{ $sertifikat->mahasiswa->nama }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>NIM:</strong></div>
                    <div class="col-md-8">{{ $sertifikat->mahasiswa->nim }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Program Studi:</strong></div>
                    <div class="col-md-8">{{ $sertifikat->mahasiswa->program_studi }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Fakultas:</strong></div>
                    <div class="col-md-8">{{ $sertifikat->mahasiswa->fakultas }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>No Sertifikat:</strong></div>
                    <div class="col-md-8">{{ $sertifikat->no_sertifikat }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Nilai Ujian SKL Ibadah:</strong></div>
                    <div class="col-md-8">{{ $sertifikat->nilai_ujian_ibadah }}</div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4"><strong>Nilai Ujian SKL Al-Qur'an:</strong></div>
                    <div class="col-md-8">{{ $sertifikat->nilai_ujian_alquran }}</div>
                </div>
            </div>

            QR Code Section
            <div class="mb-4">
                <strong>QR Code untuk Validasi:</strong>
                <div class="d-flex justify-content-center mt-2">
                    <img src="{{ $qrCodeUrl }}" alt="QR Code" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                </div>
            </div>

            <!-- Download Button -->
            <div class="d-flex justify-content-center mb-4">
                <a href="{{ route('sertifikat.download', $sertifikat->no_sertifikat) }}"
                    class="btn btn-primary btn-lg">
                    <i class="fas fa-download me-2"></i> Download Sertifikat (PDF)
                </a>
            </div>

            <!-- Back Button -->
            <div class="d-flex justify-content-center">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-lg">
                    Kembali ke Daftar Mahasiswa
                </a>
            </div>
        </div>
    </div>
</div>
@endsection