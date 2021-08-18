<?php

namespace App\Modules\Clients;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ClientsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('app/Modules/Clients/Routes/api.php'));

    }

}
