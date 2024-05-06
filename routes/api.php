<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [LoginController::class, 'submit']);
Route::post('/login/verify', [LoginController::class, 'verify']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('/driver', [DriverController::class,'show']);
    Route::post('/driver', [DriverController::class,'update']);

    Route::post('/trip', [TripController::class,'']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
