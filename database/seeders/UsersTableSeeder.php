<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            $username = str_replace(".", "_", $faker->userName);
            $email = $username.'@yopmail.com';
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $email,
                'user_role' => 'student', // Default user role
                'company_name' => $faker->company,
                'short_bio' => $faker->sentence,
                'phone' => $faker->phoneNumber,
            
                'social_links' => json_encode([
                    'facebook' => $faker->url,
                    'twitter' => $faker->url,
                ]),
                'description' => $faker->paragraph,
                'recivingMessage' => '0',
                'email_verified_at' => now(),
                'password' => bcrypt(1234567890), // You can set a default password
                'stripe_secret_key' => null, // Default value
                'stripe_public_key' => null, // Default value
                'status' => 'active', // Default user status
            ]);
        }
    }
}
