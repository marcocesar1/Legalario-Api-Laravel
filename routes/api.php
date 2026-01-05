<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::resource('customers', App\Http\Controllers\CustomerController::class);
        Route::get('countries', [App\Http\Controllers\CountryController::class, 'index']);
    });

});