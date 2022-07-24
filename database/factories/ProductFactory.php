<?php

namespace Database\Factories;

use App\Models\User;
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
        $merchants = User::where("user_type", "merchant")
        ->pluck('id')->toArray();
        return [
            'name' => fake()->name(),
            'price' => fake()->randomNumber(2),
            'shipping_cost' => fake()->randomDigit(),
            'user_id' => fake()->randomElement($merchants),
            'vat_percentage' => fake()->numberBetween(0, 20),
            'is_vat_included' => fake()->boolean(25),
        ];
    }
}
