<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\HonorController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PengaturanController;
use Illuminate\Support\Facades\Route;


// Public Routes (bisa diakses tanpa login)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Auth Routes (ditangani oleh auth.php)
require __DIR__.'/auth.php';

// Protected Routes (harus login)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Karyawan Routes
    Route::resource('karyawan', KaryawanController::class);
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');

    // User Routes
    Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Jabatan Routes
    Route::resource('jabatan', JabatanController::class);
    Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');

    // Absensi Routes
    Route::resource('absensi', AbsensiController::class);
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('absensi/masuk', [AbsensiController::class, 'absenMasuk'])->name('absensi.masuk');
    Route::get('absensi/keluar/{id}', [AbsensiController::class, 'absenKeluar'])->name('absensi.keluar');

    // Perizinan Routes
    Route::resource('perizinan', PerizinanController::class);
    Route::get('/perizinan', [PerizinanController::class, 'index'])->name('perizinan.index');

    // Honor Routes
    Route::resource('honor', HonorController::class);
    Route::get('/honor', [HonorController::class, 'index'])->name('honor.index');

    // Penggajian Routes
    Route::resource('penggajian', PenggajianController::class);
    Route::get('/penggajian', [PenggajianController::class, 'index'])->name('penggajian.index');

    // Surat Routes
    Route::resource('surat', SuratController::class);
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/surat/{id}/download', [SuratController::class, 'download'])->name('surat.download');

    // Pengaturan Routes
    Route::resource('pengaturan', PengaturanController::class);
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    
    // Rekening Routes
    Route::resource('rekening', RekeningController::class);
    Route::resource('rekening', RekeningController::class)->only(['index','store','destroy']);
    
    //AREA
    Route::resource('area', AreaController::class);
    Route::get('/area', [AreaController::class, 'index'])->name('area.index');


});