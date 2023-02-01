<?php

use App\Http\Controllers\BusinessesController;
use App\Http\Controllers\UserController;
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

Route::prefix('v1')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(BusinessesController::class)->group(function () {
            Route::get('/businesses/search', 'search');
            Route::post('/businesses', 'store');
            Route::put('/businesses/{id}', 'update');
            Route::delete('/businesses/{id}', 'destroy');
        });
    });
});
