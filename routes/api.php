<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::apiResource('tags', App\Http\Controllers\TagController::class);
    Route::apiResource('recipes', App\Http\Controllers\RecipeController::class);
    Route::apiResource('categories', App\Http\Controllers\CategoryController::class);
});
