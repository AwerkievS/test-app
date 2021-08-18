<?php

namespace Database\Factories;

use App\Modules\Clients\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{

    protected $model = Client::class;

    public function definition()
    {
        return [
            'name'      => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
        ];
    }
}
