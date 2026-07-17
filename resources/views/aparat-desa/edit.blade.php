@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Ubah Aparat Desa</h3>
        <p class="text-muted mb-0">Perbarui informasi detail aparat desa.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('aparat-desa.index') }}" class="text-decoration-none">Aparat Desa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-9">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-pencil-square text-warning me-2"></i>Form Ubah Aparat Desa</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('aparat-desa.update', $aparatDesa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Informasi Utama</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nip" class="form-label fw-medium">NIP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip', $aparatDesa->nip) }}" required>
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $aparatDesa->nama_lengkap) }}" required>
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label fw-medium">Jabatan <span class="text-danger">*</span></label>
                            <select class="form-select @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="Kepala Desa" {{ old('jabatan', $aparatDesa->jabatan) == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                                <option value="Sekretaris Desa" {{ old('jabatan', $aparatDesa->jabatan) == 'Sekretaris Desa' ? 'selected' : '' }}>Sekretaris Desa</option>
                                <option value="Kaur Pemerintahan" {{ old('jabatan', $aparatDesa->jabatan) == 'Kaur Pemerintahan' ? 'selected' : '' }}>Kaur Pemerintahan</option>
                                <option value="Kaur Keuangan" {{ old('jabatan', $aparatDesa->jabatan) == 'Kaur Keuangan' ? 'selected' : '' }}>Kaur Keuangan</option>
                                <option value="Kaur Umum" {{ old('jabatan', $aparatDesa->jabatan) == 'Kaur Umum' ? 'selected' : '' }}>Kaur Umum</option>
                                <option value="Kasi Pelayanan" {{ old('jabatan', $aparatDesa->jabatan) == 'Kasi Pelayanan' ? 'selected' : '' }}>Kasi Pelayanan</option>
                                <option value="Kepala Dusun" {{ old('jabatan', $aparatDesa->jabatan) == 'Kepala Dusun' ? 'selected' : '' }}>Kepala Dusun</option>
                            </select>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label fw-medium">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $aparatDesa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $aparatDesa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label fw-medium">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $aparatDesa->tempat_lahir) }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label fw-medium">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $aparatDesa->tanggal_lahir) }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <h6 class="text-muted fw-bold mt-4 mb-3 border-bottom pb-2">Kontak & Alamat</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_telepon" class="form-label fw-medium">Nomor Telepon</label>
                            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $aparatDesa->nomor_telepon) }}">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $aparatDesa->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-medium">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $aparatDesa->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h6 class="text-muted fw-bold mt-4 mb-3 border-bottom pb-2">Foto & Status</h6>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="foto" class="form-label fw-medium">Upload Foto Baru (Opsional)</label>
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto" accept="image/*" onchange="previewImage()">
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maks: 2MB. Biarkan kosong jika tidak ingin mengubah foto.</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                @if($aparatDesa->foto)
                                    <img id="img-preview" src="{{ asset('storage/' . $aparatDesa->foto) }}" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                                @else
                                    <img id="img-preview" src="#" alt="Preview" class="d-none img-thumbnail" style="max-height: 150px;">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="status_aktif" class="form-label fw-medium">Status Aktif <span class="text-danger">*</span></label>
                            <select class="form-select @error('status_aktif') is-invalid @enderror" id="status_aktif" name="status_aktif" required>
                                <option value="Aktif" {{ old('status_aktif', $aparatDesa->status_aktif) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ old('status_aktif', $aparatDesa->status_aktif) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status_aktif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('aparat-desa.index') }}" class="btn btn-light" style="border-radius: 8px;">Batal</a>
                        <button type="submit" class="btn btn-warning text-white" style="border-radius: 8px;">
                            <i class="bi bi-pencil me-1"></i> Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage() {
        const image = document.querySelector('#foto');
        const imgPreview = document.querySelector('#img-preview');

        if(image.files && image.files[0]) {
            imgPreview.classList.remove('d-none');
            
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    }
</script>
@endsection
