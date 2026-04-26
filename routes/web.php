<?php


use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


require base_path('routes/admin.php');
