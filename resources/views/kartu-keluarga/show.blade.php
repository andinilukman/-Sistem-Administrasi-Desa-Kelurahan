@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Detail Kartu Keluarga</h3>
        <p class="text-muted mb-0">Rincian informasi data Kartu Keluarga.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kartu-keluarga.index') }}" class="text-decoration-none">Kartu Keluarga</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-person-vcard text-info me-2"></i>Data Kartu Keluarga</h5>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2" style="border-radius: 8px; font-size: 0.9rem;">
                    NO. KK: {{ $kartuKeluarga->nomor_kk }}
                </span>
            </div>
            
            <div class="card-body p-4">
                <table class="table table-borderless table-striped">
                    <tbody>
                        <tr>
                            <th width="35%" class="text-muted fw-medium py-3">Nama Kepala Keluarga</th>
                            <td class="fw-bold py-3">{{ $kartuKeluarga->kepala_keluarga }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-medium py-3">Alamat</th>
                            <td class="py-3">{{ $kartuKeluarga->alamat }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-medium py-3">RT/RW</th>
                            <td class="py-3">{{ $kartuKeluarga->rt }} / {{ $kartuKeluarga->rw }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-medium py-3">Desa/Kelurahan</th>
                            <td class="py-3">{{ $kartuKeluarga->desa_kelurahan }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-medium py-3">Kecamatan</th>
                            <td class="py-3">{{ $kartuKeluarga->kecamatan }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-medium py-3">Kabupaten/Kota</th>
                            <td class="py-3">{{ $kartuKeluarga->kabupaten_kota }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-medium py-3">Provinsi</th>
                            <td class="py-3">{{ $kartuKeluarga->provinsi }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-medium py-3">Kode Pos</th>
                            <td class="py-3">{{ $kartuKeluarga->kode_pos }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-medium py-3">Tanggal Didaftarkan</th>
                            <td class="py-3">{{ $kartuKeluarga->created_at->format('d F Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <a href="{{ route('kartu-keluarga.index') }}" class="btn btn-light" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('kartu-keluarga.edit', $kartuKeluarga->id) }}" class="btn btn-warning text-white ms-auto" style="border-radius: 8px;">
                        <i class="bi bi-pencil me-1"></i> Ubah Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
