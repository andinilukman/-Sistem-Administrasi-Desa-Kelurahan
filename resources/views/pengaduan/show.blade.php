@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Detail Pengaduan</h3>
    </div>
    <a href="{{ route('pengaduan.index') }}" class="btn btn-light border"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-5">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h4 class="fw-bold text-dark">{{ $pengaduan->judul }}</h4>
                <p class="text-muted mb-0"><i class="bi bi-person me-1"></i> Pelapor: <strong>{{ $pengaduan->user->name ?? '-' }}</strong> | <i class="bi bi-calendar me-1"></i> {{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d M Y H:i') }}</p>
            </div>
            <div>
                @if($pengaduan->status == 'Menunggu')
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fs-6">Menunggu</span>
                @elseif($pengaduan->status == 'Diproses')
                    <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">Diproses</span>
                @else
                    <span class="badge bg-success rounded-pill px-3 py-2 fs-6">Selesai</span>
                @endif
            </div>
        </div>
        
        <div class="p-4 bg-light rounded mb-4">
            <h6 class="fw-bold text-secondary">Isi Pengaduan:</h6>
            <p class="mb-0 fs-5">{{ $pengaduan->isi }}</p>
        </div>
        
        <div class="p-4 rounded border">
            <h6 class="fw-bold text-primary"><i class="bi bi-chat-text me-2"></i>Tanggapan Admin:</h6>
            @if($pengaduan->tanggapan)
                <p class="mb-0 fs-6">{{ $pengaduan->tanggapan }}</p>
            @else
                <p class="text-muted mb-0 fst-italic">Belum ada tanggapan dari Admin.</p>
            @endif
        </div>
    </div>
</div>
@endsection
