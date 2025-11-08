@extends('backend.layout.layout')

@section('title', 'Verifikasi Sertifikat')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-center mb-6">Verifikasi Sertifikat</h1>

    @if($sertifikat)
    <div class="space-y-4">
        <div class="d-flex justify-content-between">
            <strong class="text-lg text-gray-700">Nama:</strong>
            <p class="text-lg text-gray-900">{{ $sertifikat->mahasiswa->nama }}</p>
        </div>

        <div class="d-flex justify-content-between">
            <strong class="text-lg text-gray-700">NIM:</strong>
            <p class="text-lg text-gray-900">{{ $sertifikat->mahasiswa->nim }}</p>
        </div>

        <div class="d-flex justify-content-between">
            <strong class="text-lg text-gray-700">Program Studi:</strong>
            <p class="text-lg text-gray-900">{{ $sertifikat->mahasiswa->program_studi }}</p>
        </div>

        <div class="d-flex justify-content-between">
            <strong class="text-lg text-gray-700">No Sertifikat:</strong>
            <p class="text-lg text-gray-900">{{ $sertifikat->no_sertifikat }}</p>
        </div>

        <div class="d-flex justify-content-between">
            <strong class="text-lg text-gray-700">Status:</strong>
            <p class="text-lg text-gray-900">{{ $sertifikat->is_valid ? 'Valid' : 'Tidak Valid' }}</p>
        </div>
    </div>
    @else
    <p class="text-lg text-red-500">Sertifikat tidak ditemukan.</p>
    @endif
</div>
@endsection