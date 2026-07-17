@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--sidebar-blue);">Ubah Data Penduduk</h3>
        <p class="text-muted mb-0">Perbarui informasi detail penduduk.</p>
    </div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('penduduk.index') }}" class="text-decoration-none">Penduduk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-9">
        <div class="card border-0 shadow-sm" style="border-radius: var(--radius);">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold" style="color: var(--sidebar-blue);"><i class="bi bi-pencil-square text-warning me-2"></i>Form Ubah Penduduk</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Data Kartu Keluarga</h6>
                    <div class="mb-4">
                        <label for="kartu_keluarga_id" class="form-label fw-medium">Pilih Nomor KK <span class="text-danger">*</span></label>
                        <select class="form-select @error('kartu_keluarga_id') is-invalid @enderror" id="kartu_keluarga_id" name="kartu_keluarga_id" required>
                            <option value="">-- Pilih Nomor Kartu Keluarga --</option>
                            @foreach($kartuKeluargas as $kk)
                                <option value="{{ $kk->id }}" {{ old('kartu_keluarga_id', $penduduk->kartu_keluarga_id) == $kk->id ? 'selected' : '' }}>
                                    {{ $kk->nomor_kk }} - (Kepala Keluarga: {{ $kk->kepala_keluarga }})
                                </option>
                            @endforeach
                        </select>
                        @error('kartu_keluarga_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Informasi Individu</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nik" class="form-label fw-medium">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $penduduk->nik) }}" placeholder="16 Digit NIK" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $penduduk->nama_lengkap) }}" placeholder="Nama Sesuai KTP" required>
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label fw-medium">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label fw-medium">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label fw-medium">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="agama" class="form-label fw-medium">Agama <span class="text-danger">*</span></label>
                            <select class="form-select @error('agama') is-invalid @enderror" id="agama" name="agama" required>
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam" {{ old('agama', $penduduk->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $penduduk->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama', $penduduk->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $penduduk->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama', $penduduk->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama', $penduduk->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="pendidikan" class="form-label fw-medium">Pendidikan <span class="text-danger">*</span></label>
                            <select class="form-select @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan" required>
                                <option value="">-- Pilih Pendidikan --</option>
                                <option value="Tidak/Belum Sekolah" {{ old('pendidikan', $penduduk->pendidikan) == 'Tidak/Belum Sekolah' ? 'selected' : '' }}>Tidak/Belum Sekolah</option>
                                <option value="SD/Sederajat" {{ old('pendidikan', $penduduk->pendidikan) == 'SD/Sederajat' ? 'selected' : '' }}>SD/Sederajat</option>
                                <option value="SMP/Sederajat" {{ old('pendidikan', $penduduk->pendidikan) == 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                                <option value="SMA/Sederajat" {{ old('pendidikan', $penduduk->pendidikan) == 'SMA/Sederajat' ? 'selected' : '' }}>SMA/Sederajat</option>
                                <option value="Diploma I/II" {{ old('pendidikan', $penduduk->pendidikan) == 'Diploma I/II' ? 'selected' : '' }}>Diploma I/II</option>
                                <option value="Akademi/Diploma III" {{ old('pendidikan', $penduduk->pendidikan) == 'Akademi/Diploma III' ? 'selected' : '' }}>Akademi/Diploma III</option>
                                <option value="Diploma IV/Strata I" {{ old('pendidikan', $penduduk->pendidikan) == 'Diploma IV/Strata I' ? 'selected' : '' }}>Diploma IV/Strata I</option>
                                <option value="Strata II" {{ old('pendidikan', $penduduk->pendidikan) == 'Strata II' ? 'selected' : '' }}>Strata II</option>
                                <option value="Strata III" {{ old('pendidikan', $penduduk->pendidikan) == 'Strata III' ? 'selected' : '' }}>Strata III</option>
                            </select>
                            @error('pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="pekerjaan" class="form-label fw-medium">Pekerjaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}" placeholder="Contoh: Wiraswasta" required>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="status_perkawinan" class="form-label fw-medium">Status Perkawinan <span class="text-danger">*</span></label>
                            <select class="form-select @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan" name="status_perkawinan" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Belum Kawin" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                            @error('status_perkawinan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <h6 class="text-muted fw-bold mt-4 mb-3 border-bottom pb-2">Kontak & Status</h6>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="nomor_telepon" class="form-label fw-medium">Nomor Telepon</label>
                            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $penduduk->nomor_telepon) }}" placeholder="Opsional">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $penduduk->email) }}" placeholder="Opsional">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="status_penduduk" class="form-label fw-medium">Status Penduduk <span class="text-danger">*</span></label>
                            <select class="form-select @error('status_penduduk') is-invalid @enderror" id="status_penduduk" name="status_penduduk" required>
                                <option value="Aktif" {{ old('status_penduduk', $penduduk->status_penduduk) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Pindah" {{ old('status_penduduk', $penduduk->status_penduduk) == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                                <option value="Meninggal" {{ old('status_penduduk', $penduduk->status_penduduk) == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                            </select>
                            @error('status_penduduk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('penduduk.index') }}" class="btn btn-light" style="border-radius: 8px;">Batal</a>
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
