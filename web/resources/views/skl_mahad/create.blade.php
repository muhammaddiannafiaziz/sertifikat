@extends('backend.layout.layout')

@section('title', 'Buat Data SKL Ma\'had')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Buat Data SKL Ma'had</h1>
    <p class="text-center text-muted mb-4">Pilih peserta yang sudah terdaftar untuk penerbitan SKL Ibadah & Al-Qur'an.</p>

    @if ($errors->any())
        <div class="alert alert-danger" style="max-width: 600px; margin: auto; margin-bottom: 20px;">
            <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('skl-mahad.store') }}" method="POST" class="card shadow-sm p-4" style="max-width: 600px; margin: auto;">
        @csrf

        <div class="mb-4">
            <label for="mhsmahad_id" class="form-label">Peserta SKL</label>
            <select name="mhsmahad_id" id="mhsmahad_id" class="form-select @error('mhsmahad_id') is-invalid @enderror" required>
                <option value="">Pilih Peserta</option>
                @forelse ($peserta as $pst) 
                <option value="{{ $pst->id }}" {{ old('mhsmahad_id') == $pst->id ? 'selected' : '' }}>
                    {{ $pst->mahasiswa->nama }} ({{ $pst->nim }})
                </option>
                @empty
                <option value="" disabled>Semua peserta sudah memiliki SKL atau belum ada peserta yang didaftarkan.</option>
                @endforelse
            </select>
            @error('mhsmahad_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Hanya menampilkan Peserta yang sudah terdaftar dan belum memiliki SKL Ma'had.</div>
        </div>

        <div class="mb-4">
            <label for="status_ujian_ibadah" class="form-label">Status Ujian SKL Ibadah</label>
            <select name="status_ujian_ibadah" id="status_ujian_ibadah" class="form-control @error('status_ujian_ibadah') is-invalid @enderror" required>
                <option value="lulus" {{ old('status_ujian_ibadah') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak_lulus" {{ old('status_ujian_ibadah') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
            @error('status_ujian_ibadah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status_ujian_alquran" class="form-label">Status Ujian SKL Al-Qur'an</label>
            <select name="status_ujian_alquran" id="status_ujian_alquran" class="form-control @error('status_ujian_alquran') is-invalid @enderror" required>
                <option value="lulus" {{ old('status_ujian_alquran') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak_lulus" {{ old('status_ujian_alquran') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
            @error('status_ujian_alquran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr class="my-3">

        <div class="d-flex justify-content-between">
            <a href="{{ route('skl-mahad.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary w-50">
                <i class="bi bi-save"></i> Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection