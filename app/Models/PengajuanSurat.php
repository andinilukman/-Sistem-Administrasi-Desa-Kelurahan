<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'penduduk_id',
        'jenis_surat',
        'keperluan',
        'tanggal_pengajuan',
        'status',
        'keterangan',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}
