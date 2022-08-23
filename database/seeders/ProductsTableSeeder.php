<?php

namespace Database\Seeders;

use App\Enums\CurrencyType;
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
                    'amount' => '1.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
            [
                'name' => 'Don\'t Starve',
                'prize' => [
                    'amount' => '2.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
            [
                'name' => 'Bladur\'s Gate',
                'prize' => [
                    'amount' => '3.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
            [
                'name' => 'Icewind Dale',
                'prize' => [
                    'amount' => '4.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
            [
                'name' => 'Bloodborne',
                'prize' => [
                    'amount' => '5.99',
                    'currency' => CurrencyType::USD->value,
                ],
            ],
        ];

        foreach ($products as $product) {
            $product = Product::factory()->setName($product['name'])->create();
        }
    }
}
