@extends('backend.layout.layout')

@section('title', 'Daftar Sertifikat')

@section('content')
<div class="container p-3">
    <h4 class="fw-semibold">Daftar Sertifikat</h4>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('sertifikat.index') }}" method="GET" class="d-flex align-items-center" style="gap: 5px;">
            <div class="input-group">
                <span class="input-group-text" id="search-icon">
                    <i class="bi bi-search"></i> </span>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Sertifikat" value="{{ request()->query('search') }}" style="max-width: 200px;">
            </div>
        </form>

        <div class="d-flex gap-2">
            <a href="{{ route('sertifikat.export') }}" class="btn btn-success btn-sm" style="font-size: 12px;">
                <i class="bi bi-download"></i> Export Data
            </a>
            <a href="{{ route('sertifikat.create') }}" class="btn btn-primary btn-sm" style="font-size: 12px;">
                <i class="bi bi-plus-lg"></i> Tambah Sertifikat
            </a>
        </div>
    </div>



    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>No Sertifikat</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sertifikats as $index => $sertifikat)
                <tr>
                    <td>{{ $sertifikats->firstItem() + $index }}</td>
                    <td>{{ $sertifikat->mahasiswa->nama }}</td>
                    <td>{{ $sertifikat->no_sertifikat }}</td>
                    <td>{{ $sertifikat->mahasiswa->program_studi }}</td>
                    <td>
                        <a href="{{ route('sertifikat.show', $sertifikat->id) }}" class="btn btn-info btn-sm" style="font-size: 12px;">
                            <i class="bi bi-eye"></i> </a>

                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $sertifikat->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <form action="{{ route('sertifikat.destroy', $sertifikat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="font-size: 12px;">
                                <i class="bi bi-trash"></i> </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data sertifikat tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <p class="mt-3 alert alert-info">Total Sertifikat: <strong>{{ $sertifikats->total() }}</strong></p>


        @foreach($sertifikats as $sertifikat)
        <div class="modal fade" id="editModal{{ $sertifikat->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $sertifikat->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $sertifikat->id }}">Edit Sertifikat: {{ $sertifikat->mahasiswa->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ route('sertifikat.update', $sertifikat->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Status Ujian Ibadah</label>
                                <select name="status_ujian_ibadah" class="form-control">
                                    <option value="lulus" {{ $sertifikat->status_ujian_ibadah == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                    <option value="tidak_lulus" {{ $sertifikat->status_ujian_ibadah == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Ujian Al-Qur'an</label>
                                <select name="status_ujian_alquran" class="form-control">
                                    <option value="lulus" {{ $sertifikat->status_ujian_alquran == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                    <option value="tidak_lulus" {{ $sertifikat->status_ujian_alquran == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                </select>
                            </div>
                            
                            <hr class="my-4">

                            <h3 class="h5 mb-3">SKL Bahasa Arab</h3>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="istima-{{$sertifikat->id}}" class="form-label">Nilai Istima'</label>
                                    <input type="number" name="istima" id="istima-{{$sertifikat->id}}" 
                                           value="{{ old('istima', $sertifikat->istima) }}" 
                                           min="1" max="999" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="kitabah-{{$sertifikat->id}}" class="form-label">Nilai Kitabah</label>
                                    <input type="number" name="kitabah" id="kitabah-{{$sertifikat->id}}" 
                                           value="{{ old('kitabah', $sertifikat->kitabah) }}" 
                                           min="1" max="999" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="qiraah-{{$sertifikat->id}}" class="form-label">Nilai Qira'ah</label>
                                    <input type="number" name="qiraah" id="qiraah-{{$sertifikat->id}}" 
                                           value="{{ old('qiraah', $sertifikat->qiraah) }}" 
                                           min="1" max="999" class="form-control">
                                </div>
                            </div>

                            <hr class="my-4">

                            <h3 class="h5 mb-3">SKL Bahasa Inggris</h3>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="listening-{{$sertifikat->id}}" class="form-label">Nilai Listening</label>
                                    <input type="number" name="listening" id="listening-{{$sertifikat->id}}" 
                                           value="{{ old('listening', $sertifikat->listening) }}" 
                                           min="1" max="999" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="writing-{{$sertifikat->id}}" class="form-label">Nilai Writing</label>
                                    <input type="number" name="writing" id="writing-{{$sertifikat->id}}" 
                                           value="{{ old('writing', $sertifikat->writing) }}" 
                                           min="1" max="999" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="reading-{{$sertifikat->id}}" class="form-label">Nilai Reading</label>
                                    <input type="number" name="reading" id="reading-{{$sertifikat->id}}" 
                                           value="{{ old('reading', $sertifikat->reading) }}" 
                                           min="1" max="999" class="form-control">
                                </div>
                            </div>

                            <hr class="my-4">

                            <h3 class="h5 mb-3">SKL Komputer</h3>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="word-{{$sertifikat->id}}" class="form-label">Nilai Word</label>
                                    <input type="number" name="word" id="word-{{$sertifikat->id}}" 
                                           value="{{ old('word', $sertifikat->word) }}" 
                                           min="1" max="999" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="excel-{{$sertifikat->id}}" class="form-label">Nilai Excel</label>
                                    <input type="number" name="excel" id="excel-{{$sertifikat->id}}" 
                                           value="{{ old('excel', $sertifikat->excel) }}" 
                                           min="1" max="999" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="power_point-{{$sertifikat->id}}" class="form-label">Nilai Power Point</label>
                                    <input type="number" name="power_point" id="power_point-{{$sertifikat->id}}" 
                                           value="{{ old('power_point', $sertifikat->power_point) }}" 
                                           min="1" max="999" class="form-control">
                                </div>
                            </div>
                            <hr class="my-4">

                            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </div>

    <div class="d-flex justify-content-center">
        {{ $sertifikats->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Mengatur ukuran font */


    /* Tabel dengan garis biru */
    .table-bordered {
        border: 1px solid #007bff;
        border-radius: 8px;
        overflow: hidden;
    }

    .table-bordered th,
    .table-bordered td {
        border-color: #007bff;
        padding: 8px;
    }



    /* Tombol warna biru */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    /* Tombol aksi */
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    /* Mengurangi padding dan memperkecil tombol */
    .btn-sm {
        padding: 5px 10px;
    }

    /* Responsivitas untuk tabel */
    .table-responsive {
        overflow-x: auto;
    }

    /* Mengatur tampilan untuk perangkat kecil */
    @media (max-width: 768px) {
        .table-responsive table {
            font-size: 12px;
        }
    }
</style>
@endpush