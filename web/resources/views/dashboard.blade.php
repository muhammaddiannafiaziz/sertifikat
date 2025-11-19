@extends('backend.layout.layout')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-3">
    <h4 class="fw-semibold mb-4">Dashboard Administrator</h4>
    
    <div class="row">
        @if($role != 'superadmin')
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                SKL Terbit (Role Anda)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['role_specific_skl']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-file-earmark-check text-gray-300" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Peserta (Role Anda)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['role_specific_peserta']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-fill text-gray-300" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-left-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Mahasiswa Master
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_mahasiswa']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill text-gray-300" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
    
    @if($role == 'superadmin')
    <h5 class="mt-4 mb-3">Statistik SKL Global</h5>
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h6 class="text-xs font-weight-bold text-primary text-uppercase mb-1">SKL Ma'had Terbit</h6>
                    <p class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['skl_mahad_count']) }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h6 class="text-xs font-weight-bold text-primary text-uppercase mb-1">SKL Bahasa Terbit</h6>
                    <p class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['skl_bahasa_count']) }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h6 class="text-xs font-weight-bold text-primary text-uppercase mb-1">SKL Komputer Terbit</h6>
                    <p class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['skl_tipd_count']) }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    
</div>

@endsection

@push('styles')
<style>
    /* Styling tambahan untuk Bootstrap Card agar mirip Bootstrap 4 */
    .card {
        border-radius: .35rem;
    }
    .border-left-primary {
        border-left: .25rem solid #007bff!important;
    }
    .border-left-warning {
        border-left: .25rem solid #ffc107!important;
    }
    .border-left-info {
        border-left: .25rem solid #17a2b8!important;
    }
    .text-xs {
        font-size: .7rem;
    }
    .text-gray-300 {
        color: #dee2e6;
    }
    .text-gray-800 {
        color: #343a40;
    }
</style>
@endpush