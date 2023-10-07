<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CourseLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            $randomDateTime = date('Y-m-d H:i:s', strtotime('-130 days', strtotime(now())) + mt_rand(0, 330 * 24 * 3600));
                DB::table('course_logs')->insert([
                    'course_id' => $faker->numberBetween(1, 10), 
                    'instructor_id' => $faker->numberBetween(2, 6),
                    'user_id' => $faker->numberBetween(7, 15),
                    'module_id' => $faker->numberBetween(1, 20),
                    'lesson_id' => $faker->numberBetween(1, 30),
                    'created_at' => $randomDateTime,
                    'updated_at' => now(),
                ]);
            }
    }
}