@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Detail Pengajuan Surat</h3>
        <p class="text-muted mb-0">Rincian informasi pengajuan surat dari masyarakat.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pengajuan-surat.index') }}" class="text-decoration-none">Pengajuan Surat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-4 mb-4">
        <div class="card border-0 shadow-sm text-center p-4" style="border-radius: var(--radius);">
            <div class="mb-4">
                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center text-primary mx-auto shadow-sm" style="width: 100px; height: 100px;">
                    <i class="bi bi-envelope-paper" style="font-size: 3.5rem;"></i>
                </div>
            </div>
            
            <h5 class="fw-bold text-dark mb-1">{{ $pengajuanSurat->nomor_surat }}</h5>
            <p class="text-muted mb-3">{{ $pengajuanSurat->jenis_surat }}</p>
            
            <div class="d-flex justify-content-center mb-2">
                @if($pengajuanSurat->status == 'Menunggu')
                    <span class="badge bg-warning text-dark px-3 py-2" style="border-radius: 8px;">
                        <i class="bi bi-clock-history me-1"></i> Menunggu
                    </span>
                @elseif($pengajuanSurat->status == 'Diproses')
                    <span class="badge bg-primary px-3 py-2" style="border-radius: 8px;">
                        <i class="bi bi-arrow-repeat me-1"></i> Diproses
                    </span>
                @elseif($pengajuanSurat->status == 'Disetujui')
                    <span class="badge bg-success px-3 py-2" style="border-radius: 8px;">
                        <i class="bi bi-check-circle me-1"></i> Disetujui
                    </span>
                @elseif($pengajuanSurat->status == 'Ditolak')
                    <span class="badge bg-danger px-3 py-2" style="border-radius: 8px;">
                        <i class="bi bi-x-circle me-1"></i> Ditolak
                    </span>
                @endif
            </div>
            
            <p class="small text-muted mt-3 mb-0">Diajukan pada: <br> <span class="fw-medium text-dark">{{ \Carbon\Carbon::parse($pengajuanSurat->tanggal_pengajuan)->translatedFormat('d F Y') }}</span></p>
        </div>
    </div>
    
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-file-earmark-text text-info me-2"></i>Informasi Detail Surat</h5>
            </div>
            
            <div class="card-body p-4">
                <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Pemohon (Penduduk)</h6>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <th width="40%" class="text-muted fw-medium py-1">NIK</th>
                                    <td class="fw-bold py-1">{{ $pengajuanSurat->penduduk->nik ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-1">Nama Lengkap</th>
                                    <td class="py-1">{{ $pengajuanSurat->penduduk->nama_lengkap ?? 'Data Dihapus' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <th width="40%" class="text-muted fw-medium py-1">Jenis Kelamin</th>
                                    <td class="py-1">{{ $pengajuanSurat->penduduk->jenis_kelamin ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-1">Nomor Telepon</th>
                                    <td class="py-1">{{ $pengajuanSurat->penduduk->nomor_telepon ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Konten Surat</h6>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th width="20%" class="text-muted fw-medium py-2">Keperluan</th>
                                    <td class="py-2 bg-light rounded px-3">{{ $pengajuanSurat->keperluan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2 align-middle">Keterangan Tambahan</th>
                                    <td class="py-2">
                                        @if($pengajuanSurat->keterangan)
                                            {{ $pengajuanSurat->keterangan }}
                                        @else
                                            <em class="text-muted">Tidak ada keterangan tambahan.</em>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-medium py-2">Terakhir Diperbarui</th>
                                    <td class="py-2">{{ $pengajuanSurat->updated_at->translatedFormat('l, d F Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <a href="{{ route('pengajuan-surat.index') }}" class="btn btn-light" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('pengajuan-surat.edit', $pengajuanSurat->id) }}" class="btn btn-warning text-white ms-auto" style="border-radius: 8px;">
                        <i class="bi bi-pencil me-1"></i> Ubah Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
