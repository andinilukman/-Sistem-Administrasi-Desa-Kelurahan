@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Dashboard</h3>
        <p class="text-muted mb-0">Selamat Datang di Sistem Administrasi Desa/Kelurahan</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<!-- Statistik Kartu -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-people-fill fs-4 text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 fw-bold">Penduduk</h6>
                        <h3 class="mb-0 fw-bold">{{ $jumlahPenduduk }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-file-earmark-text-fill fs-4 text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 fw-bold">Kartu Keluarga</h6>
                        <h3 class="mb-0 fw-bold">{{ $jumlahKk }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-person-badge-fill fs-4 text-info"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 fw-bold">Aparat Desa</h6>
                        <h3 class="mb-0 fw-bold">{{ $jumlahAparat }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-envelope-paper-fill fs-4 text-warning"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 fw-bold">Total Surat</h6>
                        <h3 class="mb-0 fw-bold">{{ $totalSurat }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahan Metrik Admin -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-megaphone-fill fs-4 text-danger"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 fw-bold">Pengumuman</h6>
                        <h3 class="mb-0 fw-bold">{{ $jumlahPengumuman }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-secondary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-box-seam-fill fs-4 text-secondary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 fw-bold">Aset Desa</h6>
                        <h3 class="mb-0 fw-bold">{{ $jumlahAset }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-bell-fill text-primary me-2"></i>Pemberitahuan Sistem</h5>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-primary" style="border-radius:10px;">
                    <h6 class="fw-bold"><i class="bi bi-info-circle-fill me-2"></i>Selamat Datang, Admin!</h6>
                    <p class="mb-0 small">Dashboard Administrator menyediakan akses penuh ke seluruh pengelolaan data master, administrasi surat, pengumuman, dan aset desa.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Grafik Penduduk -->
    <div class="col-xl-4 col-lg-5">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-pie-chart-fill text-primary me-2"></i>Demografi Penduduk</h5>
            </div>
            <div class="card-body p-4 d-flex justify-content-center align-items-center">
                <div style="width: 100%; max-width: 300px;">
                    <canvas id="pendudukChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Aktivitas Terbaru -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0" style="color: var(--sidebar-blue);"><i class="bi bi-activity me-2"></i>Aktivitas Terbaru</h5>
                <button class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">Lihat Semua</button>
            </div>
            <div class="card-body p-0 px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="rounded-start">Tipe Aktivitas</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col" class="rounded-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3 text-primary">
                                            <i class="bi bi-envelope-paper"></i>
                                        </div>
                                        <span class="fw-medium">Pengajuan Surat Pengantar</span>
                                    </div>
                                </td>
                                <td>Oleh: Budi Santoso (RT 01/RW 02)</td>
                                <td>Hari ini, 09:30</td>
                                <td><span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Menunggu Verifikasi</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 p-2 rounded me-3 text-success">
                                            <i class="bi bi-check-circle"></i>
                                        </div>
                                        <span class="fw-medium">Persetujuan Surat Keterangan Usaha</span>
                                    </div>
                                </td>
                                <td>Oleh: Admin (Disetujui)</td>
                                <td>Hari ini, 08:15</td>
                                <td><span class="badge bg-success px-3 py-2 rounded-pill">Selesai</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 p-2 rounded me-3 text-info">
                                            <i class="bi bi-person-plus"></i>
                                        </div>
                                        <span class="fw-medium">Penambahan Data Penduduk</span>
                                    </div>
                                </td>
                                <td>Data: Keluarga Ahmad Yani</td>
                                <td>Kemarin, 14:20</td>
                                <td><span class="badge bg-success px-3 py-2 rounded-pill">Selesai</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-danger bg-opacity-10 p-2 rounded me-3 text-danger">
                                            <i class="bi bi-x-circle"></i>
                                        </div>
                                        <span class="fw-medium">Penolakan Pengajuan Surat</span>
                                    </div>
                                </td>
                                <td>Alasan: Dokumen tidak lengkap</td>
                                <td>Kemarin, 11:05</td>
                                <td><span class="badge bg-danger px-3 py-2 rounded-pill">Ditolak</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Demografi Penduduk Doughnut Chart
        const ctxPenduduk = document.getElementById('pendudukChart').getContext('2d');
        new Chart(ctxPenduduk, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $jumlahLakiLaki }}, {{ $jumlahPerempuan }}],
                    backgroundColor: ['#2563EB', '#ec4899'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { family: "'Inter', sans-serif", size: 13 },
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1E3A8A',
                        padding: 12,
                        titleFont: { size: 13, family: "'Inter', sans-serif" },
                        bodyFont: { size: 14, weight: 'bold', family: "'Inter', sans-serif" },
                        cornerRadius: 8
                    }
                }
            }
        });
    });
</script>
@endsection
