@extends('backend.layout.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Ujian</h1>

    <!-- Tombol Tambah Ujian -->
    <a href="{{ route('ujian.create') }}" class="btn btn-primary mb-3">Tambah Ujian</a>

    <!-- Tabel Daftar Ujian -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nama Ujian</th>
                <th>Deskripsi Ujian</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ujian as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_ujian }}</td>
                <td>{{ $item->deskripsi_ujian }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('ujian.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Form Hapus -->
                    <form action="{{ route('ujian.destroy', $item->id) }}" method="POST" style="display:inline;">
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
@endsection