<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function home()
    {
        return view('interface.home');
    }

    public function login()
    {
        return view('interface.login');
    }

    public function loginPost(Request $request)
    {
        // Data akun (sementara, nanti bisa diganti database)
        $accounts = [
            [
                'email' => 'admin@mail.com',
                'password' => '123456',
                'nama' => 'Admin RSHP',
                'role' => 'admin',
            ],
            [
                'email' => 'resepsionis@mail.com',
                'password' => '654321',
                'nama' => 'Resepsionis Angel',
                'role' => 'resepsionis',
            ],
            [
                'email' => 'azzam@mail.com',
                'password' => '123456',
                'nama' => 'Azzam',
                'role' => 'resepsionis',
            ],
            [
                'email' => 'angelyna@mail.com',
                'password' => '123456',
                'nama' => 'Angelyna',
                'role' => 'resepsionis',
            ],
            [
                'email' => 'daffa@mail.com',
                'password' => '123456',
                'nama' => 'Daffa',
                'role' => 'perawat',
            ],
            [
                'email' => 'ryan@mail.com',
                'password' => '123456',
                'nama' => 'Ryan',
                'role' => 'perawat',
            ],
            [
                'email' => 'ocalucu@mail.com',
                'password' => '123456',
                'nama' => 'ocaa',
                'role' => 'dokter',
            ],
            [
                'email' => 'mayshalucu@mail.com',
                'password' => '123456',
                'nama' => 'Maysha',
                'role' => 'dokter',
            ],
            [
                'email' => 'ale@mail.com',
                'password' => '123456',
                'nama' => 'Ale',
                'role' => 'dokter',
            ],
        ];

        $email = $request->input('email');
        $password = $request->input('password');

        $user = collect($accounts)->first(function ($account) use ($email, $password) {
            return $account['email'] === $email && $account['password'] === $password;
        });

        if ($user) {
            session([
                'user' => [
                    'nama' => $user['nama'],
                    'role' => $user['role'],
                    'email' => $user['email'],
                    'logged_in' => true,
                ],
            ]);

            switch ($user['role']) {
                case 'admin':
                    return redirect('/dashboard_admin');
                case 'resepsionis':
                    return redirect('/dashboard_resepsionis');
                case 'perawat':
                    return redirect('/dashboard_perawat');
                case 'dokter':
                    return redirect('/dashboard_dokter');
                default:
                    return redirect('/dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect('/login')->with('status', 'Berhasil logout');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    // ✅ perbaikan: semua layanan pakai folder "interface"
    public function bedahhewan()
    {
        return view('interface.bedahhewan');
    }

    public function vaksinasi()
    {
        return view('interface.vaksinasi');
    }

    public function sterilisasi()
    {
        return view('interface.sterilisasi');
    }

    public function vaksinasiSterilisasi()
    {
        return view('interface.vaksinasi_sterilisasi');
    }

    public function dashboardResepsionis()
    {
        $user = session('user');
        if (!$user || ($user['role'] ?? '') !== 'resepsionis') {
            return redirect('/login');
        }

        $namaResepsionis = $user['nama'] ?? 'Angel';

        // Cegah error kalau tabel belum ada
        try {
            $total_antrian = DB::table('temu_dokter')
                ->whereRaw("LOWER(TRIM(status)) = 'a'")
                ->count();
        } catch (\Exception $e) {
            $total_antrian = 0;
        }

        // tetap di folder interface (sesuai punyamu)
        return view('interface.dashboard_resepsionis', [
            'namaResepsionis' => $namaResepsionis,
            'total_antrian'   => $total_antrian,
        ]);
    }
}
