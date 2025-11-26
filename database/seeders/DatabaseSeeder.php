<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DataUser;
use App\Models\UnMarried;
use App\Models\Married;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserResult;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Savollarni yaratish
        $questions = Question::factory()->count(10)->create();

        // 2. Foydalanuvchilarni juftlik bilan yaratish
        $userCount = 20; // Juft son bo'lishi kerak
        $users = User::factory()->count($userCount)->create();

        // Juftliklarni yaratish
        $couples = [];
        for ($i = 0; $i < $userCount; $i += 2) {
            $couples[] = [
                'user1' => $users[$i],
                'user2' => $users[$i + 1],
            ];
        }

        // Har bir juftlik uchun ma'lumotlarni to'ldirish
        foreach ($couples as $couple) {
            $user1 = $couple['user1'];
            $user2 = $couple['user2'];

            // Couple ID ni belgilash - bir-birining ID sini yozish
            $user1->update(['couple' => $user2->id]);
            $user2->update(['couple' => $user1->id]);

            // Ikkala foydalanuvchi uchun ham bir xil turmush holati
            $isMarried = rand(0, 1);
            $marriageDate = fake()->dateTimeBetween('-10 years', '-1 year');

            // User 1 uchun ma'lumotlar
            DataUser::factory()->create([
                'user_id' => $user1->id,
                'phone' => fake()->unique()->phoneNumber(),
                'jshshir' => fake()->unique()->numerify('##############'),
                'passport_id' => fake()->unique()->bothify('??#######'),
            ]);

            if ($isMarried) {
                Married::factory()->create([
                    'user_id' => $user1->id,
                    'married' => $marriageDate,
                ]);
            } else {
                UnMarried::factory()->create([
                    'user_id' => $user1->id,
                    'un_married' => fake()->dateTimeBetween('-5 years', 'today'),
                ]);
            }

            // User 2 uchun ma'lumotlar
            DataUser::factory()->create([
                'user_id' => $user2->id,
                'phone' => fake()->unique()->phoneNumber(),
                'jshshir' => fake()->unique()->numerify('##############'),
                'passport_id' => fake()->unique()->bothify('??#######'),
            ]);

            if ($isMarried) {
                Married::factory()->create([
                    'user_id' => $user2->id,
                    'married' => $marriageDate, // Bir xil sana
                ]);
            } else {
                UnMarried::factory()->create([
                    'user_id' => $user2->id,
                    'un_married' => fake()->dateTimeBetween('-5 years', 'today'),
                ]);
            }

            // Har bir foydalanuvchi uchun javoblar va natijalar
            foreach ([$user1, $user2] as $user) {
                $uniqueKey = uniqid($user->id . '_'); // Unique key yaratish

                foreach ($questions as $question) {
                    $answer = UserAnswer::factory()->create([
                        'key' => $uniqueKey,
                        'user_id' => $user->id,
                        'question_id' => $question->id,
                        'answer' => rand(0, 1) ? 'yes' : 'no',
                    ]);

                    // UserResult yaratish
                    UserResult::factory()->create([
                        'user_answers_id' => $answer->id,
                        'result' => round(rand(0, 10000) / 100, 2), // 0-100 orasida double
                    ]);
                }
            }
        }
    }
}
