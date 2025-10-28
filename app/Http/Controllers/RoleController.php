<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Tampilkan halaman Manajemen Role
     */
    public function index()
    {
        // Ambil semua user beserta relasi role-nya
        $users = User::with('roles')->get();

        // Ambil semua role untuk dropdown
        $roles = Role::all();

        // Format data biar cocok sama struktur di manajemenrole.blade.php
        $userRoles = ['data' => []];
        foreach ($users as $user) {
            $userRoles['data'][] = [
                'iduser' => $user->iduser,
                'nama' => $user->nama,
                'email' => $user->email,
                'roles' => $user->roles->pluck('nama_role')->implode(', ')
            ];
        }

        // Kirim data ke view
        return view('admin.role.manajemenrole', compact('userRoles', 'roles'))
                ->with('roleOptions', $roles);
    }

    /**
     * Simpan perubahan role user
     */
    public function store(Request $request)
    {
        $iduser = $request->input('iduser');
        $idrole = $request->input('idrole');
        $status = $request->input('status', 1);

        if ($iduser && $idrole) {
            $user = User::find($iduser);
            if ($user) {
                // attach atau update role di pivot
                $user->roles()->syncWithoutDetaching([
                    $idrole => ['status' => $status]
                ]);
            }
        }

        return redirect()->back()->with('success', 'Role user berhasil disimpan!');
    }

    /**
     * Hapus semua role milik user
     */
    public function destroy($iduser)
    {
        $user = User::find($iduser);
        if ($user) {
            $user->roles()->detach();
        }

        return redirect()->back()->with('success', 'Semua role user berhasil dihapus!');
    }
}
