<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GoodsController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
Route::post('/logout', LogoutController::class)->name('logout');

// levels
Route::group(['prefix' => 'levels'], function () {
    Route::get('/', [LevelController::class, 'index']);
    Route::get('/{level}', [LevelController::class, 'show']);
    Route::post('/', [LevelController::class, 'store']);
    Route::put('/{level}', [LevelController::class, 'update']);
    Route::delete('/{level}', [LevelController::class, 'destroy']);
});

// category
Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{category}', [CategoryController::class, 'show']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{category}', [CategoryController::class, 'update']);
    Route::delete('/{category}', [CategoryController::class, 'destroy']);
});

// goods
Route::group(['prefix' => 'goods'], function () {
    Route::get('/', [GoodsController::class, 'index']);
    Route::get('/{goods}', [GoodsController::class, 'show']);
    Route::post('/', [GoodsController::class, 'store']);
    Route::put('/{goods}', [GoodsController::class, 'update']);
    Route::delete('/{goods}', [GoodsController::class, 'destroy']);
});

// user
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});
