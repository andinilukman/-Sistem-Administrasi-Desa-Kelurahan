@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Data Aparat Desa</h3>
        <p class="text-muted mb-0">Kelola data seluruh aparat dan perangkat desa.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Aparat Desa</li>
        </ol>
    </nav>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
        <form action="{{ route('aparat-desa.index') }}" method="GET" class="d-flex w-50">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control border-start-0 bg-light" placeholder="Cari NIP atau Nama Lengkap..." value="{{ request('search') }}">
                <button class="btn btn-primary px-4" type="submit">Cari</button>
            </div>
        </form>
        
        <a href="{{ route('aparat-desa.create') }}" class="btn btn-primary" style="border-radius: 8px;">
            <i class="bi bi-plus-circle me-1"></i> Tambah Data
        </a>
    </div>
    
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="rounded-start">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Nomor Telepon</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center rounded-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aparatDesas as $index => $aparat)
                    <tr>
                        <td>{{ $aparatDesas->firstItem() + $index }}</td>
                        <td>
                            @if($aparat->foto)
                                <img src="{{ asset('storage/' . $aparat->foto) }}" alt="Foto {{ $aparat->nama_lengkap }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-medium">{{ $aparat->nip }}</td>
                        <td>{{ $aparat->nama_lengkap }}</td>
                        <td>{{ $aparat->jabatan }}</td>
                        <td>{{ $aparat->nomor_telepon ?? '-' }}</td>
                        <td>
                            @if($aparat->status_aktif == 'Aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('aparat-desa.show', $aparat->id) }}" class="btn btn-sm btn-info text-white" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('aparat-desa.edit', $aparat->id) }}" class="btn btn-sm btn-warning text-white" title="Ubah">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $aparat->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                                
                                <form id="delete-form-{{ $aparat->id }}" action="{{ route('aparat-desa.destroy', $aparat->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                            Belum ada data Aparat Desa yang tersimpan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $aparatDesas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data Aparat Desa ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
