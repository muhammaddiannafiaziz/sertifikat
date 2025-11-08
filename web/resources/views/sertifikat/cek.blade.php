@extends('frontend.layout')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-200 to-[#C5EAF9] p-6">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl overflow-hidden">
        <!-- Judul dengan background pink full -->
        <div class="bg-indigo-500 py-4 px-6">
            <h2 class="text-2xl font-bold text-center text-white">Cek Sertifikat</h2>
        </div>

        <div class="p-6">
            @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md animate-fade-in">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('cek-sertifikat') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="nim" class="block text-gray-700 font-medium mb-2">Masukkan NIM lalu cek sertifikat</label>
                    <input type="text" id="nim" name="nim"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition-shadow"
                        placeholder="Masukkan NIM Anda" required>
                </div>
                <button type="submit"
                    class="w-full bg-pink-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-pink-700 transition-all duration-300">
                    Cari Sertifikat
                </button>
            </form>
        </div>
    </div>
</div>

@endsection