<?php

namespace Database\Factories;

use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $merchants = Merchant::pluck('id')->toArray();
        return [
            'name' => fake()->name(),
            'price' => fake()->randomNumber(2),
            'shipping_cost' => fake()->randomDigit(),
            'merchant_id' => fake()->randomElement($merchants),
            'is_vat_included' => fake()->boolean(25),
        ];
    }
}
