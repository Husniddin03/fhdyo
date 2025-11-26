<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserResultFactory extends Factory
{
    protected $model = \App\Models\UserResult::class;

    public function definition(): array
    {
        return [
            'user_answers_id' => \App\Models\UserAnswer::factory(),
            'result' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
