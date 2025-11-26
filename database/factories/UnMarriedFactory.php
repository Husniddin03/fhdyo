<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UnMarriedFactory extends Factory
{
    protected $model = \App\Models\UnMarried::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'un_married' => $this->faker->date(),
        ];
    }
}
