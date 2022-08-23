<?php

namespace Database\Factories;

use App\Enums\CurrencyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    public function definition()
    {
        return [
            'currency' => fake()->randomElement(CurrencyType::valueArray()),
        ];
    }

    public function setCurrency(string $currency): static
    {
        return $this->state(function (array $attributes) use ($currency) {
            return [
                'currency' => $currency,
            ];
        });
    }

    public function setUser(int $userId): static
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'user_id' => $userId,
            ];
        });
    }
}
