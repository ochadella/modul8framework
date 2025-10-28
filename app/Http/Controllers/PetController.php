<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    // ✅ TAMPILKAN SEMUA DATA PET
    public function index()
    {
        // Ambil semua data pet, join supaya bisa menampilkan nama pemilik dan ras
        $rows = DB::table('pet')
            ->join('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->join('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')
            ->select(
                'pet.*',
                'pemilik.nama as nama_pemilik',
                'ras_hewan.nama_ras'
            )
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();

        // Ambil daftar dropdown
        $listPemilik = DB::table('pemilik')
            ->select('idpemilik', 'nama')
            ->get()
            ->map(fn($row) => (array) $row)
            ->toArray();

        $listRas = DB::table('ras_hewan')
            ->select('idras_hewan', 'nama_ras')
            ->get()
            ->map(fn($row) => (array) $row)
            ->toArray();

        $listJenis = DB::table('jenis_hewan')
            ->select('idjenis_hewan', 'nama_jenis_hewan')
            ->get()
            ->map(fn($row) => (array) $row)
            ->toArray();

        $editData = null;

        return view('resepsionis.pet.datapet', compact('rows', 'listPemilik', 'listRas', 'listJenis', 'editData'));
    }

    // ✅ TAMBAH DATA
    public function store(Request $request)
    {
        DB::table('pet')->insert([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'warna_bulu' => $request->warna_bulu,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
        ]);

        return redirect()->route('resepsionis.pet');
    }

    // ✅ EDIT DATA
    public function edit($id)
    {
        $editData = (array) DB::table('pet')->where('idpet', $id)->first();

        $rows = DB::table('pet')
            ->join('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->join('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')
            ->select(
                'pet.*',
                'pemilik.nama as nama_pemilik',
                'ras_hewan.nama_ras'
            )
            ->get()
            ->map(fn($row) => (array) $row)
            ->toArray();

        $listPemilik = DB::table('pemilik')->select('idpemilik', 'nama')->get()->map(fn($r)=>(array)$r)->toArray();
        $listRas = DB::table('ras_hewan')->select('idras_hewan', 'nama_ras')->get()->map(fn($r)=>(array)$r)->toArray();
        $listJenis = DB::table('jenis_hewan')->select('idjenis_hewan', 'nama_jenis_hewan')->get()->map(fn($r)=>(array)$r)->toArray();

        return view('resepsionis.pet.datapet', compact('rows', 'editData', 'listPemilik', 'listRas', 'listJenis'));
    }

    // ✅ UPDATE DATA
    public function update(Request $request, $id)
    {
        DB::table('pet')->where('idpet', $id)->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'warna_bulu' => $request->warna_bulu,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
        ]);

        return redirect()->route('resepsionis.pet');
    }

    // ✅ HAPUS DATA
    public function destroy($id)
    {
        DB::table('pet')->where('idpet', $id)->delete();
        return redirect()->route('resepsionis.pet');
    }
}
