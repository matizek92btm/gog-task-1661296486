<?php

namespace Database\Factories;

use App\Enums\CurrencyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    public function definition()
    {
        return [
            'value' => fake()->numberBetween(1, 99),
            'currency' => fake()->randomElement(CurrencyType::valueArray()),
        ];
    }

    public function setValue(float $value): static
    {
        return $this->state(function (array $attributes) use ($value) {
            return [
                'value' => $value,
            ];
        });
    }

    public function setCurrency(string $currency): static
    {
        return $this->state(function (array $attributes) use ($currency) {
            return [
                'currency' => $currency,
            ];
        });
    }

    public function setProduct(int $productId): static
    {
        return $this->state(function (array $attributes) use ($productId) {
            return [
                'product_id' => $productId,
            ];
        });
    }
}
