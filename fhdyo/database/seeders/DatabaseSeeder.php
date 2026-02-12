<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserData;
use App\Models\Human;
use App\Models\Couple;
use App\Models\Category;
use App\Models\Question;
use App\Models\CoupleAnswer;
use App\Models\CoupleQuiz;
use App\Models\CoupleResult;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user
        User::factory()
            ->has(UserData::factory())
            ->create([
                'name' => 'Shaxobiddin Jovliyev',
                'email' => 'shaxobiddin@gmail.com',
                'password' => bcrypt('secret'),
                'role' => 'super_admin'
            ]);

        // Users va UserData
        User::factory(10)
            ->has(UserData::factory())
            ->create();

        // Humans
        Human::factory(20)->create([
            'gender' => 'male'
        ]);

        Human::factory(20)->create([
            'gender' => 'female'
        ]);

        // Categories va Questions
        $categories = Category::factory(5)
            ->has(Question::factory(10))
            ->create();

        // Couples
        // $couples = Couple::factory(20)->create([
        //     'user_id' => 1,
        // ]);

        // $count = 0;
        // // CoupleAnswers
        // foreach ($couples as $couple) {
        //     foreach ($categories as $category) {
        //         foreach ($category->questions as $question) {
        //             CoupleAnswer::factory()->create([
        //                 'key' => $count % 2 == 0 ? $couple->husband_key : $couple->wife_key,
        //                 'couple_id' => $couple->id,
        //                 'question_id' => $question->id,
        //             ]);
        //             $count++;
        //         }
        //         $question_ids = $category->questions->random(5)->pluck('id');
        //         foreach ($question_ids as $question_id) {
        //             CoupleQuiz::factory()->create([
        //                 'couple_id' => $couple->id,
        //                 'question_id' => $question_id
        //             ]);
        //         }
        //     }
        // }

        // // CoupleResults
        // foreach ($couples as $couple) {
        //     foreach ($categories as $category) {
        //         CoupleResult::factory()->create([
        //             'couple_id' => $couple->id,
        //             'category_id' => $category->id,
        //         ]);
        //     }
        // }
    }
}
