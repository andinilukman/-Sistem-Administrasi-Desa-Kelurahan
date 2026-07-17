@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Inventaris Aset Desa</h3>
        <p class="text-muted mb-0">Kelola data inventaris dan aset yang dimiliki desa.</p>
    </div>
    
    <a href="{{ route('inventaris-aset.create') }}" class="btn btn-primary" style="border-radius: 8px;">
        <i class="bi bi-plus-lg me-1"></i> Tambah Aset
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Kode Aset</th>
                        <th scope="col">Nama Aset</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col" class="text-center">Jumlah</th>
                        <th scope="col" class="text-center">Kondisi</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($asets as $index => $aset)
                    <tr>
                        <td class="text-center">{{ $asets->firstItem() + $index }}</td>
                        <td class="fw-medium">{{ $aset->kode_aset }}</td>
                        <td>{{ $aset->nama_aset }}</td>
                        <td>{{ $aset->kategori }}</td>
                        <td>{{ $aset->lokasi }}</td>
                        <td class="text-center">{{ $aset->jumlah }}</td>
                        <td class="text-center">
                            @if($aset->kondisi == 'Baik')
                                <span class="badge bg-success rounded-pill px-2">Baik</span>
                            @elseif($aset->kondisi == 'Rusak Ringan')
                                <span class="badge bg-warning text-dark rounded-pill px-2">Rusak Ringan</span>
                            @else
                                <span class="badge bg-danger rounded-pill px-2">Rusak Berat</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('inventaris-aset.edit', $aset->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('inventaris-aset.destroy', $aset->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus aset ini?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Belum ada data aset.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $asets->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
