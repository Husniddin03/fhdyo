<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Human;
use App\Models\User;
use App\Models\Couple;

class CoupleFactory extends Factory
{
    protected $model = Couple::class;

    public function definition(): array
    {
        return [
            'husband' => Human::where('gender', 'erkak')->first()->id,
            'wife' => Human::where('gender', 'ayol')->first()->id,
            'husband_key' => Str::random(10),
            'wife_key' => Str::random(10),
            'status' => $this->faker->randomElement(['active','inactive']),
            'user_id' => User::factory(),
        ];
    }
}
