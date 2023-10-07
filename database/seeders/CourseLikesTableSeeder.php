<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CourseLikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 15) as $index) {
            $randomDateTime = date('Y-m-d H:i:s', strtotime('-130 days', strtotime(now())) + mt_rand(0, 330 * 24 * 3600));
                DB::table('course_likes')->insert([
                    'course_id' => $faker->numberBetween(1, 10), 
                    'instructor_id' => $faker->numberBetween(2, 6),
                    'user_id' => $faker->numberBetween(7, 19),
                    'created_at' => $randomDateTime,
                    'updated_at' => now(),
                ]);
            }
    }
}