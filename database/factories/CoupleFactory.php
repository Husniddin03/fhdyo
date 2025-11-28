<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Couple>
 */
class CoupleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_user_id' => \App\Models\User::factory(),
            'second_user_id' => \App\Models\User::factory(),
            'questions_type' => fake()->randomElement(['personal', 'emotional', 'family', 'interest']),
            'key' => fake()->uuid()
        ];
    }
}
