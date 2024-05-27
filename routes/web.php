<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;

Route::resource('kelas', KelasController::class);

Route::get('gurus', [GuruController::class, 'index'])->name('gurus.index');
Route::post('gurus', [GuruController::class, 'store'])->name('gurus.store');
Route::post('gurus/{guru}', [GuruController::class, 'update'])->name('gurus.update');
Route::delete('gurus/{guru}', [GuruController::class, 'destroy'])->name('gurus.destroy');
Route::get('/gurus/search', [GuruController::class, 'search'])->name('gurus.search');


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

