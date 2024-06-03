<?php

use App\Http\Controllers\LaporanController;
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




Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// Akun
Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index']);
Route::get('/akun/create', [App\Http\Controllers\AkunController::class, 'create']);
Route::post('/akun/store', [App\Http\Controllers\AkunController::class, 'store']);
Route::get('/akun/edit/{id}', [App\Http\Controllers\AkunController::class, 'edit']);
Route::patch('/akun/update/{id}', [App\Http\Controllers\AkunController::class, 'update']);
Route::delete('/akun/delete/{id}', [App\Http\Controllers\AkunController::class, 'delete']);

// Pelanggan
Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index']);
Route::get('/pelanggan/create', [App\Http\Controllers\PelangganController::class, 'create']);
Route::post('/pelanggan/store', [App\Http\Controllers\PelangganController::class, 'store']);
Route::get('/pelanggan/edit/{id}', [App\Http\Controllers\PelangganController::class, 'edit']);
Route::get('/pelanggan/view/{id}', [App\Http\Controllers\PelangganController::class, 'view']);
Route::patch('/pelanggan/update/{id}', [App\Http\Controllers\PelangganController::class, 'update']);
Route::delete('/pelanggan/delete/{id}', [App\Http\Controllers\PelangganController::class, 'delete']);

// Jenis
Route::get('/jenis', [App\Http\Controllers\JenisController::class, 'index']);
Route::get('/jenis/create', [App\Http\Controllers\JenisController::class, 'create']);
Route::post('/jenis/store', [App\Http\Controllers\JenisController::class, 'store']);
Route::get('/jenis/edit/{id}', [App\Http\Controllers\JenisController::class, 'edit']);
Route::get('/jenis/view/{id}', [App\Http\Controllers\JenisController::class, 'view']);
Route::patch('/jenis/update/{id}', [App\Http\Controllers\JenisController::class, 'update']);
Route::delete('/jenis/delete/{id}', [App\Http\Controllers\JenisController::class, 'delete']);


// Alat
Route::get('/alat', [App\Http\Controllers\AlatController::class, 'index']);
Route::get('/alat/create', [App\Http\Controllers\AlatController::class, 'create']);
Route::post('/alat/store', [App\Http\Controllers\AlatController::class, 'store']);
Route::get('/alat/edit/{id}', [App\Http\Controllers\AlatController::class, 'edit']);
Route::patch('/alat/update/{id}', [App\Http\Controllers\AlatController::class, 'update']);
Route::delete('/alat/delete/{id}', [App\Http\Controllers\AlatController::class, 'delete']);

// Rental
Route::get('/rental', [App\Http\Controllers\PenyewaanController::class, 'index']);
Route::get('/rental/create', [App\Http\Controllers\PenyewaanController::class, 'create']);
Route::post('/rental/store', [App\Http\Controllers\PenyewaanController::class, 'store']);
Route::get('/rental/edit/{id}', [App\Http\Controllers\PenyewaanController::class, 'edit']);
Route::patch('/rental/update/{id}', [App\Http\Controllers\PenyewaanController::class, 'update']);
Route::delete('/rental/delete/{id}', [App\Http\Controllers\PenyewaanController::class, 'delete']);
Route::get('/rental/kwintansi/{id}', [App\Http\Controllers\PenyewaanController::class, 'kwintansi']);

// Pengembalian
Route::get('/pengembalian', [App\Http\Controllers\PengembalianController::class, 'index']);
Route::get('/pengembalian/create', [App\Http\Controllers\PengembalianController::class, 'create']);
Route::post('/pengembalian/store', [App\Http\Controllers\PengembalianController::class, 'store']);
Route::get('/pengembalian/edit/{id}', [App\Http\Controllers\PengembalianController::class, 'edit']);
Route::patch('/pengembalian/update/{id}', [App\Http\Controllers\PengembalianController::class, 'update']);
Route::delete('/pengembalian/delete/{id}', [App\Http\Controllers\PengembalianController::class, 'delete']);
Route::get('/pengembalian/view/{id}', [App\Http\Controllers\PengembalianController::class, 'view']);
Route::get('/pengembalian/kwintansi/{id}', [App\Http\Controllers\PengembalianController::class, 'kwintansi']);

// Laporan cetakRental
Route::get('/laporan-alat', [LaporanController::class, 'cetakAlat']);
Route::get('/laporan-alat-detail/{id}', [LaporanController::class, 'cetakAlatRiwayat']);

Route::get('/laporan-rental', [LaporanController::class, 'cetakRental']);
Route::get('/laporan-rental-pertanggal/{tanggal_sewa}/{tanggal_kembali}', [App\Http\Controllers\LaporanController::class, 'cetakRentalPertanggal']);

Route::get('/laporan-pengembalian', [LaporanController::class, 'cetakPengembalian']);
Route::get('/laporan-pengembalian-pertanggal/{tanggal_sewa}/{tanggal_pengembalian}', [App\Http\Controllers\LaporanController::class, 'cetakPengembalianPertanggal']);
