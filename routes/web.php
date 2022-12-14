<?php

declare(strict_types=1);

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
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

Route::get('/', fn() => view('welcome'))->name('welcome');
Route::resource('products', ProductController::class)->names('products');
Route::get('store', [StoreController::class, 'index'])->name('store.index');
Route::get('add-order/{product}', [StoreController::class, 'addProductToOrder'])->name('add.order.product');