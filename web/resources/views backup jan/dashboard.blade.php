@extends('backend.layout.layout')

@section('title', 'Dashboard')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome, {{ Auth::user()->name }}!</h3>
                        <h6 class="mb-4 font-weight-normal mb-0">Silahkan mengeksplorasi sesuka hati <span class="text-primary">aplikasi sertifikat</span></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today ({{ now()->format('d M Y') }})
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="{{ asset('images/developer.gif') }}" alt="people" class="img-fluid" style="max-width: 390px; height: auto; overflow: hidden;">
                        <div class="weather-info">
                            <div class="d-flex">
                                <div class="ml-2">
                                    <h4 class="me-4 ms-4 mb-3 location font-weight-normal">Aplikasi Sertifikat</h4>
                                </div>
                            </div>
                        </div>
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
                                    Jumlah Dosen
                                </p>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <i class="fas fa-chalkboard-teacher" style="color: white; font-size: 30px;"></i>
                                    <p class="mt-3 fs-40" style="color: white; font-weight: bold; font-size: 40px;">10</p>
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
                                    <p class="mt-3 fs-40" style="color: white; font-weight: bold; font-size: 40px;">5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 stretch-card transparent">
                        <div class="card" style="background-color: #1F618D;"> <!-- Biru Tua -->
                            <div class="card-body">
                                <p class="mb-2" style="color: white; font-weight: bold;">
                                    Jumlah Meeting
                                </p>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <i class="fas fa-handshake" style="color: white; font-size: 30px;"></i>
                                    <p class="mt-3 fs-40" style="color: white; font-weight: bold; font-size: 40px;">15</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection