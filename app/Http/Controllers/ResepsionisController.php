<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ResepsionisController extends Controller
{
    public function index()
    {
        $resepsionis = User::where('role', 'Resepsionis')->get();
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
            'role'     => 'Resepsionis'
        ]);

        return redirect()->route('admin.resepsionis.index');
    }
}
