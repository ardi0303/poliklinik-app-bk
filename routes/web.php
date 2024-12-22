<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Dokter\DetailPeriksaController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\PeriksaController;
use App\Http\Controllers\Dokter\ProfilController;
use App\Http\Controllers\Pasien\DaftarPoliController;
use App\Models\Obat;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
  return view('welcome');
});
Route::get('/login', [AuthController::class, 'login'])->name('loginForm')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->name('registerForm')->middleware('guest');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('login');
Route::post('/register', [AuthController::class, 'handleRegisterPasien'])->name('register');
Route::post('/logout', [AuthController::class, 'handleLogout'])->name('logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::group(['middleware' => 'checkAdmin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/dokter', [DokterController::class, 'getDokter'])->name('dokter');
    Route::post('/dokter', [DokterController::class, 'addDokter'])->name('dokter.store');
    Route::put('/dokter/{id}', [DokterController::class, 'updateDokter'])->name('dokter.update');
    Route::delete('/dokter/{id}', [DokterController::class, 'deleteDokter'])->name('dokter.delete');

    Route::get('/pasien', [PasienController::class, 'getPasien'])->name('pasien');
    Route::post('/pasien', [PasienController::class, 'addPasien'])->name('pasien.store');
    Route::put('/pasien/{id}', [PasienController::class, 'updatePasien'])->name('pasien.update');
    Route::delete('/pasien/{id}', [PasienController::class, 'deletePasien'])->name('pasien.delete');

    Route::get('/poli', [PoliController::class, 'getPoli'])->name('poli');
    Route::post('/poli', [PoliController::class, 'addPoli'])->name('poli.store');
    Route::put('/poli/{id}', [PoliController::class, 'updatePoli'])->name('poli.update');
    Route::delete('/poli/{id}', [PoliController::class, 'deletePoli'])->name('poli.delete');

    Route::get('/obat', [ObatController::class, 'getObat'])->name('obat');
    Route::post('/obat', [ObatController::class, 'addObat'])->name('obat.store');
    Route::put('/obat/{id}', [ObatController::class, 'updateObat'])->name('obat.update');
    Route::delete('/obat/{id}', [ObatController::class, 'deleteObat'])->name('obat.delete');
  });
});

Route::group(['prefix' => 'dokter', 'as' => 'dokter.'], function () {
  Route::group(['middleware' => 'auth:dokter'], function () {
    Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dashboard');

    Route::get('/jadwal-periksa', [JadwalPeriksaController::class, 'getJadwalPeriksa'])->name('jadwal-periksa');
    Route::post('/jadwal-periksa', [JadwalPeriksaController::class, 'addJadwalPeriksa'])->name('jadwal-periksa.store');
    Route::put('/jadwal-periksa/{id}', [JadwalPeriksaController::class, 'updateJadwalPeriksa'])->name('jadwal-periksa.update');
    Route::delete('/jadwal-periksa/{id}', [JadwalPeriksaController::class, 'deleteJadwalPeriksa'])->name('jadwal-periksa.delete');

    Route::get('/periksa', [PeriksaController::class, 'getDaftarPoli'])->name('periksa');
    Route::post('/periksa', [PeriksaController::class, 'addPeriksa'])->name('periksa.store');
    Route::put('/periksa/{id}', [PeriksaController::class, 'updatePeriksa'])->name('periksa.update');

    Route::get('/riwayat-periksa', [DetailPeriksaController::class, 'getRiwayatPeriksa'])->name('riwayat-periksa');

    Route::get('/profil', [ProfilController::class, 'getProfil'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'updateProfil'])->name('profil.update');
  });
});

Route::group(['prefix' => 'pasien', 'as' => 'pasien.'], function () {
  Route::group(['middleware' => 'auth:pasien'], function () {
    Route::get('/dashboard', function () {
      return view('pasien.dashboard');
    })->name('dashboard');
    Route::get('daftar-poli', [DaftarPoliController::class, 'getDaftarPoli'])->name('daftar-poli');
    Route::get('jadwal-periksa/{id_poli}', [DaftarPoliController::class, 'getJadwalByPoli']);
    Route::post('daftar-poli', [DaftarPoliController::class, 'addDaftarPoli'])->name('daftar-poli.store');
  });
});
