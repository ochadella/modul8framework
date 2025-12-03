<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    public function index()
    {
        $perawat = User::whereHas('roles', function($q) {
            $q->where('nama_role', 'Perawat');
        })->get();

        return view('admin.perawat.index', compact('perawat'));
    }

    public function create()
    {
        return view('admin.perawat.create');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => bcrypt('123'),
        ]);

        // idrole=3 biasanya Perawat
        $user->roles()->attach(3);

        return redirect()->route('admin.perawat.index');
    }
}
