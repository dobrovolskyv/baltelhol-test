<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::group(['prefix' => 'api'], function () {
//     Route::get('/products', [ProductController::class, 'index'])->name('products.index');
//     Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
//     Route::post('/products', [ProductController::class, 'store'])->name('products.store');
//     Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
//     Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    
// });

Route::apiResource('products', ProductController::class);
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');