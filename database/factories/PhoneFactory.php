<?php

namespace Database\Factories;


use App\Modules\Clients\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{

    protected $model = Phone::class;

    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
