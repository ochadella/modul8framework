<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class RoleController extends Controller
{
    // ============================
    // 1. HALAMAN MASTER ROLE
    // ============================
    public function index()
    {
        $roles = Role::all();

        $roleData = [];

        foreach ($roles as $r) {
            $jumlahUser = User::where('role', $r->nama_role)->count();

            $roleData[] = [
                'idrole'      => $r->idrole,
                'nama_role'   => $r->nama_role,
                'jumlah_user' => $jumlahUser,
            ];
        }

        return view('admin.role.datarole', compact('roleData'));
    }

    // ============================
    // 2. TAMBAH ROLE BARU
    // ============================
    public function store(Request $request)
    {
        // Generate ID manual agar rapi dan tidak bolong
        $nextId = (Role::max('idrole') ?? 0) + 1;

        Role::create([
            'idrole'    => $nextId,
            'nama_role' => $request->nama_role,
            'status'    => $request->status
        ]);

        return back()->with('success', 'Role baru berhasil ditambahkan');
    }

    // ============================
    // 3. EDIT ROLE (TAMPILKAN FORM)
    // ============================
    public function edit($idrole)
    {
        $role = Role::where('idrole', $idrole)->firstOrFail();
        
        return view('admin.role.editrole', compact('role'));
    }

    // ============================
    // 4. UPDATE ROLE (SIMPAN PERUBAHAN)
    // ============================
    public function update(Request $request, $idrole)
    {
        $role = Role::where('idrole', $idrole)->firstOrFail();
        
        $role->update([
            'nama_role' => $request->nama_role,
            'status'    => $request->status
        ]);

        return redirect()->route('admin.role.manajemen')
                         ->with('success', 'Role berhasil diupdate!');
    }

    // ============================
    // 5. HAPUS ROLE (MASTER)
    // ============================
    public function destroy($idrole)
    {
        Role::where('idrole', $idrole)->delete();

        return back()->with('success', 'Role berhasil dihapus!');
    }
}