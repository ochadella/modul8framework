<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ResepsionisController extends Controller
{
    public function index()
    {
        $resepsionis = User::whereHas('roles', function($q) {
            $q->where('nama_role', 'Resepsionis');
        })->get();

        return view('admin.resepsionis.index', compact('resepsionis'));
    }

    public function create()
    {
        return view('admin.resepsionis.create');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => bcrypt('123'),
        ]);

        // idrole=4 biasanya resepsionis
        $user->roles()->attach(4);

        return redirect()->route('admin.resepsionis.index');
    }
}
