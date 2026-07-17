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
        $role = auth()->user()->role;
        if ($role == 'Admin') {
            return $this->dashboardAdmin();
        } elseif ($role == 'Kepala Desa') {
            return $this->dashboardKades();
        } elseif ($role == 'Warga') {
            return $this->dashboardWarga();
        }
        return abort(403);
    }

    private function dashboardAdmin()
    {
        $jumlahKk = KartuKeluarga::count();
        $jumlahPenduduk = Penduduk::count();
        $jumlahAparat = AparatDesa::count();
        $totalSurat = PengajuanSurat::count();
        $jumlahPengumuman = \App\Models\Pengumuman::count();
        $jumlahAset = \App\Models\InventarisAset::count();
        
        $jumlahLakiLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();
        
        return view('dashboard.admin', compact(
            'jumlahKk', 'jumlahPenduduk', 'jumlahAparat', 'totalSurat',
            'jumlahPengumuman', 'jumlahAset', 'jumlahLakiLaki', 'jumlahPerempuan'
        ));
    }

    private function dashboardKades()
    {
        $suratMenunggu = PengajuanSurat::where('status', 'Menunggu')->count();
        $suratDisetujui = PengajuanSurat::where('status', 'Disetujui')->count();
        
        $suratDiproses = PengajuanSurat::where('status', 'Diproses')->count();
        $suratDitolak = PengajuanSurat::where('status', 'Ditolak')->count();
        
        $jumlahLakiLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();

        return view('dashboard.kades', compact(
            'suratMenunggu', 'suratDisetujui', 'suratDiproses', 'suratDitolak',
            'jumlahLakiLaki', 'jumlahPerempuan'
        ));
    }

    private function dashboardWarga()
    {
        $wargaId = auth()->user()->id; // Assume Warga's user_id is related
        
        // As a simple placeholder, warga checks their submissions by their Penduduk ID. 
        // We will assume 'Warga' views their latest submissions using relations later.
        // But for now let's just get any 5 latest. Realistically, we need to link user_id to penduduk_id.
        $suratTerbaru = PengajuanSurat::latest()->take(5)->get();
        $pengumumanTerbaru = \App\Models\Pengumuman::latest()->take(5)->get();
        
        return view('dashboard.warga', compact('suratTerbaru', 'pengumumanTerbaru'));
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
