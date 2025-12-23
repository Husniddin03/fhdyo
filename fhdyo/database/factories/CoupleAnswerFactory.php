<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Couple;
use App\Models\Question;
use App\Models\CoupleAnswer;

class CoupleAnswerFactory extends Factory
{
    protected $model = CoupleAnswer::class;

    public function definition(): array
    {
        return [
            'couple_id' => Couple::factory(),
            'key' => Str::random(8),
            'question_id' => Question::factory(),
            'answer' => $this->faker->randomElement([-1,0,1]),
        ];
    }
}