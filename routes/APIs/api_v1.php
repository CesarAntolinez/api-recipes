<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('tags', \App\Http\Controllers\Api\V1\TagController::class);
    Route::apiResource('recipes', \App\Http\Controllers\Api\V1\RecipeController::class);
    Route::apiResource('categories', \App\Http\Controllers\Api\V1\CategoryController::class);
});
