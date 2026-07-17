@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Profil Administrator</h3>
        <p class="text-muted mb-0">Informasi detail mengenai akun Anda.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profil</li>
        </ol>
    </nav>
</div>

<div class="row">
    <!-- Kolom Foto Profil -->
    <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card border-0 shadow-sm text-center p-4 h-100" style="border-radius: var(--radius);">
            <div class="mb-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563EB&color=fff&size=150" 
                     alt="Foto Profil" class="rounded-circle shadow" style="width: 150px; height: 150px; border: 4px solid var(--white);">
            </div>
            
            <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
            <p class="text-muted mb-3">{{ '@' . $user->username }}</p>
            
            <div class="d-flex justify-content-center mb-3">
                <span class="badge bg-primary px-3 py-2" style="border-radius: 8px;">
                    <i class="bi bi-person-badge me-1"></i> {{ $user->role }}
                </span>
            </div>
            
            <hr class="my-4 text-muted">
            
            <div class="text-start">
                <div class="mb-3">
                    <small class="text-muted d-block fw-bold mb-1">Email</small>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-envelope text-primary me-2"></i>
                        <span>{{ $user->email }}</span>
                    </div>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold mb-1">Bergabung Sejak</small>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar-check text-primary me-2"></i>
                        <span>{{ $user->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Kolom Detail Profil & Tentang Sistem -->
    <div class="col-xl-8 col-lg-7">
        <!-- Card Informasi Pribadi -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-person-vcard text-info me-2"></i>Detail Informasi</h5>
                <button class="btn btn-sm btn-outline-primary" style="border-radius: 8px;"><i class="bi bi-pencil me-1"></i> Edit Profil</button>
            </div>
            
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label text-muted fw-bold small">Nama Lengkap</label>
                        <input type="text" class="form-control bg-light" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted fw-bold small">Username</label>
                        <input type="text" class="form-control bg-light" value="{{ $user->username }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted fw-bold small">Alamat Email</label>
                        <input type="email" class="form-control bg-light" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted fw-bold small">Nomor Telepon</label>
                        <input type="text" class="form-control bg-light" value="0812-3456-7890" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted fw-bold small">Alamat Lengkap</label>
                        <textarea class="form-control bg-light" rows="2" readonly>Kantor Kepala Desa, Jl. Pembangunan No. 1</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Tentang Sistem -->
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-info-square text-success me-2"></i>Tentang Sistem</h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-buildings text-primary fs-2"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Sistem Administrasi Desa/Kelurahan</h6>
                        <p class="text-muted mb-0 small">Versi 1.0.0 (Release)</p>
                    </div>
                </div>
                <p class="text-muted small">
                    Sistem Administrasi Desa/Kelurahan adalah platform terpadu yang dibangun untuk memudahkan tata kelola data kependudukan, aparatur, serta mempercepat pelayanan surat menyurat secara elektronik. Dirancang menggunakan framework modern Laravel 13 dan desain UI/UX terkini.
                </p>
                <div class="d-flex gap-2">
                    <span class="badge bg-light text-dark border"><i class="bi bi-code-slash me-1"></i> Laravel 13</span>
                    <span class="badge bg-light text-dark border"><i class="bi bi-bootstrap me-1"></i> Bootstrap 5</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
