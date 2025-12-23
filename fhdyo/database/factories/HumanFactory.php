<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\UserData;
use App\Models\Human;


class HumanFactory extends Factory
{
    protected $model = Human::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['male','female']),
            'birthday' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'jshshir' => Str::random(14),
            'passport_id' => strtoupper(Str::random(9)),
            'province' => $this->faker->city(),
            'region' => $this->faker->city(),
        ];
    }
}
