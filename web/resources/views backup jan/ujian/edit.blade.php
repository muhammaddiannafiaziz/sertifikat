@extends('backend.layout.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Ujian</h1>

    <!-- Form Edit Ujian -->
    <form action="{{ route('ujian.update', $ujian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Input Nama Ujian -->
        <div class="mb-3">
            <label for="nama_ujian" class="form-label">Nama Ujian</label>
            <input type="text" name="nama_ujian" class="form-control" value="{{ $ujian->nama_ujian }}" required>
        </div>

        <!-- Input Deskripsi Ujian -->
        <div class="mb-3">
            <label for="deskripsi_ujian" class="form-label">Deskripsi Ujian</label>
            <textarea name="deskripsi_ujian" class="form-control" required>{{ $ujian->deskripsi_ujian }}</textarea>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection