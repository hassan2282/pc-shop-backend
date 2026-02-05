<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conversation_id' => Conversation::all()->random()->id,
            'admin_id' =>fake()->optional()->randomElement([
                User::where('role_id', '!=', 1)->inRandomOrder()->first()->id,
                null
            ]) ,
            'text' => fake()->realText(),
            'status' => fake()->boolean(),
        ];
    }
}
