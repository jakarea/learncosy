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
        $randomDateTime = date('Y-m-d H:i:s', strtotime('-330 days', strtotime(now())) + mt_rand(0, 330 * 24 * 3600));
        $links = "https://facebook.com/".$faker->userName.",https://twitter.com/".$faker->userName.",https://instagram.com/".$faker->userName;
        DB::table('users')->insert([
            'name' => 'Mr Admin',
            'email' => 'admin1@yopmail.com',
            'user_role' => 'admin', // Default user role
            'company_name' => $faker->company,
            'short_bio' => $faker->sentence,
            'phone' => $faker->phoneNumber,
            'avatar' => 'assets/images/avatar.png',
            'description' => $faker->paragraph,
            'recivingMessage' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt(1234567890), // You can set a default password
            'stripe_secret_key' => null, // Default value
            'stripe_public_key' => null, // Default value
            'status' => 'active', // Default user status
            //'social_links' => $links,
            'created_at' => $randomDateTime,
            'updated_at' => now(),
        ]);

        foreach (range(1, 5) as $index) {
         $randomDateTime = date('Y-m-d H:i:s', strtotime('-330 days', strtotime(now())) + mt_rand(0, 330 * 24 * 3600));
            $subdomain = $faker->userName;
            $email = 'instructor'.$index.'@yopmail.com';

            $links = "https://facebook.com/".$faker->userName.",https://twitter.com/".$faker->userName.",https://instagram.com/".$faker->userName;
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $email,
                'subdomain' => 'instructor'.$index,
                'user_role' => 'instructor', // Default user role
                'company_name' => $faker->company,
                'short_bio' => $faker->sentence,
                'phone' => $faker->phoneNumber,
                'description' => $faker->paragraph,
                'recivingMessage' => 1,
                'avatar' => 'assets/images/users/'.$faker->numberBetween(1, 20).'.jpeg',
                'email_verified_at' => now(),
                'password' => bcrypt(1234567890), // You can set a default password
                'status' => 'active', // Default user status
                //'social_links' => $links,
                'created_at' => $randomDateTime,
                'updated_at' => now(),

            ]);
        }

        foreach (range(1, 20) as $index) {
            $randomDateTime = date('Y-m-d H:i:s', strtotime('-330 days', strtotime(now())) + mt_rand(0, 330 * 24 * 3600));
            $subdomain = str_replace(".", "_", $faker->userName);
            $email = 'student'.$index.'@yopmail.com';

            //$links = "https://facebook.com/".$subdomain.",https://twitter.com/".$subdomain.",https://instagram.com/".$subdomain;
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $email,
                'user_role' => 'student', // Default user role
                'company_name' => $faker->company,
                'short_bio' => $faker->sentence,
                'phone' => $faker->phoneNumber,
                'description' => $faker->paragraph,
                'recivingMessage' => 1,
                'avatar' => 'assets/images/users/'.$faker->numberBetween(1, 20).'.jpeg',
                'email_verified_at' => now(),
                'password' => bcrypt(1234567890), // You can set a default password
                'status' => 'active', // Default user status
                'social_links' => $links,
                'created_at' => $randomDateTime,
                'updated_at' => now(),
            ]);
        }
    }
}
