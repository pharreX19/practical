<?php

use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('photos', PhotoController::class);

    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::post('api-key', [ApiKeyController::class, 'store']);
    Route::post('api-key/{id}/revoke', [ApiKeyController::class, 'revoke']);
    Route::delete('api-key/{id}', [ApiKeyController::class, 'destroy']);
});
