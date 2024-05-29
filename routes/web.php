<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Models\Siswa;

Route::resource('kelas', KelasController::class);

Route::get('siswas', [SiswaController::class, 'index'])->name('siswas.index');
Route::post('siswas', [SiswaController::class, 'store'])->name('siswas.store');
Route::post('siswas/{siswa}', [SiswaController::class, 'update'])->name('siswas.update');
Route::delete('siswas/{siswa}', [SiswaController::class, 'destroy'])->name('siswas.destroy');

Route::resource('siswa', SiswaController::class);

Route::get('gurus', [GuruController::class, 'index'])->name('gurus.index');
Route::post('gurus', [GuruController::class, 'store'])->name('gurus.store');
Route::post('gurus/{guru}', [GuruController::class, 'update'])->name('gurus.update');
Route::delete('gurus/{guru}', [GuruController::class, 'destroy'])->name('gurus.destroy');

Route::resource('guru', GuruController::class);


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

