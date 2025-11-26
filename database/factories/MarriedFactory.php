<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarriedFactory extends Factory
{
    protected $model = \App\Models\Married::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'married' => $this->faker->date(),
        ];
    }
}
