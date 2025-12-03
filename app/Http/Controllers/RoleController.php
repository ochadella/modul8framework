<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role-nya
        $users = User::with('roles')->get();
        $role = Role::all();

        $userRoles = ['data' => []];

        foreach ($users as $user) {
            $userRoles['data'][] = [
                'iduser' => $user->iduser,
                'nama'   => $user->nama,
                'email'  => $user->email,
                'role'   => $user->roles->pluck('nama_role')->implode(', ')
            ];
        }

        return view('admin.role.manajemenrole', compact('userRoles', 'role'));
    }

    public function store(Request $request)
    {
        $iduser = $request->iduser;
        $idrole = $request->idrole;

        $user = User::findOrFail($iduser);

        // Tambahkan role (tanpa hapus role sebelumnya)
        $user->roles()->syncWithoutDetaching([$idrole]);

        return back()->with('success', 'Role berhasil ditambahkan!');
    }

    public function destroy($iduser)
    {
        $user = User::findOrFail($iduser);
        $user->roles()->detach();

        return back()->with('success', 'Semua role user berhasil dihapus!');
    }

    /* ⭐⭐⭐ DITAMBAHKAN TANPA MENGGANGGU CODE LAIN ⭐⭐⭐ */
    public function deleteAll($iduser)
    {
        $user = User::findOrFail($iduser);

        // hapus semua role user ini
        $user->roles()->detach();

        return back()->with('success', 'Seluruh role user berhasil dihapus!');
    }
}
