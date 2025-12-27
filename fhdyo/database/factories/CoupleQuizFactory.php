<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Couple;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoupleQuiz;
use App\Models\Question;

class CoupleQuizFactory extends Factory
{
    protected $model = CoupleQuiz::class;

    public function definition(): array
    {
        return [
            'couple_id' => Couple::factory(),
            'category_id' => Category::factory(),
            'question_id' => Question::factory(),
        ];
    }
}
