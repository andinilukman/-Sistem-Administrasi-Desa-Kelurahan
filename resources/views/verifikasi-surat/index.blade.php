@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Verifikasi Pengajuan Surat</h3>
        <p class="text-muted mb-0">Lakukan verifikasi dan persetujuan pengajuan surat warga.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Verifikasi Surat</li>
        </ol>
    </nav>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <form action="{{ route('verifikasi-surat.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 bg-light" placeholder="Cari No Surat / Nama..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <select name="status" class="form-select bg-light">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="jenis_surat" class="form-select bg-light">
                        <option value="">Semua Jenis Surat</option>
                        <option value="Surat Domisili" {{ request('jenis_surat') == 'Surat Domisili' ? 'selected' : '' }}>Surat Domisili</option>
                        <option value="Surat Keterangan Usaha" {{ request('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                        <option value="Surat Keterangan Tidak Mampu" {{ request('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
                        <option value="Surat Pengantar" {{ request('jenis_surat') == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                        <option value="Surat Kelahiran" {{ request('jenis_surat') == 'Surat Kelahiran' ? 'selected' : '' }}>Surat Kelahiran</option>
                        <option value="Surat Kematian" {{ request('jenis_surat') == 'Surat Kematian' ? 'selected' : '' }}>Surat Kematian</option>
                    </select>
                </div>
                
                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1" type="submit">Filter</button>
                    @if(request()->hasAny(['search', 'status', 'jenis_surat']))
                        <a href="{{ route('verifikasi-surat.index') }}" class="btn btn-light" title="Reset Filter"><i class="bi bi-arrow-clockwise"></i></a>
                    @endif
                </div>
            </div>
        </form>
    </div>
    
    <div class="card-body p-4 mt-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="rounded-start">No</th>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Nama Penduduk</th>
                        <th scope="col">Jenis Surat</th>
                        <th scope="col">Tanggal Pengajuan</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center rounded-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuanSurats as $index => $pengajuan)
                    <tr>
                        <td>{{ $pengajuanSurats->firstItem() + $index }}</td>
                        <td class="fw-medium">{{ $pengajuan->nomor_surat }}</td>
                        <td>
                            @if($pengajuan->penduduk)
                                {{ $pengajuan->penduduk->nama_lengkap }}
                            @else
                                <span class="text-muted text-decoration-line-through">Penduduk Dihapus</span>
                            @endif
                        </td>
                        <td>{{ $pengajuan->jenis_surat }}</td>
                        <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->translatedFormat('d F Y') }}</td>
                        <td>
                            @if($pengajuan->status == 'Menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($pengajuan->status == 'Diproses')
                                <span class="badge bg-primary">Diproses</span>
                            @elseif($pengajuan->status == 'Disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($pengajuan->status == 'Ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('verifikasi-surat.show', $pengajuan->id) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="{{ route('verifikasi-surat.edit', $pengajuan->id) }}" class="btn btn-sm btn-primary" title="Verifikasi">
                                    <i class="bi bi-check2-circle"></i> Verifikasi
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-envelope-x fs-2 d-block mb-2"></i>
                            Belum ada data Pengajuan Surat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $pengajuanSurats->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
