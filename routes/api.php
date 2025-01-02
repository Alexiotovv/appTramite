<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;


Route::prefix('/v1/disk/uploads/')->group(function(){
    Route::get('template/{path}', [FileController::class, 'templates']);
});

Route::prefix('/v1/')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->middleware('throttle:login');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('refresh-token', [AuthController::class, 'refreshTokens'])->middleware('auth:sanctum', 'abilities:refresh-access-token');
});
Route::prefix('v1/transaction/')->group(function(){
    Route::get('reception-desk', [TransactionController::class, 'retriveReceptionDesk'])->middleware('auth:sanctum');
});
Route::prefix('/v1/public/')->group(function(){
    Route::get('list/office/reception-desk', [OfficeController::class, 'getReceptionDesk']);
    Route::post('reception-desk/transaction', [TransactionController::class, 'storeReceptionDesk']);
});

Route::middleware('auth:sanctum', 'abilities:operation-api-token')->group(function(){
    Route::prefix('/v1/maintenance')->group(function(){
        Route::get('/template', [TemplateController::class, 'list']);
    });
});