<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
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
            'category_id' => Category::all()->random()->id,
            'description' => fake()->text(),
            'text' => fake()->randomHtml(),
            'slug' => fake()->slug(),
            'author_id' => User::where('role_id', '>', 1)->get()->random()->id,
            'status' => fake()->boolean(),
        ];
    }
}
