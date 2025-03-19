<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Route untuk autentikasi
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']); // Pendaftaran anggota
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Route untuk anggota dan absensi
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/absen', [AbsensiController::class, 'store']);
    Route::get('/lomba', [LombaController::class, 'index']);
    Route::post('/lomba/ajukan', [LombaController::class, 'ajukanLomba']);
    Route::get('/pengumuman', [PengumumanController::class, 'index']);
});

// Route khusus admin untuk mengelola anggota, lomba, dan pengumuman
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/anggota', [AnggotaController::class, 'index']);
    Route::post('/anggota/verifikasi/{id}', [AnggotaController::class, 'verifikasi']);
    Route::get('/lomba/kelola', [LombaController::class, 'kelola']);
    Route::post('/pengumuman', [PengumumanController::class, 'store']);
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update']);
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy']);
});