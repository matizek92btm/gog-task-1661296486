<?php

namespace Database\Seeders;

use App\Enums\CurrencyType;
use App\Enums\RoleSlug;
use App\Models\Cart;
use App\Models\Profile;
use App\Models\User;
use Doctrine\DBAL\Exception;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
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
                'role' => [
                    'slug' => RoleSlug::WORKER->value,
                ],
            ],
            [
                'email' => 'user@example.com',
                'password' => 'Example1%',
                'profile' => [
                    'currency' => CurrencyType::USD->value,
                ],
                'role' => [
                    'slug' => RoleSlug::USER->value,
                ],
            ],
        ];

        foreach ($users as $user) {
            $roleSlug = $user['role']['slug'];
            if (! $role = $this->getRole($roleSlug)) {
                throw new Exception('Role not found! '.$roleSlug);
            }
            $newUser = User::factory()->setEmail($user['email'])->setPassword($user['password'])->create();
            $newUser->attachRole($role);

            Profile::factory()->setCurrency($user['profile']['currency'])->setUser($newUser->id)->create();
            Cart::factory()->setUser($newUser->id)->create();
        }
    }

    private function getRole(string $roleSlug): Role|null
    {
        return Role::whereSlug($roleSlug)->first();
    }
}
