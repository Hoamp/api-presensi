<?php

use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/siswa', SiswaController::class);
Route::get('/absen/:id', [AbsensiController::class, 'show']);
Route::put('/absen/:id', [AbsensiController::class, 'update']);
Route::apiResource('/absen', AbsensiController::class);
