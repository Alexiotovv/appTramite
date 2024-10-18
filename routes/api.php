<?php

use App\Enums\TokenAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NivelesController;

Route::prefix('/v1/')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->middleware('throttle:login');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('refresh-token', [AuthController::class, 'refreshTokens'])->middleware('auth:sanctum', 'abilities:' . TokenAbility::REFRESH_ACCESS_TOKEN->value);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//users
//Route::post('/v1/profile', function () { return auth()->user(); })->middleware('auth:sanctum');
Route::patch('/v1/user/change_status/{user_id}', [UserController::class,'change_status'])->middleware('auth:sanctum');
Route::post('/v1/user/store', [UserController::class,'store'])->middleware('auth:sanctum');
Route::get('/v1/users', [UserController::class,'users'])->middleware('auth:sanctum');
Route::put('/v1/user/update/{id}', [UserController::class,'update'])->middleware('auth:sanctum');
Route::get('/v1/users/index', [UserController::class,'index'])->middleware('auth:sanctum');

// Niveles
Route::get('/v1/niveles/', [NivelesController::class, 'index'])->middleware('auth:sanctum');
Route::get('/v1/nivel/show/{id}', [NivelesController::class, 'show'])->middleware('auth:sanctum');
Route::post('/v1/nivel/store', [NivelesController::class, 'store'])->middleware('auth:sanctum');
Route::put('/v1/nivel/update/{id}', [NivelesController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/v1/niveles/{id}', [NivelesController ::class, 'destroy'])->middleware('auth:sanctum');