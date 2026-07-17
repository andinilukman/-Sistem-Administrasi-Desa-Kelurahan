@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Detail Pengumuman</h3>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('pengumuman.index') }}" class="text-decoration-none">Pengumuman</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-5">
        <div class="mb-4">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3"><i class="bi bi-calendar me-1"></i> {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}</span>
            <h2 class="fw-bold text-dark">{{ $pengumuman->judul }}</h2>
            <p class="text-muted"><i class="bi bi-person me-1"></i> Dipublikasikan oleh: <strong>{{ $pengumuman->pembuat }}</strong></p>
        </div>
        
        <hr class="my-4">
        
        <div class="fs-5 lh-lg text-dark">
            {!! nl2br(e($pengumuman->isi)) !!}
        </div>
        
        <div class="mt-5">
            <a href="{{ route('pengumuman.index') }}" class="btn btn-outline-secondary px-4 rounded-pill"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
        </div>
    </div>
</div>
@endsection
