@extends('frontend.layout')

@section('title', 'Dashboard')

@section('content')


<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Validasi Sertifikat</h2>
        </div>
        <div class="card-body">
            <!-- Gambar Centang -->
            <div class="mb-4">
                <img src="{{ asset('images/checkmark.jpg') }}" alt="Valid" class="img-fluid" style="width: 500px;">
            </div>

            <!-- Informasi Mahasiswa -->
            <div class="row mb-3">
                <label class="col-md-4 text-muted font-weight-bold">Nama:</label>
                <div class="col-md-8">
                    <p class="mb-0">{{ $sertifikat->mahasiswa->nama }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 text-muted font-weight-bold">NIM:</label>
                <div class="col-md-8">
                    <p class="mb-0">{{ $sertifikat->mahasiswa->nim }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 text-muted font-weight-bold">Program Studi:</label>
                <div class="col-md-8">
                    <p class="mb-0">{{ $sertifikat->mahasiswa->program_studi }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 text-muted font-weight-bold">Fakultas:</label>
                <div class="col-md-8">
                    <p class="mb-0">{{ $sertifikat->mahasiswa->fakultas }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 text-muted font-weight-bold">No Sertifikat:</label>
                <div class="col-md-8">
                    <p class="mb-0">{{ $sertifikat->no_sertifikat }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 text-muted font-weight-bold">Nilai Ujian SKL Ibadah:</label>
                <div class="col-md-8">
                    <p class="mb-0">{{ $sertifikat->nilai_ujian_ibadah }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 text-muted font-weight-bold">Nilai Ujian SKL Al-Qur'an:</label>
                <div class="col-md-8">
                    <p class="mb-0">{{ $sertifikat->nilai_ujian_alquran }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection