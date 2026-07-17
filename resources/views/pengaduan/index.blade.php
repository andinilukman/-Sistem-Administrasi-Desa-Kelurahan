@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Pengaduan Warga</h3>
        <p class="text-muted mb-0">Layanan pengaduan dan aspirasi masyarakat desa.</p>
    </div>
    
    @if(auth()->user()->role == 'Warga')
    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary" style="border-radius: 8px;">
        <i class="bi bi-plus-lg me-1"></i> Buat Pengaduan
    </a>
    @endif
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Judul Pengaduan</th>
                        @if(auth()->user()->role != 'Warga')
                        <th scope="col">Pelapor</th>
                        @endif
                        <th scope="col">Tanggal</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduans as $index => $pengaduan)
                    <tr>
                        <td class="text-center">{{ $pengaduans->firstItem() + $index }}</td>
                        <td class="fw-medium">{{ $pengaduan->judul }}</td>
                        @if(auth()->user()->role != 'Warga')
                        <td>{{ $pengaduan->user->name ?? 'Tidak Diketahui' }}</td>
                        @endif
                        <td>{{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d M Y') }}</td>
                        <td class="text-center">
                            @if($pengaduan->status == 'Menunggu')
                                <span class="badge bg-warning text-dark rounded-pill px-2">Menunggu</span>
                            @elseif($pengaduan->status == 'Diproses')
                                <span class="badge bg-primary rounded-pill px-2">Diproses</span>
                            @else
                                <span class="badge bg-success rounded-pill px-2">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pengaduan.show', $pengaduan->id) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="bi bi-eye"></i></a>
                            
                            @if(auth()->user()->role == 'Admin')
                            <a href="{{ route('pengaduan.edit', $pengaduan->id) }}" class="btn btn-sm btn-outline-primary" title="Proses"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus pengaduan ini?')"><i class="bi bi-trash"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role == 'Warga' ? 5 : 6 }}" class="text-center py-4 text-muted">Belum ada pengaduan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $pengaduans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
