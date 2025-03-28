<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('categories',CategoryController::class);
Route::get('/backCate/{id}', [CategoryController::class, 'backCate'])->name('categories.backCate');
Route::resource('products',ProductController::class);
Route::get('/backPro/{id}', [ProductController::class, 'backPro'])->name('products.backPro');