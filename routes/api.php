<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Permissions\PermissionController;
use App\Http\Controllers\Permissions\RolesController;
use App\Http\Controllers\CartController;

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
Route::post('register', [RegisterController::class, 'register']);
Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register']);
Route::post('/roles', [RolesController::class, 'createRole'])->middleware(['jwt.auth']);;
Route::get('/roles', [RolesController::class, 'getRoles'])->middleware(['jwt.auth']);;
Route::get('/roles/{name}', [RolesController::class, 'getRolesByName'])->middleware(['jwt.auth']);;
Route::post('/permissions', [PermissionController::class, 'createPermission'])->middleware(['jwt.auth']);;
Route::get('/permissions', [PermissionController::class, 'index'])->middleware(['jwt.auth']);;
Route::get('/permissions/{name}', [PermissionController::class, 'findPermissionByName'])->middleware(['jwt.auth']);;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('clients', ClientController::class);

Route::apiResource('products', ProductController::class);
Route::get('/products/catalog', [ProductController::class, 'catalog']);

Route::apiResource('categories', CategoryController::class);

Route::apiResource('orders', OrderController::class);

Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('cart/view', [CartController::class, 'viewCart'])->name('cart.view');
Route::put('cart/update/{cartId}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});


