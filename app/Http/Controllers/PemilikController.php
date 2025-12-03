<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemilikController extends Controller
{
    // ✅ Tampilkan semua data pemilik
    public function index()
    {
        // DATA UTAMA UNTUK TABEL
        $pemilik = DB::table('pemilik')->get();

        return view('resepsionis.pemilik.datapemilik', [
            'pemilik'   => $pemilik,
            'rows'      => $pemilik,   // ← mempertahankan variabel lama
            'editData'  => null        // ← biar tidak undefined
        ]);
    }

    // ✅ Tambah data pemilik
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:100',
            'no_telp'      => 'required|string|max:20',
            'alamat'       => 'required|string|max:255',
        ]);

        DB::table('pemilik')->insert([
            'nama'   => $request->nama_pemilik,
            'no_wa'  => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('resepsionis.pemilik')
            ->with('success', 'Data pemilik berhasil ditambahkan');
    }

    // ✅ Edit data pemilik
    public function edit($id)
    {
        $editData = DB::table('pemilik')->where('idpemilik', $id)->first();
        $pemilik  = DB::table('pemilik')->get();

        return view('resepsionis.pemilik.datapemilik', [
            'pemilik'  => $pemilik,
            'rows'     => $pemilik,   // tetap dipertahankan
            'editData' => $editData
        ]);
    }

    // ✅ Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:100',
            'no_telp'      => 'required|string|max:20',
            'alamat'       => 'required|string|max:255',
        ]);

        DB::table('pemilik')
            ->where('idpemilik', $id)
            ->update([
                'nama'   => $request->nama_pemilik,
                'no_wa'  => $request->no_telp,
                'alamat' => $request->alamat,
            ]);

        return redirect()->route('resepsionis.pemilik')
            ->with('success', 'Data pemilik berhasil diperbarui');
    }

    // ✅ Hapus data
    public function destroy($id)
    {
        DB::table('pemilik')->where('idpemilik', $id)->delete();

        return redirect()->route('resepsionis.pemilik')
            ->with('success', 'Data pemilik berhasil dihapus');
    }
}
