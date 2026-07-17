<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\KartuKeluarga;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::with('kartuKeluarga');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%");
        }

        $penduduks = $query->latest()->paginate(10);

        return view('penduduk.index', compact('penduduks'));
    }

    public function create()
    {
        $kartuKeluargas = KartuKeluarga::orderBy('nomor_kk', 'asc')->get();
        return view('penduduk.create', compact('kartuKeluargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kartu_keluarga_id' => 'required|exists:kartu_keluargas,id',
            'nik' => 'required|digits:16|unique:penduduks,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:30',
            'pendidikan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'status_perkawinan' => 'required|string|max:30',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status_penduduk' => 'required|string|max:30',
        ], [
            'kartu_keluarga_id.required' => 'Nomor KK wajib dipilih.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama_lengkap.required' => 'Nama Lengkap wajib diisi.',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih.',
            'agama.required' => 'Agama wajib diisi.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'status_perkawinan.required' => 'Status Perkawinan wajib dipilih.',
            'status_penduduk.required' => 'Status Penduduk wajib dipilih.',
        ]);

        Penduduk::create($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk berhasil disimpan.');
    }

    public function show(Penduduk $penduduk)
    {
        $penduduk->load('kartuKeluarga');
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        $kartuKeluargas = KartuKeluarga::orderBy('nomor_kk', 'asc')->get();
        return view('penduduk.edit', compact('penduduk', 'kartuKeluargas'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $request->validate([
            'kartu_keluarga_id' => 'required|exists:kartu_keluargas,id',
            'nik' => 'required|digits:16|unique:penduduks,nik,' . $penduduk->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:30',
            'pendidikan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'status_perkawinan' => 'required|string|max:30',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status_penduduk' => 'required|string|max:30',
        ], [
            'kartu_keluarga_id.required' => 'Nomor KK wajib dipilih.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama_lengkap.required' => 'Nama Lengkap wajib diisi.',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih.',
            'agama.required' => 'Agama wajib diisi.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'status_perkawinan.required' => 'Status Perkawinan wajib dipilih.',
            'status_penduduk.required' => 'Status Penduduk wajib dipilih.',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk berhasil dihapus.');
    }
}
