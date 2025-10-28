<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KodeTindakanController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel kode_tindakan
        $rows = DB::table('kode_tindakan')->get();

        // ✅ Kirim ke view yang benar (nama file: datatindakan.blade.php)
        return view('admin.kodetindakan.datatindakan', compact('rows'));
    }

    public function store(Request $request)
    {
        DB::table('kode_tindakan')->insert([
            'kode_tindakan' => $request->kode_tindakan,
            'nama_tindakan' => $request->nama_tindakan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.kodetindakan.data')->with('success', 'Data berhasil ditambahkan!');
    }

    public function delete($id)
    {
        DB::table('kode_tindakan')->where('id_tindakan', $id)->delete();

        return redirect()->route('admin.kodetindakan.data')->with('success', 'Data berhasil dihapus!');
    }
}
