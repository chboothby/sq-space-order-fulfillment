<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FulfillOrderController;
use App\Http\Controllers\MakeCSVController;
use App\Http\Controllers\OrdersController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/orders/courier', [OrdersController::class, 'index'])->name('courier');
Route::post('/orders/courier', [MakeCSVController::class, 'make'])->name('courier.make');

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgot'])->name('password.forgot');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
Route::post('/reset-password/{token}', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/signup', [SignupController::class, 'store']);


Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::post('/orders/fulfill', [FulfillOrderController::class, 'fulfill'])->name('fulfill');
Route::delete('/orders', [OrdersController::class, 'removeAllOrders'])->name('orders.remove');


Route::post('/upload-file', [FileUploadController::class, 'upload'])->name('file-upload.post');

Route::fallback(function () {
    if (Auth::check()) {
        return redirect()->route('unfulfilled');
    } else {
        return redirect()->route('login');
    }
});



