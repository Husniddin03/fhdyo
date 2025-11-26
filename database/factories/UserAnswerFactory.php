<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserAnswerFactory extends Factory
{
    protected $model = \App\Models\UserAnswer::class;

    public function definition(): array
    {
        return [
            'key' => $this->faker->uuid(),
            'user_id' => \App\Models\User::factory(),
            'question_id' => \App\Models\Question::factory(),
            'answer' => $this->faker->randomElement(['yes', 'no']),
        ];
    }
}
