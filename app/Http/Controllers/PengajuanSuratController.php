<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\Penduduk;
use Carbon\Carbon;

class PengajuanSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanSurat::with('penduduk');

        // Search by Nomor Surat or Nama Penduduk
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhereHas('penduduk', function ($q) use ($search) {
                      $q->where('nama_lengkap', 'like', "%{$search}%");
                  });
        }

        // Filter by Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by Jenis Surat
        if ($request->has('jenis_surat') && $request->jenis_surat != '') {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        $pengajuanSurats = $query->latest()->paginate(10)->withQueryString();

        return view('pengajuan-surat.index', compact('pengajuanSurats'));
    }

    public function wargaIndex()
    {
        $pengajuanSurats = PengajuanSurat::latest()->paginate(10);
        return view('pengajuan-surat.warga-index', compact('pengajuanSurats'));
    }

    public function create()
    {
        $penduduks = Penduduk::orderBy('nama_lengkap', 'asc')->get();
        
        // Generate nomor surat: SURAT/YYYYMMDD/XXXX
        $today = Carbon::now()->format('Ymd');
        $count = PengajuanSurat::whereDate('created_at', Carbon::today())->count() + 1;
        $nomorSurat = 'SURAT/' . $today . '/' . str_pad($count, 4, '0', STR_PAD_LEFT);

        return view('pengajuan-surat.create', compact('penduduks', 'nomorSurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|unique:pengajuan_surats,nomor_surat',
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_surat' => 'required|string',
            'keperluan' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:Menunggu,Diproses,Disetujui,Ditolak',
            'keterangan' => 'nullable|string',
        ], [
            'nomor_surat.required' => 'Nomor Surat wajib diisi.',
            'nomor_surat.unique' => 'Nomor Surat sudah digunakan.',
            'penduduk_id.required' => 'Penduduk wajib dipilih.',
            'jenis_surat.required' => 'Jenis Surat wajib dipilih.',
            'keperluan.required' => 'Keperluan wajib diisi.',
            'tanggal_pengajuan.required' => 'Tanggal Pengajuan wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        PengajuanSurat::create($request->all());

        if (auth()->check() && auth()->user()->role == 'Warga') {
            return redirect()->route('pengajuan-surat.warga')->with('success', 'Pengajuan Surat berhasil ditambahkan.');
        }

        return redirect()->route('pengajuan-surat.index')->with('success', 'Pengajuan Surat berhasil ditambahkan.');
    }

    public function show(PengajuanSurat $pengajuanSurat)
    {
        $pengajuanSurat->load('penduduk');
        return view('pengajuan-surat.show', compact('pengajuanSurat'));
    }

    public function edit(PengajuanSurat $pengajuanSurat)
    {
        $penduduks = Penduduk::orderBy('nama_lengkap', 'asc')->get();
        return view('pengajuan-surat.edit', compact('pengajuanSurat', 'penduduks'));
    }

    public function update(Request $request, PengajuanSurat $pengajuanSurat)
    {
        $request->validate([
            'nomor_surat' => 'required|string|unique:pengajuan_surats,nomor_surat,' . $pengajuanSurat->id,
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_surat' => 'required|string',
            'keperluan' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:Menunggu,Diproses,Disetujui,Ditolak',
            'keterangan' => 'nullable|string',
        ], [
            'nomor_surat.required' => 'Nomor Surat wajib diisi.',
            'nomor_surat.unique' => 'Nomor Surat sudah digunakan.',
            'penduduk_id.required' => 'Penduduk wajib dipilih.',
            'jenis_surat.required' => 'Jenis Surat wajib dipilih.',
            'keperluan.required' => 'Keperluan wajib diisi.',
            'tanggal_pengajuan.required' => 'Tanggal Pengajuan wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $pengajuanSurat->update($request->all());

        return redirect()->route('pengajuan-surat.index')->with('success', 'Pengajuan Surat berhasil diperbarui.');
    }

    public function destroy(PengajuanSurat $pengajuanSurat)
    {
        $pengajuanSurat->delete();

        return redirect()->route('pengajuan-surat.index')->with('success', 'Pengajuan Surat berhasil dihapus.');
    }
}
