<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PertanyaanController;
use App\Http\Controllers\LandingPageController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk konsultasi (bisa diakses oleh siapa saja, termasuk guest)
    Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.form');
    Route::post('/konsultasi/proses', [KonsultasiController::class, 'process'])->name('konsultasi.process');


    // Route baru untuk riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{id}', [RiwayatController::class, 'show'])->name('riwayat.show');
    Route::delete('/riwayat/{id}', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');
    
});


// admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Semua route admin harus berada di dalam sini
    Route::resource('jurusan', JurusanController::class);
    Route::resource('pertanyaan', PertanyaanController::class);
});

require __DIR__.'/auth.php';
