@extends('backend.layout.layout')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Detail Mahasiswa</h1>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <strong class="text-dark">Nama:</strong>
                <p>{{ $mahasiswa->nama }}</p>
            </div>

            <div class="mb-3">
                <strong class="text-dark">NIM:</strong>
                <p>{{ $mahasiswa->nim }}</p>
            </div>

            <div class="mb-3">
                <strong class="text-dark">Program Studi:</strong>
                <p>{{ $mahasiswa->program_studi }}</p>
            </div>

            <div class="mb-3">
                <strong class="text-dark">Fakultas:</strong>
                <p>{{ $mahasiswa->fakultas }}</p>
            </div>

            <div class="mb-3">
                <strong class="text-dark">Email:</strong>
                <p>{{ $mahasiswa->email }}</p>
            </div>

            <div class="mb-3">
                <strong class="text-dark">Ujian yang Diikuti:</strong>
                <ul>
                    @forelse ($mahasiswa->ujian as $ujian)
                    <li>{{ $ujian->nama_ujian }} - {{ $ujian->deskripsi_ujian }}</li>
                    @empty
                    <p>Mahasiswa ini belum mengikuti ujian.</p>
                    @endforelse
                </ul>
            </div>

            <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary">Kembali ke Daftar Mahasiswa</a>
        </div>
    </div>
</div>
@endsection