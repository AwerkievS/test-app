<?php

namespace App\Modules\Clients\Controllers;


use App\Modules\Clients\Services\ClientsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClientsController extends Controller
{

    private $clientsService;

    public function __construct(ClientsService $clientsService)
    {
        $this->clientsService = $clientsService;
    }

    public function getListClients()
    {
        return $this->clientsService->listClients();
    }

    public function getClient($id)
    {
        return $this->clientsService->getById();
    }

    public function search()
    {

    }

    public function createClient(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|sting',
            'last_name' => 'required|sting',
            'emails' => 'required|array|email',
            'phones' => 'required|array|string',
        ]);


        return;
    }

    public function updateClient()
    {
        return;
    }

    public function deleteClient($id)
    {
        $this->clientsService->deleteClient($id);
    }


}
