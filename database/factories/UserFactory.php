<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'email' => fake()->safeEmail(),
            'password' => 'SomeRandomPassword!',
        ];
    }

    public function setEmail(string $email): static
    {
        return $this->state(function (array $attributes) use ($email) {
            return [
                'email' => $email,
            ];
        });
    }

    public function setPassword(string $password): static
    {
        return $this->state(function (array $attributes) use ($password) {
            return [
                'password' => $password,
            ];
        });
    }
}
