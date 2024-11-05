<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;


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

Route::get('/welcome', function () {
    return view('welcome');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ShopController::class, 'index']);
    Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);
    Route::post('/reserve', [ReservationController::class, 'store']);
    Route::match(['get', 'post'], '/search', [ShopController::class, 'search']);
    Route::post('/favorite', [FavoriteController::class, 'store']);
    Route::delete('/not-favorite', [FavoriteController::class, 'destroy']);
    Route::get('/mypage', [AuthController::class, 'index']);
});
