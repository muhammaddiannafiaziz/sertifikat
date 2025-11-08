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
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>{{ $sertifikat->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>NIM</strong></td>
                        <td>{{ $sertifikat->mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td><strong>Program Studi</strong></td>
                        <td>{{ $sertifikat->mahasiswa->program_studi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Fakultas</strong></td>
                        <td>{{ $sertifikat->mahasiswa->fakultas }}</td>
                    </tr>
                </table>
            </div>

            <!-- Informasi Sertifikat -->
            <h5 class="card-title mt-4 mb-4">Informasi Sertifikat</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td><strong>No Sertifikat</strong></td>
                        <td>{{ $sertifikat->no_sertifikat }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status Ujian SKL Ibadah</strong></td>
                        <td>{{ $sertifikat->status_ujian_ibadah == 'lulus' ? 'Lulus' : 'Tidak Lulus' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status Ujian SKL Al-Qur'an</strong></td>
                        <td>{{ $sertifikat->status_ujian_alquran == 'lulus' ? 'Lulus' : 'Tidak Lulus' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('sertifikat.index') }}" class="btn btn-sm btn-secondary me-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('sertifikat.download', $sertifikat->no_sertifikat) }}" class="btn btn-sm btn-primary">
            <i class="bi bi-download"></i> Download Sertifikat (PDF)
        </a>
    </div>
</div>
@endsection