@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Riwayat Pengajuan Surat</h3>
        <p class="text-muted mb-0">Lacak status surat yang telah Anda ajukan.</p>
    </div>
    
    <a href="{{ route('pengajuan-surat.create-warga') }}" class="btn btn-primary" style="border-radius: 8px;">
        <i class="bi bi-plus-lg me-1"></i> Ajukan Surat
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Jenis Surat</th>
                        <th scope="col">Tanggal Pengajuan</th>
                        <th scope="col">Keperluan</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuanSurats as $index => $surat)
                    <tr>
                        <td class="text-center">{{ $pengajuanSurats->firstItem() + $index }}</td>
                        <td class="fw-medium">{{ $surat->nomor_surat }}</td>
                        <td>{{ $surat->jenis_surat }}</td>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->translatedFormat('d M Y') }}</td>
                        <td>{{ Str::limit($surat->keperluan, 30) }}</td>
                        <td class="text-center">
                            @if($surat->status == 'Menunggu')
                                <span class="badge bg-warning text-dark rounded-pill px-2">Menunggu</span>
                            @elseif($surat->status == 'Diproses')
                                <span class="badge bg-primary rounded-pill px-2">Diproses</span>
                            @elseif($surat->status == 'Disetujui')
                                <span class="badge bg-success rounded-pill px-2">Disetujui</span>
                            @elseif($surat->status == 'Ditolak')
                                <span class="badge bg-danger rounded-pill px-2">Ditolak</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pengajuan-surat.show-warga', $surat->id) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat pengajuan surat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $pengajuanSurats->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
