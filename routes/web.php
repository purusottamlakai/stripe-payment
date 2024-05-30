<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/hosted', [CheckoutController::class, 'index'])->name('hosted');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/embedded', [HomeController::class, 'embedded'])->name('embedded');
Route::post('/checkout/embedded', [CheckoutController::class, 'checkoutEmbeded'])->name('checkout.embedded');
Route::get('/custom', [HomeController::class, 'custom'])->name('custom');
Route::post('/custom', [CheckoutController::class, 'custom'])->name('checkout.custom');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');