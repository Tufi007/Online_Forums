<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Answer;
use App\Models\User;
use App\Models\Question;
use Faker\Factory as Faker;

class AnswerSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $faker = Faker::create();

        $users = User::all();
        $questions = Question::all();

        foreach (range(1, 50) as $index) {
            Answer::create([
                'user_id' => $faker->randomElement($users)->id,
                'answer_text' => $faker->paragraph,
                'image' => null,
                'date_time' => $faker->dateTimeThisYear,
                'reference_links' => $faker->url,
                'q_id' => $faker->randomElement($questions)->id,
            ]);
        }
    }
}
