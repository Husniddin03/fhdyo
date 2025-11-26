<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DataUserFactory extends Factory
{
    protected $model = \App\Models\DataUser::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'phone' => $this->faker->phoneNumber(),
            'jshshir' => $this->faker->numerify('###########'),
            'passport_id' => $this->faker->bothify('AA######'),
            'province' => $this->faker->state(),
            'region' => $this->faker->city(),
        ];
    }
}
