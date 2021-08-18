<?php

namespace App\Modules\Clients\Controllers;


use App\Modules\Clients\DTO\FilterData;
use App\Modules\Clients\Exceptions\UnsupportedFilterException;
use App\Modules\Clients\Services\ClientsService;
use App\Rules\EmailsArray;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ClientsController extends Controller
{

    private $clientsService;

    public function __construct(ClientsService $clientsService)
    {
        $this->clientsService = $clientsService;
    }

    /**
     *
     * @throws \Exception
     */
    public function searchClients(Request $request)
    {
        return $this->clientsService->listClients(new FilterData($request->get('filterType'), $request->get('filterValue')));
    }

    public function getClient($id)
    {
        try {
            return $this->clientsService->getById($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => false,
                'error'  => 'client not found',
            ])->setStatusCode(Response::HTTP_NOT_FOUND);
        }
    }

    public function createClient(Request $request): \Illuminate\Http\JsonResponse
    {
        $userData = $request->all();
        $validate = Validator::make($userData, [
            'name'      => 'required|string',
            'last_name' => 'required|string',
            'emails'    => ['required', 'array', new EmailsArray()],
            'phones'    => 'required|array',
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false, 'errors' => $validate->errors()])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        try {
            $client = $this->clientsService->createClient($userData);
        } catch (\Throwable $exception) {
            return response()->json(['status' => false, 'errors' => [$exception->getMessage()]]);
        }
        Log::channel('clients')->info('client added by user ', [
            'client_id' => $client->id,
            'user_id'   => $request->user()->id,
        ]);
        return response()->json(['status' => true, 'client' => $client]);
    }

    public function updateClient($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $userData = $request->all();
        $validate = Validator::make($userData, [
            'name'      => 'string',
            'last_name' => 'string',
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => false, 'errors' => $validate->errors()])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        $status = $this->clientsService->updateUser($id, $request->all($userData));
        Log::channel('clients')->info('client updated by user ',
            [
                'client_id' => $id,
                'user_id'   => $request->user()->id,
            ]);
        return response()->json(['status' => $status]);
    }

    public function deleteClient($id, Request $request)
    {
        $this->clientsService->deleteClient($id);
        Log::channel('clients')->info('client deleted by user ', [
            'client_id' => $id,
            'user_id'   => $request->user()->id,
        ]);
    }


}
