@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Laporan Kartu Keluarga</h3>
        <p class="text-muted mb-0">Laporan data kartu keluarga desa.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan KK</li>
        </ol>
    </nav>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <form action="{{ route('laporan-kartu-keluarga.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 bg-light" placeholder="Cari No KK / Kepala Keluarga..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <select name="rt" class="form-select bg-light">
                        <option value="">Semua RT</option>
                        <option value="01" {{ request('rt') == '01' ? 'selected' : '' }}>RT 01</option>
                        <option value="02" {{ request('rt') == '02' ? 'selected' : '' }}>RT 02</option>
                        <option value="03" {{ request('rt') == '03' ? 'selected' : '' }}>RT 03</option>
                        <option value="04" {{ request('rt') == '04' ? 'selected' : '' }}>RT 04</option>
                        <option value="05" {{ request('rt') == '05' ? 'selected' : '' }}>RT 05</option>
                    </select>
                </div>
                
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1" type="submit">Filter</button>
                    @if(request()->hasAny(['search', 'rt']))
                        <a href="{{ route('laporan-kartu-keluarga.index') }}" class="btn btn-light" title="Reset Filter"><i class="bi bi-arrow-clockwise"></i></a>
                    @endif
                </div>
            </div>
        </form>
        

    </div>
    
    <div class="card-body p-4 mt-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nomor KK</th>
                        <th scope="col">Kepala Keluarga</th>
                        <th scope="col">Alamat Lengkap</th>
                        <th scope="col">RT/RW</th>
                        <th scope="col">Kode Pos</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kartuKeluargas as $index => $kk)
                    <tr>
                        <td class="text-center">{{ $kartuKeluargas->firstItem() + $index }}</td>
                        <td class="fw-medium">{{ $kk->nomor_kk }}</td>
                        <td>{{ $kk->kepala_keluarga }}</td>
                        <td>{{ $kk->alamat }}, {{ $kk->desa_kelurahan }}, Kec. {{ $kk->kecamatan }}</td>
                        <td>{{ $kk->rt }} / {{ $kk->rw }}</td>
                        <td>{{ $kk->kode_pos }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-card-heading fs-2 d-block mb-2"></i>
                            Tidak ada data Kartu Keluarga yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $kartuKeluargas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
