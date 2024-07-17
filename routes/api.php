<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureProviderIsValid;

Route::controller(AuthController::class)->group(function(){
    Route::prefix('auth')->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
    });

});

Route::middleware([EnsureProviderIsValid::class, 'auth:sanctum'])->group(function () {
    Route::post('/{provider}/employees', [EmployeeController::class, 'store']);
    Route::put('/{provider}/employees//{employee}', [EmployeeController::class, 'update']);
});



