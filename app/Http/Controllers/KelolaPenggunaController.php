<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaPenggunaController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('kelola-pengguna.index', compact('users'));
    }

    public function create()
    {
        return view('kelola-pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,Kepala Desa,Warga',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('kelola-pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function show(User $kelola_pengguna)
    {
        return view('kelola-pengguna.show', ['user' => $kelola_pengguna]);
    }

    public function edit(User $kelola_pengguna)
    {
        return view('kelola-pengguna.edit', ['user' => $kelola_pengguna]);
    }

    public function update(Request $request, User $kelola_pengguna)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $kelola_pengguna->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $kelola_pengguna->id,
            'role' => 'required|in:Admin,Kepala Desa,Warga',
        ]);

        $data = $request->only('name', 'username', 'email', 'role');
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $kelola_pengguna->update($data);

        return redirect()->route('kelola-pengguna.index')->with('success', 'Data pengguna berhasil diubah');
    }

    public function destroy(User $kelola_pengguna)
    {
        if (auth()->id() == $kelola_pengguna->id) {
            return redirect()->route('kelola-pengguna.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri');
        }

        $kelola_pengguna->delete();
        return redirect()->route('kelola-pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
