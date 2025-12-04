<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /* ===========================================================
       INDEX — Menampilkan dokter berdasarkan role = Dokter
    ============================================================ */
    public function index()
    {
        $dokter = User::where('role', 'Dokter')
                      ->orderBy('iduser', 'asc')
                      ->get();

        return view('admin.dokter.index', compact('dokter'));
    }

    /* ===========================================================
       CREATE — Tidak dipakai lagi karena sistem memakai POP UP
    ============================================================ */
    public function create()
    {
        // HANYA KEMBALI KE INDEX, karena modal dipakai.
        return redirect()->route('admin.dokter.index');
    }

    /* ===========================================================
       STORE — Tambah dokter via modal (WAJIB FIX IDUSER)
    ============================================================ */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|min:3',
            'status'   => 'required'
        ]);

        // === ⚠ WAJIB: GENERATE iduser MANUAL ===
        $nextId = (User::max('iduser') ?? 0) + 1;

        User::create([
            'iduser'   => $nextId,
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'Dokter',   // fixed, tidak boleh berubah
            'status'   => $request->status
        ]);

        return response()->json(['success' => true]);
    }

    /* ===========================================================
       UPDATE — Edit dokter via modal
    ============================================================ */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email',
            'status' => 'required'
        ]);

        $dokter = User::find($id);

        if (!$dokter) {
            return response()->json(['success' => false, 'message' => 'Dokter tidak ditemukan']);
        }

        // Cek email duplikat
        $emailCheck = User::where('email', $request->email)
                          ->where('iduser', '!=', $id)
                          ->first();

        if ($emailCheck) {
            return response()->json(['success' => false, 'message' => 'Email sudah digunakan']);
        }

        $dokter->update([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }

    /* ===========================================================
       RESET PASSWORD
    ============================================================ */
    public function reset($id)
    {
        $dokter = User::find($id);

        if (!$dokter) {
            return back()->with('error', 'Dokter tidak ditemukan');
        }

        $dokter->password = Hash::make("123456");
        $dokter->save();

        return back()->with('success', 'Password berhasil direset menjadi 123456');
    }

    /* ===========================================================
       DELETE DOKTER
    ============================================================ */
    public function delete($id)
    {
        $dokter = User::find($id);

        if (!$dokter) {
            return back()->with('error', 'Dokter tidak ditemukan');
        }

        $dokter->delete();

        return back()->with('success', 'Dokter berhasil dihapus');
    }
}
