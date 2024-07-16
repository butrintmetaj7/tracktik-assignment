<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
    Route::prefix('auth')->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
    });

});

Route::post('/employees/{provider}', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


