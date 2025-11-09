@extends('frontend.layout')

@section('title', 'Hasil Pengecekan SKL')

@section('content')

<header class="ex-header bg-gray">
    <div class="container px-4 sm:px-8 xl:px-4">
        <h1 class="xl:ml-24">Hasil Pengecekan SKL</h1>
    </div> </header> <div class="basic-1 pt-12 pb-16">
    <div class="container px-4 sm:px-8">
        <div class="mx-auto max-w-4xl">

            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-bold mb-4">Data Mahasiswa</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 text-gray-700">
                    <div>
                        <span class="font-semibold">Nama Lengkap:</span>
                        <span class="ml-2">{{ $mahasiswa->nama }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">NIM:</span>
                        <span class="ml-2">{{ $mahasiswa->nim }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Program Studi:</span>
                        <span class="ml-2">{{ $mahasiswa->program_studi }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Fakultas:</span>
                        <span class="ml-2">{{ $mahasiswa->fakultas }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">SKL Ma'had (Ibadah & Al-Qur'an)</h3>
                    @if($sklMahad)
                        <span class="text-sm font-semibold text-green-600">Data Ditemukan</span>
                    @else
                        <span class="text-sm font-semibold text-red-600">Data Tidak Ditemukan</span>
                    @endif
                </div>

                @if($sklMahad)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="font-semibold">Status SKL Ibadah:</p>
                        @if($sklMahad->status_ujian_ibadah == 'lulus')
                            <p class="text-green-600 font-bold">Lulus</p>
                        @else
                            <p class="text-red-600 font-bold">Tidak Lulus</p>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold">Status SKL Al-Qur'an:</p>
                         @if($sklMahad->status_ujian_alquran == 'lulus')
                            <p class="text-green-600 font-bold">Lulus</p>
                        @else
                            <p class="text-red-600 font-bold">Tidak Lulus</p>
                        @endif
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <a href="{{ route('public.download', $sklMahad->no_sertifikat) }}" class="btn-solid-sm" target="_blank">
                        <i class="fas fa-download mr-2"></i>Download Sertifikat Ma'had
                    </a>
                </div>
                @else
                <p class="text-gray-500">Data SKL Ma'had untuk NIM ini belum diterbitkan.</p>
                @endif
            </div>

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">SKL Bahasa (Arab & Inggris)</h3>
                    @if($sklBahasa)
                        <span class="text-sm font-semibold text-green-600">Data Ditemukan</span>
                    @else
                        <span class="text-sm font-semibold text-red-600">Data Tidak Ditemukan</span>
                    @endif
                </div>

                @if($sklBahasa)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kompetensi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rincian</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td rowspan="3" class="px-6 py-4 align-top font-semibold">Bahasa Arab</td>
                                <td class="px-6 py-4">Istima'</td>
                                <td class="px-6 py-4 text-center">{{ $sklBahasa->istima ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">Kitabah</td>
                                <td class="px-6 py-4 text-center">{{ $sklBahasa->kitabah ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">Qira'ah</td>
                                <td class="px-6 py-4 text-center">{{ $sklBahasa->qiraah ?? '-' }}</td>
                            </tr>
                             <tr>
                                <td rowspan="3" class="px-6 py-4 align-top font-semibold">Bahasa Inggris</td>
                                <td class="px-6 py-4">Listening</td>
                                <td class="px-6 py-4 text-center">{{ $sklBahasa->listening ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">Writing</td>
                                <td class="px-6 py-4 text-center">{{ $sklBahasa->writing ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">Reading</td>
                                <td class="px-6 py-4 text-center">{{ $sklBahasa->reading ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 text-right">
                    <a href="{{ route('public.download', $sklBahasa->no_sertifikat) }}" class="btn-solid-sm" target="_blank">
                        <i class="fas fa-download mr-2"></i>Download Sertifikat Bahasa
                    </a>
                </div>
                @else
                <p class="text-gray-500">Data SKL Bahasa untuk NIM ini belum diterbitkan.</p>
                @endif
            </div>

            <div class="bg-white shadow rounded-lg p-6 mb-8">
                 <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">SKL Komputer (TIPD)</h3>
                    @if($sklTipd)
                        <span class="text-sm font-semibold text-green-600">Data Ditemukan</span>
                    @else
                        <span class="text-sm font-semibold text-red-600">Data Tidak Ditemukan</span>
                    @endif
                </div>
                
                @if($sklTipd)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kompetensi</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">Word</td>
                                <td class="px-6 py-4 text-center">{{ $sklTipd->word ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">Excel</td>
                                <td class="px-6 py-4 text-center">{{ $sklTipd->excel ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">Power Point</td>
                                <td class="px-6 py-4 text-center">{{ $sklTipd->power_point ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <div class="mt-6 text-right">
                    <a href="{{ route('public.download', $sklTipd->no_sertifikat) }}" class="btn-solid-sm" target="_blank">
                        <i class="fas fa-download mr-2"></i>Download Sertifikat Komputer
                    </a>
                </div>
                @else
                <p class="text-gray-500">Data SKL Komputer untuk NIM ini belum diterbitkan.</p>
                @endif
            </div>

            <div class="text-center">
                <a href="{{ route('public.cek') }}" class="btn-outline-lg">
                    <i class="fas fa-arrow-left mr-2"></i>Cari NIM Lain
                </a>
            </div>
        </div> 
    </div> 
</div> 
@endsection