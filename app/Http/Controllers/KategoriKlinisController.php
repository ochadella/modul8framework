<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriKlinisController extends Controller
{
    // ✅ Menampilkan semua kategori klinis
    public function index()
    {
        $rows = DB::table('kategori_klinis')->get()->map(fn($r) => (array) $r);

        return view('admin.kategoriklinis.datakategoriklinis', [
            'rows' => $rows,
            'editData' => null
        ]);
    }

    // ✅ Simpan data baru
    public function store(Request $request)
    {
        DB::table('kategori_klinis')->insert([
            'nama_kategori_klinis' => $request->nama_kategori_klinis,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.kategoriklinis.data');
    }

    // ✅ Edit data
    public function edit($id)
    {
        $editData = (array) DB::table('kategori_klinis')->where('idkategori_klinis', $id)->first();
        $rows = DB::table('kategori_klinis')->get()->map(fn($r) => (array) $r);

        return view('admin.kategoriklinis.datakategoriklinis', compact('rows', 'editData'));
    }

    // ✅ Update data
    public function update(Request $request, $id)
    {
        DB::table('kategori_klinis')->where('idkategori_klinis', $id)->update([
            'nama_kategori_klinis' => $request->nama_kategori_klinis,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.kategoriklinis.data');
    }

    // ✅ Hapus data
    public function destroy($id)
    {
        DB::table('kategori_klinis')->where('idkategori_klinis', $id)->delete();

        return redirect()->route('admin.kategoriklinis.data');
    }
}
