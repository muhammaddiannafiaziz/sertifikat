@extends('frontend.layout')

@section('title', 'Cek Sertifikat SKL')

@section('content')

<header class="ex-header bg-gray">
    <div class="container px-4 sm:px-8 xl:px-4">
        <h1 class="xl:ml-24">Cek Sertifikat SKL</h1>
    </div> </header> <div class="basic-1 pt-12 pb-16">
    <div class="container px-4 sm:px-8">
        <div class="mx-auto max-w-lg"> <div class="text-center mb-8">
                <h2 class="text-3xl font-bold mb-2">Pencarian Data SKL</h2>
                <p class="text-gray-600">
                    Masukkan Nomor Induk Mahasiswa (NIM) Anda untuk melihat data SKL.
                </p>
            </div>

            <form action="{{ route('public.cek.hasil') }}" method="POST">
                @csrf

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                @endif

                <div class="mb-4">
                    <label for="nim" class="block text-gray-700 text-sm font-bold mb-2">NIM (Nomor Induk Mahasiswa)</label>
                    <input type="text" 
                           name="nim" 
                           id="nim" 
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nim') border-red-500 @enderror" 
                           value="{{ old('nim') }}" 
                           placeholder="Contoh: 21314151" 
                           required 
                           autofocus>
                    
                    @error('nim')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full btn-solid-lg">
                        <i class="fas fa-search mr-2"></i>Cari Data
                    </button>
                </div>
            </form>
            
        </div>
    </div>
</div> 
@endsection