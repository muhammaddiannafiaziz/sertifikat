@extends('frontend.layout')

@section('title', 'Dashboard')

@section('content')

<!-- Header -->
<header id="header" class="header py-28 text-center md:pt-36 lg:text-left xl:pt-24 xl:pb-32">
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
        <div class="mb-7 lg:mt-32 xl:mt-40 xl:mr-12">
            <h1 class="h1-large mb-1">Welcome To</h1>
            <h1 class="h1-large mb-5">Aplikasi Sertifikat</h1>
            <p class="p-large mb-8">UIN Raden Mas Said Surakarta</p>

            <!-- Button Validasi Sertifikat -->
            <a href="#sertifikat" class="btn-solid-lg secondary bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Unduh Sertifikat
            </a>

            <!-- Button Validasi Sertifikat -->
            <a href="#validasi" class="btn-solid-lg bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Validasi Sertifikat
            </a>
        </div>
        <div class="xl:text-right">
            <img class="inline" src="{{ asset('images/sertif.png') }}" alt="alternative" />
        </div>
    </div> <!-- end of container -->
</header> <!-- end of header -->
<!-- end of header -->


<!-- Sertifikat -->
<div id="sertifikat" class="pt-12 pb-16 lg:pt-16">
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
        <div class="lg:col-span-5">
            <div class="mb-16 lg:mb-0 xl:mt-16">
                <h2 class="mb-6">Cek Sertifikat</h2>
                <p class="mb-4">Cek sertifikat dengan cara mengetikkan nim kemudian cari sertifikat lalu unduh sertifikat</p>
                <!-- Tombol untuk membuka aplikasi pemindai -->
                <a href="{{ route('public.cek')}}" target="_blank">
                    <button type="button" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Cek Sertifikat
                    </button>
                </a>
            </div>
        </div> <!-- end of col -->
        <div class="lg:col-span-7">
            <div class="xl:ml-14">
                <img class="inline" src="{{ asset('images/sertifikat.png') }}" alt="alternative" />
            </div>
        </div> <!-- end of col -->
    </div> <!-- end of container -->
</div>
<!-- end of sertifikat -->

<!-- Validasi -->
<div id="validasi" class="pt-12 pb-16 lg:pt-16">
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
        <!-- Kolom Tombol untuk Membuka Google Scan -->
        <div class="lg:col-span-5">
            <div class="xl:ml-14">
                <img class="inline" src="{{ asset('images/scan.png') }}" alt="alternative" />
            </div>
        </div> <!-- end of col -->

        <!-- Kolom Gambar -->
        <div class="lg:col-span-7">
            <div class="mb-16 lg:mb-0 xl:mt-16">
                <!-- Judul dan Deskripsi Validasi Sertifikat -->
                <h2 class="text-2xl font-semibold mb-6">Validasi Sertifikat</h2>
                <p class="mb-4">Klik tombol di bawah ini untuk membuka pemindai Google Lens atau aplikasi pemindai QR untuk memvalidasi sertifikat Anda.</p>
                <p class="mb-4">Pastikan Anda memindai QR Code atau barcode yang terdapat di sertifikat untuk melakukan validasi secara otomatis.</p>

                <!-- Tombol untuk membuka aplikasi pemindai -->
                <a href="https://lens.google.com" target="_blank">
                    <button type="button" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Buka Google Lens untuk Pemindaian
                    </button>
                </a>
            </div>

        </div> <!-- end of col -->
    </div> <!-- end of container -->
</div> <!-- end of validasi -->


@endsection