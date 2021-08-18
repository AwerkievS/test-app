<?php

namespace Database\Seeders;

use App\Modules\Clients\Models\Client;
use App\Modules\Clients\Models\Email;
use App\Modules\Clients\Models\Phone;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Client::factory()
            ->has(Email::factory()->count(2))
            ->has(Phone::factory()->count(2))
            ->count(10)
            ->make();
    }
}
