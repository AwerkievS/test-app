<?php

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

Route::prefix('clients')->group(function () {

    Route::get('/', [ClientsController::class, 'getListClients']);

    Route::get('/search', [ClientsController::class, 'getClient']);

    Route::get('/{id}', [ClientsController::class, 'getClient']);

    Route::put('/', [ClientsController::class, 'createClient']);

    Route::post('/{id}', [ClientsController::class, 'updateClient']);

    Route::delete('/{id}', [ClientsController::class, 'deleteClient']);

});
