<?php

namespace App\Modules\Clients\Services;

use App\Modules\Clients\Models\Client;

class ClientsService
{

    public function listClients()
    {
        return Client::all();
    }

    public function getById($id)
    {
        return Client::findOrFail($id);
    }

    public function deleteClient($id): ?bool
    {
        return Client::destroy($id);
    }

}
