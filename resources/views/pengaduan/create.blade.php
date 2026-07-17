@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Buat Pengaduan</h3>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-4">
        <form action="{{ route('pengaduan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Judul Pengaduan</label>
                <input type="text" name="judul" class="form-control" placeholder="Contoh: Jalan rusak di RT 01" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Isi Pengaduan / Deskripsi</label>
                <textarea name="isi" rows="6" class="form-control" placeholder="Jelaskan detail pengaduan Anda..." required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-send me-1"></i> Kirim Pengaduan</button>
            <a href="{{ route('pengaduan.index') }}" class="btn btn-light px-4">Batal</a>
        </form>
    </div>
</div>
@endsection
