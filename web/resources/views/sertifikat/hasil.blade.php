@extends('frontend.layout')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-200 to-[#C5EAF9] p-6">
    <div class="w-full max-w-3xl bg-white shadow-lg rounded-xl overflow-hidden">
        <!-- Header Pink -->
        <div class="bg-indigo-500 py-4 px-6">
            <h2 class="text-2xl font-bold text-center text-white">Sertifikat Anda</h2>
        </div>

        <div class="p-6">
            <table class="w-full border-collapse border border-gray-300">
                <tbody>
                    <tr class="bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 font-semibold">Nama</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $sertifikat->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 font-semibold">No Sertifikat</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $sertifikat->no_sertifikat }}</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 font-semibold">Status Ujian Ibadah</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <span class="font-semibold {{ $sertifikat->status_ujian_ibadah === 'lulus' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($sertifikat->status_ujian_ibadah) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 font-semibold">Status Ujian Al-Qur'an</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <span class="font-semibold {{ $sertifikat->status_ujian_alquran === 'lulus' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($sertifikat->status_ujian_alquran) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Tombol Unduh -->
            <div class="text-center mt-6">
                <a href="{{ route('download-sertifikat', $sertifikat->no_sertifikat) }}"
                    class="bg-blue-600 text-white text-lg font-medium py-2 px-6 rounded-lg shadow-md hover:bg-blue-700 transition-all duration-300">
                    Unduh Sertifikat
                </a>
            </div>
        </div>
    </div>
</div>


@endsection