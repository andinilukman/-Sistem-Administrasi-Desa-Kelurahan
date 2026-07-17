<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AparatDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'jabatan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nomor_telepon',
        'email',
        'alamat',
        'foto',
        'status_aktif',
    ];
}
