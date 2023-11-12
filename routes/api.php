<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\AktivitasDariUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BMIController;
use App\Http\Controllers\BMRController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\GulaDarahController;
use App\Http\Controllers\Hba1cController;
use App\Http\Controllers\KolesterolController;
use App\Http\Controllers\KonsumsiMakananController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\TekananDarahController;
use App\Http\Controllers\UserRecordDataController;
use App\Models\AktivitasDariUser;
use App\Models\KonsumsiMakanan;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Register User
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/account', [AuthController::class, 'accountData']);
    Route::patch('/update-profile', [AuthController::class, 'updateProfile']);

    // USER RECORD DATA
    Route::get('/user-record-data', [UserRecordDataController::class, 'index']);
    Route::post('/user-record-data', [UserRecordDataController::class, 'store']);
    Route::get('/user-record-data/{id}', [UserRecordDataController::class, 'show']);
    Route::patch('/user-record-data/{id}', [UserRecordDataController::class, 'update']);
    Route::delete('/user-record-data/{id}', [UserRecordDataController::class, 'destroy']);

    // ACTIVITAS
    Route::get('/aktivitas', [AktivitasController::class, 'index']);
    // --- aktivitas dari User
    Route::get('/aktivitas-user', [AktivitasDariUserController::class, 'index']);
    Route::post('/aktivitas-user', [AktivitasDariUserController::class, 'store']);
    Route::patch('/aktivitas-user/{id}', [AktivitasDariUserController::class, 'update']);
    Route::delete('/aktivitas-user/{id}', [AktivitasDariUserController::class, 'destroy']);

    // DIARY DATA
    Route::get('/diaries', [DiaryController::class, 'index']);
    Route::post('/diaries', [DiaryController::class, 'store']);
    Route::get('/diaries/{id}', [DiaryController::class, 'show']);
    Route::patch('/diaries/{id}', [DiaryController::class, 'update']);
    Route::delete('/diaries/{id}', [DiaryController::class, 'destroy']);

    // BMI
    Route::post('/hitung-bmi', [BMIController::class, 'store']);
    Route::get('/bmi', [BMIController::class, 'index']);

    // BMR
    Route::post('/hitung-bmr', [BMRController::class, 'store']);
    Route::get('/bmr', [BMRController::class, 'index']);

    // Gula Darah
    Route::post('/hitung-gula-darah', [GulaDarahController::class, 'store']);
    Route::get('/gula-darah', [GulaDarahController::class, 'index']);

    // HBA1C
    Route::post('/hitung-hba1c', [Hba1cController::class, 'store']);
    Route::get('/hba1c', [Hba1cController::class, 'index']);

    // TEKANAN DARAH
    Route::post('/hitung-tekanan-darah', [TekananDarahController::class, 'store']);
    Route::get('/tekanan-darah', [TekananDarahController::class, 'index']);

    // KONSUMSI MAKANAN
    Route::post('/tambah-konsumsi-makanan', [KonsumsiMakananController::class, 'store']);
    Route::get('/konsumsi-makanan', [KonsumsiMakananController::class, 'index']);

    // KOLESTEROL
    Route::post('/hitung-kolsterol', [KolesterolController::class, 'store']);
    Route::get('/kolesterol', [KolesterolController::class, 'index']);

    //  REKAP
    Route::get('/rekap', [RekapController::class, 'index']);
    Route::post('/tambah-rekap', [RekapController::class, 'store']);
    Route::get('/rekap/{id}', [RekapController::class, 'show']);
});
