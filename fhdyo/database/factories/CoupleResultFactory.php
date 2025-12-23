<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Couple;
use App\Models\Category;
use App\Models\CoupleResult;

class CoupleResultFactory extends Factory
{
    protected $model = CoupleResult::class;

    public function definition(): array
    {
        return [
            'couple_id' => Couple::factory(),
            'category_id' => Category::factory(),
            'percent' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
