@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Kelola Pengguna</h3>
        <p class="text-muted mb-0">Manajemen akun pengguna sistem.</p>
    </div>
    
    <a href="{{ route('kelola-pengguna.create') }}" class="btn btn-primary" style="border-radius: 8px;">
        <i class="bi bi-person-plus-fill me-1"></i> Tambah Pengguna
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-center">Role</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $users->firstItem() + $index }}</td>
                        <td class="fw-medium">{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            @if($user->role == 'Admin')
                                <span class="badge bg-danger rounded-pill px-2">Admin</span>
                            @elseif($user->role == 'Kepala Desa')
                                <span class="badge bg-primary rounded-pill px-2">Kepala Desa</span>
                            @else
                                <span class="badge bg-secondary rounded-pill px-2">Warga</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('kelola-pengguna.edit', $user->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            
                            @if(auth()->id() != $user->id)
                            <form action="{{ route('kelola-pengguna.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus pengguna ini?')"><i class="bi bi-trash"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
