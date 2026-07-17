@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Verifikasi Surat</h3>
        <p class="text-muted mb-0">Ubah status dan tambahkan catatan persetujuan surat.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('verifikasi-surat.index') }}" class="text-decoration-none">Verifikasi Surat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Proses Verifikasi</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-check2-square text-primary me-2"></i>Form Verifikasi Status</h5>
            </div>
            
            <div class="card-body p-4">
                <div class="alert alert-info border-0 shadow-sm mb-4" style="border-radius: 10px;">
                    <div class="d-flex">
                        <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Informasi Pengajuan</h6>
                            <p class="mb-0 small">
                                Anda sedang memverifikasi pengajuan <strong>{{ $pengajuanSurat->jenis_surat }}</strong> 
                                atas nama <strong>{{ $pengajuanSurat->penduduk->nama_lengkap ?? 'Tidak Diketahui' }}</strong> 
                                dengan nomor pengajuan <span class="fw-medium">{{ $pengajuanSurat->nomor_surat }}</span>.
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('verifikasi-surat.update', $pengajuanSurat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Ubah Status <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <input type="radio" class="btn-check" name="status" id="status_menunggu" value="Menunggu" {{ old('status', $pengajuanSurat->status) == 'Menunggu' ? 'checked' : '' }} required>
                                <label class="btn btn-outline-warning w-100 fw-medium p-3 text-dark" for="status_menunggu" style="border-radius: 10px;">
                                    <i class="bi bi-clock-history d-block fs-3 mb-1"></i>
                                    Menunggu
                                </label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" class="btn-check" name="status" id="status_diproses" value="Diproses" {{ old('status', $pengajuanSurat->status) == 'Diproses' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary w-100 fw-medium p-3" for="status_diproses" style="border-radius: 10px;">
                                    <i class="bi bi-arrow-repeat d-block fs-3 mb-1"></i>
                                    Diproses
                                </label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" class="btn-check" name="status" id="status_disetujui" value="Disetujui" {{ old('status', $pengajuanSurat->status) == 'Disetujui' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success w-100 fw-medium p-3" for="status_disetujui" style="border-radius: 10px;">
                                    <i class="bi bi-check-circle d-block fs-3 mb-1"></i>
                                    Disetujui
                                </label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" class="btn-check" name="status" id="status_ditolak" value="Ditolak" {{ old('status', $pengajuanSurat->status) == 'Ditolak' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger w-100 fw-medium p-3" for="status_ditolak" style="border-radius: 10px;">
                                    <i class="bi bi-x-circle d-block fs-3 mb-1"></i>
                                    Ditolak
                                </label>
                            </div>
                        </div>
                        @error('status')
                            <div class="text-danger mt-2 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label fw-bold text-dark">Catatan Admin <span class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="4" placeholder="Tuliskan catatan alasan persetujuan atau penolakan di sini...">{{ old('keterangan', $pengajuanSurat->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('verifikasi-surat.index') }}" class="btn btn-light px-4" style="border-radius: 8px;">Batal</a>
                        <button type="submit" class="btn btn-primary px-4" style="border-radius: 8px;">
                            <i class="bi bi-save me-1"></i> Simpan Hasil Verifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
