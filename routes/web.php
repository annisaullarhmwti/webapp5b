<?php

use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use Illuminate\Support\Facades\Route;

// Halaman untuk tamu yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])
        ->name('login.attempt');
});

    // Halaman internal yang hanya bisa diakses setelah login
    Route::middleware(['auth', 'prevent-back'])->group(function () {

    // Halaman utama diarahkan ke dashboard
    Route::get('/', fn () => redirect()->route('dashboard'));

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Data mahasiswa
    // 1. Endpoint JSON DataTables
    Route::get('/mahasiswa/data', [MahasiswaController::class, 'data'])
        ->name('mahasiswa.data');

    // 2. Tambah, ubah, dan hapus: khusus admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class)
            ->except(['index', 'show']);
    });

    // 3. Daftar dan detail: semua pengguna yang sudah login
    Route::resource('mahasiswa', MahasiswaController::class)
        ->only(['index', 'show']);

    // Data Mata Kuliah
    // 1. Endpoint JSON DataTables
    Route::get('/mata-kuliah/data', [MataKuliahController::class, 'data'])
        ->name('matakuliah.data');

    // 2. Tambah, ubah, dan hapus: khusus admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('mata-kuliah', MataKuliahController::class)
            ->except(['index', 'show'])
            ->parameters(['mata-kuliah' => 'mata_kuliah'])
            ->names('matakuliah');
    });

    // 3. Daftar dan detail: semua pengguna yang sudah login
    Route::resource('mata-kuliah', MataKuliahController::class)
        ->only(['index', 'show'])
        ->parameters(['mata-kuliah' => 'mata_kuliah'])
        ->names('matakuliah');

    // Data KRS
    // 1. Endpoint JSON DataTables
    Route::get('/krs/data', [KrsController::class, 'data'])
        ->name('krs.data');

    // 2. Tambah, ubah, dan hapus: khusus admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('krs', KrsController::class)
            ->except(['index', 'show']);
    });

    // 3. Daftar dan detail: semua pengguna yang sudah login
    Route::resource('krs', KrsController::class)
        ->only(['index', 'show']);

    // Halaman beranda
    Route::get('/beranda', [BerandaController::class, 'index'])
        ->name('beranda');

    // Data Dosen (Jobsheet 11)

    // 1. Endpoint JSON DataTables: harus di atas route {dosen}
    Route::get('/dosen/data', [DosenController::class, 'data'])
        ->name('dosen.data');

    // 2. Tambah, ubah, dan hapus: khusus admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('dosen', DosenController::class)
            ->except(['index', 'show']);
    });

    // 3. Daftar dan detail: semua pengguna yang sudah login
    Route::resource('dosen', DosenController::class)
        ->only(['index', 'show']);

    // Manajemen pengguna khusus admin
    Route::get('/pengguna', [PenggunaController::class, 'index'])
        ->middleware('role:admin')
        ->name('pengguna.index');
});