@extends('backend.layout.layout')

@section('title', 'Dashboard')

@section('content')

<div class="container p-3">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h4 class="fw-semibold">Welcome, {{ Auth::user()->name }}!</h4>
                        <h6 class="mb-4 font-weight-normal mb-0">Selamat datang di Dashboard <span class="text-primary">Aplikasi Sertifikat</span></h6>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="{{ asset('images/sertif-icon.avif') }}" alt="people" class="img-fluid" style="max-width: 390px; height: auto; overflow: hidden;">
                    <!-- <div class="weather-info">
                            <div class="d-flex">
                                <div class="ml-2">
                                    <h4 class="me-4 ms-4 mb-3 location font-weight-normal">Aplikasi Sertifikat</h4>
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 col-12 mb-4 stretch-card transparent">
                    <div class="card" style="background-color: #4A90E2;"> <!-- Biru Cerah -->
                        <div class="card-body">
                            <p class="mb-2" style="color: white; font-weight: bold;">
                                Jumlah Mahasiswa
                            </p>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-user-graduate" style="color: white; font-size: 30px;"></i>
                                <p class="mt-3 fs-40" style="color: white; font-weight: bold; font-size: 40px;">{{ $totalMahasiswa }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-4 stretch-card transparent">
                    <div class="card" style="background-color: #003366;"> <!-- Biru Gelap -->
                        <div class="card-body">
                            <p class="mb-2" style="color: white; font-weight: bold;">
                                Jumlah Sertifikat
                            </p>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-chalkboard-teacher" style="color: white; font-size: 30px;"></i>
                                <p class="mt-3 fs-40" style="color: white; font-weight: bold; font-size: 40px;">Total Sertifikat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card" style="background-color: #5DADE2;"> <!-- Biru Laut -->
                        <div class="card-body">
                            <p class="mb-2" style="color: white; font-weight: bold;">
                                Jumlah Kelas
                            </p>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-school" style="color: white; font-size: 30px;"></i>
                                <p class="mt-3 fs-40" style="color: white; font-weight: bold; font-size: 40px;">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 stretch-card transparent">
                    <div class="card" style="background-color: #1F618D;"> <!-- Biru Tua -->
                        <div class="card-body">
                            <p class="mb-2" style="color: white; font-weight: bold;">
                                Jumlah Ujian
                            </p>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-handshake" style="color: white; font-size: 30px;"></i>
                                <p class="mt-3 fs-40" style="color: white; font-weight: bold; font-size: 40px;">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


@endsection