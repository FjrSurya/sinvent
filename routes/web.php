<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('login.login');
});

Route::get('/login', [Controllers\LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('login', [Controllers\LoginController::class,'authenticate']);
Route::post('/logout', [Controllers\LoginController::class,'logout'])->name('logout');
Route::get('/register', [Controllers\RegisterController::class, 'create'])->name('register');
Route::post('register', [Controllers\RegisterController::class, 'store']);

Route::resource('/v_dashboard', Controllers\DashboardController::class)->middleware('auth');
Route::resource('v_kategori', Controllers\KategoriController::class)->middleware('auth');
Route::resource('v_barang', Controllers\BarangController::class)->middleware('auth');
Route::resource('brmasuk', Controllers\BrmasukController::class)->middleware('auth');
Route::resource('brkeluar', Controllers\BrkeluarController::class)->middleware('auth');

Route::get('kategori/search', [Controllers\KategoriController::class, 'search'])->name('kategori.search');
Route::get('barang/search', [Controllers\BarangController::class, 'search'])->name('barang.search');
Route::get('brmasuk/search', [Controllers\BrmasukController::class, 'search'])->name('brmasuk.search');
Route::get('brkeluar/search', [Controllers\BrkeluarController::class, 'search'])->name('brkeluar.search');