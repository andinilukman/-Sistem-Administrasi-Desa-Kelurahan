@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Ubah Pengajuan Surat</h3>
        <p class="text-muted mb-0">Perbarui data administrasi pengajuan surat masyarakat.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pengajuan-surat.index') }}" class="text-decoration-none">Pengajuan Surat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-9">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-pencil-square text-warning me-2"></i>Form Ubah Pengajuan Surat</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('pengajuan-surat.update', $pengajuanSurat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Informasi Surat</h6>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_surat" class="form-label fw-medium">Nomor Surat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $pengajuanSurat->nomor_surat) }}" required>
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tanggal_pengajuan" class="form-label fw-medium">Tanggal Pengajuan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" id="tanggal_pengajuan" name="tanggal_pengajuan" value="{{ old('tanggal_pengajuan', $pengajuanSurat->tanggal_pengajuan) }}" required>
                            @error('tanggal_pengajuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="penduduk_id" class="form-label fw-medium">Pilih Penduduk <span class="text-danger">*</span></label>
                            <select class="form-select @error('penduduk_id') is-invalid @enderror" id="penduduk_id" name="penduduk_id" required>
                                <option value="">-- Cari Penduduk --</option>
                                @foreach($penduduks as $penduduk)
                                    <option value="{{ $penduduk->id }}" {{ old('penduduk_id', $pengajuanSurat->penduduk_id) == $penduduk->id ? 'selected' : '' }}>
                                        {{ $penduduk->nik }} - {{ $penduduk->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penduduk_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="jenis_surat" class="form-label fw-medium">Jenis Surat <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_surat') is-invalid @enderror" id="jenis_surat" name="jenis_surat" required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                <option value="Surat Domisili" {{ old('jenis_surat', $pengajuanSurat->jenis_surat) == 'Surat Domisili' ? 'selected' : '' }}>Surat Domisili</option>
                                <option value="Surat Keterangan Usaha" {{ old('jenis_surat', $pengajuanSurat->jenis_surat) == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                                <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat', $pengajuanSurat->jenis_surat) == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
                                <option value="Surat Pengantar" {{ old('jenis_surat', $pengajuanSurat->jenis_surat) == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                                <option value="Surat Kelahiran" {{ old('jenis_surat', $pengajuanSurat->jenis_surat) == 'Surat Kelahiran' ? 'selected' : '' }}>Surat Kelahiran</option>
                                <option value="Surat Kematian" {{ old('jenis_surat', $pengajuanSurat->jenis_surat) == 'Surat Kematian' ? 'selected' : '' }}>Surat Kematian</option>
                            </select>
                            @error('jenis_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="keperluan" class="form-label fw-medium">Keperluan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" rows="3" required>{{ old('keperluan', $pengajuanSurat->keperluan) }}</textarea>
                        @error('keperluan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Status & Keterangan</h6>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="Menunggu" {{ old('status', $pengajuanSurat->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Diproses" {{ old('status', $pengajuanSurat->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Disetujui" {{ old('status', $pengajuanSurat->status) == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Ditolak" {{ old('status', $pengajuanSurat->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label fw-medium">Keterangan Tambahan <span class="text-muted">(Opsional)</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="2">{{ old('keterangan', $pengajuanSurat->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('pengajuan-surat.index') }}" class="btn btn-light" style="border-radius: 8px;">Batal</a>
                        <button type="submit" class="btn btn-warning text-white" style="border-radius: 8px;">
                            <i class="bi bi-pencil me-1"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
