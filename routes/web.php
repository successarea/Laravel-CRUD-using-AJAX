<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('products');
});

Route::get('/', [ProductController::class, 'products'])->name('products');
Route::post('/add_product', [ProductController::class, 'addProduct'])->name('add.product');
Route::post('/update_product', [ProductController::class, 'updateProduct'])->name('update.product');
Route::post('/delete_product', [ProductController::class, 'deleteProduct'])->name('delete.product');
Route::get('/pagination/paginate-data', [ProductController::class, 'pagination']);
Route::get('/search_product', [ProductController::class, 'searchProduct'])->name('search.product');
