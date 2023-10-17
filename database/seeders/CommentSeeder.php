<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $users = User::all();
        $questions = Question::all();
        $answers = Answer::all();

        foreach (range(1, 50) as $index) {
            Comment::create([
                'comment_text' => $faker->paragraph,
                'user_id' => $faker->randomElement($users)->id,
                'q_id' => $faker->randomElement($questions)->id,
                'a_id' => $faker->randomElement($answers)->id,
            ]);
        }
    }
}
