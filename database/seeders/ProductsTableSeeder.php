<?php

namespace Database\Seeders;

use App\Enums\CurrencyType;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Fallout',
                'prize' => [
                    'value' => '1.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
            [
                'name' => 'Don\'t Starve',
                'prize' => [
                    'value' => '2.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
            [
                'name' => 'Bladur\'s Gate',
                'prize' => [
                    'value' => '3.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
            [
                'name' => 'Icewind Dale',
                'prize' => [
                    'value' => '4.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
            [
                'name' => 'Bloodborne',
                'prize' => [
                    'value' => '5.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
        ];

        foreach ($products as $product) {
            $newProduct = Product::factory()->setName($product['name'])->create();

            Price::factory()
                ->setCurrency($product['prize']['currency'])
                ->setValue($product['prize']['value'])
                ->setProduct($newProduct->id)
                ->create();
        }
    }
}
