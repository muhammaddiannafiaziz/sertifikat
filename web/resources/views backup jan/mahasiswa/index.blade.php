@extends('backend.layout.layout')

@section('title', 'Daftar Mahasiswa')

@section('content')

@if (session('warning'))
<div class="alert alert-danger">
    {{ session('warning') }}
</div>
@endif

<div class="container">
    <!-- Header dan Controls -->
    <div class="d-flex justify-content-between align-items-center mb-3" style="font-size: 0.9rem;">
        <!-- Tombol Tambah Mahasiswa dengan Modal -->
        <button type="button" class="btn btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#tambahMahasiswaModal" style="margin-right: 5px;">
            Tambah
            <i class="bi bi-plus-circle ms-2"></i> <!-- Ikon di sebelah kanan tombol Tambah -->
        </button>

        <!-- Tombol Import Mahasiswa dengan Modal -->
        <button type="button" class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#importModal" style="margin-right: 5px;">
            Import
            <i class="bi bi-upload ms-2"></i> <!-- Ikon di sebelah kanan tombol Import -->
        </button>
    </div>

    <!-- Notifikasi Success -->
    @if(session('success'))
    <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <!-- Tabel Mahasiswa -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Fakultas</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $index => $mhs)
                <tr>
                    <td>{{ $index + $mahasiswa->firstItem() }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->program_studi }}</td>
                    <td>{{ $mhs->fakultas }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMahasiswaModal{{ $mhs->id }}">
                            <i class="bi bi-pencil-square"></i> <!-- Ikon Edit -->
                        </button>
                        <!-- Tombol Hapus -->
                        <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> <!-- Ikon Hapus -->
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Jumlah Mahasiswa -->
    <div class="mb-4">
        <div class="d-flex justify-content-start">
            <div class="card shadow-sm border-primary" style="border-radius: 5px;">
                <div class="card-body d-flex align-items-center p-2">
                    <i class="bi bi-person-fill" style="font-size: 2.2rem; color: #007bff; margin-right: 8px;"></i>
                    <div class="d-flex flex-column">
                        <div class="d-flex me-2 align-items-center">
                            <span class="h5 mb-0" style="font-size: 0.8rem; line-height: 1.2; color: #007bff;">Jumlah Mahasiswa:</span>
                            <p class="card-text mb-0 ms-2" style="font-size: 2rem; color: #003968; font-weight: bold; line-height: 1.2;">{{ $mahasiswa->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if ($mahasiswa->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $mahasiswa->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @endif

                @php
                $currentPage = $mahasiswa->currentPage();
                $lastPage = $mahasiswa->lastPage();
                $rangeStart = max(1, $currentPage - 5);
                $rangeEnd = min($lastPage, $currentPage + 5);
                @endphp

                @for ($page = $rangeStart; $page <= $rangeEnd; $page++)
                    <li class="page-item {{ $mahasiswa->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $mahasiswa->url($page) }}">{{ $page }}</a>
                    </li>
                    @endfor

                    @if ($mahasiswa->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $mahasiswa->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    @endif
            </ul>
        </nav>
    </div>
</div>

<!-- Modal Tambah Mahasiswa -->
<div class="modal fade" id="tambahMahasiswaModal" tabindex="-1" aria-labelledby="tambahMahasiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMahasiswaModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" required>
                    </div>
                    <div class="mb-3">
                        <label for="program_studi" class="form-label">Program Studi</label>
                        <input type="text" class="form-control" id="program_studi" name="program_studi" required>
                    </div>
                    <div class="mb-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <input type="text" class="form-control" id="fakultas" name="fakultas" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import Mahasiswa -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File Excel</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Import Mahasiswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Mahasiswa -->
@foreach($mahasiswa as $mhs)
<div class="modal fade" id="editMahasiswaModal{{ $mhs->id }}" tabindex="-1" aria-labelledby="editMahasiswaModalLabel{{ $mhs->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMahasiswaModalLabel{{ $mhs->id }}">Edit Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mahasiswa.update', $mhs->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $mhs->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="{{ $mhs->nim }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="program_studi" class="form-label">Program Studi</label>
                        <input type="text" class="form-control" id="program_studi" name="program_studi" value="{{ $mhs->program_studi }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <input type="text" class="form-control" id="fakultas" name="fakultas" value="{{ $mhs->fakultas }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $mhs->email }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning">Update Mahasiswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection