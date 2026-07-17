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
        <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid var(--primary-blue) !important; border-radius: var(--radius);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-grow-1">
                    <h6 class="text-muted fw-semibold mb-2 text-uppercase" style="font-size: 0.8rem;">Jumlah Penduduk</h6>
                    <h3 class="fw-bold mb-0" style="color: var(--sidebar-blue);">{{ number_format($jumlahPenduduk, 0, ',', '.') }}</h3>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 55px; height: 55px;">
                        <i class="bi bi-people-fill text-primary" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #10b981 !important; border-radius: var(--radius);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-grow-1">
                    <h6 class="text-muted fw-semibold mb-2 text-uppercase" style="font-size: 0.8rem;">Jumlah Kartu Keluarga</h6>
                    <h3 class="fw-bold mb-0" style="color: var(--sidebar-blue);">{{ number_format($jumlahKk, 0, ',', '.') }}</h3>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 55px; height: 55px; background-color: rgba(16, 185, 129, 0.1);">
                        <i class="bi bi-card-heading" style="font-size: 1.5rem; color: #10b981;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #f59e0b !important; border-radius: var(--radius);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-grow-1">
                    <h6 class="text-muted fw-semibold mb-2 text-uppercase" style="font-size: 0.8rem;">Jumlah Aparat Desa</h6>
                    <h3 class="fw-bold mb-0" style="color: var(--sidebar-blue);">{{ number_format($jumlahAparat, 0, ',', '.') }}</h3>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 55px; height: 55px; background-color: rgba(245, 158, 11, 0.1);">
                        <i class="bi bi-person-badge-fill" style="font-size: 1.5rem; color: #f59e0b;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #ef4444 !important; border-radius: var(--radius);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-grow-1">
                    <h6 class="text-muted fw-semibold mb-2 text-uppercase" style="font-size: 0.8rem;">Total Pengajuan Surat</h6>
                    <h3 class="fw-bold mb-0" style="color: var(--sidebar-blue);">{{ number_format($totalSurat, 0, ',', '.') }}</h3>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 55px; height: 55px; background-color: rgba(239, 68, 68, 0.1);">
                        <i class="bi bi-envelope-paper-fill" style="font-size: 1.5rem; color: #ef4444;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Status Surat -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: var(--radius); background-color: var(--sidebar-blue); color: white;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-grow-1">
                    <h6 class="fw-medium mb-2 opacity-75" style="font-size: 0.9rem;">Surat Menunggu</h6>
                    <h3 class="fw-bold mb-0">{{ number_format($suratMenunggu, 0, ',', '.') }}</h3>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: rgba(255, 255, 255, 0.2);">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: var(--radius); background-color: var(--primary-blue); color: white;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-grow-1">
                    <h6 class="fw-medium mb-2 opacity-75" style="font-size: 0.9rem;">Surat Diproses</h6>
                    <h3 class="fw-bold mb-0">{{ number_format($suratDiproses, 0, ',', '.') }}</h3>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: rgba(255, 255, 255, 0.2);">
                        <i class="bi bi-arrow-repeat fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: var(--radius); background-color: var(--light-blue); color: white;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-grow-1">
                    <h6 class="fw-medium mb-2 opacity-75" style="font-size: 0.9rem;">Surat Disetujui</h6>
                    <h3 class="fw-bold mb-0">{{ number_format($suratDisetujui, 0, ',', '.') }}</h3>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: rgba(255, 255, 255, 0.2);">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: var(--radius); background-color: #0f172a; color: white;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-grow-1">
                    <h6 class="fw-medium mb-2 opacity-75" style="font-size: 0.9rem;">Surat Ditolak</h6>
                    <h3 class="fw-bold mb-0">{{ number_format($suratDitolak, 0, ',', '.') }}</h3>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: rgba(255, 255, 255, 0.2);">
                        <i class="bi bi-x-circle fs-4"></i>
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
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-graph-up me-2"></i>Statistik Pengajuan Surat</h5>
            </div>
            <div class="card-body p-4">
                <canvas id="suratChart" height="120"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Informasi Desa -->
    <div class="col-xl-4 col-lg-5">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-info-circle-fill text-primary me-2"></i>Informasi Desa</h5>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-primary bg-primary bg-opacity-10 border-0" role="alert" style="border-radius: 10px;">
                    <h6 class="fw-bold mb-1"><i class="bi bi-megaphone-fill me-2"></i>Pelayanan Administrasi</h6>
                    <p class="mb-0 small">Pelayanan administrasi dibuka setiap hari kerja pukul 08:00 - 15:00 WIB.</p>
                </div>
                
                <div class="alert alert-warning bg-warning bg-opacity-10 border-0" role="alert" style="border-radius: 10px;">
                    <h6 class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Pembaruan Data KK</h6>
                    <p class="mb-0 small">Warga diimbau untuk segera memperbarui data Kartu Keluarga terbaru.</p>
                </div>
                
                <div class="alert alert-info bg-info bg-opacity-10 border-0 mb-0" role="alert" style="border-radius: 10px;">
                    <h6 class="fw-bold mb-1"><i class="bi bi-calendar-event-fill me-2"></i>Jadwal Gotong Royong</h6>
                    <p class="mb-0 small">Kegiatan gotong royong rutin akan dilaksanakan pada hari Minggu pagi di setiap dusun.</p>
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
        const ctx = document.getElementById('suratChart').getContext('2d');
        
        const gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
        gradientBlue.addColorStop(0, 'rgba(37, 99, 235, 0.5)');
        gradientBlue.addColorStop(1, 'rgba(37, 99, 235, 0.0)');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Menunggu', 'Diproses', 'Disetujui', 'Ditolak'],
                datasets: [{
                    label: 'Jumlah Surat',
                    data: [
                        {{ $suratMenunggu }}, 
                        {{ $suratDiproses }}, 
                        {{ $suratDisetujui }}, 
                        {{ $suratDitolak }}
                    ],
                    backgroundColor: [
                        '#f59e0b', // Menunggu - Kuning
                        '#2563EB', // Diproses - Biru
                        '#10b981', // Disetujui - Hijau
                        '#ef4444'  // Ditolak - Merah
                    ],
                    borderWidth: 0,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1E3A8A',
                        padding: 12,
                        titleFont: { size: 13, family: "'Inter', sans-serif" },
                        bodyFont: { size: 14, weight: 'bold', family: "'Inter', sans-serif" },
                        displayColors: false,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: { family: "'Inter', sans-serif" }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: { family: "'Inter', sans-serif" }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
