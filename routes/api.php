<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
});

Route::apiResource('category', CategoryController::class);
Route::apiResource('article', ArticleController::class);
