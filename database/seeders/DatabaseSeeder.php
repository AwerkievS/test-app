<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\Clients\Models\Client;
use App\Modules\Clients\Models\Email;
use App\Modules\Clients\Models\Phone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

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
        $result = Client::factory()
            ->has(Email::factory()->count(2))
            ->has(Phone::factory()->count(2))
            ->count(10)
            ->create();

        $user = User::create([
            'name'     => 'test_admin',
            'email'    => 'test@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        $user->createToken('admin');

    }
}
