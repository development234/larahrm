<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

// Simple test route
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

// Test route karyawan sederhana
Route::get('/api/karyawan/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'Karyawan API is working!'
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Routes sederhana tanpa nested prefix
Route::get('/api/absensi/list', [ApiController::class, 'getAbsensi']);
Route::post('/api/absensi/create', [ApiController::class, 'createAbsensi']);
Route::get('/api/absensi/detail/{id}', [ApiController::class, 'getAbsensiById']);
Route::put('/api/absensi/update/{id}', [ApiController::class, 'updateAbsensi']);
Route::delete('/api/absensi/delete/{id}', [ApiController::class, 'deleteAbsensi']);

// Karyawan routes
Route::get('/api/karyawan/list', [ApiController::class, 'getKaryawan']);
Route::get('/api/karyawan/detail/{id}', [ApiController::class, 'getKaryawanById']);
Route::post('/api/karyawan/create', [ApiController::class, 'createKaryawan']);
Route::put('/api/karyawan/update/{id}', [ApiController::class, 'updateKaryawan']);
Route::delete('/api/karyawan/delete/{id}', [ApiController::class, 'deleteKaryawan']);
Route::post('/api/karyawan/login', [ApiController::class, 'loginKaryawan']);