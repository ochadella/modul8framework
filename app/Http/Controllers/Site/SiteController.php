<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SiteController extends Controller
{
    /**
     * Halaman Home
     */
    public function home()
    {
        return view('interface.home');
    }

    /**
     * Halaman Login
     */
    public function login()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('interface.login');
    }

    /**
     * Proses Login dengan redirect otomatis berdasarkan role
     */
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan password benar
        if ($user && Hash::check($request->password, $user->password)) {
            
            // Login user
            Auth::login($user);
            
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // ⭐ REDIRECT OTOMATIS BERDASARKAN ROLE
            return $this->redirectByRole($user);
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * ⭐ FUNGSI REDIRECT BERDASARKAN ROLE
     */
    private function redirectByRole($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('interface.dashboard');
                
            case 'dokter':
                return redirect()->route('interface.dashboard_dokter');
                
            case 'perawat':
                return redirect()->route('interface.dashboard_perawat');
                
            case 'resepsionis':
                return redirect()->route('dashboard.resepsionis');
                
            default:
                // Jika role tidak dikenali, redirect ke dashboard admin
                return redirect()->route('interface.dashboard');
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }

    /**
     * Halaman Register
     */
    public function register()
    {
        return view('interface.register');
    }

    /**
     * Dashboard Resepsionis
     */
    public function dashboardResepsionis()
    {
        $namaResepsionis = auth()->user()->nama ?? auth()->user()->email ?? 'Resepsionis';
        $total_antrian = 5;
        return view('interface.dashboard_resepsionis', compact('namaResepsionis', 'total_antrian'));
    }
}