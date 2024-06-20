<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('create', [KategoriController::class, 'createAPIKategori']);
Route::get('/show', [KategoriController::class, 'showAPIKategori']);
Route::get('/detail/{id}', [KategoriController::class, 'detailAPIKategori']);
Route::post('update/{kategori_id}', [KategoriController::class, 'updateAPIKategori']);
Route::delete('delete/{kategori_id}', [KategoriController::class, 'deleteAPIKategori']);