<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKk = KartuKeluarga::count();
        $jumlahPenduduk = Penduduk::count();
        return view('dashboard', compact('jumlahKk', 'jumlahPenduduk'));
    }

    public function placeholder($title)
    {
        $formattedTitle = ucwords(str_replace('-', ' ', $title));
        
        // Custom titles for specific routes if needed
        $titles = [
            'kartu-keluarga' => 'Data Kartu Keluarga',
            'penduduk' => 'Data Penduduk',
            'aparat-desa' => 'Data Aparat Desa',
            'pengajuan-surat' => 'Pengajuan Surat',
            'verifikasi-surat' => 'Verifikasi Surat',
            'surat-disetujui' => 'Surat Disetujui',
            'surat-ditolak' => 'Surat Ditolak',
            'riwayat-surat' => 'Riwayat Surat',
            'laporan-penduduk' => 'Laporan Penduduk',
            'laporan-surat' => 'Laporan Surat',
            'statistik' => 'Statistik',
            'profil' => 'Profil Pengguna'
        ];
        
        $displayTitle = $titles[$title] ?? $formattedTitle;
        
        return view('placeholder', ['title' => $displayTitle]);
    }
}
