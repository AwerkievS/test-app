<?php

namespace App\Modules\Clients\Services;

use App\Modules\Clients\DTO\FilterData;
use App\Modules\Clients\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ClientsService
{

    public function listClients(FilterData $filterFields)
    {
        $builder = $this->buildClientsQuery($filterFields);

        return $builder->get();
    }

    public function getById($id)
    {
        return Client::with(['emails', 'phones'])->findOrFail($id);
    }

    /**
     * @throws \Throwable
     */
    public function createClient(array $clientData): Client
    {
        $client = new Client();
        $client->fill($clientData);
        DB::transaction(function () use ($client, $clientData) {
            $client->save();
            $client->emails()->createMany($this->getPrepareFillableArray($clientData['emails'], 'email'));
            $client->phones()->createMany($this->getPrepareFillableArray($clientData['phones'], 'phone'));
        });

        return $client;
    }

    public function updateUser($id, $data): bool
    {
        $client = $this->getById($id);
        $client->fill($data);
        return $client->save();
    }

    public function deleteClient($id): ?bool
    {
        return Client::destroy($id);
    }


    private function buildClientsQuery(FilterData $filterData)
    {
        $client = Client::with(['emails', 'phones']);

        if ($filterData->getName()) {
            $name = $filterData->getName();
            $client->where('name', 'like', "%$name%");
        }

        if ($filterData->getLastname()) {
            $lastName = $filterData->getLastname();
            $client->where('last_name', 'like', "%$lastName%");

        }


        if ($filterData->getEmail()) {
            $email = $filterData->getEmail();
            $client->whereHas('emails', function ($query) use ($email) {
                $query->where('email', 'like', "%$email%");
            });
        }

        if ($filterData->getPhone()) {
            $phone = $filterData->getPhone();
            $client->whereHas('phones', function ($query) use ($phone) {
                $query->where('phone', 'like', "%$phone%");
            });

        }

        return $client;
    }


    private function getPrepareFillableArray($items, $key): array
    {
        $result = [];
        foreach ($items as $email) {
            $result[] = [$key => $email];
        }

        return $result;
    }

}
