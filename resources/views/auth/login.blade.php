@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-left">
        <div class="login-card">
            <div class="login-header">
                <h3>Sistem Administrasi Desa/Kelurahan</h3>
                <p>Silakan masuk untuk mengakses sistem.</p>
            </div>
            
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="username" class="form-label fw-medium">Nama Pengguna</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkan nama pengguna" value="{{ old('username') }}" required autofocus>
                    </div>
                    @error('username')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label fw-medium">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan kata sandi" required>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                </button>
            </form>
        </div>
    </div>
    
    <div class="auth-right">
        <i class="bi bi-bank"></i>
        <h2>Pelayanan Masyarakat Terpadu</h2>
        <p>Sistem informasi administrasi terintegrasi untuk meningkatkan kualitas pelayanan publik di tingkat Desa dan Kelurahan.</p>
    </div>
</div>
@endsection
