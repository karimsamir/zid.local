<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\productDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $products = Product::pluck('id')->toArray();
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'language' => fake()->languageCode(),
            'product_id' => fake()->randomElement($products),
        ];
    }
}
