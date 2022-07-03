<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $products = Product::pluck('id')->toArray();
        $customers = Customer::pluck('id')->toArray();
        return [
            'product_id' => fake()->randomElement($products),
            'customer_id' => fake()->randomElement($customers),
            'shipping_address' => fake()->address(),

        ];
    }
}
