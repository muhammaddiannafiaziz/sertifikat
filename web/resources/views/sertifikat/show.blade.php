@extends('backend.layout.layout')

@section('title', 'Detail Sertifikat')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm max-w-4xl mx-auto">
        <div class="card-body">
            <h3 class="mb-4">Detail Sertifikat</h3>

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
                    <div class="col-md-4"><strong>Status Ujian SKL Ibadah:</strong></div>
                    <div class="col-md-8">
                        {{ $sertifikat->status_ujian_ibadah == 'lulus' ? 'Lulus' : 'Tidak Lulus' }}
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4"><strong>Status Ujian SKL Al-Qur'an:</strong></div>
                    <div class="col-md-8">
                        {{ $sertifikat->status_ujian_alquran == 'lulus' ? 'Lulus' : 'Tidak Lulus' }}
                    </div>
                </div>

            </div>

            QR Code Section
            <div class="mb-4">
                <strong>QR Code untuk Validasi:</strong>
                <div class="d-flex justify-content-center mt-2">
                    <img src="{{ $qrCodeUrl }}" alt="QR Code" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2 mt-3"> <a href="{{ route('sertifikat.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>

                <a href="{{ route('sertifikat.download', $sertifikat->no_sertifikat) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-download me-1"></i> Download Sertifikat
                </a>
            </div>
        </div>
    </div>
</div>
@endsection