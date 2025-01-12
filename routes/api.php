<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\LocationController;



Route::middleware(['throttle:5,1'])->post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'throttle:10,1'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/weather', [WeatherController::class, 'getWeather']);
    Route::post('/location', [LocationController::class, 'saveLocation']);
    Route::get('/locations', [LocationController::class, 'getUserLocations']);
    Route::delete('/location/{id}', [LocationController::class, 'deleteLocation']);
});