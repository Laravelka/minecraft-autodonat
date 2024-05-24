<?php

use App\Http\Controllers\Api\{AuthController, CategoriesController, ServersController, ProductsController};
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->prefix('auth')->group(function() {
    Route::middleware('auth:sanctum')->post('logout', 'logout')->name('logout');
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
});

Route::controller(ServersController::class)->prefix('servers')->name('servers.')->group(function() {
    Route::get('/', 'index')->name('get');
});

Route::controller(ProductsController::class)->prefix('products')->name('products.')->group(function() {
    Route::get('/', 'index')->name('get');
});

Route::controller(CategoriesController::class)->prefix('categories')->name('categories.')->group(function() {
    Route::get('/', 'index')->name('get');
    Route::get('/withProducts', 'getWithProducts')->name('with.products');
});
