<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::get('product/relationship', [ProductController::class, 'relationship'])->name('product.relationship');
    Route::resource('product', ProductController::class);
    Route::resource('tag', TagController::class);
});
