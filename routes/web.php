<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('alats', AlatController::class);
    Route::get('/reports/peminjaman', [ReportController::class, 'peminjamanReport'])->name('reports.peminjaman');
    Route::get('/reports/pengembalian', [ReportController::class, 'pengembalianReport'])->name('reports.pengembalian');
    Route::get('/reports/alat', [ReportController::class, 'alatReport'])->name('reports.alat');
    Route::get('/reports/user', [ReportController::class, 'userReport'])->name('reports.user');
});

// Operator Routes
Route::middleware(['auth', 'operator'])->group(function () {
    Route::get('/peminjamans/approve', [PeminjamanController::class, 'indexApprove'])->name('peminjamans.approve-list');
    Route::post('/peminjamans/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('peminjamans.approve');
    Route::post('/peminjamans/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('peminjamans.reject');
    Route::post('/pengembalians/{pengembalian}/confirm', [PengembalianController::class, 'confirm'])->name('pengembalians.confirm');
});

// Member & Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::resource('peminjamans', PeminjamanController::class);
    Route::resource('pengembalians', PengembalianController::class, ['except' => ['create', 'store']]);
    Route::get('/alats/list', [AlatController::class, 'listAlat'])->name('alats.list');
    Route::get('/pengembalian-barang', [PengembalianController::class, 'formPengembalian'])->name('pengembalians.form');
});

// Member Only Routes for Pengembalian Create
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/pengembalians/create', [PengembalianController::class, 'create'])->name('pengembalians.create');
    Route::post('/pengembalians', [PengembalianController::class, 'store'])->name('pengembalians.store');
});

require __DIR__.'/auth.php';
