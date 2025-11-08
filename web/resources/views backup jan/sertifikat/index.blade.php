@extends('backend.layout.layout')

@section('title', 'Daftar Sertifikat')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Daftar Sertifikat</h1>

    <!-- Menampilkan Pesan Error jika Ada -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Button untuk Menambah Sertifikat -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('sertifikat.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Sertifikat</a>
    </div>

    <!-- Tabel Sertifikat -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
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
                        <a href="{{ route('sertifikat.show', $sertifikat->id) }}" class="btn btn-info btn-sm">Lihat</a>

                        <!-- Form untuk Hapus Sertifikat -->
                        <form action="{{ route('sertifikat.destroy', $sertifikat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

    /* Header tabel dengan warna biru */
    .bg-primary {
        background-color: #007bff !important;
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