<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Administrasi Desa/Kelurahan - Masuk</title>
    
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
            height: 100vh;
            overflow: hidden;
        }
        
        .auth-container {
            height: 100vh;
            display: flex;
        }
        
        .auth-left {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--white);
            padding: 40px;
        }
        
        .auth-right {
            flex: 1;
            background: linear-gradient(135deg, var(--sidebar-blue) 0%, var(--primary-blue) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            flex-direction: column;
            text-align: center;
            padding: 40px;
        }
        
        .auth-right i {
            font-size: 8rem;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .auth-right h2 {
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .auth-right p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 400px;
        }
        
        .login-card {
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h3 {
            font-weight: 700;
            color: var(--sidebar-blue);
        }
        
        .login-header p {
            color: #6c757d;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.25);
            border-color: var(--primary-blue);
        }
        
        .btn-primary {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--sidebar-blue);
            border-color: var(--sidebar-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }
        
        @media (max-width: 768px) {
            .auth-right {
                display: none;
            }
        }
    </style>
</head>
<body>

    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom Scripts -->
    <script>
        // SweetAlert untuk notifikasi error
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Masuk Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#2563EB',
                confirmButtonText: 'Coba Lagi'
            });
        @endif
    </script>
</body>
</html>
