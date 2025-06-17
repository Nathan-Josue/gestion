<?php
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class);
Route::post('/test-categorie', function () {
    return response()->json(['message' => 'ça marche !']);
});
