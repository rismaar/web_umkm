<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/login', function () {
    return view('authentication.login');
})->name('login');

Route::get('/regist', function () {
    return view('authentication.regist');
})->name('regist');

Route::post('/saveregist', [AuthController::class, 'saveregist'])->name('saveregist');
Route::post('/savelogin', [AuthController::class, 'savelogin'])->name('savelogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/products', [ProductsController::class, 'ProductsIndex'])->name('products');
Route::post('/store', [ProductsController::class, 'store'])->name('storeProduct');
Route::post('/update/{idProduct}', [ProductsController::class, 'update'])->name('updateProduct');

Route::get('primary', [ProductsController::class, 'primary'])->name('primary');
Route::get('snack', [ProductsController::class, 'snack'])->name('snack');

Route::post('/storeCategories', [CategoryController::class, 'storeCategories'])->middleware(['auth', 'role:admin'])->name('storeCategories');
