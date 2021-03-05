<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\FulfillOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
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




Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'store']);


Route::get('/orders/unfulfilled', [OrdersController::class, 'index'])->name('unfulfilled');
Route::post('/orders/unfulfilled', [OrdersController::class, 'fetch']);

Route::get('/orders/fulfilled', [OrdersController::class, 'index'])->name('fulfilled');


Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/signup', [SignupController::class, 'store']);


Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::post('orders/fulfill', [FulfillOrderController::class, 'fulfill'])->name('fulfill');

