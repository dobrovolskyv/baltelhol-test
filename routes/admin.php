<?php

use App\Http\Controllers\Admin\ProductController;

Route::middleware(['auth:sanctum'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/products', ProductController::class);
//Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});
