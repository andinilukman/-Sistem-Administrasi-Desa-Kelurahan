<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisAset extends Model
{
    use HasFactory;

    protected $table = 'inventaris_asets';

    protected $fillable = [
        'kode_aset',
        'nama_aset',
        'kategori',
        'lokasi',
        'jumlah',
        'kondisi',
        'keterangan',
    ];
}
