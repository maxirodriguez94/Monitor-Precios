<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/locations', [LocationController::class, 'index']);
    Route::post('/locations', [LocationController::class, 'store']);
    Route::delete('/locations/{location}', [LocationController::class, 'destroy']);

    Route::get('/items', [ItemController::class, 'index']);
    Route::post('/items', [ItemController::class, 'store']);
    Route::delete('/items/{item}', [ItemController::class, 'destroy']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/prices', [PriceController::class, 'store']);
    Route::delete('/prices/{prices}', [PriceController::class, 'destroy']);

    Route::get('/monitor', [MonitorController::class, 'index'])->name('monitor');
});
