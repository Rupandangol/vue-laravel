<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::get('products', [\App\Http\Controllers\Api\ProductController::class, 'index']);

//showProduct
Route::get('/products/{category_id?}', [\App\Http\Controllers\Api\ProductController::class, 'categoryProduct']);
//deleteProduct
Route::delete('/products/delete/{product_id}', [\App\Http\Controllers\Api\ProductController::class, 'deleteProduct']);
//CreateProduct
Route::post('/products/create', [\App\Http\Controllers\Api\ProductController::class, 'createProduct']);
//updateProduct
Route::post('/products/update', [\App\Http\Controllers\Api\ProductController::class, 'updateProduct']);


//todoList
Route::group(['prefix' => 'todoList'], function () {
    Route::get('/list', [\App\Http\Controllers\TodoListController::class, 'list']);
    Route::post('/taskComplete', [\App\Http\Controllers\TodoListController::class, 'taskComplete']);

    Route::delete('/delete/{id}', [\App\Http\Controllers\TodoListController::class, 'delete']);

    Route::post('/add', [\App\Http\Controllers\TodoListController::class, 'add']);

});
