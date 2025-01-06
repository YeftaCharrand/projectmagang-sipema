<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\DosenRoleController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaRoleKaprodiController;
use App\Http\Controllers\PlotingController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('role:kaprodi')->group(function () {
    // ------------------------------------------- DOSEN -------------------------------------------
    // Route untuk menampilkan daftar dosen
    Route::get('/dosen', [DosenController::class, 'indexDosen'])->name('dosen.index');
    // Fitur cari dosen
    Route::get('/dosenn/search', [DosenController::class, 'search'])->name('dosenn.search');
    // Route untuk menyimpan data dosen baru
    Route::post('/dosen', [DosenController::class, 'storeDosen'])->name('dosen.store');
    // Route untuk memperbarui data dosen
    Route::post('/dosen/{kode_dosen}', [DosenController::class, 'updateDosen'])->name('dosen.update');
    // Route untuk menghapus data dosen
    Route::delete('/dosen/{dosen}', [DosenController::class, 'destroyDosen'])->name('dosen.destroy');

    // ------------------------------------------- MAHASISWA -------------------------------------------
    Route::get('/mhs', [MahasiswaRoleKaprodiController::class, 'indexMahasiswa'])->name('mhs.index');
    Route::get('/mhs/search', [MahasiswaRoleKaprodiController::class, 'search'])->name('mhs.search');
    Route::post('/mhs', [MahasiswaRoleKaprodiController::class, 'storeMahasiswa'])->name('mhs.store');
    Route::post('/mhs/{nim}', [MahasiswaRoleKaprodiController::class, 'updateMahasiswa'])->name('mhs.update');
    Route::delete('/mhs/{mahasiswa}', [MahasiswaRoleKaprodiController::class, 'destroyMahasiswa'])->name('mhs.destroy');

    // ------------------------------------------- KELAS -------------------------------------------
    Route::get('/kelas', [KelasController::class, 'indexKelas'])->name('kelas.index');
    Route::get('/kelas/search', [KelasController::class, 'search'])->name('kelas.search');
    Route::post('/kelas', [KelasController::class, 'storeKelas'])->name('kelas.store');
    Route::post('/kelas/{id}', [KelasController::class, 'updateKelas'])->name('kelas.update');
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroyKelas'])->name('kelas.destroy');

    // ------------------------------------------- PLOTING -------------------------------------------
    Route::get('/plotting', [PlotingController::class, 'indexPlot'])->name('plotting.index');
    // Route untuk menampilkan daftar plotting
    Route::post('/plotting/dosen/update', [PlotingController::class, 'updateKelasDosen'])->name('plotting.updateKelasDosen');
    // Route untuk menghapus dosen di plotting
    Route::delete('/plotting/dosen/destroy/{id}', [PlotingController::class, 'destroyKelasDosen'])->name('plotting.destroyKelasDosen');
    // Route untuk mengupdate kelas mahasiswa
    Route::post('/plotting/mahasiswa/update', [PlotingController::class, 'updateKelasMahasiswa'])->name('plotting.updateKelasMahasiswa');
    // Route untuk menghapus mahasiswa di plotting
    Route::delete('/plotting/mahasiswa/destroy/{id}', [PlotingController::class, 'destroyKelasMahasiswa'])->name('plotting.destroyKelasMahasiswa');
});

Route::middleware('role:mahasiswa')->group(function () {
    Route::get('/profilemahasiswa', [MahasiswaController::class, 'profilemahasiswa'])->name('mahasiswa.profilemahasiswa');
    Route::post('/requests', [MahasiswaController::class, 'store'])->name('requests.store');
    Route::post('/mahasiswa/{id}/update', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::post('/mahasiswa/{id}/update', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::post('/profilemahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
});

Route::middleware(['auth', 'dosen'])->group(function () {
    Route::get('/dosenrole', [DosenRoleController::class, 'index'])->name('dosenrole.index');
    Route::get('/mahasiswa', [DosenRoleController::class, 'filterByClass'])->name('dosen.filterByClass');
    Route::get('/requestmhs', [DosenRoleController::class, 'Request'])->name('request.index');
    Route::get('/dosen/search', [DosenRoleController::class, 'search'])->name('dosen.search');
    Route::get('/dosen/searchmhs', [DosenRoleController::class, 'searchmhs'])->name('dosen.searchmhs');
    Route::post('/requestAcc', [DosenRoleController::class, 'UpdateEdit'])->name('update.request');
    Route::get('/dosen/create', [DosenRoleController::class, 'create'])->name('dosenrole.create');
    Route::post('/dosen/store', [DosenRoleController::class, 'store'])->name('dosenrole.store');
    Route::get('/dosen/edit/{id}', [DosenRoleController::class, 'edit'])->name('dosenrole.edit');
    Route::post('/dosen/update/{id}', [DosenRoleController::class, 'update'])->name('dosenrole.update');
    Route::post('/dosen/updatekelas/{id}', [DosenRoleController::class, 'destroy'])->name('dosenrole.destroykelas');
    Route::delete('/dosen/hapus/{id}', [DosenRoleController::class, 'destroy'])->name('dosenrole.destroy');
    Route::post('/dosen/updatedosen/{id}', [DosenRoleController::class, 'updateDosen'])->name('dosenrole.updatedosen');
});

