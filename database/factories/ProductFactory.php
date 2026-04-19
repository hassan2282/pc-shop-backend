<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
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
            'title' => fake()->word(),
            'price' => fake()->numberBetween(100000, 50000000),
            'amount' => fake()->numberBetween(1, 100),
            'description' => fake()->text(30),
            'text' => fake()->realText(100),
            'slug' => fake()->slug(),
            'status' => fake()->boolean(),
            'views' => fake()->numberBetween(0, 50000),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
