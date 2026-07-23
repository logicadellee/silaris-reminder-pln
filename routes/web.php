<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/pelanggan/import', [PelangganController::class, 'importForm'])
        ->name('pelanggan.import.form');

    Route::post('/pelanggan/import', [PelangganController::class, 'import'])
        ->name('pelanggan.import');

    Route::resource('pelanggan', PelangganController::class);

    Route::resource('tagihan', TagihanController::class);

    Route::get('/tagihan/{id}/reminder', [TagihanController::class, 'reminder'])
        ->name('tagihan.reminder');

    Route::post('/tagihan/{id}/send', [TagihanController::class, 'sendReminder'])
        ->name('tagihan.send');

    Route::resource('reminder', ReminderController::class);

    Route::resource('riwayat', RiwayatController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';