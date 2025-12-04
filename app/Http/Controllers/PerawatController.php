<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    public function index()
    {
        $perawat = User::where('role', 'Perawat')->get();

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
            'role'     => 'Perawat'
        ]);

        return redirect()->route('admin.perawat.index');
    }

    public function reset($id){
    $user = User::findOrFail($id);

    $user->update([
        'password' => bcrypt("123456")
    ]);

    return back()->with('success', 'Password perawat berhasil direset menjadi 123456!');
    }

}
