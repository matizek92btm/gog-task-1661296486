<?php

namespace Database\Factories;

use App\Enums\CartProductAmount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    public function definition()
    {
        return [
            'max' => fake()->numberBetween(1, CartProductAmount::MAX->value),
        ];
    }

    public function setMax(int $max): static
    {
        return $this->state(function (array $attributes) use ($max) {
            return [
                'max' => $max,
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
