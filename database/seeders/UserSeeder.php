<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'country_code' => $faker->optional(0.7, null)->randomElement(['US', 'CA', 'UK', 'AU']),
                'phone_number' => $faker->optional(0.7, null)->phoneNumber,
                'password' => Hash::make('password'),
            ]);
        }
    }
}

