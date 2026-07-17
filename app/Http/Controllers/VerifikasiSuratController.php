<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;

class VerifikasiSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return view('verifikasi-surat.index', compact('pengajuanSurats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengajuanSurat = PengajuanSurat::with('penduduk')->findOrFail($id);
        return view('verifikasi-surat.show', compact('pengajuanSurat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengajuanSurat = PengajuanSurat::with('penduduk')->findOrFail($id);
        return view('verifikasi-surat.edit', compact('pengajuanSurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengajuanSurat = PengajuanSurat::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Disetujui,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $pengajuanSurat->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('verifikasi-surat.index')->with('success', 'Status pengajuan surat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }
}
