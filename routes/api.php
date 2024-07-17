<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
    Route::prefix('auth')->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
    });

});


Route::post('/employees/{provider}', [EmployeeController::class, 'store'])->middleware('auth:sanctum');


