@extends('backend.layout.layout')

@section('title', 'Detail SKL Ma\'had')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm" style="max-width: 42rem; margin: auto;">
        <div class="card-body">
            <h3 class="mb-4 text-center">Detail SKL Ma'had</h3>

            <div class="mb-4">
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Nama:</strong></div>
                    <div class="col-md-8">{{ $sklMahad->mahasiswa->nama }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>NIM:</strong></div>
                    <div class="col-md-8">{{ $sklMahad->mahasiswa->nim }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Program Studi:</strong></div>
                    <div class="col-md-8">{{ $sklMahad->mahasiswa->program_studi }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Fakultas:</strong></div>
                    <div class="col-md-8">{{ $sklMahad->mahasiswa->fakultas }}</div>
                </div>
            </div>

            <hr>

            <div class="mb-4 mt-4">
                <div class="row mb-2">
                    <div class="col-md-4"><strong>No Sertifikat:</strong></div>
                    <div class="col-md-8">{{ $sklMahad->no_sertifikat }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Status SKL Ibadah:</strong></div>
                    <div class="col-md-8">
                        @if($sklMahad->status_ujian_ibadah == 'lulus')
                            <span class="badge bg-success">Lulus</span>
                        @else
                            <span class="badge bg-danger">Tidak Lulus</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Status SKL Al-Qur'an:</strong></div>
                    <div class="col-md-8">
                        @if($sklMahad->status_ujian_alquran == 'lulus')
                            <span class="badge bg-success">Lulus</span>
                        @else
                            <span class="badge bg-danger">Tidak Lulus</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <strong class="d-block text-center">QR Code untuk Validasi:</strong>
                <div class="d-flex justify-content-center mt-2">
                    @if($qrCodeUrl)
                        <img src="{{ $qrCodeUrl }}" alt="QR Code" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                    @else
                        <div class="alert alert-warning" role="alert">
                            File QR Code tidak ditemukan.
                        </div>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2 mt-3">
                <a href="{{ route('skl-mahad.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <a href="{{ route('skl-mahad.edit', $sklMahad->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                </div>
        </div>
    </div>
</div>
@endsection