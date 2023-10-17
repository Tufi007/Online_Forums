<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use Faker\Factory as Faker;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            Profile::create([
                'user_id' => $index, // Assuming user_id corresponds to the user
                'profile_picture' => null,
                'street_address' => $faker->streetAddress,
                'state_city' => $faker->city,
                'country' => $faker->country,
                'date_of_birth' => $faker->date,
                'academic_qualification' => $faker->sentence,
                'work_experience' => $faker->paragraph,
                'about_you' => $faker->paragraph,
            ]);
        }
    }
}
