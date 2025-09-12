<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'store'])
    ->name('login');

Route::group(['middleware' => ['auth:sanctum']], function() {

    require __DIR__ . '/APIs/api_v1.php';
    require __DIR__ . '/APIs/api_v2.php';
});
