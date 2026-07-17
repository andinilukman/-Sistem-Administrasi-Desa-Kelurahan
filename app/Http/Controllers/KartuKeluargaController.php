<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KartuKeluarga;

class KartuKeluargaController extends Controller
{
    public function index(Request $request)
    {
        $query = KartuKeluarga::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nomor_kk', 'like', "%{$search}%")
                  ->orWhere('kepala_keluarga', 'like', "%{$search}%");
        }

        $kartuKeluargas = $query->latest()->paginate(10);

        return view('kartu-keluarga.index', compact('kartuKeluargas'));
    }

    public function create()
    {
        return view('kartu-keluarga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kk' => 'required|digits:16|unique:kartu_keluargas,nomor_kk',
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
        ], [
            'nomor_kk.required' => 'Nomor KK wajib diisi.',
            'nomor_kk.digits' => 'Nomor KK harus 16 angka.',
            'nomor_kk.unique' => 'Nomor KK sudah terdaftar.',
            'kepala_keluarga.required' => 'Kepala Keluarga wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'desa_kelurahan.required' => 'Desa/Kelurahan wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kabupaten_kota.required' => 'Kabupaten/Kota wajib diisi.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kode_pos.required' => 'Kode Pos wajib diisi.',
        ]);

        KartuKeluarga::create($request->all());

        return redirect()->route('kartu-keluarga.index')->with('success', 'Data Kartu Keluarga berhasil disimpan.');
    }

    public function show(KartuKeluarga $kartuKeluarga)
    {
        return view('kartu-keluarga.show', compact('kartuKeluarga'));
    }

    public function edit(KartuKeluarga $kartuKeluarga)
    {
        return view('kartu-keluarga.edit', compact('kartuKeluarga'));
    }

    public function update(Request $request, KartuKeluarga $kartuKeluarga)
    {
        $request->validate([
            'nomor_kk' => 'required|digits:16|unique:kartu_keluargas,nomor_kk,' . $kartuKeluarga->id,
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
        ], [
            'nomor_kk.required' => 'Nomor KK wajib diisi.',
            'nomor_kk.digits' => 'Nomor KK harus 16 angka.',
            'nomor_kk.unique' => 'Nomor KK sudah terdaftar.',
            'kepala_keluarga.required' => 'Kepala Keluarga wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'desa_kelurahan.required' => 'Desa/Kelurahan wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kabupaten_kota.required' => 'Kabupaten/Kota wajib diisi.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kode_pos.required' => 'Kode Pos wajib diisi.',
        ]);

        $kartuKeluarga->update($request->all());

        return redirect()->route('kartu-keluarga.index')->with('success', 'Data Kartu Keluarga berhasil diperbarui.');
    }

    public function destroy(KartuKeluarga $kartuKeluarga)
    {
        $kartuKeluarga->delete();

        return redirect()->route('kartu-keluarga.index')->with('success', 'Data Kartu Keluarga berhasil dihapus.');
    }
}
