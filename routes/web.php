<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;

/*
|--------------------------------------------------------------------------
| Halaman Utama & Auth
|--------------------------------------------------------------------------
*/
Route::get('/', [SiteController::class, 'home'])->name('interface.home');
Route::get('/login', [SiteController::class, 'login'])->name('login');
Route::post('/login', [SiteController::class, 'loginPost']);
Route::get('/logout', [SiteController::class, 'logout'])->name('logout');
Route::get('/register', [SiteController::class, 'register'])->name('register');

/*
|--------------------------------------------------------------------------
| Layanan Umum
|--------------------------------------------------------------------------
*/
Route::view('/bedahhewan', 'bedahhewan')->name('interface.bedahhewan');
Route::view('/vaksinasi', 'vaksinasi')->name('interface.vaksinasi');
Route::view('/sterilisasi', 'sterilisasi')->name('interface.sterilisasi');
Route::view('/vaksinasi_sterilisasi', 'vaksinasi_sterilisasi')->name('interface.vaksinasi_sterilisasi');
Route::view('/visimisi', 'interface.visimisi')->name('interface.visimisi');
Route::view('/layanan', 'interface.layanan')->name('interface.layanan');
Route::view('/struktur', 'interface.struktur')->name('interface.struktur');

/*
|--------------------------------------------------------------------------
| Detail Layanan Bedah (klikable di halaman Bedah Hewan)
|--------------------------------------------------------------------------
*/
Route::view('/bedah-sterilisasi', 'bedahsterilisasi')->name('interface.bedah.sterilisasi');
Route::view('/bedah-minor', 'bedahminor')->name('interface.bedah.minor');
Route::view('/bedah-mayor', 'bedahmayor')->name('interface.bedah.mayor');
Route::view('/bedah-darurat', 'bedahdarurat')->name('interface.bedah.darurat');
Route::view('/bedah-gigimulut', 'bedahgigimulut')->name('interface.bedah.gigimulut');

/*
|--------------------------------------------------------------------------
| Dashboard (berdasarkan role)
|--------------------------------------------------------------------------
*/
Route::view('/dashboard', 'dashboard')->name('dashboard.admin');
Route::view('/dashboard_dokter', 'dashboard_dokter')->name('interface.dashboarddokter');
Route::view('/dashboard_perawat', 'dashboard.dashboard_perawat')->name('interface.dashboard_perawat');
Route::get('/dashboard_resepsionis', [SiteController::class, 'dashboardResepsionis'])->name('dashboard.resepsionis');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    // Kategori
    Route::view('/kategori/datakategori', 'admin.kategori.datakategori')->name('admin.kategori.data');
    Route::view('/kategori/tambahkategori', 'admin.kategori.tambahkategori')->name('admin.kategori.tambah');
    Route::view('/kategori/editkategori', 'admin.kategori.editkategori')->name('admin.kategori.edit');
    Route::view('/kategori/hapuskategori', 'admin.kategori.hapuskategori')->name('admin.kategori.hapus');

    // Kategori Klinis
    Route::view('/kategoriklinis/datakategoriklinis', 'admin.kategoriklinis.datakategoriklinis')->name('admin.kategoriklinis.data');
    Route::view('/kategoriklinis/tambahkategoriklinis', 'admin.kategoriklinis.tambahkategoriklinis')->name('admin.kategoriklinis.tambah');

    // Kode Tindakan
    Route::view('/kodetindakan/datatindakan', 'admin.kodetindakan.datatindakan')->name('admin.kodetindakan.data');

    // Role
    Route::view('/role/manajemenrole', 'admin.role.manajemenrole')->name('admin.role.manajemen');
    Route::view('/role/tambahrole', 'admin.role.tambahrole')->name('admin.role.tambah');
    Route::view('/role/editrole', 'admin.role.editrole')->name('admin.role.edit');

    // User
    Route::view('/user/datauser', 'admin.user.datauser')->name('admin.user.data');
    Route::view('/user/edituser', 'admin.user.edituser')->name('admin.user.edit');
    Route::view('/user/resetpw', 'admin.user.resetpw')->name('admin.user.resetpw');
    Route::view('/user/tambahuser', 'admin.user.tambahuser')->name('admin.user.tambah');
});

/*
|--------------------------------------------------------------------------
| DOKTER
|--------------------------------------------------------------------------
*/
Route::prefix('dokter')->group(function () {
    Route::view('/jadwal/jadwal_pemeriksaan', 'dokter.jadwal.jadwal_pemeriksaan')->name('dokter.jadwal');
    Route::view('/jenis/datajenishewan', 'dokter.jenis.datajenishewan')->name('dokter.jenis.data');
    Route::view('/jenis/tambahjenishewan', 'dokter.jenis.tambahjenishewan')->name('dokter.jenis.tambah');
    Route::view('/pasien/datapasiendokter', 'dokter.pasien.datapasiendokter')->name('dokter.pasien');
    Route::view('/ras/datarashewan', 'dokter.ras.datarashewan')->name('dokter.ras');
    Route::view('/rekammedis/datarekammedis', 'dokter.rekammedis.datarekammedis')->name('dokter.rekammedis.data');
    Route::view('/rekammedis/detailrekammedis', 'dokter.rekammedis.detailrekammedis')->name('dokter.rekammedis.detail');
});

/*
|--------------------------------------------------------------------------
| PERAWAT
|--------------------------------------------------------------------------
*/
Route::prefix('perawat')->group(function () {
    Route::view('/jadwal/jadwal_jaga', 'perawat.jadwal.jadwal_jaga')->name('perawat.jadwal');
    Route::view('/pasien/data_pasien', 'perawat.pasien.data_pasien')->name('perawat.pasien');
    Route::view('/pemeriksaan/data_pemeriksaan', 'perawat.pemeriksaan.data_pemeriksaan')->name('perawat.pemeriksaan.data');
    Route::view('/pemeriksaan/editpemeriksaan', 'perawat.pemeriksaan.editpemeriksaan')->name('perawat.pemeriksaan.edit');
    Route::view('/pemeriksaan/hapuspemeriksaan', 'perawat.pemeriksaan.hapuspemeriksaan')->name('perawat.pemeriksaan.hapus');
    Route::view('/rekammedis/datarekammedis', 'perawat.rekammedis.datarekammedis')->name('perawat.rekammedis.data');
    Route::view('/rekammedis/inputrekammedis', 'perawat.rekammedis.inputrekammedis')->name('perawat.rekammedis.input');
    Route::view('/rekammedis/prosesinput', 'perawat.rekammedis.prosesinput')->name('perawat.rekammedis.proses');
});

/*
|--------------------------------------------------------------------------
| RESEPSIONIS
|--------------------------------------------------------------------------
*/
Route::prefix('resepsionis')->group(function () {
    Route::view('/pemilik/datapemilik', 'resepsionis.pemilik.datapemilik')->name('resepsionis.pemilik');
    Route::view('/pet/datapet', 'resepsionis.pet.datapet')->name('resepsionis.pet');
    Route::view('/temudokter/temudokter', 'resepsionis.temudokter.temudokter')->name('resepsionis.temudokter');


});

