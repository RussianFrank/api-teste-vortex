<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create();

        return [
            'name' => fake()->name(),
            'user_id' => $user->id,
            'email' => fake()->unique()->safeEmail(),
            'subject' => fake()->sentence(),
            'body' => fake()->text(200),
            'schedule' => now(),
            'is_sent' => fake()->boolean(0),
        ];
    }
}
