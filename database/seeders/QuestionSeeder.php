<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Subject;
use App\Models\User;
use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();
        $subjects = Subject::all();

        foreach (range(1, 50) as $index) {
            Question::create([
                'user_id' => $faker->randomElement($users)->id,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'image' => null,
                'date_time' => $faker->dateTimeThisYear,
                's_id' => $faker->randomElement($subjects)->id,
            ]);
        }
    }
}
