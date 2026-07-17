@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Tambah Data Kartu Keluarga</h3>
        <p class="text-muted mb-0">Masukkan informasi Kartu Keluarga baru.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kartu-keluarga.index') }}" class="text-decoration-none">Kartu Keluarga</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-file-earmark-plus text-primary me-2"></i>Form Kartu Keluarga</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('kartu-keluarga.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_kk" class="form-label fw-medium">Nomor KK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nomor_kk') is-invalid @enderror" id="nomor_kk" name="nomor_kk" value="{{ old('nomor_kk') }}" placeholder="16 Digit Nomor KK" required>
                            @error('nomor_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="kepala_keluarga" class="form-label fw-medium">Kepala Keluarga <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kepala_keluarga') is-invalid @enderror" id="kepala_keluarga" name="kepala_keluarga" value="{{ old('kepala_keluarga') }}" placeholder="Nama Kepala Keluarga" required>
                            @error('kepala_keluarga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-medium">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Alamat Lengkap" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rt" class="form-label fw-medium">RT <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" value="{{ old('rt') }}" placeholder="001" required>
                            @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="rw" class="form-label fw-medium">RW <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" value="{{ old('rw') }}" placeholder="002" required>
                            @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="desa_kelurahan" class="form-label fw-medium">Desa/Kelurahan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('desa_kelurahan') is-invalid @enderror" id="desa_kelurahan" name="desa_kelurahan" value="{{ old('desa_kelurahan') }}" required>
                            @error('desa_kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="kecamatan" class="form-label fw-medium">Kecamatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" required>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-5">
                            <label for="kabupaten_kota" class="form-label fw-medium">Kabupaten/Kota <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kabupaten_kota') is-invalid @enderror" id="kabupaten_kota" name="kabupaten_kota" value="{{ old('kabupaten_kota') }}" required>
                            @error('kabupaten_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="provinsi" class="form-label fw-medium">Provinsi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi" value="{{ old('provinsi') }}" required>
                            @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-3">
                            <label for="kode_pos" class="form-label fw-medium">Kode Pos <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" required>
                            @error('kode_pos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('kartu-keluarga.index') }}" class="btn btn-light" style="border-radius: 8px;">Batal</a>
                        <button type="submit" class="btn btn-primary" style="border-radius: 8px;">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
