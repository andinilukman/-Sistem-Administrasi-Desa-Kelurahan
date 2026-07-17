@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Ubah Pengumuman</h3>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-4">
        <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Judul Pengumuman</label>
                <input type="text" name="judul" class="form-control" value="{{ $pengumuman->judul }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $pengumuman->tanggal }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Isi Pengumuman</label>
                <textarea name="isi" rows="6" class="form-control" required>{{ $pengumuman->isi }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
            <a href="{{ route('pengumuman.index') }}" class="btn btn-light px-4">Batal</a>
        </form>
    </div>
</div>
@endsection
