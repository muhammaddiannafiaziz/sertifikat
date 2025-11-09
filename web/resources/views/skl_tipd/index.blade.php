@extends('backend.layout.layout')

@section('title', 'Data SKL Komputer')

@section('content')
<div class="container p-3">
    <h4 class="fw-semibold">Data SKL Komputer</h4>
    <p>Pengelolaan data SKL Komputer (Word, Excel, Power Point).</p>

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
        <form action="{{ route('skl-tipd.index') }}" method="GET" class="d-flex align-items-center" style="gap: 5px;">
            <div class="input-group">
                <span class="input-group-text" id="search-icon">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Nama/NIM/No. Sertifikat" value="{{ request()->query('search') }}" style="max-width: 250px;">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </form>

        <div class="d-flex gap-2">
            <a href="{{ route('skl-tipd.create') }}" class="btn btn-primary btn-sm" style="font-size: 12px;">
                <i class="bi bi-plus-lg"></i> Tambah Data SKL
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>No Sertifikat</th>
                    <th>Status Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sklTipdData as $index => $data)
                <tr>
                    <td>{{ $sklTipdData->firstItem() + $index }}</td>
                    <td>{{ $data->mahasiswa->nama }}</td>
                    <td>{{ $data->mahasiswa->nim }}</td>
                    <td>{{ $data->no_sertifikat }}</td>
                    <td>
                        @if($data->word || $data->excel || $data->power_point)
                            <span class="badge bg-success">Ada Nilai</span>
                        @else
                            <span class="badge bg-secondary">Belum Diisi</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('skl-tipd.show', $data->id) }}" class="btn btn-info btn-sm" style="font-size: 12px;">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('skl-tipd.edit', $data->id) }}" class="btn btn-warning btn-sm" style="font-size: 12px;">
                            <i class="bi bi-pencil"></i> 
                        </a>

                        <form action="{{ route('skl-tipd.destroy', $data->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="font-size: 12px;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Data SKL Komputer tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($sklTipdData->total() > 0)
        <p class="mt-3 alert alert-info">
            Menampilkan {{ $sklTipdData->firstItem() }} sampai {{ $sklTipdData->lastItem() }} dari <strong>{{ $sklTipdData->total() }}</strong> total data.
        </p>
        @endif
    </div>

    <div class="d-flex justify-content-center">
        {{ $sklTipdData->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@push('styles')
<style>
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
    .btn-sm {
        padding: 5px 10px;
    }
</style>
@endpush