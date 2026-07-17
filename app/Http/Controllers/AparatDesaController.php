<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AparatDesa;
use Illuminate\Support\Facades\Storage;

class AparatDesaController extends Controller
{
    public function index(Request $request)
    {
        $query = AparatDesa::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nip', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%");
        }

        $aparatDesas = $query->latest()->paginate(10);

        return view('aparat-desa.index', compact('aparatDesas'));
    }

    public function create()
    {
        return view('aparat-desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:30|unique:aparat_desas,nip',
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_aktif' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama_lengkap.required' => 'Nama Lengkap wajib diisi.',
            'jabatan.required' => 'Jabatan wajib dipilih.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih.',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
            'status_aktif.required' => 'Status wajib dipilih.',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/aparat', $filename);
            $data['foto'] = 'aparat/' . $filename;
        }

        AparatDesa::create($data);

        return redirect()->route('aparat-desa.index')->with('success', 'Data Aparat Desa berhasil disimpan.');
    }

    public function show(AparatDesa $aparatDesa)
    {
        return view('aparat-desa.show', compact('aparatDesa'));
    }

    public function edit(AparatDesa $aparatDesa)
    {
        return view('aparat-desa.edit', compact('aparatDesa'));
    }

    public function update(Request $request, AparatDesa $aparatDesa)
    {
        $request->validate([
            'nip' => 'required|string|max:30|unique:aparat_desas,nip,' . $aparatDesa->id,
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_aktif' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama_lengkap.required' => 'Nama Lengkap wajib diisi.',
            'jabatan.required' => 'Jabatan wajib dipilih.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih.',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
            'status_aktif.required' => 'Status wajib dipilih.',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($aparatDesa->foto && Storage::exists('public/' . $aparatDesa->foto)) {
                Storage::delete('public/' . $aparatDesa->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/aparat', $filename);
            $data['foto'] = 'aparat/' . $filename;
        }

        $aparatDesa->update($data);

        return redirect()->route('aparat-desa.index')->with('success', 'Data Aparat Desa berhasil diperbarui.');
    }

    public function destroy(AparatDesa $aparatDesa)
    {
        // Delete photo
        if ($aparatDesa->foto && Storage::exists('public/' . $aparatDesa->foto)) {
            Storage::delete('public/' . $aparatDesa->foto);
        }

        $aparatDesa->delete();

        return redirect()->route('aparat-desa.index')->with('success', 'Data Aparat Desa berhasil dihapus.');
    }
}
