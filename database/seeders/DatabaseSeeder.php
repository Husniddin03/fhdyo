<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DataUser;
use App\Models\Couple;
use App\Models\Question;
use App\Models\UserAnswer;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(50)->create();
        $users->each(function ($user) {
            DataUser::factory()->create([
                'user_id' => $user->id,
            ]);
        });
        $questions = Question::factory(50)->create();

        $coupleCount = 0;
        
        $availableUsers = $users->shuffle();
        
        for ($i = 0; $i < 25 && $availableUsers->count() >= 2; $i++) {
            $firstUser = $availableUsers->shift();
            $secondUser = $availableUsers->shift();
            Couple::factory()->create([
                'first_user_id'  => $firstUser->id,
                'second_user_id' => $secondUser->id,
                'questions_id'   => $questions->random()->id,
            ]);
            
            $coupleCount++;
        }
        
        $totalAnswers = 0;
        
        foreach ($users as $user) {
            $selectedQuestions = $questions->random(5);
            
            foreach ($selectedQuestions as $q) {
                UserAnswer::factory()->create([
                    'user_id'     => $user->id,
                    'question_id' => $q->id,
                ]);
                $totalAnswers++;
            }
        }
        
    }
}