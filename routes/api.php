<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('invoice')->group(function () {
    Route::get('/', [InvoiceController::class, 'index']);
    Route::get('/{id}', [InvoiceController::class, 'show']);
    Route::post('/store', [InvoiceController::class, 'store']);
    Route::post('{id}/update', [InvoiceController::class, 'update']);
    Route::delete('/{id}', [InvoiceController::class, 'destroy']);
});

Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'index']);
    Route::get('/{id}', [PaymentController::class, 'show']);
    Route::post('/{id}/update', [PaymentController::class, 'update']);
    Route::post('/{id}/upload', [PaymentController::class, 'upload']);
    Route::post('/{invoice_id}/store', [PaymentController::class, 'store']);
    Route::delete('/{id}', [PaymentController::class, 'destroy']);
});

Route::prefix('production')->group(function () {
    Route::get('/', [ProductionController::class, 'index']);
    Route::get('/{id}', [ProductionController::class, 'show']);
    Route::post('{invoice_id}/store', [ProductionController::class, 'store']);
    Route::post('{id}/update', [ProductionController::class, 'update']);
    Route::delete('/{id}', [ProductionController::class, 'destroy']);
});

Route::prefix('item')->group(function () {
    Route::get('/', [ItemController::class, 'index']);
    Route::get('/{item}', [ItemController::class, 'show']);
    Route::post('/store', [ItemController::class, 'store']);
    Route::post('{item}/update', [ItemController::class, 'update']);
    Route::delete('/{item}', [ItemController::class, 'destroy']);
});

Route::prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'index']);
    Route::get('/{customer}', [CustomerController::class, 'show']);
    Route::post('/store', [CustomerController::class, 'store']);
    Route::post('{customer}/update', [CustomerController::class, 'update']);
    Route::delete('/{customer}', [CustomerController::class, 'destroy']);
});
