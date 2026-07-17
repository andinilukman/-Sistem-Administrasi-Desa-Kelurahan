@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Detail Data Penduduk</h3>
        <p class="text-muted mb-0">Rincian informasi lengkap individu.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('penduduk.index') }}" class="text-decoration-none">Penduduk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-9">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-person-vcard text-info me-2"></i>Informasi Penduduk</h5>
                
                @if($penduduk->status_penduduk == 'Aktif')
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2" style="border-radius: 8px; font-size: 0.9rem;">
                        <i class="bi bi-check-circle me-1"></i> Aktif
                    </span>
                @elseif($penduduk->status_penduduk == 'Meninggal')
                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2" style="border-radius: 8px; font-size: 0.9rem;">
                        <i class="bi bi-x-circle me-1"></i> Meninggal
                    </span>
                @else
                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2" style="border-radius: 8px; font-size: 0.9rem;">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ $penduduk->status_penduduk }}
                    </span>
                @endif
            </div>
            
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Informasi Pribadi</h6>
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th width="40%" class="text-muted fw-medium py-2">NIK</th>
                                    <td class="fw-bold py-2">{{ $penduduk->nik }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Nama Lengkap</th>
                                    <td class="fw-bold text-primary py-2">{{ $penduduk->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Tempat, Tanggal Lahir</th>
                                    <td class="py-2">{{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Jenis Kelamin</th>
                                    <td class="py-2">{{ $penduduk->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Agama</th>
                                    <td class="py-2">{{ $penduduk->agama }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Informasi Latar Belakang & Keluarga</h6>
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th width="40%" class="text-muted fw-medium py-2">Nomor KK</th>
                                    <td class="fw-bold py-2">
                                        @if($penduduk->kartuKeluarga)
                                            <a href="{{ route('kartu-keluarga.show', $penduduk->kartuKeluarga->id) }}" class="text-decoration-none">
                                                {{ $penduduk->kartuKeluarga->nomor_kk }}
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak terikat (Data terhapus)</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Pendidikan</th>
                                    <td class="py-2">{{ $penduduk->pendidikan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Pekerjaan</th>
                                    <td class="py-2">{{ $penduduk->pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Status Perkawinan</th>
                                    <td class="py-2">{{ $penduduk->status_perkawinan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Informasi Kontak</h6>
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th width="20%" class="text-muted fw-medium py-2">Nomor Telepon</th>
                                    <td class="py-2">{{ $penduduk->nomor_telepon ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Email</th>
                                    <td class="py-2">{{ $penduduk->email ?: '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <a href="{{ route('penduduk.index') }}" class="btn btn-light" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('penduduk.edit', $penduduk->id) }}" class="btn btn-warning text-white ms-auto" style="border-radius: 8px;">
                        <i class="bi bi-pencil me-1"></i> Ubah Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
