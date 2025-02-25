<?php

use App\Http\Controllers\ClothingItemController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/clothing-items', [ClothingItemController::class, 'index']);
    Route::post('/clothing-items', [ClothingItemController::class, 'store']);
    Route::delete('/clothing-items/{id}', [ClothingItemController::class, 'destroy']);
});

