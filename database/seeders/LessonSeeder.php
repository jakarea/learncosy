<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $faker = Faker::create();
    
            foreach (range(1, 500) as $index) {
                $randomDateTime = date('Y-m-d H:i:s', strtotime('-330 days', strtotime(now())) + mt_rand(0, 330 * 24 * 3600));
                DB::table('lessons')->insert([
                    'course_id' => $faker->numberBetween(1, 50), 
                    'instructor_id' => $faker->numberBetween(3, 15), 
                    'user_id' => $faker->numberBetween(3, 15),
                    'module_id' => $faker->numberBetween(1, 100),
                    'title' => $faker->sentence,
                    'slug' => $faker->slug,
                    'video_link' => $faker->optional()->url,
                    'thumbnail' => 'thumbnail1.png',
                    'short_description' => $faker->paragraph,
                    'status' => $faker->randomElement(['pending', 'published']),
                    'type' => $faker->randomElement(['video', 'text','audio']),
                    'created_at' => $randomDateTime,
                    'updated_at' => now(),
                ]);
            }
    }
}
