<?php

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\LoggingController;
use App\Http\Controllers\UserController;
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

Route::prefix('/auth')
    ->controller(AuthorizationController::class)
    ->group(function () {
        Route::post('/registration', 'registration');
        Route::post('/login', 'login');
    });

Route::prefix('/user')
    ->controller(UserController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
       Route::get('/', 'user');
    });

Route::prefix('/logs')
    ->controller(LoggingController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', 'all');
    });
