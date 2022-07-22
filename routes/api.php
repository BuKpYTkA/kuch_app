<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShoppingCartController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->group(static function () {
    Route::prefix('products')->group(static function () {
        Route::post('/create', [ProductsController::class, 'create']);
        Route::post('/update/{product}', [ProductsController::class, 'update']);
        Route::post('/delete/{product}', [ProductsController::class, 'delete']);
        Route::get('/all', [ProductsController::class, 'getAll']);
    });
    Route::prefix('categories')->group(static function () {
        Route::post('/create', [CategoriesController::class, 'create']);
        Route::post('/update/{category}', [CategoriesController::class, 'update']);
        Route::post('/delete/{category}', [CategoriesController::class, 'delete']);
        Route::get('/all', [CategoriesController::class, 'getAll']);
    });
    Route::prefix('shopping_cart')->group(static function () {
        Route::post('/add', [ShoppingCartController::class, 'addItem']);
        Route::post('/remove', [ShoppingCartController::class, 'removeItem']);
        Route::post('/clear', [ShoppingCartController::class, 'clear']);
        Route::get('/get', [ShoppingCartController::class, 'getItems']);
    });
    Route::prefix('orders')->group(static function () {
        Route::post('/create', [OrdersController::class, 'create']);
        Route::post('/update_status/{order}', [OrdersController::class, 'updateStatus']);
        Route::get('/all', [OrdersController::class, 'getAll']);
    });
});

