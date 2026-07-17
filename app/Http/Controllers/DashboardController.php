<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use App\Models\AparatDesa;
use App\Models\PengajuanSurat;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKk = KartuKeluarga::count();
        $jumlahPenduduk = Penduduk::count();
        $jumlahAparat = AparatDesa::count();
        
        $suratMenunggu = PengajuanSurat::where('status', 'Menunggu')->count();
        $suratDiproses = PengajuanSurat::where('status', 'Diproses')->count();
        $suratDisetujui = PengajuanSurat::where('status', 'Disetujui')->count();
        $suratDitolak = PengajuanSurat::where('status', 'Ditolak')->count();
        $totalSurat = PengajuanSurat::count();
        
        return view('dashboard', compact(
            'jumlahKk', 'jumlahPenduduk', 'jumlahAparat', 
            'suratMenunggu', 'suratDiproses', 'suratDisetujui', 'suratDitolak', 'totalSurat'
        ));
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
