@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">{{ $title ?? 'Judul Halaman' }}</h3>
        <p class="text-muted mb-0">Modul Sistem Administrasi Desa/Kelurahan</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'Halaman' }}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5" style="border-radius: var(--radius);">
            <div class="card-body">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle p-4 mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-tools text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold" style="color: var(--sidebar-blue);">Sedang Dalam Pengembangan</h4>
                    <p class="text-muted fs-5 mb-0 mt-2">"Fitur ini akan dikembangkan pada tahap berikutnya."</p>
                </div>
                
                <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3" style="border-radius: 10px; padding: 10px 20px;">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
