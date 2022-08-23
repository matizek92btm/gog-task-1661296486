<?php

namespace Database\Seeders;

use App\Enums\CurrencyType;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'email' => 'worker@example.com',
                'password' => 'Example1%',
                'profile' => [
                    'currency' => CurrencyType::USD->value,
                ],
            ],
            [
                'email' => 'user@example.com',
                'password' => 'Example1%',
                'profile' => [
                    'currency' => CurrencyType::USD->value,
                ],
            ],
        ];

        foreach ($users as $user) {
            $newUser = User::factory()->setEmail($user['email'])->setPassword($user['password'])->create();
            $newProfile = Profile::factory()->setCurrency($user['profile']['currency'])->setUser($newUser->id)->create();
        }
    }
}
