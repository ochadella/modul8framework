<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\JenisHewanController;
use App\Http\Controllers\RasHewanController;
use App\Http\Controllers\PemilikController; // ✅ Tambahan controller untuk data pemilik
use App\Http\Controllers\PetController; // ✅ Tambahan controller untuk data pet
use App\Http\Controllers\KategoriController; // ✅ Tambahan controller baru untuk data kategori
use App\Http\Controllers\KategoriKlinisController; // ✅ Tambahan controller baru untuk data kategori klinis
use App\Http\Controllers\KodeTindakanController; // ✅ Tambahan controller baru untuk Kode Tindakan

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

// ✅ Halaman Data Master Admin
Route::view('/admin/datamaster', 'admin.datamaster')->name('admin.datamaster');

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
| Detail Layanan Bedah
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
Route::view('/dashboard_admin', 'interface.dashboard')->name('interface.dashboard');
Route::view('/dashboard_dokter', 'interface.dashboard_dokter')->name('interface.dashboard_dokter');
Route::view('/dashboard_perawat', 'interface.dashboard_perawat')->name('interface.dashboard_perawat');
Route::get('/dashboard_resepsionis', [SiteController::class, 'dashboardResepsionis'])->name('dashboard.resepsionis');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ✅ CRUD Kategori (pakai controller biar tampil dari DB)
    |--------------------------------------------------------------------------
    */
    Route::get('/kategori/datakategori', [KategoriController::class, 'index'])->name('admin.kategori.data');
    Route::post('/kategori/datakategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::get('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.delete');

    /*
    |--------------------------------------------------------------------------
    | ✅ CRUD Kategori Klinis (pakai controller biar tampil dari DB)
    |--------------------------------------------------------------------------
    */
    Route::get('/kategoriklinis/datakategoriklinis', [KategoriKlinisController::class, 'index'])->name('admin.kategoriklinis.data');
    Route::post('/kategoriklinis/datakategoriklinis', [KategoriKlinisController::class, 'store'])->name('admin.kategoriklinis.store');
    Route::get('/kategoriklinis/edit/{id}', [KategoriKlinisController::class, 'edit'])->name('admin.kategoriklinis.edit');
    Route::post('/kategoriklinis/update/{id}', [KategoriKlinisController::class, 'update'])->name('admin.kategoriklinis.update');
    Route::get('/kategoriklinis/delete/{id}', [KategoriKlinisController::class, 'destroy'])->name('admin.kategoriklinis.delete');

    /*
    |--------------------------------------------------------------------------
    | ✅ CRUD Kode Tindakan (pakai controller baru)
    |--------------------------------------------------------------------------
    */
    Route::get('/kodetindakan/datatindakan', [KodeTindakanController::class, 'index'])->name('admin.kodetindakan.data');
    Route::post('/kodetindakan/store', [KodeTindakanController::class, 'store'])->name('admin.kodetindakan.store');
    Route::get('/kodetindakan/delete/{id}', [KodeTindakanController::class, 'delete'])->name('admin.kodetindakan.delete');
    Route::view('/kodetindakan/tambahkodetindakan', 'admin.kodetindakan.tambahkodetindakan')->name('admin.kodetindakan.tambah');
    Route::view('/kodetindakan/editkodetindakan', 'admin.kodetindakan.editkodetindakan')->name('admin.kodetindakan.edit');

    // ✅ Role (pakai controller)
    Route::get('/role/manajemenrole', [RoleController::class, 'index'])->name('admin.role.manajemen');
    Route::post('/role/manajemenrole', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('/role/hapus/{iduser}', [RoleController::class, 'destroy'])->name('admin.role.delete');
    Route::view('/role/tambahrole', 'admin.role.tambahrole')->name('admin.role.tambah');
    Route::view('/role/editrole', 'admin.role.editrole')->name('admin.role.edit');

    // ✅ User (pakai controller)
    Route::get('/user/datauser', [UserController::class, 'index'])->name('admin.user.data');
    Route::view('/user/edituser', 'admin.user.edituser')->name('admin.user.edit');
    Route::view('/user/resetpw', 'admin.user.resetpw')->name('admin.user.resetpw');
    Route::get('/user/tambahuser', [UserController::class, 'create'])->name('admin.user.tambah'); // ✅ ini path yang benar
    Route::post('/user/tambahuser', [UserController::class, 'store'])->name('admin.user.store');

});

/*
|--------------------------------------------------------------------------
| DOKTER
|--------------------------------------------------------------------------
*/
Route::prefix('dokter')->group(function () {
    Route::view('/jadwal/jadwal_pemeriksaan', 'dokter.jadwal.jadwal_pemeriksaan')->name('dokter.jadwal');

    // ✅ CRUD Jenis Hewan
    Route::get('/jenis/datajenishewan', [JenisHewanController::class, 'index'])->name('dokter.jenis.data');
    Route::post('/jenis/datajenishewan', [JenisHewanController::class, 'store'])->name('dokter.jenis.store');
    Route::get('/jenis/edit/{id}', [JenisHewanController::class, 'edit'])->name('dokter.jenis.edit');
    Route::post('/jenis/update/{id}', [JenisHewanController::class, 'update'])->name('dokter.jenis.update');
    Route::get('/jenis/hapus/{id}', [JenisHewanController::class, 'destroy'])->name('dokter.jenis.delete');

    // ✅ CRUD Ras Hewan
    Route::get('/ras/datarashewan', [RasHewanController::class, 'index'])->name('dokter.ras.data');
    Route::post('/ras/datarashewan', [RasHewanController::class, 'store'])->name('dokter.ras.store');
    Route::get('/ras/edit/{id}', [RasHewanController::class, 'edit'])->name('dokter.ras.edit');
    Route::post('/ras/update/{id}', [RasHewanController::class, 'update'])->name('dokter.ras.update');
    Route::get('/ras/delete/{id}', [RasHewanController::class, 'destroy'])->name('dokter.ras.delete');

    // Halaman tambahan
    Route::view('/jenis/tambahjenishewan', 'dokter.jenis.tambahjenishewan')->name('dokter.jenis.tambah');
    Route::view('/pasien/datapasiendokter', 'dokter.pasien.datapasiendokter')->name('dokter.pasien');
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
    // ✅ CRUD Data Pemilik
    Route::get('/pemilik/datapemilik', [PemilikController::class, 'index'])->name('resepsionis.pemilik');
    Route::post('/pemilik/datapemilik', [PemilikController::class, 'store'])->name('resepsionis.pemilik.store');
    Route::get('/pemilik/edit/{id}', [PemilikController::class, 'edit'])->name('resepsionis.pemilik.edit');
    Route::post('/pemilik/update/{id}', [PemilikController::class, 'update'])->name('resepsionis.pemilik.update');
    Route::get('/pemilik/delete/{id}', [PemilikController::class, 'destroy'])->name('resepsionis.pemilik.delete');

    // ✅ CRUD Data Pet
    Route::get('/pet/datapet', [PetController::class, 'index'])->name('resepsionis.pet');
    Route::post('/pet/datapet', [PetController::class, 'store'])->name('resepsionis.pet.store');
    Route::get('/pet/edit/{id}', [PetController::class, 'edit'])->name('resepsionis.pet.edit');
    Route::post('/pet/update/{id}', [PetController::class, 'update'])->name('resepsionis.pet.update');
    Route::get('/pet/delete/{id}', [PetController::class, 'destroy'])->name('resepsionis.pet.delete');

    Route::view('/temudokter/temudokter', 'resepsionis.temudokter.temudokter')->name('resepsionis.temudokter');
});
