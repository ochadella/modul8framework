<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // ✅ Tampilkan semua data kategori
    public function index()
    {
        // Ambil semua data dari tabel 'kategori'
        $rows = DB::table('kategori')->get()->map(function ($item) {
            return (array) $item;
        });

        // Kirim ke view
        return view('admin.kategori.datakategori', [
            'rows' => $rows,
            'editData' => null
        ]);
    }

    // ✅ Simpan data baru
    public function store(Request $request)
    {
        DB::table('kategori')->insert([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.data');
    }

    // ✅ Edit data (tampilkan data lama)
    public function edit($id)
    {
        $editData = (array) DB::table('kategori')->where('idkategori', $id)->first();
        $rows = DB::table('kategori')->get()->map(fn($i) => (array) $i);

        return view('admin.kategori.datakategori', compact('rows', 'editData'));
    }

    // ✅ Update data
    public function update(Request $request, $id)
    {
        DB::table('kategori')->where('idkategori', $id)->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.data');
    }

    // ✅ Hapus data
    public function destroy($id)
    {
        DB::table('kategori')->where('idkategori', $id)->delete();

        return redirect()->route('admin.kategori.data');
    }
}
