<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PeminjamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        if ($role == 'admin') return redirect()->route('admin.dashboard');
        if ($role == 'petugas') return redirect()->route('petugas.dashboard');
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- GRUP ADMIN (Hanya Admin yang bisa akses ini) ---
        Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Route admin Kategori 
        Route::get('/admin/kategori', [AdminController::class, 'kategori'])->name('admin.kategori');
        Route::post('/admin/kategori', [AdminController::class, 'storeKategori'])->name('admin.kategori.store');
        Route::delete('/admin/kategori/{id}', [AdminController::class, 'destroyKategori'])->name('admin.kategori.destroy');
        Route::get('/admin/kategori/{id}/edit', [AdminController::class, 'editKategori'])->name('admin.kategori.edit');
        Route::put('/admin/kategori/{id}', [AdminController::class, 'updateKategori'])->name('admin.kategori.update');

        //route admin alat
        Route::get('/admin/alat', [AdminController::class, 'alat'])->name('admin.alat');
        Route::post('/admin/alat', [AdminController::class, 'storeAlat'])->name('admin.alat.store');
        Route::delete('/admin/alat/{id}', [AdminController::class, 'destroyAlat'])->name('admin.alat.destroy');
        Route::get('/admin/alat/{id}/edit', [AdminController::class, 'editAlat'])->name('admin.alat.edit');
        Route::put('/admin/alat/{id}', [AdminController::class, 'updateAlat'])->name('admin.alat.update');

        //route admin user
        Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
        Route::post('/admin/user', [AdminController::class, 'storeUser'])->name('admin.user.store');
        Route::delete('/admin/user/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
        Route::get('/admin/user/{id}/edit', [AdminController::class, 'editUser'])->name('admin.user.edit');
        Route::put('/admin/user/{id}', [AdminController::class, 'updateUser'])->name('admin.user.update');

        //route admin peminjaman
        Route::get('/admin/peminjaman', [AdminController::class, 'peminjaman'])->name('admin.peminjaman');
        Route::delete('/admin/peminjaman/{id}', [AdminController::class, 'destroyPeminjaman'])->name('admin.peminjaman.destroy');
        Route::get('/admin/peminjaman/cetak', [AdminController::class, 'cetakPeminjaman'])->name('admin.peminjaman.cetak');
    });

    // PETUGAS ---
        Route::middleware(['role:petugas'])->group(function () {
            Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
            Route::patch('/petugas/approve/{id}', [PetugasController::class, 'approve'])->name('petugas.approve');
            Route::patch('/petugas/reject/{id}', [PetugasController::class, 'reject'])->name('petugas.reject');
            Route::patch('/petugas/return/{id}', [PetugasController::class, 'return'])->name('petugas.return');
        });

    // --- GRUP PEMINJAM ---
    Route::middleware(['role:peminjam'])->group(function () {
        Route::get('/dashboard', [PeminjamController::class, 'index'])->name('dashboard');
        Route::post('/pinjam',[PeminjamController::class, 'store'])->name('pinjam.store');
        Route::get('/riwayat', [PeminjamController::class, 'riwayat'])->name('peminjam.riwayat');
    });
});

require __DIR__.'/auth.php';