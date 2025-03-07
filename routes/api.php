<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([], function () {
    Route::post('products', [ProductController::class, 'createProduct']);
    Route::post('orders', [OrderController::class, 'createOrder']);
    Route::post('orders/{id}/process', [OrderController::class, 'processOrder']);
});