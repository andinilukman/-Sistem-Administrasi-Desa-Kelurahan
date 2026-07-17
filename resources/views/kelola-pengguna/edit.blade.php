@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Ubah Pengguna</h3>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-4">
        <form action="{{ route('kelola-pengguna.update', $user->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Role (Hak Akses)</label>
                    <select name="role" class="form-select" required>
                        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Kepala Desa" {{ $user->role == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                        <option value="Warga" {{ $user->role == 'Warga' ? 'selected' : '' }}>Warga</option>
                    </select>
                </div>
                
                <div class="col-12 mt-4">
                    <h6 class="fw-bold text-danger"><i class="bi bi-shield-lock me-2"></i>Ubah Password (Opsional)</h6>
                    <hr class="mt-1 mb-3">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Password Baru</label>
                    <input type="password" name="password" class="form-control" minlength="8" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" minlength="8">
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
                <a href="{{ route('kelola-pengguna.index') }}" class="btn btn-light px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
