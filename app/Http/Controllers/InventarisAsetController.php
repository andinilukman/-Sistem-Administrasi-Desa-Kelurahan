<?php

namespace App\Http\Controllers;

use App\Models\InventarisAset;
use Illuminate\Http\Request;

class InventarisAsetController extends Controller
{
    public function index()
    {
        $asets = InventarisAset::latest()->paginate(10);
        return view('inventaris.index', compact('asets'));
    }

    public function create()
    {
        return view('inventaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_aset' => 'required|string|unique:inventaris_asets',
            'nama_aset' => 'required|string|max:255',
            'kategori' => 'required|string',
            'lokasi' => 'required|string',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|string',
        ]);

        InventarisAset::create($request->all());

        return redirect()->route('inventaris-aset.index')->with('success', 'Data Aset berhasil ditambahkan');
    }

    public function show(InventarisAset $inventaris_aset)
    {
        return view('inventaris.show', ['aset' => $inventaris_aset]);
    }

    public function edit(InventarisAset $inventaris_aset)
    {
        return view('inventaris.edit', ['aset' => $inventaris_aset]);
    }

    public function update(Request $request, InventarisAset $inventaris_aset)
    {
        $request->validate([
            'kode_aset' => 'required|string|unique:inventaris_asets,kode_aset,' . $inventaris_aset->id,
            'nama_aset' => 'required|string|max:255',
            'kategori' => 'required|string',
            'lokasi' => 'required|string',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|string',
        ]);

        $inventaris_aset->update($request->all());

        return redirect()->route('inventaris-aset.index')->with('success', 'Data Aset berhasil diubah');
    }

    public function destroy(InventarisAset $inventaris_aset)
    {
        $inventaris_aset->delete();
        return redirect()->route('inventaris-aset.index')->with('success', 'Data Aset berhasil dihapus');
    }
}
