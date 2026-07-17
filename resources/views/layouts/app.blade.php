<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Administrasi Desa/Kelurahan</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-blue: #2563EB;
            --sidebar-blue: #1E3A8A;
            --light-blue: #60A5FA;
            --bg-gray: #F8FAFC;
            --white: #FFFFFF;
            --radius: 15px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-gray);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background-color: var(--sidebar-blue);
            color: var(--white);
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header i {
            font-size: 2rem;
            color: var(--light-blue);
            margin-bottom: 10px;
        }

        .sidebar-header h5 {
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 15px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--white);
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: var(--primary-blue);
        }

        .nav-item-header {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            margin: 20px 20px 5px 20px;
            letter-spacing: 1px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Navbar */
        .navbar {
            background-color: var(--white);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            padding: 15px 30px;
            z-index: 999;
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-blue);
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--light-blue);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: var(--radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        /* Footer */
        .footer {
            margin-top: auto;
            background-color: var(--white);
            padding: 20px;
            text-align: center;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            color: #6c757d;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-gray);
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Loading Spinner */
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--white);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease;
        }
    </style>
</head>

<body>

    <!-- Loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Memuat...</span>
        </div>
    </div>

    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column">
        <div class="sidebar-header">
            <i class="bi bi-buildings"></i>
            <h5>Administrasi Desa</h5>
        </div>

        <ul class="nav flex-column mb-auto mt-3 overflow-auto" style="flex: 1;">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Dashboard
                </a>
            </li>

            @php $role = auth()->check() ? auth()->user()->role : ''; @endphp

            @if($role == 'Admin')
                <li class="nav-item-header">Master Data</li>
                <li class="nav-item">
                    <a href="{{ route('kartu-keluarga.index') }}" class="nav-link {{ request()->routeIs('kartu-keluarga.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Data Kartu Keluarga
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penduduk.index') }}" class="nav-link {{ request()->routeIs('penduduk.*') ? 'active' : '' }}"> 
                        <i class="bi bi-person-lines-fill"></i> Data Penduduk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('aparat-desa.index') }}" class="nav-link {{ request()->routeIs('aparat-desa.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge-fill"></i> Data Aparat Desa
                    </a>
                </li>

                <li class="nav-item-header">Administrasi Surat</li>
                <li class="nav-item">
                    <a href="{{ route('pengajuan-surat.index') }}" class="nav-link {{ request()->routeIs('pengajuan-surat.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope-plus-fill"></i> Pengajuan Surat
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('verifikasi-surat.index') }}" class="nav-link {{ request()->routeIs('verifikasi-surat.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope-check-fill"></i> Verifikasi Surat
                    </a>
                </li>

                <li class="nav-item-header">Pengelolaan</li>
                <li class="nav-item">
                    <a href="{{ route('pengumuman.index') }}" class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                        <i class="bi bi-megaphone-fill"></i> Pengumuman
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('inventaris-aset.index') }}" class="nav-link {{ request()->routeIs('inventaris-aset.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i> Inventaris Aset Desa
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kelola-pengguna.index') }}" class="nav-link {{ request()->routeIs('kelola-pengguna.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Kelola Pengguna
                    </a>
                </li>

                <li class="nav-item-header">Laporan</li>
                <li class="nav-item">
                    <a href="{{ route('laporan-penduduk.index') }}" class="nav-link {{ request()->routeIs('laporan-penduduk.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-person-fill"></i> Laporan Penduduk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan-kartu-keluarga.index') }}" class="nav-link {{ request()->routeIs('laporan-kartu-keluarga.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text-fill"></i> Laporan Kartu Keluarga
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan-surat.index') }}" class="nav-link {{ request()->routeIs('laporan-surat.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-check-fill"></i> Laporan Pengajuan Surat
                    </a>
                </li>
            @elseif($role == 'Kepala Desa')
                <li class="nav-item-header">Administrasi Surat</li>
                <li class="nav-item">
                    <a href="{{ route('verifikasi-surat.index') }}" class="nav-link {{ request()->routeIs('verifikasi-surat.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope-check-fill"></i> Persetujuan Surat
                    </a>
                </li>

                <li class="nav-item-header">Laporan & Statistik</li>
                <li class="nav-item">
                    <a href="{{ route('laporan-penduduk.index') }}" class="nav-link {{ request()->routeIs('laporan-penduduk.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-person-fill"></i> Laporan Penduduk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan-kartu-keluarga.index') }}" class="nav-link {{ request()->routeIs('laporan-kartu-keluarga.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text-fill"></i> Laporan KK
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan-surat.index') }}" class="nav-link {{ request()->routeIs('laporan-surat.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-check-fill"></i> Laporan Surat
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('statistik') }}" class="nav-link {{ request()->routeIs('statistik') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart-fill"></i> Statistik
                    </a>
                </li>

                <li class="nav-item-header">Informasi</li>
                <li class="nav-item">
                    <a href="{{ route('pengumuman.index') }}" class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                        <i class="bi bi-megaphone-fill"></i> Pengumuman
                    </a>
                </li>
            @elseif($role == 'Warga')
                <li class="nav-item-header">Layanan Surat</li>
                <li class="nav-item">
                    <a href="{{ route('pengajuan-surat.warga') }}" class="nav-link {{ request()->routeIs('pengajuan-surat.warga') || request()->routeIs('pengajuan-surat.create-warga') ? 'active' : '' }}">
                        <i class="bi bi-envelope-plus-fill"></i> Ajukan Surat
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengajuan-surat.warga') }}" class="nav-link {{ request()->routeIs('pengajuan-surat.show-warga') ? 'active' : '' }}">
                        <i class="bi bi-envelope-check-fill"></i> Status Pengajuan
                    </a>
                </li>

                <li class="nav-item-header">Layanan Lainnya</li>
                <li class="nav-item">
                    <a href="{{ route('pengaduan.index') }}" class="nav-link {{ request()->routeIs('pengaduan.*') ? 'active' : '' }}">
                        <i class="bi bi-chat-left-dots-fill"></i> Pengaduan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengumuman.index') }}" class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                        <i class="bi bi-megaphone-fill"></i> Pengumuman Desa
                    </a>
                </li>
            @endif

            <li class="nav-item-header">Profil</li>
            <li class="nav-item">
                <a href="{{ route('profil.index') }}" class="nav-link {{ request()->routeIs('profil.index') ? 'active' : '' }}">
                    <i class="bi bi-person-fill"></i> Profil
                </a>
            </li>
        </ul>

        <div class="mt-auto p-3">
            <a href="{{ route('logout') }}" class="nav-link text-danger">
                <i class="bi bi-box-arrow-right"></i>
                Keluar
            </a>
        </div>
    </nav>

    <!-- Main Content wrapper -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand d-none d-md-block" href="#">Sistem Administrasi Desa/Kelurahan</a>

                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2 fw-medium">
                                {{ auth()->check() ? auth()->user()->name : 'Guest' }}
                                <br>
                                <small class="text-muted" style="font-size: 0.75rem;">{{ auth()->check() ? auth()->user()->role : '' }}</small>
                            </span>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->check() ? auth()->user()->name : 'Guest') }}&background=2563EB&color=fff"
                                alt="Profil" class="profile-img">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius: 10px;">
                            <li><a class="dropdown-item py-2" href="{{ route('profil.index') }}"><i
                                        class="bi bi-person me-2"></i> Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"><i
                                        class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid p-4" style="flex: 1;">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p class="mb-0">&copy; 2026 Sistem Administrasi Desa/Kelurahan | Laravel 13</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Scripts -->
    <script>
        // Hide loader after page loads
        window.addEventListener('load', function() {
            setTimeout(function() {
                const loader = document.getElementById('loader');
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }, 300);
        });

        // Toast Notification Function
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#2563EB',
                confirmButtonText: 'Tutup'
            });
        @endif
    </script>

    @yield('scripts')
</body>

</html>
