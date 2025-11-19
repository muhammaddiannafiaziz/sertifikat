@extends('backend.layout.layout')

@section('title', 'Detail SKL Komputer')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm" style="max-width: 42rem; margin: auto;">
        <div class="card-body">
            <h3 class="mb-4 text-center">Detail SKL Komputer</h3>

            <div class="mb-4">
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Nama:</strong></div>
                    <div class="col-md-8">{{ $sklTipd->mhsTipd->mahasiswa->nama }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>NIM:</strong></div>
                    <div class="col-md-8">{{ $sklTipd->mhsTipd->mahasiswa->nim }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Program Studi:</strong></div>
                    <div class="col-md-8">{{ $sklTipd->mhsTipd->mahasiswa->program_studi }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Fakultas:</strong></div>
                    <div class="col-md-8">{{ $sklTipd->mhsTipd->mahasiswa->fakultas }}</div>
                </div>
            </div>

            <hr>

            <div class="mb-4 mt-4">
                <div class="row mb-3">
                    <div class="col-md-4"><strong>No Sertifikat:</strong></div>
                    <div class="col-md-8">{{ $sklTipd->no_sertifikat }}</div>
                </div>

                <h5 class="mb-3">Rincian Nilai</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Kompetensi</th>
                                <th class="text-center">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nilai Word</td>
                                <td class="text-center">{{ $sklTipd->word ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Nilai Excel</td>
                                <td class="text-center">{{ $sklTipd->excel ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Nilai Power Point</td>
                                <td class="text-center">{{ $sklTipd->power_point ?? '-' }}</td>
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
                <a href="{{ route('skl-tipd.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <a href="{{ route('skl-tipd.edit', $sklTipd->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                </div>
        </div>
    </div>
</div>
@endsection