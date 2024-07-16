<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
      'APP_NAME' =>  env('APP_NAME'),
      'API_URL' =>  env('API_URL'),
    ]);
});
