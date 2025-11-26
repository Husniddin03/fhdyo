<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = \App\Models\Question::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['personal', 'health', 'education']),
            'question' => $this->faker->sentence(),
        ];
    }
}
