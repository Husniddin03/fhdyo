<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAnswer>
 */
class UserAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'couples_id' => \App\Models\Couple::factory(),
            'user_id' => \App\Models\User::factory(),
            'questions_id' => \App\Models\Question::factory(),
            'answer' => fake()->randomElement([true, false]),
        ];
    }
}
