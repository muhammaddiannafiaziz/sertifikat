@extends('backend.layout.layout')

@section('title', 'Edit Sertifikat')

@section('content')
<div class="container">
    <h2>Edit Status Sertifikat</h2>
    <form action="{{ route('sertifikat.update', $sertifikat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Status Ujian Ibadah</label>
            <select name="status_ujian_ibadah" class="form-control">
                <option value="lulus" {{ $sertifikat->status_ujian_ibadah == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak_lulus" {{ $sertifikat->status_ujian_ibadah == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status Ujian Al-Qur'an</label>
            <select name="status_ujian_alquran" class="form-control">
                <option value="lulus" {{ $sertifikat->status_ujian_alquran == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak_lulus" {{ $sertifikat->status_ujian_alquran == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection