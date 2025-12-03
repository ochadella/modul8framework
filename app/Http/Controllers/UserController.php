<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{

    /* ============================ */
    /*     INDEX (WAJIB ADA)       */
    /* ============================ */
    public function index()
    {
        // Ambil semua user
        $users = User::all();

        // Ambil semua role untuk dropdown tambah user
        $roles = Role::all();

        // Kembalikan ke view
        return view('admin.user.datauser', compact('users', 'roles'));
    }


    /* ============================ */
    /*     TAMBAH USER             */
    /* ============================ */
    public function store(Request $req)
    {
        $req->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:3',
            'role' => 'required'
        ]);

        User::create([
            'nama' => $req->nama,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'role' => $req->role
        ]);

        return response()->json(['success' => true]);
    }


    /* ============================ */
    /*     UPDATE USER             */
    /* ============================ */
    public function update(Request $req)
    {
        $req->validate([
            'edit_id' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $user = User::find($req->edit_id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan']);
        }

        // CEK EMAIL DUPLIKAT
        $cekEmail = User::where('email', $req->email)
                        ->where('iduser', '!=', $req->edit_id)
                        ->first();

        if ($cekEmail) {
            return response()->json(['success' => false, 'message' => 'Email sudah digunakan']);
        }

        $user->update([
            'nama' => $req->nama,
            'email' => $req->email,
            'role' => $req->role
        ]);

        return response()->json(['success' => true]);
    }


    /* ============================ */
    /*     RESET PASSWORD          */
    /* ============================ */
    public function resetPassword($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        $user->password = Hash::make("123456");
        $user->save();

        return back()->with('success', 'Password berhasil direset menjadi 123456');
    }


    /* ============================ */
    /*     DELETE USER             */
    /* ============================ */
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}
