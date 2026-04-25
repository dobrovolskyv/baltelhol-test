<?php

use App\Http\Controllers\Admin\ProductController;

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function (){
//    Route::apiResource('/products', ProductController::class);
});
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
