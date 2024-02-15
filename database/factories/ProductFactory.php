<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' => fake()->unique()->randomNumber(),
            'description' => fake()->text(),
            'minimum_order' => fake()->randomDigitNotNull(),
            'price' => fake()->randomDigitNotNull(),
            'quantity' => fake()->randomDigitNotNull(),
        ];
    }
}
