<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pengguna', [DashboardController::class, 'user'])->name('user');
    Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index');
    Route::post('/mobil', [MobilController::class, 'create'])->name('mobil.create');
    Route::patch('/mobil/{id}', [MobilController::class, 'edit'])->name('mobil.edit');
    Route::delete('/mobil/{id}', [MobilController::class, 'delete'])->name('mobil.delete');
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    // Route::patch('/mobil', [MobilController::class, 'edit'])->name('mobil.edit');
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'delete'])->name('peminjaman.delete');
    Route::delete('/pengembalian/{id}', [PengembalianController::class, 'delete'])->name('pengembalian.delete');
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian', [PengembalianController::class, 'create'])->name('pengembalian.create');
});
