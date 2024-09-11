<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DvdController;
use App\Http\Controllers\PeminjamanController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('manajemen-dvd', DvdController::class);

// Menampilkan form peminjaman
Route::get('peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');

// Menyimpan data peminjaman
Route::post('peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
