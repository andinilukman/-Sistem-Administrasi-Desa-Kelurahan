@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Pengumuman Desa</h3>
        <p class="text-muted mb-0">Informasi dan berita terbaru dari desa.</p>
    </div>
    
    @if(auth()->user()->role == 'Admin')
    <a href="{{ route('pengumuman.create') }}" class="btn btn-primary" style="border-radius: 8px;">
        <i class="bi bi-plus-lg me-1"></i> Tambah Pengumuman
    </a>
    @endif
</div>

<div class="row g-4">
    @forelse($pengumumans as $pengumuman)
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: var(--radius);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-primary rounded-pill px-3">{{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d M Y') }}</span>
                    @if(auth()->user()->role == 'Admin')
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light rounded-circle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="{{ route('pengumuman.edit', $pengumuman->id) }}"><i class="bi bi-pencil me-2 text-warning"></i>Ubah</a></li>
                            <li>
                                <form action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="dropdown-item text-danger" type="submit" onclick="return confirm('Yakin hapus pengumuman ini?')"><i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
                <h5 class="fw-bold mt-3 mb-2 text-dark">{{ $pengumuman->judul }}</h5>
                <p class="text-muted small mb-0">{{ Str::limit($pengumuman->isi, 120) }}</p>
                <div class="mt-3">
                    <a href="{{ route('pengumuman.show', $pengumuman->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-body p-5 text-center text-muted">
                <i class="bi bi-megaphone fs-1 d-block mb-3"></i>
                <h5>Belum Ada Pengumuman</h5>
                <p class="mb-0">Saat ini tidak ada informasi atau berita terbaru.</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $pengumumans->links('pagination::bootstrap-5') }}
</div>
@endsection
