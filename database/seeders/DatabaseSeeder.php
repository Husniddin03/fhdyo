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

        // Har bir user uchun DataUser yaratish
        $users->each(function ($user) {
            DataUser::factory()->create([
                'user_id' => $user->id,
            ]);
        });

        // 4 xil type bo‘yicha 25 tadan savol
        $types = ['personal', 'emotional', 'family', 'interest'];
        foreach ($types as $type) {
            Question::factory(25)->create([
                'type' => $type
            ]);
        }

        $availableUsers = $users->shuffle()->values();

        for ($i = 0; $i < 30; $i++) {

            shuffle($types);
            $questions = Question::where('type', $types[1])->get();

            $couple = Couple::factory()->create([
                'first_user_id'  => $availableUsers[$i],
                'second_user_id' => $availableUsers[$i + 1],
                'questions_type' => $types[1],
                'key'            => fake()->uuid(),
                'result' => fake()->randomFloat(2, 0, 100),
            ]);


            foreach ($questions as $question) {

                UserAnswer::factory()->create([
                    'couples_id'   => $couple->id,
                    'user_id'      => $availableUsers[$i],
                    'questions_id' => $question->id,
                ]);

                UserAnswer::factory()->create([
                    'couples_id'   => $couple->id,
                    'user_id'      => $availableUsers[$i + 1],
                    'questions_id' => $question->id,
                ]);

            }
        }
    }
}
