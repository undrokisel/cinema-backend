<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignInController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/sign_up', [SignUpController::class, 'store']);

Route::post('/sign_in', [SignInController::class, 'sign_in']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/cart/toggleToCart', [CartController::class, 'toggleMovieToCart']);
    Route::post('/cart/addMovieToCart', [CartController::class, 'addMovieToCart']);
    Route::post('/cart/removeMovieFromCart', [CartController::class, 'removeMovieFromCart']);
    Route::post('/cart/getCart', [CartController::class, 'getCart']);
    Route::post('/order/createOrder', [OrderController::class, 'createOrder']);
    Route::post('/order/getOrders', [OrderController::class, 'getOrders']);
    Route::post('/cart/removeMovieFromOrders', [OrderController::class, 'removeMovieFromOrders']);
});