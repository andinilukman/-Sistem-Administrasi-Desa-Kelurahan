@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Dashboard Kepala Desa</h3>
        <p class="text-muted mb-0">Tinjauan cepat data administrasi dan persetujuan surat.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<!-- Statistik Status Surat Khusus Kades -->
<div class="row g-4 mb-4">
    <!-- Menunggu -->
    <div class="col-xl-6 col-md-6">
        <div class="card text-white border-0 shadow-sm h-100" style="border-radius: var(--radius); background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-clock-history position-absolute opacity-25" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <h6 class="mb-1 text-white-50 fw-bold">Perlu Persetujuan (Menunggu)</h6>
                <h2 class="mb-0 fw-bold">{{ $suratMenunggu }} Surat</h2>
            </div>
        </div>
    </div>

    <!-- Disetujui -->
    <div class="col-xl-6 col-md-6">
        <div class="card text-white border-0 shadow-sm h-100" style="border-radius: var(--radius); background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="bi bi-check2-circle position-absolute opacity-25" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                <h6 class="mb-1 text-white-50 fw-bold">Telah Disetujui</h6>
                <h2 class="mb-0 fw-bold">{{ $suratDisetujui }} Surat</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-bar-chart-fill text-primary me-2"></i>Statistik Pengajuan Surat</h5>
                <span class="badge bg-light text-dark border"><i class="bi bi-calendar3 me-1"></i> Tahun Ini</span>
            </div>
            <div class="card-body p-4">
                <div style="height: 300px; width: 100%;">
                    <canvas id="suratChart"></canvas>
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
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('suratChart').getContext('2d');
        
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
                            font: { family: "'Inter', sans-serif" },
                            precision: 0
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
