@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Proses Pengaduan</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Detail Pengaduan</h5>
                <div class="mb-3">
                    <small class="text-muted d-block">Judul</small>
                    <span class="fw-medium">{{ $pengaduan->judul }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Pelapor</small>
                    <span class="fw-medium">{{ $pengaduan->user->name ?? '-' }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Tanggal</small>
                    <span class="fw-medium">{{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d M Y H:i') }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Isi Pengaduan</small>
                    <p class="mb-0 bg-light p-3 rounded mt-1">{{ $pengaduan->isi }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7 mb-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Tanggapan Admin</h5>
                <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Pengaduan</label>
                        <select name="status" class="form-select" required>
                            <option value="Menunggu" {{ $pengaduan->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Keterangan / Tanggapan</label>
                        <textarea name="tanggapan" rows="6" class="form-control" placeholder="Tulis tanggapan untuk warga...">{{ $pengaduan->tanggapan }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Status</button>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-light px-4">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
