<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RasHewanController extends Controller
{
    // ✅ Tampilkan daftar ras + data jenis hewan
    public function index()
    {
        // Ambil semua jenis hewan (untuk dropdown)
        $listJenis = DB::table('jenis_hewan')->get();

        // Ambil semua ras + join nama jenis
        $listRas = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.idras_hewan', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
            ->orderBy('ras_hewan.idras_hewan', 'asc')
            ->get();

        // Kirim data ke view
        return view('dokter.ras.Datarashewan', [
            'listRas' => $listRas,
            'listJenis' => $listJenis,
            'editData' => null,
        ]);
    }

    // ⭐⭐⭐ DITAMBAHKAN — buka form tambah ras ⭐⭐⭐
    public function create()
    {
        // Ambil semua jenis hewan untuk dropdown
        $listJenis = DB::table('jenis_hewan')->get();

        // Ambil semua ras seperti biasa
        $listRas = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.idras_hewan', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
            ->orderBy('ras_hewan.idras_hewan', 'asc')
            ->get();

        // Tampilkan view tanpa editData
        return view('dokter.ras.Datarashewan', [
            'listRas'   => $listRas,
            'listJenis' => $listJenis,
            'editData'  => null,
        ]);
    }

    // ✅ Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|integer',
        ]);

        DB::table('ras_hewan')->insert([
            'nama_ras' => $request->nama_ras,
            'idjenis_hewan' => $request->idjenis_hewan,
        ]);

        return redirect()->route('dokter.ras.data')->with('success', 'Ras hewan berhasil ditambahkan');
    }

    // ✅ Edit data (tampilkan data lama untuk form)
    public function edit($id)
    {
        $editData = DB::table('ras_hewan')->where('idras_hewan', $id)->first();
        $listJenis = DB::table('jenis_hewan')->get();

        $listRas = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.idras_hewan', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
            ->orderBy('ras_hewan.idras_hewan', 'asc')
            ->get();

        return view('dokter.ras.Datarashewan', [
            'listRas' => $listRas,
            'listJenis' => $listJenis,
            'editData' => $editData,
        ]);
    }

    // ✅ Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|integer',
        ]);

        DB::table('ras_hewan')->where('idras_hewan', $id)->update([
            'nama_ras' => $request->nama_ras,
            'idjenis_hewan' => $request->idjenis_hewan,
        ]);

        return redirect()->route('dokter.ras.data')->with('success', 'Data ras hewan berhasil diperbarui');
    }

    // ✅ Hapus data
    public function destroy($id)
    {
        DB::table('ras_hewan')->where('idras_hewan', $id)->delete();
        return redirect()->route('dokter.ras.data')->with('success', 'Data ras hewan berhasil dihapus');
    }
}
