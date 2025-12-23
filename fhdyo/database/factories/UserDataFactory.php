<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\UserData;
use App\Models\User;

class UserDataFactory extends Factory
{
    protected $model = UserData::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'avatar' => $this->faker->imageUrl(),
            'birthday' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male','female']),
        ];
    }
}
