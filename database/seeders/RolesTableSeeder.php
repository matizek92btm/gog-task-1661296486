<?php

namespace Database\Seeders;

use App\Enums\RoleSlug;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $RoleItems = [
            [
                'name'        => 'Worker',
                'slug'        => RoleSlug::WORKER->value,
                'description' => 'Worker.',
                'level'       => 2,
            ],
            [
                'name'        => 'User',
                'slug'        => RoleSlug::USER->value,
                'description' => 'User Role',
                'level'       => 1,
            ],
        ];

        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if (null === $newRoleItem) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
    }
}
