<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\TempatController;

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

Route::middleware('auth:sanctum')->get('/user', function(Request $request){
    return $request->user();
});

// public route

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/mobil', [MobilController::class, 'index']);
Route::get('/tempat', [TempatController::class, 'index']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/mobils', MobilController::class)->except('create', 'edit', 'show', 'index');
    Route::get('/mobil/{id}', [MobilController::class, 'show']);
    Route::resource('/tempats', TempatController::class)->except('create', 'edit', 'show', 'index');
    Route::get('/tempat/{id}', [TempatController::class, 'show']);
});
