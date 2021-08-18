<?php

use App\Http\Controllers\Controller;
use App\Modules\Clients\Controllers\ClientsController;
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

Route::get('login', [Controller::class, 'loginPage'])->name('login');
Route::post('login', [Controller::class, 'login']);

Route::middleware('auth:sanctum')->prefix('clients')->group(function () {

    Route::get('/', [ClientsController::class, 'searchClients']);

    Route::get('/{id}', [ClientsController::class, 'getClient']);

    Route::put('/', [ClientsController::class, 'createClient']);

    Route::post('/{id}', [ClientsController::class, 'updateClient']);

    Route::delete('/{id}', [ClientsController::class, 'deleteClient']);

});
