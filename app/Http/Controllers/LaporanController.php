<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\KartuKeluarga;
use App\Models\PengajuanSurat;

class LaporanController extends Controller
{
    public function penduduk(Request $request)
    {
        $query = Penduduk::with('kartuKeluarga');

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        $penduduks = $query->orderBy('nama_lengkap', 'asc')->paginate(10)->withQueryString();

        return view('laporan.penduduk', compact('penduduks'));
    }

    public function kartuKeluarga(Request $request)
    {
        $query = KartuKeluarga::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('kepala_keluarga', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_kk', 'like', '%' . $request->search . '%');
        }

        if ($request->has('rt') && $request->rt != '') {
            $query->where('rt', $request->rt);
        }

        $kartuKeluargas = $query->orderBy('kepala_keluarga', 'asc')->paginate(10)->withQueryString();

        return view('laporan.kartu-keluarga', compact('kartuKeluargas'));
    }

    public function pengajuanSurat(Request $request)
    {
        $query = PengajuanSurat::with('penduduk');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhereHas('penduduk', function ($q) use ($search) {
                      $q->where('nama_lengkap', 'like', "%{$search}%");
                  });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('jenis_surat') && $request->jenis_surat != '') {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        $pengajuanSurats = $query->latest()->paginate(10)->withQueryString();

        return view('laporan.pengajuan-surat', compact('pengajuanSurats'));
    }
}
