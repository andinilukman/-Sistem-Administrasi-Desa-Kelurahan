@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Detail Aparat Desa</h3>
        <p class="text-muted mb-0">Rincian informasi lengkap aparat desa.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('aparat-desa.index') }}" class="text-decoration-none">Aparat Desa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-4 mb-4">
        <div class="card border-0 shadow-sm text-center p-4" style="border-radius: var(--radius);">
            <div class="mb-3">
                @if($aparatDesa->foto)
                    <img src="{{ asset('storage/' . $aparatDesa->foto) }}" alt="Foto {{ $aparatDesa->nama_lengkap }}" class="rounded-circle shadow-sm" style="width: 150px; height: 150px; object-fit: cover; border: 3px solid var(--light-blue);">
                @else
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white mx-auto shadow-sm" style="width: 150px; height: 150px; border: 3px solid #dee2e6;">
                        <i class="bi bi-person" style="font-size: 5rem;"></i>
                    </div>
                @endif
            </div>
            <h5 class="fw-bold mb-1">{{ $aparatDesa->nama_lengkap }}</h5>
            <p class="text-primary fw-medium mb-3">{{ $aparatDesa->jabatan }}</p>
            
            <div>
                @if($aparatDesa->status_aktif == 'Aktif')
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2" style="border-radius: 8px;">
                        <i class="bi bi-check-circle me-1"></i> Aktif
                    </span>
                @else
                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2" style="border-radius: 8px;">
                        <i class="bi bi-x-circle me-1"></i> Tidak Aktif
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-person-vcard text-info me-2"></i>Informasi Detail</h5>
            </div>
            
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th width="40%" class="text-muted fw-medium py-2">NIP</th>
                                    <td class="fw-bold py-2">{{ $aparatDesa->nip }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Tempat, Tanggal Lahir</th>
                                    <td class="py-2">{{ $aparatDesa->tempat_lahir }}, {{ \Carbon\Carbon::parse($aparatDesa->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Jenis Kelamin</th>
                                    <td class="py-2">{{ $aparatDesa->jenis_kelamin }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th width="40%" class="text-muted fw-medium py-2">Nomor Telepon</th>
                                    <td class="py-2">{{ $aparatDesa->nomor_telepon ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Email</th>
                                    <td class="py-2">{{ $aparatDesa->email ?: '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th width="20%" class="text-muted fw-medium py-2">Alamat Lengkap</th>
                                    <td class="py-2">{{ $aparatDesa->alamat }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Terdaftar Pada</th>
                                    <td class="py-2">{{ $aparatDesa->created_at->translatedFormat('l, d F Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <a href="{{ route('aparat-desa.index') }}" class="btn btn-light" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('aparat-desa.edit', $aparatDesa->id) }}" class="btn btn-warning text-white ms-auto" style="border-radius: 8px;">
                        <i class="bi bi-pencil me-1"></i> Ubah Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
