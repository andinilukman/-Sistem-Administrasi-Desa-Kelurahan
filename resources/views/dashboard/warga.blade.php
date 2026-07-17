@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Dashboard Warga</h3>
        <p class="text-muted mb-0">Layanan pengajuan surat dan informasi desa.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<div class="row g-4 mb-4">
    <!-- Akses Cepat -->
    <div class="col-xl-4 col-md-12">
        <div class="card bg-white border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Akses Cepat</h5>
            </div>
            <div class="card-body p-4 text-center">
                <a href="{{ route('pengajuan-surat.create-warga') }}" class="btn btn-primary w-100 mb-3 py-3" style="border-radius: 12px; font-weight:600;">
                    <i class="bi bi-envelope-plus-fill fs-4 d-block mb-1"></i> Ajukan Surat Baru
                </a>
                <a href="{{ route('pengaduan.create') }}" class="btn btn-outline-danger w-100 py-3" style="border-radius: 12px; font-weight:600;">
                    <i class="bi bi-chat-left-dots-fill fs-4 d-block mb-1"></i> Buat Pengaduan
                </a>
            </div>
        </div>
    </div>

    <!-- Status Pengajuan Terbaru -->
    <div class="col-xl-8 col-md-12">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-clock-history text-primary me-2"></i>Status Pengajuan Terbaru</h5>
                <a href="{{ route('pengajuan-surat.warga') }}" class="btn btn-sm btn-light">Lihat Semua</a>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No Surat</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suratTerbaru as $surat)
                            <tr>
                                <td class="fw-medium">{{ $surat->nomor_surat }}</td>
                                <td>{{ $surat->jenis_surat }}</td>
                                <td>{{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->translatedFormat('d M Y') }}</td>
                                <td>
                                    @if($surat->status == 'Menunggu')
                                        <span class="badge bg-warning text-dark rounded-pill px-2">Menunggu</span>
                                    @elseif($surat->status == 'Diproses')
                                        <span class="badge bg-primary rounded-pill px-2">Diproses</span>
                                    @elseif($surat->status == 'Disetujui')
                                        <span class="badge bg-success rounded-pill px-2">Disetujui</span>
                                    @elseif($surat->status == 'Ditolak')
                                        <span class="badge bg-danger rounded-pill px-2">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">Belum ada pengajuan surat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pengumuman Desa -->
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-megaphone-fill text-danger me-2"></i>Pengumuman Desa Terbaru</h5>
            </div>
            <div class="card-body p-4">
                @forelse($pengumumanTerbaru as $pengumuman)
                <div class="alert alert-info border-0 mb-3" style="border-radius: 12px; background-color: #f0f7ff;">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="fw-bold text-dark mb-0">{{ $pengumuman->judul }}</h6>
                        <small class="text-muted"><i class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d M Y') }}</small>
                    </div>
                    <p class="mb-0 text-dark small">{{ Str::limit($pengumuman->isi, 150) }}</p>
                    <div class="mt-2 text-end">
                        <a href="{{ route('pengumuman.show', $pengumuman->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Baca Selengkapnya</a>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                    Belum ada pengumuman terbaru.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
