<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = User::whereHas('roles', function($q) {
            $q->where('nama_role', 'Dokter');
        })->get();

        return view('admin.dokter.index', compact('dokter'));
    }

    public function create()
    {
        return view('admin.dokter.create');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => bcrypt('123'),
        ]);

        // role dokter biasanya idrole=2
        $user->roles()->attach(2);

        return redirect()->route('admin.dokter.index');
    }
}
