@extends('frontend.layout')

@section('title', 'Validasi Sertifikat')

@section('content')
@php
    // Helper sederhana di dalam blade untuk mengambil objek mahasiswa
    $mhs = null;
    if ($type == 'mahad') $mhs = $data->mhsMahad;
    elseif ($type == 'bahasa') $mhs = $data->mhsBahasa->mahasiswa;
    elseif ($type == 'tipd') $mhs = $data->mhsTipd->mahasiswa;
@endphp

<header class="ex-header bg-gray">
    <div class="container px-4 sm:px-8 xl:px-4">
        <h1 class="xl:ml-24">Validasi Sertifikat</h1>
    </div> </header> <div class="basic-1 pt-12 pb-16">
    <div class="container px-4 sm:px-8">
        <div class="mx-auto max-w-2xl"> @if($data)
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-6 rounded-lg shadow-md" role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="fill-current h-10 w-10 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/></svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">Sertifikat Sah dan Terverifikasi</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6 mt-6">
                    <h3 class="text-xl font-bold mb-4">Detail Sertifikat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 text-gray-700">
                        <div>
                            <span class="font-semibold">No. Sertifikat:</span>
                            <span class="ml-2">{{ $mhs->no_sertifikat }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Nama Lengkap:</span>
                            <span class="ml-2">{{ $mhs->nama }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">NIM:</span>
                            <span class="ml-2">{{ $mhs->nim }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Program Studi:</span>
                            <span class="ml-2">{{ $mhs->program_studi }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Jenis SKL:</span>
                            <span class="ml-2 font-bold uppercase">{{ $type }}</span>
                        </div>
                    </div>
                </div>
            
            @else
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-6 rounded-lg shadow-md" role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="fill-current h-10 w-10 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"/></svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">Sertifikat Tidak Ditemukan</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6 mt-6 text-center">
                    <p class="text-lg">Nomor sertifikat <strong>{{ $no_sertifikat }}</strong> tidak terdaftar di database kami.</p>
                    <p class="text-gray-600 mt-2">Pastikan QR Code yang Anda scan benar.</p>
                </div>
            @endif

            <div class="text-center mt-8">
                <a href="{{ route('public.cek') }}" class="btn-outline-lg">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Halaman Cek NIM
                </a>
            </div>
        </div>
    </div>
</div>
@endsection