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

Route::prefix('user')->group(function () {

    Route::get('/', [\App\Http\Controllers\UsersController::class, 'getListUsers']);

    Route::get('/{id}', [\App\Http\Controllers\UsersController::class, 'getUser']);

    Route::put('/', [\App\Http\Controllers\UsersController::class, 'createUser']);

    Route::post('/{id}', [\App\Http\Controllers\UsersController::class, 'updateUser']);

    Route::delete('/{id}', [\App\Http\Controllers\UsersController::class, 'deleteUser']);

});
