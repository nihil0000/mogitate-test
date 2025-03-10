<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/products', function () {
//     return view('index');
// });

Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index'); // Show product list
    Route::get('/register', [ProductController::class, 'create'])->name('create'); // Show store form
    Route::post('/register', [ProductController::class, 'store'])->name('store'); // Store product
    Route::get('/search', [ProductController::class, 'index'])->name('search'); // Search product

    Route::get('/{productId}', [ProductController::class, 'show'])->name('show'); // Show product details
    Route::patch('/{productId}/update', [ProductController::class, 'update'])->name('update'); // Update product details
    Route::delete('/{productId}/delete', [ProductController::class, 'destroy'])->name('destroy'); // Delete product
});
