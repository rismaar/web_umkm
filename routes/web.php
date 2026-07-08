<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SaleController;

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
Route::put('/update/{idProduct}', [ProductsController::class, 'update'])->name('updateProduct');
Route::delete('/destroy/{idProduct}', [ProductsController::class, 'destroy'])->name('deleteProduct');

Route::get('primary', [ProductsController::class, 'primary'])->name('primary');
Route::get('snack', [ProductsController::class, 'snack'])->name('snack');
Route::get('extensions', [ProductsController::class, 'extensions'])->name('extensions');
Route::get('drink', [ProductsController::class, 'drink'])->name('drink');

Route::post('/cart/add/{idProduct}', [CartController::class, 'add'])->name('addtoCart');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::patch('/cart/increase/{idCartItem}', [CartController::class, 'increase'])->name('increase');
Route::patch('/cart/decrease/{idCartItem}', [CartController::class, 'decrease'])->name('decrease');
Route::delete('/cart/remove/{idCartItem}', [CartController::class, 'remove'])->name('remove');

Route::get('/history', [SaleController::class, 'history'])->name('historySales');
Route::post('/checkout', [SaleController::class, 'checkout'])->name('checkout');
Route::patch('/updateStatus/{idSale}', [SaleController::class, 'updateStatus'])->name('updateStatus');
Route::get('/orderHistory', [SaleController::class, 'orderHistory'])->name('orderHistory');
Route::patch('/received/{idSale}', [SaleController::class, 'received'])->name('received');

Route::post('/storeCategories', [CategoryController::class, 'storeCategories'])->middleware(['auth', 'role:admin'])->name('storeCategories');