<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataUser>
 */
class DataUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'phone' => fake()->phoneNumber(),
            'jshshir' => fake()->numerify('##############'),
            'passport_id' => fake()->numerify('AA######'),
            'province' => fake()->city(),
            'region' => fake()->streetName(),
        ];
    }
}
