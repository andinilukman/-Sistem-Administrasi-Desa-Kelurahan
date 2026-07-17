@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Laporan Penduduk</h3>
        <p class="text-muted mb-0">Laporan data kependudukan desa.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Penduduk</li>
        </ol>
    </nav>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <form action="{{ route('laporan-penduduk.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 bg-light" placeholder="Cari NIK / Nama..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <select name="jenis_kelamin" class="form-select bg-light">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1" type="submit">Filter</button>
                    @if(request()->hasAny(['search', 'jenis_kelamin']))
                        <a href="{{ route('laporan-penduduk.index') }}" class="btn btn-light" title="Reset Filter"><i class="bi bi-arrow-clockwise"></i></a>
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
                        <th scope="col">NIK</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Nomor KK</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Tempat, Tgl Lahir</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduks as $index => $penduduk)
                    <tr>
                        <td class="text-center">{{ $penduduks->firstItem() + $index }}</td>
                        <td class="fw-medium">{{ $penduduk->nik }}</td>
                        <td>{{ $penduduk->nama_lengkap }}</td>
                        <td>{{ $penduduk->kartuKeluarga->nomor_kk ?? '-' }}</td>
                        <td>{{ $penduduk->jenis_kelamin }}</td>
                        <td>{{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->translatedFormat('d M Y') }}</td>
                        <td>
                            @if($penduduk->status_penduduk == 'Tetap')
                                <span class="badge bg-primary px-2 py-1 rounded-pill">Tetap</span>
                            @else
                                <span class="badge bg-info px-2 py-1 rounded-pill">Sementara</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                            Tidak ada data penduduk yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $penduduks->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
