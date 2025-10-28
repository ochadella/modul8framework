<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // ✅ pastikan model User dipanggil dan namespace benar

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        return view('admin.user.datauser', compact('users'));
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('admin.user.tambahuser');
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        // ✅ Validasi input — pastikan nama tabel sesuai (user / users)
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email', // ubah ke 'user' jika tabel di DB kamu bernama 'user'
            'password' => 'required|min:6',
        ]);

        // Simpan ke database
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect balik ke Data User
        return redirect()->route('admin.user.data')->with('success', 'User berhasil ditambahkan!');
    }
}
