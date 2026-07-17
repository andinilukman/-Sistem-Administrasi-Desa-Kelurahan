<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if ($role == 'Warga') {
            $pengaduans = Pengaduan::where('user_id', auth()->id())->latest()->paginate(10);
        } else {
            // Admin atau lainnya bisa melihat semua pengaduan
            $pengaduans = Pengaduan::latest()->paginate(10);
        }

        return view('pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
        ]);

        Pengaduan::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim');
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|string',
            'tanggapan' => 'nullable|string',
        ]);

        $pengaduan->update($request->only('status', 'tanggapan'));

        return redirect()->route('pengaduan.index')->with('success', 'Status pengaduan berhasil diubah');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
    }
}
