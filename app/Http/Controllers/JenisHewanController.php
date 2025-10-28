<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    public function index()
    {
        $rows = DB::table('jenis_hewan')->get();
        return view('dokter.jenis.datajenishewan', [
            'rows' => $rows,
            'editData' => null
        ]);
    }

    public function store(Request $request)
    {
        DB::table('jenis_hewan')->insert([
            'nama_jenis_hewan' => $request->nama
        ]);
        return redirect('/dokter/jenis/datajenishewan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $editData = DB::table('jenis_hewan')->where('idjenis_hewan', $id)->first();
        $rows = DB::table('jenis_hewan')->get();
        return view('dokter.jenis.datajenishewan', compact('editData', 'rows'));
    }

    public function update(Request $request, $id)
    {
        DB::table('jenis_hewan')->where('idjenis_hewan', $id)->update([
            'nama_jenis_hewan' => $request->nama
        ]);
        return redirect('/dokter/jenis/datajenishewan')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('jenis_hewan')->where('idjenis_hewan', $id)->delete();
        return redirect('/dokter/jenis/datajenishewan')->with('success', 'Data berhasil dihapus!');
    }
}
