@extends('backend.layout.layout')

@section('title', 'Daftar Peserta SKL Ma\'had')

@section('content')
<div class="container p-3">
    <h4 class="fw-semibold">Daftar Peserta SKL Ma'had</h4>
    <p>Data Mahasiswa yang berhak dibuatkan SKL Ibadah & Al-Qur'an.</p>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('peserta-mahad.index') }}" method="GET" class="d-flex align-items-center" style="gap: 5px;">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Nama/NIM" value="{{ request()->query('search') }}" style="max-width: 250px;">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </form>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#importModal" style="font-size: 12px;">
                <i class="bi bi-upload"></i> Import Peserta
            </button>
            <a href="{{ route('peserta-mahad.create') }}" class="btn btn-primary btn-sm" style="font-size: 12px;">
                <i class="bi bi-plus-lg"></i> Tambah Manual
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Program Studi</th>
                    <th>Status SKL</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesertaData as $index => $data)
                <tr>
                    <td>{{ $pesertaData->firstItem() + $index }}</td>
                    <td>{{ $data->nim }}</td>
                    <td>{{ $data->mahasiswa->nama }}</td>
                    <td>{{ $data->mahasiswa->program_studi }}</td>
                    <td>
                        @if($data->sklMahad)
                            <span class="badge bg-success">SKL Sudah Terbit</span>
                        @else
                            <span class="badge bg-warning text-dark">Menunggu Penerbitan</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('peserta-mahad.destroy', $data->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Menghapus peserta ini juga akan menghapus data SKL yang mungkin sudah terbit. Yakin?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="font-size: 12px;">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Data Peserta SKL Ma'had tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($pesertaData->total() > 0)
        <p class="mt-3 alert alert-info">
            Total Peserta: <strong>{{ $pesertaData->total() }}</strong>
        </p>
        @endif
    </div>

    <div class="d-flex justify-content-center">
        {{ $pesertaData->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Peserta SKL Ma'had</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('peserta-mahad.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p class="small text-muted">Pastikan file berformat CSV/TXT dan hanya berisi satu kolom dengan header **"nim"**.</p>
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File CSV/TXT</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection