@extends('backend.layout.layout')

@section('title', 'Daftar Sertifikat')

@section('content')
<div class="container p-3">
    <h4 class="fw-semibold">Daftar Sertifikat</h4>

    <!-- Menampilkan Pesan Error jika Ada -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Form Pencarian Mahasiswa -->
        <form action="{{ route('sertifikat.index') }}" method="GET" class="d-flex align-items-center" style="gap: 5px;">
            <div class="input-group">
                <!-- Ikon Search di dalam Input -->
                <span class="input-group-text" id="search-icon">
                    <i class="bi bi-search"></i> <!-- Gunakan Bootstrap Icons untuk ikon pencarian -->
                </span>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Sertifikat" value="{{ request()->query('search') }}" style="max-width: 200px;">
            </div>
        </form>

        <div class="d-flex gap-2">
            <!-- Tombol Export Data -->
            <a href="{{ route('sertifikat.export') }}" class="btn btn-success btn-sm" style="font-size: 12px;">
                <i class="bi bi-download"></i> Export Data
            </a>
            <!-- Button untuk Menambah Sertifikat -->
            <a href="{{ route('sertifikat.create') }}" class="btn btn-primary btn-sm" style="font-size: 12px;">
                <i class="bi bi-plus-lg"></i> Tambah Sertifikat
            </a>
        </div>
    </div>



    <!-- Tabel Sertifikat -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>No Sertifikat</th>
                    <th>Program Studi</th>
                    <th>Tanggal Pembuatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sertifikats as $index => $sertifikat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sertifikat->mahasiswa->nama }}</td>
                    <td>{{ $sertifikat->no_sertifikat }}</td>
                    <td>{{ $sertifikat->mahasiswa->program_studi }}</td>
                    <td>{{ $sertifikat->created_at->format('d M Y') }}</td>
                    <td>
                        <!-- Tombol Lihat -->
                        <a href="{{ route('sertifikat.show', $sertifikat->id) }}" class="btn btn-info btn-sm" style="font-size: 12px;">
                            <i class="bi bi-eye"></i> <!-- Ikon Mata untuk Lihat -->
                        </a>

                        <!-- Tombol Edit (Modal) -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $sertifikat->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <!-- Tombol Edit
                        <a href="{{ route('sertifikat.edit', $sertifikat->id) }}" class="btn btn-warning btn-sm" style="font-size: 12px;">
                            <i class="bi bi-pencil"></i> 
                        </a> -->

                        <!-- Form untuk Hapus Sertifikat -->
                        <form action="{{ route('sertifikat.destroy', $sertifikat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="font-size: 12px;">
                                <i class="bi bi-trash"></i> <!-- Ikon Tempat Sampah untuk Hapus -->
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="mt-3 alert alert-info">Total Sertifikat: <strong>{{ $sertifikats->total() }}</strong></p>


        @foreach($sertifikats as $sertifikat)
        <div class="modal fade" id="editModal{{ $sertifikat->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Status Kelulusan</h5>
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

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $sertifikats->links('pagination::bootstrap-5') }}
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