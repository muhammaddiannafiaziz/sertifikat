@extends('backend.layout.layout')

@section('title', 'Detail SKL Bahasa')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm" style="max-width: 42rem; margin: auto;">
        <div class="card-body">
            <h3 class="mb-4 text-center">Detail SKL Bahasa</h3>

            <div class="mb-4">
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Nama:</strong></div>
                    <div class="col-md-8">{{ $sklBahasa->mahasiswa->nama }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>NIM:</strong></div>
                    <div class="col-md-8">{{ $sklBahasa->mahasiswa->nim }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Program Studi:</strong></div>
                    <div class="col-md-8">{{ $sklBahasa->mahasiswa->program_studi }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Fakultas:</strong></div>
                    <div class="col-md-8">{{ $sklBahasa->mahasiswa->fakultas }}</div>
                </div>
            </div>

            <hr>

            <div class="mb-4 mt-4">
                <div class="row mb-3">
                    <div class="col-md-4"><strong>No Sertifikat:</strong></div>
                    <div class="col-md-8">{{ $sklBahasa->no_sertifikat }}</div>
                </div>

                <h5 class="mb-3">Rincian Nilai</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Kompetensi</th>
                                <th>Rincian</th>
                                <th class="text-center">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="3" class="align-middle"><strong>Bahasa Arab</strong></td>
                                <td>Istima'</td>
                                <td class="text-center">{{ $sklBahasa->istima ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Kitabah</td>
                                <td class="text-center">{{ $sklBahasa->kitabah ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Qira'ah</td>
                                <td class="text-center">{{ $sklBahasa->qiraah ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td rowspan="3" class="align-middle"><strong>Bahasa Inggris</strong></td>
                                <td>Listening</td>
                                <td class="text-center">{{ $sklBahasa->listening ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Writing</td>
                                <td class="text-center">{{ $sklBahasa->writing ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Reading</td>
                                <td class="text-center">{{ $sklBahasa->reading ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
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
                <a href="{{ route('skl-bahasa.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <a href="{{ route('skl-bahasa.edit', $sklBahasa->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                </div>
        </div>
    </div>
</div>
@endsection