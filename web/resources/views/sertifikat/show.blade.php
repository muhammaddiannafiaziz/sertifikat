@extends('backend.layout.layout')

@section('title', 'Detail Sertifikat')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm" style="max-width: 42rem; margin: auto;"> <div class="card-body">
            <h3 class="mb-4 text-center">Detail Sertifikat</h3>

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
                    <div class="col-md-4"><strong>Status SKL Ibadah:</strong></div>
                    <div class="col-md-8">
                        @if($sertifikat->status_ujian_ibadah == 'lulus')
                            <span class="badge bg-success">Lulus</span>
                        @else
                            <span class="badge bg-danger">Tidak Lulus</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-2"> <div class="col-md-4"><strong>Status SKL Al-Qur'an:</strong></div>
                    <div class="col-md-8">
                        @if($sertifikat->status_ujian_alquran == 'lulus')
                            <span class="badge bg-success">Lulus</span>
                        @else
                            <span class="badge bg-danger">Tidak Lulus</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($sertifikat->istima || $sertifikat->listening || $sertifikat->word)
            <div class="mb-4">
                <h5 class="mb-3">Rincian Nilai SKL</h5>
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
                            @if($sertifikat->istima)
                                <tr>
                                    <td rowspan="3" class="align-middle"><strong>Bahasa Arab</strong></td>
                                    <td>Istima'</td>
                                    <td class="text-center">{{ $sertifikat->istima }}</td>
                                </tr>
                                <tr>
                                    <td>Kitabah</td>
                                    <td class="text-center">{{ $sertifikat->kitabah }}</td>
                                </tr>
                                <tr>
                                    <td>Qira'ah</td>
                                    <td class="text-center">{{ $sertifikat->qiraah }}</td>
                                </tr>
                            @endif

                            @if($sertifikat->listening)
                                <tr>
                                    <td rowspan="3" class="align-middle"><strong>Bahasa Inggris</strong></td>
                                    <td>Listening</td>
                                    <td class="text-center">{{ $sertifikat->listening }}</td>
                                </tr>
                                <tr>
                                    <td>Writing</td>
                                    <td class="text-center">{{ $sertifikat->writing }}</td>
                                </tr>
                                <tr>
                                    <td>Reading</td>
                                    <td class="text-center">{{ $sertifikat->reading }}</td>
                                </tr>
                            @endif

                            @if($sertifikat->word)
                                <tr>
                                    <td rowspan="3" class="align-middle"><strong>Komputer</strong></td>
                                    <td>Word</td>
                                    <td class="text-center">{{ $sertifikat->word }}</td>
                                </tr>
                                <tr>
                                    <td>Excel</td>
                                    <td class="text-center">{{ $sertifikat->excel }}</td>
                                </tr>
                                <tr>
                                    <td>Power Point</td>
                                    <td class="text-center">{{ $sertifikat->power_point }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            <div class="mb-4">
                <strong class="d-block text-center">QR Code untuk Validasi:</strong>
                <div class="d-flex justify-content-center mt-2">
                    <img src="{{ $qrCodeUrl }}" alt="QR Code" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2 mt-3">
                <a href="{{ route('sertifikat.index') }}" class="btn btn-secondary btn-sm">
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