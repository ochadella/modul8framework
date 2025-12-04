<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return view('interface.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // CEK USER ADA
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar.',
            ])->withInput($request->only('email'));
        }

        // CEK PASSWORD
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ])->withInput($request->only('email'));
        }

        // CEK STATUS AKTIF
        if (isset($user->status) && $user->status !== 'aktif') {
            return back()->withErrors([
                'email' => 'Akun tidak aktif. Hubungi administrator.',
            ])->withInput($request->only('email'));
        }

        // LOGIN SUKSES
        Auth::login($user);
        $request->session()->regenerate();

        // GET ROLE
        $role = strtolower(trim($user->role));

        // LOG UNTUK DEBUG
        Log::info("User Login", [
            'email' => $user->email,
            'role_asli' => $user->role,
            'role_processed' => $role,
            'iduser' => $user->iduser
        ]);

        // REDIRECT BERDASARKAN ROLE
        try {
            switch ($role) {
                case 'administrator':
                case 'admin':
                    Log::info("Redirect ke dashboard admin");
                    return redirect()->route('interface.dashboard');
                    
                case 'dokter':
                    Log::info("Redirect ke dashboard dokter");
                    return redirect()->route('dashboard_dokter');
                    
                case 'perawat':
                    Log::info("Redirect ke dashboard perawat");
                    return redirect()->route('interface.dashboard_perawat');
                    
                case 'resepsionis':
                    Log::info("Redirect ke dashboard resepsionis");
                    return redirect()->route('dashboard.resepsionis');
                    
                default:
                    Log::error("Role tidak dikenali: " . $role);
                    Auth::logout();
                    return back()->withErrors([
                        'email' => "Role tidak dikenali: [{$user->role}]. Hubungi admin.",
                    ])->withInput($request->only('email'));
            }
        } 
        catch (\Exception $e) {
            Log::error("Error saat redirect", [
                'error' => $e->getMessage(),
                'role' => $role
            ]);
            Auth::logout();
            return back()->withErrors([
                'email' => 'Terjadi kesalahan sistem. Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}