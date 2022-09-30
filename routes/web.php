<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/', [KasController::class, 'index'])->name('home')->middleware('auth');
Route::get('/log_hapus', [KasController::class, 'log_hapus'])->name('log_hapus')->middleware('auth');
Route::post('/tambah_data', [KasController::class, 'tambah_data'])->name('tambah_data')->middleware('auth');
Route::get('/hapus_kas/{id}', [KasController::class, 'hapus_kas'])->name('hapus.kas')->middleware('auth');
Route::get('/undo_kas/{id}', [KasController::class, 'undo_kas'])->name('hapus.kas')->middleware('auth');