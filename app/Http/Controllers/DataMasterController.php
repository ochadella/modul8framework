<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use App\Models\Pet;

class DataMasterController extends Controller
{
    public function index()
    {
        // === SUMMARY CARD ===
        $totalUser  = User::count();
        $totalJenis = JenisHewan::count();
        $totalRas   = RasHewan::count();
        $totalPet   = Pet::count();

        // === PIE CHART: JUMLAH JENIS (langsung ambil nama jenis) ===
        $jenisLabels = JenisHewan::pluck('nama_jenis_hewan');
        $jenisCounts = JenisHewan::pluck('idjenis_hewan')->map(function ($id) {
            return RasHewan::where('idjenis_hewan', $id)->count();
        });

        // === BAR CHART: JUMLAH RAS PER JENIS ===
        $rasCounts = JenisHewan::leftJoin(
                'ras_hewan',
                'jenis_hewan.idjenis_hewan',
                '=',
                'ras_hewan.idjenis_hewan'
            )
            ->select(
                'jenis_hewan.nama_jenis_hewan',
                DB::raw('COUNT(ras_hewan.idras_hewan) AS jumlah_ras')
            )
            ->groupBy('jenis_hewan.idjenis_hewan', 'jenis_hewan.nama_jenis_hewan')
            ->orderBy('jenis_hewan.idjenis_hewan')
            ->get();

        $barLabels = $rasCounts->pluck('nama_jenis_hewan');
        $barValues = $rasCounts->pluck('jumlah_ras');

        // === ACTIVITY LOG SAFE MODE (tabel tidak wajib ada) ===
        try {
            $activities = DB::table('activity_logs')->latest()->limit(10)->get();
        } catch (\Exception $e) {
            $activities = [];
        }

        return view('admin.datamaster', compact(
            'totalUser',
            'totalJenis',
            'totalRas',
            'totalPet',
            'jenisLabels',
            'jenisCounts',
            'barLabels',
            'barValues',
            'activities'
        ));
    }
}
