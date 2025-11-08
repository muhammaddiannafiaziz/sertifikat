@extends('frontend.layout')

@section('title', 'Dashboard')

@section('content')

<!-- Header -->
<div id="header" class="header py-28 text-center md:pt-36 lg:text-left xl:pt-24 xl:pb-2 bg-white">
    <div class="container p-6 rounded-xl shadow-md px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8 bg-white">

        <!-- Tabel Informasi Mahasiswa -->
        <div class="overflow-x-auto">
            <div>
                <h2 class="text-gray-600">Validasi Sertifikat</h2>
                <p class="mb-4"> Sertifikat dengan Nomor <span class="font-semibold text-blue-500">{{ $sertifikat->no_sertifikat }}</span> valid ditemukan</p>
            </div>
            <table class="min-w-full table-auto border-separate border border-blue-200 rounded-lg">
                <thead class="bg-blue-100 rounded-tl-lg rounded-tr-lg">
                    <!-- No content needed here as no headers -->
                </thead>
                <tbody class="text-gray-800">
                    <tr class="bg-blue-50">
                        <td class="px-4 py-3 font-bold text-sm text-gray-600">Nama</td>
                        <td class="px-2 py-3 text-sm">{{ $sertifikat->mahasiswa->nama }}</td>
                    </tr>
                    <tr class="bg-blue-100">
                        <td class="px-4 py-3 font-bold text-sm text-gray-600">NIM</td>
                        <td class="px-2 py-3 text-sm">{{ $sertifikat->mahasiswa->nim }}</td>
                    </tr>
                    <tr class="bg-blue-50">
                        <td class="px-4 py-3 font-bold text-sm text-gray-600">Program Studi</td>
                        <td class="px-2 py-3 text-sm">{{ $sertifikat->mahasiswa->program_studi }}</td>
                    </tr>
                    <tr class="bg-blue-100">
                        <td class="px-4 py-3 font-bold text-sm text-gray-600">Fakultas</td>
                        <td class="px-2 py-3 text-sm">{{ $sertifikat->mahasiswa->fakultas }}</td>
                    </tr>
                    <tr class="bg-blue-50">
                        <td class="px-4 py-3 font-bold text-sm text-gray-600">No Sertifikat</td>
                        <td class="px-2 py-3 text-sm">{{ $sertifikat->no_sertifikat }}</td>
                    </tr>
                    <tr class="bg-blue-100">
                        <td class="px-4 py-3 font-bold text-sm text-gray-600">Status Ujian SKL Ibadah</td>
                        <td class="px-2 py-3 text-sm">
                            {{ $sertifikat->status_ujian_ibadah == 'lulus' ? 'Lulus' : 'Tidak Lulus' }}
                        </td>
                    </tr>
                    <tr class="bg-blue-50">
                        <td class="px-4 py-3 font-bold text-sm text-gray-600">Status Ujian SKL Al-Qur'an</td>
                        <td class="px-2 py-3 text-sm">
                            {{ $sertifikat->status_ujian_alquran == 'lulus' ? 'Lulus' : 'Tidak Lulus' }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <!-- Optional footer if needed -->
                </tfoot>
            </table>
        </div>

        <!-- Gambar -->
        <div class="xl:text-right flex justify-center pt-4 mt-28">
            <img src="{{ asset('images/valid.png') }}" alt="Valid" class="w-70 h-40">
        </div>

    </div> <!-- end of container -->
</div> <!-- end of header -->

@endsection