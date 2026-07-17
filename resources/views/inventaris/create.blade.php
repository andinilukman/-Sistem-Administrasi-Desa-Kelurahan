@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Tambah Aset Desa</h3>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
    <div class="card-body p-4">
        <form action="{{ route('inventaris-aset.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kode Aset</label>
                    <input type="text" name="kode_aset" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Aset</label>
                    <input type="text" name="nama_aset" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Kendaraan">Kendaraan</option>
                        <option value="Bangunan">Bangunan</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required min="1">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kondisi</label>
                    <select name="kondisi" class="form-select" required>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Keterangan (Opsional)</label>
                    <textarea name="keterangan" rows="3" class="form-control"></textarea>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('inventaris-aset.index') }}" class="btn btn-light px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
